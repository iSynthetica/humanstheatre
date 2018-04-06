<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

if ( ! function_exists( 'understrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript sources.
	 */
	function understrap_scripts() {

		// Get the theme data.
		$the_theme = wp_get_theme();

		$query_args = array(
			'family' => 'Open+Sans+Condensed:300',
			'subset' => 'cyrillic-ext',
		);

		wp_register_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );

		//wp_enqueue_style('open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300');
		wp_enqueue_style('google_fonts');

        wp_register_style('lightGallery', get_stylesheet_directory_uri() . '/vendors/lightGallery/css/lightgallery.css', array(), '1.3.9');
        wp_register_style('lg-transitions', get_stylesheet_directory_uri() . '/vendors/lightGallery/css/lg-transitions.css', array(), '1.3.9');

		wp_enqueue_style( 'jq-fullpage', get_stylesheet_directory_uri() . '/vendors/jquery.fullpage/jquery.fullpage.min.css', array(), '2.9.4' );

		wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/vendors/slick/slick.css', array(), '1.6.0' );
		wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/vendors/slick/slick-theme.css', array(), '1.6.0' );

		wp_enqueue_style( 'understrap-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array('lightGallery', 'lg-transitions'), $the_theme->get( 'Version' ) );

        if (is_page_template( 'page-templates/landingpage.php' ) || is_page_template( 'page-templates/homepage.php' )) {
            understrap_landing_page_styles();
        }

		wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'scrolloverflow', get_template_directory_uri() . '/vendors/jquery.fullpage/scrolloverflow.min.js', array(), '5.2.0', true );
        //wp_enqueue_script( 'jq-fullpage', get_template_directory_uri() . '/vendors/jquery.fullpage/jquery.fullpage.min.js', array(), '2.9.4', true );
        wp_enqueue_script( 'jq-easing', get_template_directory_uri() . '/vendors/jquery.fullpage/jquery.easings.min.js', array(), '2.9.4', true );
        wp_enqueue_script( 'jq-fullpage', get_template_directory_uri() . '/vendors/jquery.fullpage/jquery.fullpage.js', array(), '2.9.4', true );

        wp_register_script('lightGallery', get_stylesheet_directory_uri() . '/vendors/lightGallery/js/lightgallery.js', array('jquery'), '1.3.9', true);
        wp_register_script('lg-thumbnail', get_stylesheet_directory_uri() . '/vendors/lightGallery/js/lg-thumbnail.js', array('lightGallery'), '1.3.9', true);
        wp_register_script('lg-fullscreen', get_stylesheet_directory_uri() . '/vendors/lightGallery/js/lg-fullscreen.js', array('lightGallery'), '1.3.9', true);
        wp_register_script('lg-zoom', get_stylesheet_directory_uri() . '/vendors/lightGallery/js/lg-zoom.js', array('lightGallery'), '1.3.9', true);
        wp_register_script('lg-video', get_stylesheet_directory_uri() . '/vendors/lightGallery/js/lg-video.js', array('lightGallery'), '1.3.9', true);

        wp_register_script('slick', get_stylesheet_directory_uri() . '/vendors/slick/slick.min.js', array(), '1.6.0', true);

        wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array('lightGallery', 'lg-thumbnail', 'lg-fullscreen','lg-zoom', 'lg-video', 'slick'), $the_theme->get( 'Version' ), true );

		//if ( is_page_template( 'page-templates/landingpage.php' ) || is_page_template( 'page-templates/homepage.php' ) ) {
		if ( is_page_template( 'page-templates/landingpage.php' ) || is_page_template( 'page-templates/homepage.php' ) ) {
			understrap_landing_page_scripts();
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'understrap_scripts' ).

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );

function understrap_landing_page_styles() {
    global $post;
    $sections = get_field( 'sections', $post->ID );

    //var_dump($sections);

    $style = '';

    foreach ($sections as $section) {
        $section = current($section);
        $id = $section->ID;

        $section_id = get_field( 'id', $id );
        $bg_image = get_the_post_thumbnail_url( $id );
        $bg_color = get_field( 'background_color', $id );
        $xl_background_position = get_field( 'xl_background_position', $id );
        $xl_portrait_background_position = get_field( 'xl_portrait_background_position', $id );
        $lg_background_position = get_field( 'lg_background_position', $id );
        $lg_portrait_background_position = get_field( 'lg_portrait_background_position', $id );
        $md_background_position = get_field( 'md_background_position', $id );
        $sm_background_position = get_field( 'sm_background_position', $id );

        $style .= '
        #' . $section_id . ' {
            background-color: ' . $bg_color . ';
            background-image: url("' . $bg_image . '");
            background-size: cover;
            background-position-y: bottom;
            background-position-x: ' . $xl_background_position . ';
            color: #fff;
            background-repeat: no-repeat;
        }
        @media (max-width: 1199px) {
            #' . $section_id . ' {
                background-position-x: ' . $lg_background_position . ';
            }
        }
        @media (max-width: 991px) {
            #' . $section_id . ' {
                background-position-x: ' . $md_background_position . ';
            }
        }
        @media (max-width: 767px) {
            #' . $section_id . ' {
                background-position-x: ' . $sm_background_position . ';
                padding-top: 10px;
                padding-bottom: 10px;
            }
        }
        @media only screen and (min-width: 768px) and (orientation : portrait) {
            #' . $section_id . ' {
            background-position-x: ' . $xl_portrait_background_position . ';
            }
        }
        @media only screen and (min-width: 992px) and (orientation : portrait) {
            #' . $section_id . ' {
            background-position-x: ' . $lg_portrait_background_position . ';
            }
        }
        @media only screen and (min-width: 1200px) and (orientation : portrait) {
            #' . $section_id . ' {
            background-position-x: ' . $xl_portrait_background_position . ';
            }
        }
        
        #section-home {
            //background-size: contain;
        }
        
        ';
    }

    wp_add_inline_style( 'understrap-styles', $style );
}

function understrap_landing_page_scripts() {
    global $post;
    $sections = get_field( 'sections', $post->ID );

    //var_dump($sections);

    $script = "
    var w = 0;

    jQuery(window).on('load', function(){
        w = jQuery(window).width();
    });
    
    jQuery(document).ready(function() {
    
        if (jQuery(window).width() > 767) {
            big_screen_fullpage();
        }
    
	    jQuery(document).on('click', '.page-template-landingpage .up-link-container span', function() {
	        jQuery.fn.fullpage.moveTo(1, 0);
	    });
	    
	    

    jQuery(window).on('resize', function(){
        if ( w ===  jQuery(window).width()) {
            return;
        }

        if ( w < 768 && jQuery(window).width() < 768) {
            w =  jQuery(window).width();
            return;
        }

        if ( w > 767 && jQuery(window).width() > 767) {
            w =  jQuery(window).width();
            return;
        }

        if ( w > 767 && jQuery(window).width() < 768) {
            jQuery.fn.fullpage.destroy('all');
            w =  jQuery(window).width();
            return;
        }

        if ( w < 768 && jQuery(window).width() > 767) {
            big_screen_fullpage();
            w =  jQuery(window).width();
            return;
        }

        jQuery.fn.fullpage.destroy('all');
        
        if (jQuery(window).width() > 767) {
            big_screen_fullpage();
        }
        w =  jQuery(window).width();
    });
        
    });
    
    function big_screen_fullpage() {
	    jQuery('#fullpage').fullpage({
	        responsiveWidth: 768,
	        scrollOverflow: true,
	        navigation: true,
	        navigationPosition: 'right',
	        afterLoad: function(anchorLink, index){
	            var loadedSection = jQuery(this);
	            if (index == 5 && jQuery( '#section-about-actors' ).length) {
	                var IScrollScroller = loadedSection.find('.fp-scrollable').data('iscrollInstance');
	                
	                //IScrollScroller.isAnimating = true;
					IScrollScroller.scrollTo(0, 0, 0, IScroll.utils.ease.quadratic);
	            }
	        },
	        onLeave: function(index, nextIndex, direction){
				var leavingSection = jQuery(this);
				
	            if ( (nextIndex == 7 || nextIndex == 6) && jQuery( '#section-about-actors' ).length ) {
	                IScrollScroller = new IScroll('#section-about-actors .fp-scrollable');
	                //console.log(IScroll);
	                IScrollScroller.scrollTo(0, IScrollScroller.maxScrollY, 0);
	                IScrollScroller.destroy();
	            }
			},
	        anchors:[";

    foreach ($sections as $section) {
        $section = current($section);
        $id = $section->ID;

        $section_id = get_field( 'id', $id );
        $anchor = get_field( 'anchor', $id );

	    $script .= "'".$anchor."', ";
    }

	$script .= " 'contacts']
	    });
    }
    ";

	wp_add_inline_script( 'understrap-scripts', $script );
}
