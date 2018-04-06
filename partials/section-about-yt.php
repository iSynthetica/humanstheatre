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
        'numberposts' => 2,
        'orderby'     => 'menu_order',
        'order'       => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'team_display_on_managemen',
                'compare' => '==',
                'value' => '1'
            )
        )
    )
);
?>

<div id="<?php echo $section_id ?>" class="section<?php echo $section_classes ?>">
    <div class="portrait-overlay"></div>
    <div class="container">
        <div class="row<?php echo understrap_section_row_class($id); ?>">
            <div class="col col-start"></div>
            <div class="section-content<?php echo understrap_section_content_col_class($id); ?>">
                <?php // var_dump($team); ?>
                <?php
                if ( $section_title ) {
                    ?><h2><?php echo $section_title ?></h2><?php
                }

                if ( $section_subtitle ) {
                    ?><h3><?php echo $section_subtitle ?></h3><?php
                }

                if( !empty($team) ) {
                    foreach ($team as $member) {
                        ?>
                        <h2 class="team-member__title"><?php echo $member->post_title ?></h2>
                        <p class="team-member__position"><?php echo get_field( 'team_position', $member->ID ) ?></p>
                        <div class="team-member__content">
                            <?php echo wpautop($member->post_content); ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="col col-end"></div>
        </div>
        <?php understrap_show_template('element-section-bg-img.php', array('id' => $id)); ?>
    </div>
    <?php understrap_show_template('element-up-link.php', array('id' => $id)); ?>
</div>