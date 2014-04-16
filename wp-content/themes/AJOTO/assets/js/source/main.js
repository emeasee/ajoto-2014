/* global Froogaloop */

MBP.hideUrlBarOnLoad();

//Globals
var ipad = false,
    latlng = new google.maps.LatLng(51.50130, -0.09100),
    currnow = 'GBP';
    
//Cache our essentials
window.$my =
{
    head : jQuery('header'),
    home_wrap : jQuery('#content.home'),
    about_wrap : jQuery('#content.about'),
    blog_wrap : jQuery('#content.blog'),
    page_wrap : jQuery('#content.page'),
    single_wrap : jQuery('#content.single'),
    main : jQuery('#main'),
    footer : jQuery('footer'),
    menu : jQuery('#footer-links .nav').children()
};

jQuery.cookie('currency',currnow,{ path: '/' });

//Functions 
function initializeMap() {
    var ajotostyles =[
  {
      featureType: 'road.local',
      elementType: 'all',
      stylers: [ { hue: '#c9dfe3' }, { saturation:-50 } ]
    },
    {
      featureType: 'road.local',
      elementType: 'labels',
      stylers: [ { visibility: 'off' }, { lightness: 100} ]
    },
    {
      featureType: 'road.arterial',
      elementType: 'geometry',
      stylers: [ { hue: '#ffffff' }, { saturation:-100 }, { lightness:60} ]
    },
    {
      featureType: 'road.arterial',
      elementType: 'labels',
      stylers: [ { visibility: 'off' } ]
    },
    {
      featureType: 'road.highway',
      elementType: 'all',
      stylers: [ { hue: '#ffffff' }, { lightness:30}, { saturation:-100 } ]
    },
    {
      featureType: 'road.highway',
      elementType: 'labels',
      stylers: [ { visibility: 'off' } ]
    },
    {
      featureType: 'poi',
      elementType: 'all',
      stylers: [ { saturation:-100 } ]
    },
    {
      featureType: 'poi',
      elementType: 'labels',
      stylers: [ { visibility:'simplified' } ]
    },
    {
      featureType: 'poi.school',
      elementType: 'labels',
      stylers: [ { visibility:'on' } ]
    },
    {
      featureType: 'landscape',
      elementType: 'all',
      stylers: [{ hue: '#f0f0f0' }, { saturation:-100 }, { lightness:60}]
    },
    {
      featureType: 'administrative',
      elementType: 'all',
      stylers: [ { saturation:-100 } ]
    },
    {
      featureType: 'administrative',
      elementType: 'labels',
      stylers: [ { visibility:'simplified' } ]
    },
    {
      featureType: 'administrative.locality',
      elementType: 'labels',
      stylers: [ { visibility:'on' } ]
    },
    {
      featureType: 'administrative.neighborhood',
      elementType: 'labels',
      stylers: [ { visibility:'off' } ]
    },
    {
      featureType: 'water',
      elementType: 'all',
      stylers: [{ hue: '#ffffff' }, { saturation:-100 }, { lightness:40}]
    },
    {
      featureType: 'water',
      elementType: 'labels',
      stylers: [{ visibility:'simplified' }]
    },
    {
      featureType: 'transit',
      elementType: 'all',
      stylers: [{ saturation:-100 }]
    }
  ];

    var myOptions = {
      zoom: 13,
      center: latlng,
      streetViewControl: true,
      panControl: false,
      zoomControl: true,
      scrollwheel:false,
      minZoom:4,
      zoomControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL
      },
      mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'ajoto']
    }
    };
    var map = new google.maps.Map(document.getElementById('map_canvas'),
        myOptions);
        
    var image = 'http://www.ajoto.com/ajotogooglemarker.png';
    var myLatLng = new google.maps.LatLng(51.482689, -0.044739);
    var ajotoMarker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image
    });
        
    var styledMapOptions = {
        name: 'AJOTO'
    };

  var ajotoMapType =new google.maps.StyledMapType(
    ajotostyles, styledMapOptions);
    
    map.mapTypes.set('ajoto', ajotoMapType);
    map.setMapTypeId('ajoto');
  }

function cookieBar() {
    if(jQuery.cookie('cookies') == null){
        jQuery('#cookiebar').css('display','block');
    }
}

function setCurrency(){
    if(jQuery.cookie('currency') != 'GBP'){
        jQuery('.widget_shopping_cart select#currselect','#cart-bar:visible').val(jQuery.cookie('currency')).trigger('change');
    } else {
        jQuery('.widget_shopping_cart select#currselect','#cart-bar:visible').val('GBP').trigger('change');
    }
}

function facebookSetup(){
    if(jQuery.cookie('liked') == 'yes'){
        jQuery('#fake_facebook_button').css('background-image','url("http://ajoto.com/wp-content/themes/AJOTO/library/images/facebook_s_liked.png")');
    } else {
        jQuery('#fake_facebook_button').css('background-image','url("http://ajoto.com/wp-content/themes/AJOTO/library/images/facebook_s.png")');
    }

    FB.Event.subscribe('edge.create', function() {
        jQuery.cookie('liked','yes', {expires:365});
        jQuery('#fake_facebook_button').css('background-image','url("http://ajoto.com/wp-content/themes/AJOTO/library/images/facebook_s_liked.png")');
    });
    FB.Event.subscribe('edge.remove', function() {
        jQuery.cookie('liked','no');
        jQuery('#fake_facebook_button').css('background-image','url("http://ajoto.com/wp-content/themes/AJOTO/library/images/facebook_s.png")');
    });
}

function fluidvids(){
    var iframes = document.getElementsByTagName('iframe');
       
       for (var i = 0; i < iframes.length; i++) {
           var iframe = iframes[i];
           var players = /www.youtube.com|player.vimeo.com/;
           if(iframe.src.search(players) !== -1) {
               var videoRatio = (iframe.height / iframe.width) * 100;
               
               iframe.style.position = 'absolute';
               iframe.style.top = '0';
               iframe.style.left = '0';
               iframe.width = '100%';
               iframe.height = '100%';
               
               var div = document.createElement('div');
               div.className = 'video-wrap';
               div.style.width = '100%';
               div.style.position = 'relative';
               div.style.paddingTop = videoRatio + '%';
               
               var parentNode = iframe.parentNode;
               parentNode.insertBefore(div, iframe);
               div.appendChild(iframe);
           }
       }
}

function addEvent(element, eventName, callback) {
    if (element.addEventListener) {
    element.addEventListener(eventName, callback, false);
    } else {
        element.attachEvent(eventName, callback, false);
    }
}

function ready(player_id){
    var container = document.getElementById(player_id).parentNode.parentNode,
        froogaloop = $f(player_id);

    var playBtn = container.querySelector('.cover');
    var loading = container.querySelector('span.loading');

    addEvent(playBtn, 'click', function() {
        froogaloop.api('play');
        jQuery(playBtn).fadeOut('slow');
    }, false);

    froogaloop.addEvent('playProgress', function(){
        jQuery(loading).fadeOut('slow');
    });
}

function moreless(){
    // The height of the content block when it's not expanded
    var adjustheight = 160;
    // The 'more' link text
    var moreText = 'Click to read more';
    // The 'less' link text
    var lessText = 'Click to read less';

    // Sets the .more-block div to the specified height and hides any content that overflows
    jQuery('.more-less .more-block').css('height', adjustheight).css('overflow', 'hidden');

    // The section added to the bottom of the 'more-less' div
    jQuery('.more-less').append('<p class="continued">[&hellip;]</p><a href="#" class="adjust"></a>');
    // Set the 'More' text
    jQuery('a.adjust').text(moreText);

    jQuery('.adjust').toggle(function() {
        jQuery(this).parents('div:first').find('.more-block').css('height', 'auto').css('overflow', 'visible');
        // Hide the [...] when expanded
        jQuery(this).parents('div:first').find('p.continued').css('display', 'none');
        jQuery(this).text(lessText);
    }, function() {
        jQuery(this).parents('div:first').find('.more-block').css('height', adjustheight).css('overflow', 'hidden');
        jQuery(this).parents('div:first').find('p.continued').css('display', 'block');
        jQuery(this).text(moreText);
    });
}

function nodeAddedAnim(event){
  if (event.animationName == 'nodeInserted'){
      jQuery('a.added_to_cart').html("Added To Basket").animate({
           bottom:"0px"
       },300,function(){setTimeout(function() {
               jQuery('a.added_to_cart').animate({
                   bottom:"-40px"
               },300,function(){jQuery(this).remove();});
           }, 2000);
     });     
  }    
}

function wrap( str ) {
     return '<a href="' + str + '">' + str + '<\/a>';
 };

 function replaceText() {
     jQuery("section.tweet div.table p").each( function(){
       jQuery(this).html(jQuery(this).html().replace(/\bhttp[^ ]+/ig, wrap));
     })

 }

(function( $, window, undefined ) {
    
    $(document).ready(function() {
        setTimeout(function() {
            setCurrency();
        }, 1);
        cookieBar();
        
        if( navigator.userAgent.match(/iPad/i) != null ){
         console.log('hello');
          viewport = document.querySelector("meta[name=viewport]");
          viewport.setAttribute('content', 'width=910px, user-scalable=0');
        }
        //Initialise Videos
        if ($('.video .loading').length){
            fluidvids();
            var vimeoPlayers = document.querySelectorAll('iframe'),player;
            for (var i = 0, length = vimeoPlayers.length; i < length; i++) {
                player = vimeoPlayers[i];
                Froogaloop(player).addEvent('ready', ready);
            }
         }

        //Initialise Masonry
        if ($my.page_wrap.length) {
            if(!jQuery.browser.mobile){
                $('section.screen,section.mid').masonry({
                    itemSelector : 'div.card, div.slideshow, div.video',
                    columnWidth: 205,
                    gutter: 10
                });
            }
        }
        if ($my.blog_wrap.length){
          replaceText();
        }
        
        //Initiate the shop
        $('div#content div.choice:even').css({marginLeft: '18%'});
        $('div#content div.choice small.out-of-stock').siblings().css('opacity','0.2').find('div.add').remove();
        $('div#content div.choice small.out-of-stock').siblings('div.quantity').css('visibility','hidden');
        $('div.woocommerce_message:not(:first)').remove();

        //Fix strange bug on Checkout page
        if ($('body.woocommerce-checkout').length){
          $('div.login #username').attr('placeholder', '* Username/Email');
          $('div.login #password').attr('placeholder', '* Password');
          //$('input#createaccount').attr('checked','checked');
            $(document).ajaxComplete(function(event, xhr, settings) {
                if(settings.url == "/wp-admin/admin-ajax.php?action=woocommerce_checkout"){
                  $('ul.woocommerce-error').prependTo('div.woocommerce');
                }
            });
          }
  
        $('input:text, textarea').each(function(){
            var $this = $(this);
            $this.data('placeholder', $this.attr('placeholder'))
                .focus(function(){$this.removeAttr('placeholder');})
                .blur(function(){$this.attr('placeholder', $this.data('placeholder'));});
        });

        $('#account_username_field').insertBefore('#account_password_field');
        $('#order_comments').attr('rows','10');
        
        $('div.choice .container').add('div.build container').on('click touchend',function(){
            ths = $(this).parent();
            ths.find('.quantity input.plus').trigger('click');
         });
        
        $('#quick-convert p.c-info, #cdis').live('click',function(){
            $('#cdis').toggle();
        });
            
        //Initialise Currency selector  
        $('.widget_shopping_cart select#currselect').live('change',function(){
            var currselect = $(this).val();
            $('.amount').each(function(){
                var amount = $(this).parent().attr('id');
                var target = $(this);
                jQuery.ajax({
                    type: 'POST',
                    url: 'http://'+document.location.hostname+'/wp-admin/admin-ajax.php',
                    data: {
                        action: 'get_exchange_rate',
                        amount: amount,
                        currselect: currselect
                    },
                    success: function(data){
                        target.text(data);
                        currnow = $('.widget_shopping_cart select#currselect').val();
                        $.cookie('currency',currnow,{ path: '/' });
                    },
                    error: function(errorThrown){
                        console.log(errorThrown);
                    }
                });
            });
        });


        
        $('#shiptobilling input').change(function(){
            $('div.shipping_address').css('opacity','0.5');
            $('div.shipping_address input').prop('readonly', true);
            if (!$(this).is(':checked')) {
                $('div.shipping_address').css('opacity','1');
                $('div.shipping_address input').prop('readonly', false);
            }}).change();

         $('#cart-bar').scrollToFixed( {
            bottom: 0,
            limit: function() {
              var limit = $('#container').height() - 320;
              return limit;
        }
        });
        $('#cookiebar, div.validation_error, .page-template-build-php .woocommerce-message, a.added_to_cart').scrollToFixed( {
            bottom: 14,
            limit: function() {
            var limit = $('#container').height() - 360;
            return limit;
        }
        });

        if ($('.woocommerce-message').length) {
            setTimeout(function() {
                $('.woocommerce-message, ul.woocommerce-error').animate({
                    bottom:"-50px"
                },function(){$(this).remove();});
            }, 2000);
        }

        $("#cookiebar #confirm").on('click',function(e){
            $.cookie('cookies','yes',{ path: '/' });
            $(this).parent().animate({
                bottom:"-20px"
            },function(){
                $(this).css('display','none');
            });
            return false;
        });

        $('body').on({
            ajaxStart: function() {
            $('#quick-convert').addClass('loading');
        },
            ajaxStop: function() {
            $('#quick-convert').removeClass('loading');
        }});

        $('#cdis').click(function(){
            $(this).hide();
        });

        $('ul#faq li h4').toggle(function() {
            $(this).parent().find('.textblock').slideDown('200',function(){
                $(window).resize();
            });
            if ($(this).parent().attr('id') == "contact"){
                initializeMap();
            }
        }, function(){
            $(this).parent().find('.textblock').slideUp('200',function(){
                $(window).resize();
            });
        });

        $('span.pin').on({
            mouseenter:
                function(){
                    $(this).find('small').animate({opacity:'0.5'},100);
                },
            mouseleave:
                function(){
                    $(this).find('small').animate({opacity:'1'},100);
                },
            click:
                function(){
                    $(this).parent().find('div.info').fadeIn('fast');
                }
        });

        $('.pin-container .close').on({
            click:
                function () {
                    $(this).parent().fadeOut('fast');
                }
        });

        $('section.buttons .buttons a.over').hover(function(){
            $(this).stop().animate({'opacity': 1});
        },function() {
            $(this).stop().animate({'opacity': 0});
        });

        $('a.add_to_cart_button').on('click touchend', function(){
          if($('a.added_to_cart').length){
            console.log('Notifing');
          }
        });

        $('#footer-bar a.top').click(function(e){
            $('html,body').animate({ scrollTop: 0 },1000);
            e.preventDefault();
        });
        
        $('#gallery img').removeAttr('width height');

        if(window.location.hash) {
            var hash = window.location.hash;
            console.log(hash);
            $(hash + ' h4').click();
        }

        if ($my.single_wrap.length) {
          $(".gallery").royalSlider({
            keyboardNavEnabled: true,
            controlNavigation:'none',
            arrowsNavAutoHide: false,
            imgWidth: 850,
            imgHeight: 470
          });
        }

        
    });
    $(window).load(function(){
        if ($my.single_wrap.length) {
            //facebookSetup();
        }
    });
    
})( jQuery, window );

  document.addEventListener('animationstart', nodeAddedAnim, false);
  document.addEventListener('MSAnimationStart', nodeAddedAnim, false);
  document.addEventListener('webkitAnimationStart', nodeAddedAnim, false);

// HTML5 Fallbacks for older browsers
jQuery(function($) {
    // check placeholder browser support
    if (!Modernizr.input.placeholder) {
        // set placeholder values
        $(this).find('[placeholder]').each(function() {
            $(this).val( $(this).attr('placeholder') );
        });
 
        // focus and blur of placeholders
        $('[placeholder]').focus(function() {
            if ($(this).val() == $(this).attr('placeholder')) {
                $(this).val('');
                $(this).removeClass('placeholder');
            }
        }).blur(function() {
            if ($(this).val() === '' || $(this).val() == $(this).attr('placeholder')) {
                $(this).val($(this).attr('placeholder'));
                $(this).addClass('placeholder');
            }
        });
 
        // remove placeholders on submit
        $('[placeholder]').closest('form').submit(function() {
            $(this).find('[placeholder]').each(function() {
                if ($(this).val() == $(this).attr('placeholder')) {
                    $(this).val('');
                }
            });
        });
    }
});