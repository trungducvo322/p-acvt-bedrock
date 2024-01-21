<?php
    $class = isset( $args['class'] ) ? $args['class'] : '';
    $column = isset($args['column']) ? ' c-postNews__eachcol'.$args['column'] : '';

?>

<div class="c-postNews__each <?php echo ( $class ) ?><?php echo ( $column ) ?>">
    <div class="each-image">
        <?php echo get_the_post_thumbnail(get_the_ID(), 'medium') ?>
    </div>
    <div class="each-title"><h3><?php the_title() ?></h3></div>
    <div class="each-date"><?php echo get_the_date( 'd/m/Y' ) ?> </div>
    <div class="each-readMore">
        <a href="<?php the_permalink() ?>">Đọc tiếp</a>
    </div> 
</div>
