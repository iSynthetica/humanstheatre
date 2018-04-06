<?php
$is_up_link         = get_field( 'show_up_link', $id );

if( $is_up_link ) {
    ?>
    <div class="up-link-container">
        <span>UP</span>
    </div>
    <?php
}
?>