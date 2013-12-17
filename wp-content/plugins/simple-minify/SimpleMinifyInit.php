<?php

/**
 * @package Simple Minify
 */
use Assetic\Factory\AssetFactory;
use Assetic\AssetManager;
use Assetic\FilterManager;
use Assetic\Filter\JSMinFilter;
use Assetic\Filter\CssMinFilter;
use Assetic\Filter\CssRewriteFilter;
use Assetic\Filter\ScssphpFilter;
use Assetic\Filter\CoffeeScriptFilter;
use Assetic\Filter\CompassFilter;
use Assetic\Filter\LessphpFilter;
use Assetic\Cache\FilesystemCache;
use Assetic\Asset\StringAsset;

/**
 * Class that holds plugin's logic.
 */
class SimpleMinifyInit {

    public $js;
    public $css;
    protected $exclusions;
    protected $assetsPath;
    protected $assetsUrl;
    protected $jsFilters = array();
    protected $cssFilters = array();
    protected $styles = array();
    protected $mTimesStyles = array();
    protected $sass = array();
    protected $mTimesSass = array();
    protected $less = array();
    protected $mTimesLess = array();
    protected $scripts = array('header' => array(), 'footer' => array());
    protected $mTimes = array('header' => array(), 'footer' => array());
    protected $coffee = array('header' => array(), 'footer' => array());
    protected $mTimesCoffee = array('header' => array(), 'footer' => array());
    protected $jsMin = 'JSMin';
    protected $cssMin = 'CssMin';

    /**
     * Constructor of the class
     */
    public function __construct() {

        //Init assetic's object to manage js minify
        $this->js = new AssetFactory(ABSPATH);
        $this->js->setAssetManager(new AssetManager);
        $this->js->setFilterManager(new FilterManager);

        //Init assetic's object to manage css minify
        $this->css = new AssetFactory(ABSPATH);
        $this->css->setAssetManager(new AssetManager);
        $this->css->setFilterManager(new FilterManager);

        //Defines filter for js minify
        $this->js->getFilterManager()->set($this->jsMin, new JSMinFilter);
        $this->jsFilters [] = $this->jsMin;

        //Defines filter for css minify
        $this->css->getFilterManager()->set($this->cssMin, new CssMinFilter);
        $this->css->getFilterManager()->set('CssRewrite', new CssRewriteFilter);
        $this->cssFilters [] = $this->cssMin;

        //Define assets path to save asseticized files
        $uploadsDir = wp_upload_dir();
        $this->assetsUrl = str_replace('http://', '//', $uploadsDir['baseurl']) . '/am_assets/';
        $this->assetsPath = $uploadsDir['basedir'] . '/am_assets/';

        if (!is_dir($this->assetsPath)) //Creates the AM cache dir
            mkdir($this->assetsPath, 0777);
        elseif (get_option('am_last_gc', 0) <= time() - 864000) //Every 10 days the garbage collector is called
            $this->gc();

        //Manager for Filesystem management
        $this->cache = new FilesystemCache($this->assetsPath);

        $this->exclusions = preg_split('/[ ]*,[ ]*/', trim(get_option('am_files_to_exclude')));

        //Detects all js and css added to WordPress and removes their inclusion
        if (get_option('am_compress_styles', 1))
            add_action('wp_print_styles', array($this, 'extractStyles'), 1000);
        add_action('wp_footer', array($this, 'extractStyles'), 2);
        if (get_option('am_compress_scripts', 1))
            add_action('wp_print_scripts', array($this, 'extractScripts'), 1000);
        add_action('wp_footer', array($this, 'extractScripts'), 1);


        //Inclusion of scripts in <head> and before </body>
        add_action('wp_head', array($this, 'headerServe'));
        add_action('wp_footer', array($this, 'footerServe'));
    }

    /**
     * Garbage collector for 10 days old files
     */
    public function gc() {
        update_option('am_last_gc', time());
        foreach (glob("{$this->assetsPath}*.*") as $filepath)
            if (filemtime($filepath) <= time() - 864000) //If the file is older than 10 days then is removed
                unlink($filepath);
    }

    /**
     * Guess absolute path from file URL
     */
    public function guessPath($file_url, $handle) {
        global $wp_scripts;
        global $wp_styles;

        $components = parse_url($file_url);
        // Check we have at least a path
        if (!isset($components['path']))
            return false;

        $file_path = false;

        $wp_content_dirname = str_replace(ABSPATH, '', WP_CONTENT_DIR);
        $wp_plugin_dirname = str_replace(ABSPATH, '', WP_PLUGIN_DIR);

        if (isset($components['scheme'])) {
            $plugin_url = str_replace($components['scheme'] . '://', '', WP_PLUGIN_URL);
            $content_url = str_replace($components['scheme'] . '://', '', WP_CONTENT_URL);

            // External ressources
            if ($this->is_external($file_url, $handle)) {
                return $this->create_external_asset($file_url, $handle);
            }

            // Script is enqueued from a plugin
            if (strpos($file_url, $plugin_url) !== false) {
                $search = array($wp_plugin_dirname, '//');
                $replace = array('', '/');
                $file_path = WP_PLUGIN_DIR . str_replace($search, $replace, $components['path']);
            }

            // Script is enqueued from a theme
            elseif (strpos($file_url, $content_url) !== false) {
                $search = array($wp_content_dirname, '//');
                $replace = array('', '/');
                $file_path = WP_CONTENT_DIR . str_replace($search, $replace, $components['path']);
            }
        }

        // Script is enqueued from wordpress
        if (strpos($file_url, WPINC) !== false)
            $file_path = untrailingslashit(ABSPATH) . $file_url;
        return $file_path;
    }
    /**
     * Create the external folder in cache folder
     *
     * @return boolean 
     */
    private function create_external_assets_folder() {
        // Create external folder if not exists
        $this->external_assetsPath = $this->assetsPath . 'external/';
        $this->external_assetsUrl = $this->assetsUrl . 'external/';
        if (!is_dir($this->external_assetsPath)) {
            return mkdir($this->external_assetsPath, 0777);
        }
        return true;
    }

    /**
     * Checks if the file is an external and allowed resource
     *
     * @param string $file_url The file url
     * @param string $handle The handle
     */
    protected function is_external($file_url, $handle) {
        global $wp_scripts;
        
        // check if it is an external resources
        if (strpos($file_url, $_SERVER['SERVER_NAME']) !== false) {
            return false;
        }
        
        // Check if we're allowed to compresse styles and scripts 
        $type = isset($wp_scripts->registered[$handle]) ? 'scripts' : 'styles';
        $parsed_url = parse_url($file_url);
        $domain = $parsed_url['host'];
        if (get_option('am_compress_external_' . $type, 1) != 1) {
            return false;
        }
        
        // Check the allowed domains
        $allow_include = get_option('am_' . $type . '_to_include', '');

        if (empty($allow_include)) {
            return false;
        }
        return in_array($domain, explode(',', $allow_include));
    }

    /**
     * Create the external resources
     *
     * @param string $file_url The file url
     * @param string $handle The handle
     */
    protected function create_external_asset($file_url, $handle) {
        
        // Check if the external folder exists
        if (!$this->create_external_assets_folder()) {
            return $file_url;
        }

        $file_name = basename(md5($file_url));
        $ext = pathinfo($file_url, PATHINFO_EXTENSION);
        $final_ext = !empty($ext) ? '.' . $ext : '';
        $local_file_path = $this->external_assetsPath . $file_name . $final_ext;
        
        // Copy the external source in cache folder
        if (!is_file($local_file_path)) {
            $file_response = wp_remote_get($file_url);

            if (is_wp_error($file_response) || wp_remote_retrieve_response_code($file_response) >= 400) {
                return $file_url;
            }

            file_put_contents($local_file_path, wp_remote_retrieve_body($file_response));
        }

        wp_deregister_script($handle);
        return $local_file_path;
    }

    /**
     * Checks if the file is within the list of "to exclude" resources
     *
     * @param string $path The file path
     * @return boolean Whether the file is to exclude or not
     */
    protected function isFileExcluded($path) {
        $filename = explode('/', $path);
        if (in_array($filename[count($filename) - 1], $this->exclusions))
            return true;

        return false;
    }

    /**
     * Takes all the scripts enqueued to the theme and removes them from the queue
     */
    public function extractScripts() {
        global $wp_scripts;
        if (empty($wp_scripts->queue))
            return;

        // Trigger dependency resolution
        $wp_scripts->all_deps($wp_scripts->queue);

        foreach ($wp_scripts->to_do as $key => $handle) {

            if ($this->isFileExcluded($wp_scripts->registered[$handle]->src))
                continue;

            $script_path = $this->guessPath($wp_scripts->registered[$handle]->src, $handle);

            // Script didn't match any case (plugin, theme or wordpress locations)
            if ($script_path === false)
                continue;

            $where = 'footer';
            //Conditions for respect the hierarchy of the scripts
            if (empty($wp_scripts->registered[$handle]->extra))
                $where = 'header';

            if (!empty($wp_scripts->registered[$handle]->extra) && empty($wp_scripts->registered[$handle]->extra['group']))
                $where = 'header';

            if (!empty($wp_scripts->registered[$handle]->extra['group']) && $wp_scripts->registered[$handle]->extra['group'] == 1)
                $where = 'footer';

            if (did_action('assetsminify_extractscripts')) {
                $where = 'footer';
            }

            if (empty($script_path) || !is_file($script_path))
                continue;

            //Separation between css-frameworks stylesheets and .css stylesheets
            $ext = substr($script_path, -7);

            if ($ext === '.coffee') {
                $this->coffee[$where][$handle] = $script_path;
                $this->mTimesCoffee[$where][$handle] = filemtime($this->coffee[$where][$handle]);
            } else {
                $this->scripts[$where][$handle] = $script_path;
                $this->mTimes[$where][$handle] = filemtime($this->scripts[$where][$handle]);
            }

            //Removes scripts from the queue so this plugin will be
            //responsible to include all the scripts except other domains ones.
            $wp_scripts->dequeue($handle);

            //Move the handle to the done array.
            $wp_scripts->done[] = $handle;

            unset($wp_scripts->to_do[$key]);
        }
        do_action('assetsminify_extractscripts');
    }

    /**
     * Takes all the stylesheets enqueued to the theme and removes them from the queue
     */
    public function extractStyles() {

        global $wp_styles;
        if (empty($wp_styles->queue))
            return;

        // Trigger dependency resolution
        $wp_styles->all_deps($wp_styles->queue);

        foreach ($wp_styles->to_do as $key => $handle) {

            if ($this->isFileExcluded($wp_styles->registered[$handle]->src))
                continue;

            //Removes absolute part of the path if it's specified in the src
            $style_path = $this->guessPath($wp_styles->registered[$handle]->src, $handle);
            $media = $wp_styles->registered[$handle]->args;

            if (empty($media))
                $media = 'all';

            // Script didn't match any case (plugin, theme or wordpress locations)
            if ($style_path == false)
                continue;

            if (!file_exists($style_path))
                continue;

            //Separation between css-frameworks stylesheets and .css stylesheets
            $ext = substr($style_path, -5);
            if (in_array($ext, array('.sass', '.scss'))) {
                $this->sass[$media][$handle] = $style_path;
                $this->mTimesSass[$media][$handle] = filemtime($this->sass[$media][$handle]);
            } elseif ($ext == '.less') {
                $this->less[$media][$handle] = $style_path;
                $this->mTimesLess[$media][$handle] = filemtime($this->less[$media][$handle]);
            } else {
                $this->styles[$media][$handle] = $style_path;
                $this->mTimesStyles[$media][$handle] = filemtime($this->styles[$media][$handle]);
            }

            //Removes css from the queue so this plugin will be
            //responsible to include all the stylesheets except other domains ones.
            $wp_styles->dequeue($handle);
            //Move the handle to the done array.
            $wp_styles->done[] = $handle;
            unset($wp_styles->to_do[$key]);
        }
        do_action('assetsminify_extractstyles');
    }

    /**
     * Returns header's inclusion for CSS and JS (if provided)
     */
    public function headerServe() {

        //Compiles CSS stylesheets
        $this->generateCss();

        //Compiles SASS stylesheets
        $this->generateSass();

        //Compiles LESS stylesheets
        $this->generateLess();

        //Manages the stylesheets
        if (!empty($this->styles)) {
            $mtime = is_string($this->mTimesStyles) ? md5(implode('&', $this->mTimesStyles)) : $this->mTimesStyles;

            //Prints css inclusion in the page
            foreach ($this->styles as $media => $style) {
                if (!empty($style['styles-am-generated'])) {
                    $this->dumpCss($style['styles-am-generated'], $media);
                }

                if (!empty($style['sass-am-generated'])) {
                    $this->dumpCss($style['sass-am-generated'], $media);
                }

                if (!empty($style['less-am-generated'])) {
                    $this->dumpCss($style['less-am-generated'], $media);
                }
            }
        }

        //Manages the scripts from CoffeeScript to be printed in the header
        $this->generateCoffee('header');

        //Manages the scripts to be printed in the header
        $this->headerServeScripts();

        //Clear the cache styles for the footer
        unset($this->styles, $this->less, $this->sass);
    }

    /**
     * Takes all the SASS stylesheets and manages their queue to asseticize them
     */
    public function generateSass() {
        if (empty($this->sass))
            return false;


        $styles_r = $this->sass;

        foreach ($styles_r as $media => $styles) {
            $mtime = md5(implode('&', $this->mTimesSass[$media]));

            //If SASS stylesheets have been updated -> compass compile
            $media = sanitize_title($media);
            if (!$this->cache->has("sass-{$media}-{$mtime}.css")) {

                if (get_option('am_use_compass', 0) != 0) {
                    //Defines compass filter instance and sprite images paths
                    $compassInstance = new CompassFilter(get_option('am_compass_path', '/usr/bin/compass'));
                    $compassInstance->setImagesDir(get_theme_root() . "/" . get_template() . "/images");
                    $compassInstance->setGeneratedImagesPath($this->assetsPath);
                    $compassInstance->setHttpGeneratedImagesPath(str_replace(ABSPATH, '', $this->assetsPath));
                    $this->css->getFilterManager()->set('Compass', $compassInstance);
                    $filter = 'Compass';
                } else {
                    $this->css->getFilterManager()->set('Scssphp', new ScssphpFilter);
                    $filter = 'Scssphp';
                }

                //Saves the asseticized stylesheets
                @$this->cache->set("sass-{$media}-{$mtime}.css", $this->css->createAsset($styles, array($filter, 'CssRewrite', $this->cssMin), array('output' => WP_CONTENT_DIR . "/"))->dump());
            }

            //Adds SASS compiled stylesheet to normal css queue
            $this->styles[$media]['sass-am-generated'] = "sass-{$media}-{$mtime}.css";
            $this->mTimesStyles[$media]['sass-am-generated'] = filemtime($this->assetsPath . $this->styles[$media]['sass-am-generated']);
        }
    }

    /**
     * Takes all the LESS stylesheets and manages their queue to asseticize them
     */
    public function generateLess() {
        if (empty($this->less))
            return false;

        $styles_r = $this->less;

        foreach ($styles_r as $media => $styles) {
            $mtime = md5(implode('&', $this->mTimesLess[$media]));

            //If LESS stylesheets have been updated compile them
            $media = sanitize_title($media);
            if (!$this->cache->has("less-{$media}-{$mtime}.css")) {
                //Defines compass filter instance and sprite images paths
                $this->css->getFilterManager()->set('Lessphp', new LessphpFilter);

                //Saves the asseticized stylesheets
                @$this->cache->set("less-{$media}-{$mtime}.css", $this->css->createAsset($styles, array('Lessphp', 'CssRewrite', $this->cssMin), array('output' => WP_CONTENT_DIR . "/"))->dump());
            }

            //Adds LESS compiled stylesheet to normal css queue
            $this->styles[$media]['less-am-generated'] = "less-{$media}-{$mtime}.css";
            $this->mTimesStyles[$media]['less-am-generated'] = filemtime($this->assetsPath . $this->styles[$media]['less-am-generated']);
        }
    }

    /**
     * Takes all the CSS stylesheets and manages their queue to asseticize them
     */
    public function generateCss() {

        if (empty($this->styles))
            return false;

        $styles_r = $this->styles;

        foreach ($styles_r as $media => $styles) {
            $mtime = md5(implode('&', $this->mTimesStyles[$media]));


            //If CSS stylesheets have been updated compile and save them
            $media = sanitize_title($media);
            if (!$this->cache->has("styles-{$media}-{$mtime}.css")) {
                @$this->cache->set("styles-{$media}-{$mtime}.css", $this->css->createAsset($styles, array('CssRewrite', $this->cssMin), array('output' => WP_CONTENT_DIR . "/"))->dump());
            }

            //Adds CSS compiled stylesheet to normal css queue
            $this->styles[$media] = array('styles-am-generated' => "styles-{$media}-{$mtime}.css");
            $this->mTimesStyles[$media] = array('styles-am-generated' => filemtime($this->assetsPath . $this->styles[$media]['styles-am-generated']));
        }
    }

    /**
     * Returns coffeescript inclusions for JS (if provided)
     */
    public function generateCoffee($type) {
        if (empty($this->coffee[$type]))
            return false;

        $mtime = md5(implode('&', $this->mTimesCoffee[$type]) . implode('&', $this->coffee[$type]));

        //Saves the asseticized header scripts
        if (!$this->cache->has("{$type}-cs-{$mtime}.js")) {
            $this->js->getFilterManager()->set('CoffeeScriptFilter', new CoffeeScriptFilter(get_option('am_coffeescript_path', '/usr/bin/coffee')));
            $this->cache->set("{$type}-cs-{$mtime}.js", $this->js->createAsset($this->coffee[$type], array($this->jsMin, 'CoffeeScriptFilter'))->dump());
        }


        //Adds Coffeescript compiled stylesheet to normal js queue
        $script = $this->assetsPath . "{$type}-cs-{$mtime}.js";
        $this->scripts[$type][] = $script;
        $this->mTimes[$type][] = filemtime($script);
    }

    /**
     * Returns header's inclusion for JS (if provided)
     */
    public function headerServeScripts() {
        if (empty($this->scripts['header']))
            return false;

        $mtime = md5(implode('&', $this->mTimes['header']) . implode('&', $this->scripts['header']));

        //Saves the asseticized header scripts
        if (!$this->cache->has("head-{$mtime}.js"))
            $this->cache->set("head-{$mtime}.js", $this->js->createAsset($this->scripts['header'], $this->jsFilters)->dump());

        //Prints <script> inclusion in the page
        $this->dumpScriptData('header');
        $this->dumpJs("head-{$mtime}.js", false);
    }

    /**
     * Returns footer's inclusion for JS (if provided)
     */
    public function footerServe() {

        // Process Styles
        //Compiles CSS stylesheets
        $this->generateCss();

        //Compiles SASS stylesheets
        $this->generateSass();

        //Compiles LESS stylesheets
        $this->generateLess();

        //Manages the stylesheets
        if (!empty($this->styles)) {
            $mtime = is_string($this->mTimesStyles) ? md5(implode('&', $this->mTimesStyles)) : $this->mTimesStyles;

            //Prints css inclusion in the page
            foreach ($this->styles as $media => $style) {
                if (!empty($style['styles-am-generated'])) {
                    $this->dumpCss($style['styles-am-generated'], $media);
                }

                if (!empty($style['sass-am-generated'])) {
                    $this->dumpCss($style['sass-am-generated'], $media);
                }

                if (!empty($style['less-am-generated'])) {
                    $this->dumpCss($style['less-am-generated'], $media);
                }
            }
        }


        // Process Scripts
        //Manages the scripts from CoffeeScript to be printed in the footer
        $this->generateCoffee('footer');

        if (empty($this->scripts['footer']))
            return false;

        $mtime = md5(implode('&', $this->mTimes['footer']) . implode('&', $this->scripts['footer']));

        //Saves the asseticized footer scripts
        if (!$this->cache->has("foot-{$mtime}.js"))
            $this->cache->set("foot-{$mtime}.js", $this->js->createAsset($this->scripts['footer'], $this->jsFilters)->dump());

        //Prints <script> inclusion in the page
        $this->dumpScriptData('footer');
        $this->dumpJs("foot-{$mtime}.js");
    }

    /**
     * Combines the script data from all minified scripts
     */
    protected function buildScriptData($where) {
        global $wp_scripts;
        $data = '';

        if (empty($this->scripts[$where]))
            return '';

        foreach ($this->scripts[$where] as $handle => $filepath) {
            $data .= $wp_scripts->print_extra_script($handle, false);
        }

        $asset = new StringAsset($data, array(new JSMinFilter));

        return $asset->dump();
    }

    /**
     * Prints <script> tag to include the JS
     */
    protected function dumpJs($filename, $async = true) {
        echo "<script type='text/javascript' src='" . $this->assetsUrl . $filename . "'" . ($async ? " async" : "") . "></script>\n";
    }

    /**
     * Prints <link> tag to include the CSS
     */
    protected function dumpCss($filename, $media = 'all') {
        if (empty($media)) {
            $media = 'all';
        }
        echo "<link href='" . $this->assetsUrl . $filename . "' media='" . $media . "' rel='stylesheet' type='text/css'>\n";
    }

    /**
     * Prints <script> tags with addtional script data and i10n
     */
    protected function dumpScriptData($where) {
        $data = $this->buildScriptData($where);

        if (empty($data))
            return false;

        echo "<script type='text/javascript'>\n"; // CDATA and type='text/javascript' is not needed for HTML 5
        echo "/* <![CDATA[ */\n";
        echo "$data\n";
        echo "/* ]]> */\n";
        echo "</script>\n";
    }

}

new SimpleMinifyInit;
