<?php
$bg_image           = get_the_post_thumbnail_url( $id );

if ($bg_image) {
    ?>
    <div class="row section-bg__row">
        <div class="col section-bg__col">
            <img src="<?php echo $bg_image ?>" alt="">
        </div>
    </div>
    <?php
}
?>