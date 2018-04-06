<?php
$section            = current($section);
$id                 = $section->ID;
$section_id         = get_field( 'id', $id );
$section_classes    = ' ' . get_field( 'classes', $id );
$section_title      = get_field( 'content_title', $id );
$section_subtitle   = get_field( 'content_subtitle', $id );

$gallery = get_posts(
    array(
        'post_type' => array('ht_gallery'),
        'numberposts' => -1,
        'orderby'     => 'menu_order',
        'order'       => 'ASC',
    )
);
?>

<div id="<?php echo $section_id ?>" class="section<?php echo $section_classes ?>">
    <div class="container">
        <div class="row section-content_row<?php echo understrap_section_row_class($id); ?>">
            <div class="col col-start"></div>
            <div class="section-content<?php echo understrap_section_content_col_class($id); ?>">
                <?php
                if ( $section_title ) {
                    ?><h2><?php echo $section_title ?></h2><?php
                }
                ?>

            </div>
            <div class="col col-end"></div>
        </div>

        <?php
        if( !empty( $gallery ) ) {
            ?>
            <div class="row gallery-slick-slider__row">
                <div class="col gallery-slick-slider_col">
                    <div id="gallery-slick-slider">
                    <?php
                    $i = 1;
                    $image_hover = get_stylesheet_directory_uri() . '/img/gallery-hover.png';
                    foreach ( $gallery as $item ) {
                        $image = get_stylesheet_directory_uri() . '/img/gallery-' . $i . '.png';
                        $thumbnail = get_the_post_thumbnail_url( $item->ID, 'gallery-thumb' );
                        ?>
                        <div id="gallery<?php echo $item->ID ?>" class="gallery-slick-slide">
                            <div class="gallery-slick-slide__image-container">
                                <div class="gallery-slick-slide__portrait-holder">
                                    <img src="<?echo $thumbnail ?>" alt="">
                                </div>
                                <div class="gallery-slick-slide__frame-holder">
                                    <img src="<?echo $image ?>" alt="">
                                </div>

                                <div class="gallery-slick-slide__hover-holder">
                                    <img src="<?echo $image_hover ?>" alt="<?php echo $item->post_title ?>">
                                </div>
                            </div>
                            <h3 class="gallery-slick-slide__title"><?php echo $item->post_title ?></h3>
                        </div>
                        <?php
                        if ($i < 4) {
                            $i++;
                        } else {
                            $i = 1;
                        }
                    }
                    ?>
                    </div>
                </div>
            </div>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#gallery-slick-slider').slick({
            cssEase: 'ease',
            arrows: true,
            dots: false,
            infinite: false,
            speed: 500,
            slidesToShow: 4,
            slidesToScroll: 1,
            slide: '.gallery-slick-slide', // Cause trouble with responsive settings
            responsive: [
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                }
            ]
        });

        <?php
        foreach ( $gallery as $item ) {
            $gallery_photos   = get_field( 'photo_gallery_items', $item->ID );
            $i = 1;
            $num = count( $gallery_photos );
            ?>
            jQuery('#gallery<?php echo $item->ID ?>').on('click', function() {
                jQuery(this).lightGallery({
                    dynamic: true,
                    dynamicEl: [
                        <?php
                        foreach ($gallery_photos as $photo) {
                            ?>
                            {
                                "src": '<?php echo $photo['url'] ?>',
                                'thumb': '<?php echo $photo['sizes']['thumbnail'] ?>',
                                'subHtml': ''
                            }<?php if( $i < $num ) {echo " , ";} ?>
                            <?php
                            $i++;
                        }
                        ?>
                    ]
                });
            });
            <?php
        }
        ?>

    });
</script>

            <?php
        }
        ?>
        <?php understrap_show_template('element-section-bg-img.php', array('id' => $id)); ?>
    </div>
    <?php understrap_show_template('element-up-link.php', array('id' => $id)); ?>
</div>