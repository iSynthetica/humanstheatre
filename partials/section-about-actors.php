<?php
$section            = current($section);
$id                 = $section->ID;
$section_id         = get_field( 'id', $id );
$section_classes    = ' ' . get_field( 'classes', $id );
$section_title      = get_field( 'content_title', $id );
$section_subtitle   = get_field( 'content_subtitle', $id );

$team = get_posts(
    array(
        'post_type' => array('ht_team'),
        'numberposts' => -1,
        'orderby'     => 'menu_order',
        'order'       => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'team_is_actor',
                'compare' => '==',
                'value' => '1'
            )
        )
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

                echo wpautop($section->post_content);

                if( !empty($team) ) {
                    ?>
                    <div class="team-members__container actors__container">
                        <?php

                        if ( $section_subtitle ) {
                            ?><h3><?php echo $section_subtitle ?></h3><?php
                        }
                        $i = 1;
                        foreach ($team as $member) {
                            if ($i < 10) {
                                $num = '0' . $i;
                            } else {
                                $num = $i;
                            }
                            $image = get_stylesheet_directory_uri() . '/img/artists-' . $num . '.png';
                            $image_hover = get_stylesheet_directory_uri() . '/img/artists-hover.png';
                            $portrait = get_the_post_thumbnail_url( $member->ID );
                            $video = get_field( 'team_video', $member->ID );
                            $video_class = $video ? ' team-member-video__container' : '';
                            ?>
                            <div id="team-member-<?php echo $member->ID ?>" class="team-member__container<?php echo $video_class ?>">
                                <div class="team-member__image-container">
                                    <div class="team-member__portrait-holder">
                                        <img src="<?echo $portrait ?>" alt="">
                                    </div>
                                    <div class="team-member__frame-holder">
                                        <img src="<?echo $image ?>" alt="">
                                    </div>
                                    <div class="team-member__hover-holder">
                                        <img src="<?echo $image_hover ?>" alt="<?php echo $member->post_title ?>">
                                    </div>
                                </div>
                                <h3 class="team-member__title"><?php echo $member->post_title ?></h3>
                            </div>
                            <?php
                            if ($i < 10) {
                                $i++;
                            } else {
                                $i = 1;
                            }
                        }
                        ?>
                    </div>
                    <script type="text/javascript">
                        jQuery(document).ready(function () {
	                        <?php
	                        foreach ( $team as $member ) {
                                $video = get_field( 'team_video', $member->ID );
                                $portrait = get_the_post_thumbnail_url( $member->ID );
                                if ($video) {
                                    ?>
                                    jQuery('#team-member-<?php echo $member->ID ?>').on('click', function() {
                                        jQuery(this).lightGallery({
                                            fullScreen: false,
                                            zoom: false,
                                            dynamic: true,
                                            dynamicEl: [
                                                {
                                                    "src": '<?php echo $video ?>',
                                                    'thumb': '<?php echo $portrait ?>',
                                                    'subHtml': '<h3 class="team-member__title"><?php echo $member->post_title ?></h3>'
                                                }
                                            ]
                                        });
                                    });
                                    <?php
                                }
	                        }
	                        ?>
                        });
                    </script>
                    <?php
                }
                ?>
            </div>
            <div class="col col-end"></div>
        </div>
    </div>
    <?php understrap_show_template('element-up-link.php', array('id' => $id)); ?>
</div>