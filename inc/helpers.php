<?php

/**
 * Show templates passing attributes and including the file.
 *
 * @param string $template_name
 * @param array $args
 * @param string $template_path
 */
function understrap_show_template($template_name, $args = array(), $template_path = 'partials')
{
    if (!empty($args) && is_array($args)) {
        extract($args);
    }

    $located = understrap_locate_template($template_name, $template_path);

    if (!file_exists($located)) {
        return;
    }

    include($located);
}

/**
 * Like show, but returns the HTML instead of outputting.
 *
 * @param $template_name
 * @param array $args
 * @param string $template_path
 * @param string $default_path
 * @return string
 */
function understrap_get_template($template_name, $args = array(), $template_path = 'partials')
{
    ob_start();
    understrap_show_template($template_name, $args, $template_path);
    return ob_get_clean();
}

/**
 * Locate a template and return the path for inclusion.
 *
 * @param $template_name
 * @param string $template_path
 * @return string
 */
function understrap_locate_template($template_name, $template_path = 'partials')
{
    if (!$template_path) {
        $template_path = 'partials';
    }

    $template = locate_template(
        array(
            trailingslashit($template_path) . $template_name,
            $template_name
        )
    );

    return $template;
}

function understrap_section_row_class($id) {
    $xl_layout             = get_field( 'xl_content_layout', $id );
    $lg_layout             = get_field( 'lg_content_layout', $id );
    $md_layout             = get_field( 'md_content_layout', $id );
    $sm_layout             = get_field( 'sm_content_layout', $id );

    $row_class = '';

    if ( 'content-center' == $xl_layout ) {
        $row_class .= ' justify-content-xl-center';
    } elseif ( 'content-right' == $xl_layout ) {
        $row_class .= ' justify-content-xl-end';
    } else {
        $row_class .= ' justify-content-xl-start';
    }

    if ( 'content-center' == $lg_layout ) {
        $row_class .= ' justify-content-lg-center';
    } elseif ( 'content-right' == $lg_layout ) {
        $row_class .= ' justify-content-lg-end';
    } else {
        $row_class .= ' justify-content-lg-start';
    }

    if ( 'content-center' == $md_layout ) {
        $row_class .= ' justify-content-md-center';
    } elseif ( 'content-right' == $md_layout ) {
        $row_class .= ' justify-content-md-end';
    } else {
        $row_class .= ' justify-content-md-start';
    }

    if ( 'content-center' == $sm_layout ) {
        $row_class .= ' justify-content-sm-center';
    } elseif ( 'content-right' == $sm_layout ) {
        $row_class .= ' justify-content-sm-end';
    } else {
        $row_class .= ' justify-content-sm-start';
    }

    return $row_class;
}

function understrap_section_content_col_class($id) {
    $xl_content_align = get_field( 'xl_content_align', $id );
    $lg_content_align = get_field( 'lg_content_align', $id );
    $md_content_align = get_field( 'md_content_align', $id );
    $sm_content_align = get_field( 'sm_content_align', $id );

    $row_class = '';

    if ( 'align-center' == $xl_content_align ) {
        $row_class .= ' text-xl-center';
    } elseif ( 'align-right' == $xl_content_align ) {
        $row_class .= ' text-xl-right';
    }

    if ( 'align-center' == $lg_content_align ) {
        $row_class .= ' text-lg-center';
    } elseif ( 'align-right' == $lg_content_align ) {
        $row_class .= ' text-lg-right';
    }

    if ( 'align-center' == $md_content_align ) {
        $row_class .= ' text-md-center';
    } elseif ( 'align-right' == $md_content_align ) {
        $row_class .= ' text-md-right';
    }

    if ( 'align-center' == $sm_content_align ) {
        $row_class .= ' text-sm-center';
    } elseif ( 'align-right' == $sm_content_align ) {
        $row_class .= ' text-sm-right';
    }

    $xl_content_width = get_field( 'xl_content_width', $id );
    $lg_content_width = get_field( 'lg_content_width', $id );
    $md_content_width = get_field( 'md_content_width', $id );
    $sm_content_width = get_field( 'sm_content_width', $id );

    $row_class .= $xl_content_width ? ' col-xl-' . $xl_content_width : ' col-xl-6';
    $row_class .= $lg_content_width ? ' col-lg-' . $lg_content_width : ' col-lg-6';
    $row_class .= $md_content_width ? ' col-md-' . $md_content_width : ' col-md-6';
    $row_class .= $sm_content_width ? ' col-sm-' . $sm_content_width : ' col-sm-6';

    return $row_class;
}

function modal_video_cb( $atts ){
    global $wp_embed;

    $atts = shortcode_atts( array(
        'url' => '',
        'close' => false,
        'id' => 'myModal'
    ), $atts );

    ob_start();
    ?>
    <div class="modal fade video-modal" id="<?php echo $atts['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog video-modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="video-container">
                        <?php echo $wp_embed->run_shortcode('[embed width="720" height="405"]' .$atts['url']. '[/embed]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('modal_video', 'modal_video_cb');

function lightgallery_video_cb( $atts ) {

	$atts = shortcode_atts( array(
		'id' => false,
		'url' => false,
		'thumb' => false,
		'btn-label' => false,
        'sub-html' => false
	), $atts );

	ob_start();
	if ( $atts['id'] && $atts['btn-label'] && $atts['url'] && $atts['thumb'] ) {
		?>
        <a id="<?php echo $atts['id'] ?>" class="cta-button cta-button_video"><?php echo $atts['btn-label'] ?></a>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('#<?php echo $atts['id'] ?>').on('click', function() {
                    jQuery(this).lightGallery({
                        fullScreen: false,
                        zoom: false,
                        dynamic: true,
                        dynamicEl: [
                            {
                                "src": '<?php echo $atts['url'] ?>',
                                'thumb': '<?php echo $atts['thumb'] ?>'
								<?php
								if ($atts['sub-html']) {
								?>
                                , 'subHtml': '<h3 class="team-member__title"><?php echo $atts['sub-html'] ?></h3>'
								<?php
								}
								?>

                            }
                        ]
                    });
                });
            });
        </script>
		<?php
    }
	return ob_get_clean();
}

add_shortcode('lightgallery_video', 'lightgallery_video_cb');