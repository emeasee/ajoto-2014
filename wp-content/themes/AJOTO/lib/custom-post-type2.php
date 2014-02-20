<?php
/* Refining the shop database custom post type in Wordpress*/

// let's create the function for the custom type
function custom_post2_example() { 
	// creating (registering) the custom type 
	register_post_type( 'shops', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Shops', 'post type general name'), /* This is the Title of the Group */
			'singular_name' => __('Entry', 'post type singular name'), /* This is the individual type */
			'add_new' => __('Add New', 'custom post type item'), /* The add new menu item */
			'add_new_item' => __('Add New Shop'), /* Add New Display Title */
			'edit' => __( 'Edit' ), /* Edit Dialog */
			'edit_item' => __('Edit Shop Entry'), /* Edit Display Title */
			'new_item' => __('New Shop'), /* New Display Title */
			'view_item' => __('View Shop'), /* View Display Title */
			'search_items' => __('Search Shop'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Holds our Shop list' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/assets/images/custom_1.png', /* the icon for the custom post type menu */
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'thumbnail', 'revisions')
	 	) /* end of options */
	); /* end of register post type */
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post2_example');
	
	// now let's add custom categories (these act like categories)
    register_taxonomy( 'custom_tag_s', 
    	array('shops'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true it acts like categories  */             
    		'labels' => array(
    			'name' => __( 'Country' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Country' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Countries' ), /* search title for taxomony */
    			'all_items' => __( 'All Countries' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Country' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Country:' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Country' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Country' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Country' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Country Name' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    	)
    );   
    
	// now let's add custom tags (these act like categories)
    register_taxonomy( 'custom_cat_s', 
    	array('shops'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
    		'labels' => array(
    			'name' => __( 'City' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'City' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Cities' ), /* search title for taxomony */
    			'all_items' => __( 'All Cities' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent City' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent City:' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit City' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update City' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New City' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New City Name' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    	)
    ); 

    add_action( 'add_meta_boxes', 'shop_box' );
    function shop_box() {
        add_meta_box( 
            'shop_details',
            __( 'Enter details below for the Shop contact', 'shop-details' ),
            'shop_box_content',
            'shops',
            'normal',
            'high'
        );
    }

    add_action( 'add_meta_boxes', 's_info_box' );
    function s_info_box() {
        add_meta_box( 
            'shop_info',
            __( 'Enter text for the Shop info page', 'shop-info' ),
            'shop_info_content',
            'shops',
            'normal',
            'high'
        );
    }

    add_action( 'add_meta_boxes', 's_position_box' );
    function s_position_box() {
        add_meta_box( 
            'pin_details',
            __( 'Enter the x-y coordinates for the map', 'pin-details' ),
            's_pin_position',
            'shops',
            'side',
            'high'
        );
    }

/* Display the post meta box. */
function shop_box_content( $object, $box ) { ?>

    <?php wp_nonce_field( basename( __FILE__ ), 'shops_nonce' ); ?> 
    <p>
        <h2>Shop Address</h2>
        <label for="address-1"><?php _e( "Address Line 1", 'example' ); ?></label>
        <input class="widefat" type="text" name="address-1" id="address-1" value="<?php echo esc_attr( get_post_meta( $object->ID, 'address-1', true ) ); ?>" size="30" />
        <br/><br/>
        <label for="address-2"><?php _e( "Address Line 2", 'example' ); ?></label>
        <input class="widefat" type="text" name="address-2" id="address-2" value="<?php echo esc_attr( get_post_meta( $object->ID, 'address-2', true ) ); ?>" size="30" />
        <br/><br/>
        <label for="city"><?php _e( "City", 'example' ); ?></label>
        <input class="widefat" type="text" name="city" id="city" value="<?php echo esc_attr( get_post_meta( $object->ID, 'city', true ) ); ?>" size="30" />
        <br/><br/>
        <label for="postcode"><?php _e( "Postcode", 'example' ); ?></label>
        <input class="widefat" type="text" name="postcode" id="postcode" value="<?php echo esc_attr( get_post_meta( $object->ID, 'postcode', true ) ); ?>" size="30" />
        <br/><br/>
        <label for="country"><?php _e( "Country", 'example' ); ?></label>
        <input class="widefat" type="text" name="country" id="country" value="<?php echo esc_attr( get_post_meta( $object->ID, 'country', true ) ); ?>" size="30" />
    </p>
    <p>
        <h2>Contact Details</h2>
        <label for="website"><?php _e( "Website Address", 'example' ); ?></label>
        <input class="widefat" type="text" name="website" id="website" value="<?php echo esc_attr( get_post_meta( $object->ID, 'website', true ) ); ?>" size="30" />
        <br/><br/>
        <label for="contact"><?php _e( "Company Contact", 'example' ); ?></label>
        <input class="widefat" type="text" name="contact" id="contact" value="<?php echo esc_attr( get_post_meta( $object->ID, 'contact', true ) ); ?>" size="30" />
        <br/><br/>
        <label for="phone"><?php _e( "Phone Number", 'example' ); ?></label>
        <input class="widefat" type="text" name="phone" id="phone" value="<?php echo esc_attr( get_post_meta( $object->ID, 'phone', true ) ); ?>" size="30" />
        <br/><br/>
        <label for="email"><?php _e( "Email Address", 'example' ); ?></label>
        <input class="widefat" type="text" name="email" id="email" value="<?php echo esc_attr( get_post_meta( $object->ID, 'email', true ) ); ?>" size="30" />
    </p>
<?php }

/* Display the post meta box. */
function shop_info_content( $object, $box ) { ?>

    <?php wp_nonce_field( basename( __FILE__ ), 'info_nonce' ); ?> 
    <p>
        <h2>Enter text</h2>
        <label for="history"><?php _e( "History", 'example' ); ?></label>
        <textarea class="widefat" type="text" name="history" id="history" value="<?php echo esc_attr( get_post_meta( $object->ID, 'history', true ) ); ?>" rows="5"></textarea>
        <br/><br/>
        <label for="what"><?php _e( "What They Do", 'example' ); ?></label>
        <textarea class="widefat" type="text" name="what" id="what" value="<?php echo esc_attr( get_post_meta( $object->ID, 'what', true ) ); ?>" rows="5"></textarea>
        <br/><br/>
        <label for="why"><?php _e( "Why", 'example' ); ?></label>
        <textarea class="widefat" type="text" name="why" id="why" value="<?php echo esc_attr( get_post_meta( $object->ID, 'why', true ) ); ?>" rows="5"></textarea>
        <br/><br/>
        <label for="vision"><?php _e( "Vision", 'example' ); ?></label>
        <textarea class="widefat" type="text" name="vision" id="vision" value="<?php echo esc_attr( get_post_meta( $object->ID, 'vision', true ) ); ?>" rows="5"></textarea>
        <br/><br/>
        <label for="slides"><?php _e( "Royalslider ID number", 'example' ); ?></label>
        <input class="widefat" type="text" name="slides" id="slides" value="<?php echo esc_attr( get_post_meta( $object->ID, 'slides', true ) ); ?>" size="30" />
    </p>


<?php }

function s_pin_position( $object, $box ) { ?>
    <?php wp_nonce_field( basename( __FILE__ ), 'pin_nonce' ); ?> 
    <p>
        <h2>Pin Position</h2>
        <label for="posx"><?php _e( "Position X", 'example' ); ?></label>
        <input class="widefat" type="text" name="posx" id="posx" value="<?php echo esc_attr( get_post_meta( $object->ID, 'posx', true ) ); ?>" size="30" />
        <br/><br/>
        <label for="posy"><?php _e( "Position Y", 'example' ); ?></label>
        <input class="widefat" type="text" name="posy" id="posy" value="<?php echo esc_attr( get_post_meta( $object->ID, 'posy', true ) ); ?>" size="30" />
    </p>
<?php }

function shop_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'shops_nonce' ] ) && wp_verify_nonce( $_POST[ 'shops_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'address-1' ] ) ) {
        update_post_meta( $post_id, 'address-1', sanitize_text_field( $_POST[ 'address-1' ] ) );
    }
    if( isset( $_POST[ 'address-2' ] ) ) {
        update_post_meta( $post_id, 'address-2', sanitize_text_field( $_POST[ 'address-2' ] ) );
    }
    if( isset( $_POST[ 'city' ] ) ) {
        update_post_meta( $post_id, 'city', sanitize_text_field( $_POST[ 'city' ] ) );
    }
    if( isset( $_POST[ 'postcode' ] ) ) {
        update_post_meta( $post_id, 'postcode', sanitize_text_field( $_POST[ 'postcode' ] ) );
    }
    if( isset( $_POST[ 'country' ] ) ) {
        update_post_meta( $post_id, 'country', sanitize_text_field( $_POST[ 'country' ] ) );
    }
    if( isset( $_POST[ 'website' ] ) ) {
        update_post_meta( $post_id, 'website', sanitize_text_field( $_POST[ 'website' ] ) );
    }
    if( isset( $_POST[ 'contact' ] ) ) {
        update_post_meta( $post_id, 'contact', sanitize_text_field( $_POST[ 'contact' ] ) );
    }
    if( isset( $_POST[ 'phone' ] ) ) {
        update_post_meta( $post_id, 'phone', sanitize_text_field( $_POST[ 'phone' ] ) );
    }
    if( isset( $_POST[ 'email' ] ) ) {
        update_post_meta( $post_id, 'email', sanitize_text_field( $_POST[ 'email' ] ) );
    }

 
} // end example_meta_save()
add_action( 'save_post', 'shop_meta_save' );

function s_position_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'pin_nonce' ] ) && wp_verify_nonce( $_POST[ 'pin_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ 'posx' ] ) ) {
        update_post_meta( $post_id, 'posx', sanitize_text_field( $_POST[ 'posx' ] ) );
    }
    if( isset( $_POST[ 'posy' ] ) ) {
        update_post_meta( $post_id, 'posy', sanitize_text_field( $_POST[ 'posy' ] ) );
    }
}
add_action( 'save_post', 's_position_meta_save' );


function s_info_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'info_nonce' ] ) && wp_verify_nonce( $_POST[ 'info_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ 'history' ] ) ) {
        update_post_meta( $post_id, 'history', sanitize_text_field( $_POST[ 'history' ] ) );
    }
    if( isset( $_POST[ 'what' ] ) ) {
        update_post_meta( $post_id, 'what', sanitize_text_field( $_POST[ 'what' ] ) );
    }
    if( isset( $_POST[ 'why' ] ) ) {
        update_post_meta( $post_id, 'why', sanitize_text_field( $_POST[ 'why' ] ) );
    }
    if( isset( $_POST[ 'vision' ] ) ) {
        update_post_meta( $post_id, 'vision', sanitize_text_field( $_POST[ 'vision' ] ) );
    }
    if( isset( $_POST[ 'slides' ] ) ) {
        update_post_meta( $post_id, 'slides', sanitize_text_field( $_POST[ 'slides' ] ) );
    }
}
add_action( 'save_post', 's_info_meta_save' );


function add_shop_columns($columns) {
    return array_merge($columns, 
              array('website' => __('Website'),
                    'contact' =>__( 'Contact'),
                    'phone' =>__( 'Phone Number'),
                    'email' =>__( 'Email')));
}
add_filter( 'manage_shops_posts_columns', 'add_shop_columns');

function custom_shops_columns( $column ) {
    global $post;
    switch ( $column ) {
        case 'website':
        echo get_post_meta( $post->ID , 'website' , true );
        break;

      case 'contact':
        echo get_post_meta( $post->ID , 'contact' , true ); 
        break;

      case 'phone':
        echo get_post_meta( $post->ID , 'phone' , true ); 
        break;
    
      case 'email':
        echo get_post_meta( $post->ID , 'email' , true ); 
        break;  
    }
}
add_action( 'manage_shops_posts_custom_column' , 'custom_shops_columns' );


	

?>