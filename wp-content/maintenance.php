<?php
$protocol = $_SERVER["SERVER_PROTOCOL"];
if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol )
    $protocol = 'HTTP/1.0';
header( "$protocol 503 Service Unavailable", true, 503 );
header( 'Content-Type: text/html; charset=utf-8' );
?>
<!doctype html>  
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        
         <title>AJOTO / Undergoing Maintenance</title>

        <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,700,900' rel='stylesheet' type='text/css'>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>


        <style>
/************ Main Styles ************/ 
            html{
                font-size: 100%;
                height:100%;
                overflow-y: scroll;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }
            body {
              margin: 0;
              font-family: 'Futura';
              font-size: 1em;
              line-height: 1.5;
              color: #565656;
              background: url('http://ajoto.com/maintenance/images/main_bg.gif') repeat;
              width: 100%;
              overflow: visible;
              -webkit-font-smoothing: antialiased;
            }
            a,
            a:visited {
              color: #612e59;
            }
            a:visited:link {
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }
            a:hover,
            a:active {
              outline: 0;
            }
            h1 {
              font-size: 2em;
              text-align: center;
              font-weight: normal;
            }
            h1,
            .h1 {
              line-height: 1.8em;
            }
            h2{
                font-size: 1.5em;
            }
            b,
            strong {
              font-weight: bold;
            }
            blockquote {
              margin: 0;
            }
            pre,
            code,
            kbd,
            samp {
              font-family: monospace, serif;
              _font-family: 'courier new', monospace;
              font-size: 1em;
            }
            small {
              font-size: 75%;
            }
            ul{
                list-style: none;
                list-style-image: none;
            }

            .sans-serif {
              font-family: 'Futura';
              letter-spacing: 2px;
            }
            .serif {
              font-family: 'Merriweather', serif;
              letter-spacing: normal;
            }

/************* Header Styles *************/
            .header {
              text-align: center;
              top: 0;
              left: 0;
              right: 0;
              width: 100%;
              z-index: 1000;
              background: white;
            }
            #inner-header {
              width: 100%;
              height: 80px;
            }
            p#logo {
              margin: 0;
              padding: 0;
              height: 100%;
            }
            p#logo img {
              margin-top: 1.6em;
              height: 25%;
            }

/************* Navigation Styles *************/
            .menu {
              width: 100%;
              height: 30px;
              background: #f0f0f0;
              letter-spacing: 2px;
            }
            .menu ul {
              max-width: 850px;
              height: 100%;
              display: block;
            }
            .menu ul li {
              float: left;
              height: 100%;
              text-transform: uppercase;
            }
            .menu ul li a {
              display: block;
              text-decoration: none;
              height: 100%;
              padding: 0px 1.3em;
              font-size: 0.65em;
              line-height: 3.2em;
              color: #323333;
            }
            .menu ul li a:hover,
            .menu ul li a:focus {
              background: #dedede;
            }
            .menu ul li ul.sub-menu,
            .menu ul li ul.children {
              display: none;
            }
            .menu ul li ul.sub-menu li,
            .menu ul li ul.children li {
              background: #f0f0f0;
            }
            .menu ul .right {
              float: right;
            }
            .menu ul .shop {
              font-family: "Merriweather";
              letter-spacing: normal;
              font-size: 0.9em;
              font-style: italic;
            }
            .menu ul .shop a {
              line-height: 2.8em;
            }
            
/************* Page Styles *************/ 
            #container {
              width: 100%;
            }
            .wrap {
              width: 90%;
              margin: 0 auto;
            }
            #content {
              margin: 0 auto;
              width: 910px;
              background: #fff;
              padding-top: 30px;
              padding-bottom: 40px;
              border: 1px solid #f9f9f9;
              overflow: hidden;
            }
            #content section {
              margin: 0 auto;
              text-align: center;
              max-width: 850px;
            }
            #content section p.italic {
              font-style: italic;
              padding-bottom: 25px;
            }
            #content section.title {
              height: auto;
              width: 95%;
              position: relative;
            }
            #content section.title p {
              font-size: 1.6em;
              padding: 41px;
              border-top: 1px solid #323333;
              border-bottom: 1px solid #323333;
            }
            #content section.title p span {
              font-style: normal;
              font-size: 0.45em;
              padding-top: 10px;
              letter-spacing: 1px;
            }
            #content section.title a.arrow {
              width: 35px;
              height: 70px;
              background-image: url('http://ajoto.com/maintenance/images/controls-sprite-black.png');
              top: 50%;
              margin-top: -37px;
              cursor: pointer;
              display: block;
              position: absolute;
              z-index: 25;
            }
            #content section.title a.arrow.left {
              background-position: top left;
              left: 0;
            }
            #content section.title a.arrow.right {
              background-position: top right;
              right: 0;
            }
            #content section.title span.number {
              position: absolute;
              top: 10px;
              left: 48%;
              color: #d5d5d5;
            }
            #content section.title.small p {
              font-size: 1.14em;
              font-style: normal;
              line-height: 2.8em;
              padding: 0;
              text-transform: uppercase;
              border: none;
              background-color: #f9f9f9;
              margin: 20px 0 10px 0;
            }
            .meta {
              color: #999;
            }

/************* Post Content Styles *************/
            .post-content {
              text-align: center;
              margin: 0 auto;
              width: 100%;
              padding-top: 40px;
            }
            .post-content .textblock {
              width: 70%;
              margin: 0 auto;
              min-height: 200px;
            }
            .post-content .textblock p {
              width: 100%;
              padding: 30px 0 30px 0;
              font-size: 13px;
              font-family: 'Merriweather', sans-serif;
              letter-spacing: normal;
            }
            .post-content .textblock p span {
              display: block;
              padding: 10px;
            }
            .post-content .textblock p.half {
              width: 23%;
              float: left;
              padding: 5%;
            }
            .post-content .normal p {
              padding: 5px 0 5px 0;
            }
            .post-content dd {
              margin-left: 0;
              font-size: 0.9em;
              color: #787878;
              margin-bottom: 1.5em;
            }
            .post-content img {
              margin: 0 0 1.5em 0;
              max-width: 100%;
            }
            .post-content video,
            .post-content object {
              max-width: 100%;
              width: 100%;
            }
            .post-content pre,
            .post-content code {
              background: #eee;
              border: 1px solid #cecece;
              padding: 10px;
            }
            
/************* Footer Styles *************/
            .footer {
              z-index: 800;
              position: absolute;
              background: #323333;
              width: 100%;
            }
            .footer #footer-bar {
              width: 100%;
              height: 100%;
              padding-bottom: 10px;
              position: relative;
              text-align: center;
              margin: 0 auto;
              background: url('http://ajoto.com/maintenance/images/menu_bg.gif') repeat;
              -moz-box-shadow: inset 0px 4px 10px 1px rgba(0, 0, 0, 0.3);
              -webkit-box-shadow: inset 0px 4px 10px 1px rgba(0, 0, 0, 0.3);
              box-shadow: inset 0px 4px 10px 1px rgba(0, 0, 0, 0.3);
            }
            .footer #footer-bar .nav-box {
              width: 70%;
              height: 100%;
              margin: 0 auto;
              position: relative;
            }
            .footer #footer-bar .nav-box ul {
              text-align: center;
            }
            .footer #footer-bar .nav-box ul li {
              width: 100%;
              list-style: none;
            }
            .footer #footer-bar .nav-box ul li a {
              text-decoration: none;
              text-transform: uppercase;
              font-size: 0.8em;
            }
            .footer #footer-bar .nav-box a.top {
              display: block;
              height: 14px;
              letter-spacing: 2px;
              color: #646464;
              text-decoration: none;
              font-size: 11px;
              padding: 2em 0;
              line-height: 3em;
              background: url('http://ajoto.com/maintenance/images/arrows_sprite.png') no-repeat;
              background-position: 50% 354%;
            }
            .footer #footer-bar .nav-box ul.share {
              height: 30px;
            }
            .footer #footer-bar .nav-box ul.share li {
              width: 50px;
              height: 30px;
              display: inline-block;
            }
            .footer #footer-bar .nav-box ul.share li img {
              width: 30px;
            }
            .footer #footer-bar .nav-box ul.meta li {
              font-size: 14px;
              display: inline-block;
              width: auto;
            }
            .footer #footer-bar .nav-box ul.meta li a {
              color: #646464;
              padding: 6px;
              font-family: "Merriweather";
              text-transform: none;
              letter-spacing: normal;
            }
            .footer #footer-bar .nav-box p {
              font-size: 9px;
              color: #646464;
              padding-left: 2px;
              height: 63px;
              letter-spacing: 2px;
              background-image: url('http://ajoto.com/maintenance/images/mark-btm.png');
              background-repeat: no-repeat;
              background-position: bottom;
            }
            @media all and (-webkit-min-device-pixel-ratio: 1.5) {
              .footer #footer-bar .nav-box p {
                background-image: url('http://ajoto.com/maintenance/images/mark-btm@2x.png');
                background-size: 60px 20px;
              }
            }

        </style>

    </head>
    
    <body>

        <header role="banner" class="header">
            <div id="inner-header" class="wrap clearfix">           
                <p id="logo" class="h1"><a href="http://www.ajoto.com" rel="external"><img src="http://ajoto.com/maintenance/images/ajoto-logo.png" alt=""></a></p>         
            </div> <!-- end #inner-header -->
            <nav class="menu">

            </nav>
        </header> <!-- end header -->

        <div id="container">
            <div id="content" class="page">
                        <section class="title">
                            <p class="serif">
                            Website Down
                            <br/>
                            <span class="sans-serif">WE WILL BE BACK AGAIN SOON</span></p>
                        </section>          
                        <section class="post-content">
                                <div class="textblock normal text">
                                    <h1>We are currently down for maintenance. <br/>Please check back later. Sorry!</h1>
                                </div>
                        </section> <!-- end article section -->   
    
            </div> <!-- end #content -->
        </div>

<footer role="contentinfo" class="footer">
    <div id="footer-bar">
        <div class="nav-box">               
                <a class="top" href="">BACK TO TOP</a>
                <ul class="share">
                    <li><a href="http://www.facebook.com/ajotostudio" target="_blank"><img src="http://ajoto.com/maintenance/images/facebook_l.png" alt=""/></a></li>
                    <li><a href="http://www.twitter.com/ajoto" target="_blank"><img src="http://ajoto.com/maintenance/images/twitter_l.png" alt=""/></a></li>
                    <li><a href="http://www.pinterest.com/ajoto" target="_blank"><img src="http://ajoto.com/maintenance/images/pinterest_l.png" alt=""/></a></li>
                    <li><a href="mailto:studio@ajoto.com" target="_blank"><img src="http://ajoto.com/maintenance/images/email_l.png" alt=""/></a></li>
                </ul>
                
                <ul class="meta">
                    <li><a href="http://www.ajoto.com/contact" id="other" style="padding-left:0;">Contact Us</a></li>
                    <li><a href="http://www.ajoto.com/press" id="press">Press</a></li>
                    <li><a href="http://www.ajoto.com/terms" id="ts">Terms &amp; Conditions</a></li>
                    <li><a href="http://www.ajoto.com/privacy" id="privacy" style="padding-right:0;">Privacy Policy</a></li>
                    <li><a href="http://www.ajoto.com/privacy/cookies" id="cookies" style="padding-right:0;">Cookies Information</a></li>
                </ul>
            <p>© COPYRIGHT AJOTO LTD. 2013 </p>
        </div>
        </div> <!-- end .footer-bar -->     
</footer> <!-- end footer -->   
</body>

</html>
<?php die(); ?>