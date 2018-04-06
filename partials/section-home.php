<?php
$section            = current($section);
$id                 = $section->ID;
$section_id         = get_field( 'id', $id );
$section_classes    = ' ' . get_field( 'classes', $id );
$section_title      = get_field( 'content_title', $id );
$section_subtitle   = get_field( 'content_subtitle', $id );
$is_intro           = get_field( 'is_intro', $id );
?>


<div id="<?php echo $section_id ?>" class="section<?php echo $section_classes ?>">
    <?php if( $is_intro ) { ?>
        <?php understrap_show_template('element-section-navigation.php'); ?>
    <?php } ?>

    <div class="container">
        <div class="row section-content_row<?php echo understrap_section_row_class($id); ?>">
            <div class="col col-start"></div>
            <div class="section-content<?php echo understrap_section_content_col_class($id); ?> text-center">
                <?php
                if ( $section_title ) {
                    ?><h2><?php echo $section_title ?></h2><?php
                }

                if ( $section_subtitle ) {
                    ?><h3><?php echo $section_subtitle ?></h3><?php
                }

                echo do_shortcode(wpautop($section->post_content));
                ?>
            </div>
            <div class="col col-end"></div>
        </div>
        <?php understrap_show_template('element-section-bg-img.php', array('id' => $id)); ?>
    </div>
    <?php understrap_show_template('element-up-link.php', array('id' => $id)); ?>
</div>