<?php 
    $label = isset($args['label']) ? $args['label'] : '';
?>
<div class="c-postNews__each">
    <div class="each-image <?php echo !empty($label) ? $label : '' ?>">
        <a href="<?php the_permalink() ?>">
            <?php echo get_the_post_thumbnail(get_the_ID(), 'medium') ?>
        </a>
    </div>
    <div class="each-title social">
        <h3><?php the_title() ?></h3>
        <div class="each-social">
            <img src="<?php echo PAS ?>/assets/img/ico/ico_share.svg" alt="" class="">
            <?php get_template_part('page/views/postShare1') ?>
        </div>
    </div>
    <div class="each-description">
        <?php echo strip_tags(substr(get_the_content() , 0, 300)) ?>
    </div>
    <div class="each-address">
        <?php $address = get_post_meta( get_the_ID(), 'fave_property_address', true ); ?>
        <?php  echo $address; ?>
    </div>
    <div class="each-property-types">
        <?php get_template_part('page/views/postTermList') ?>  
    </div>
</div>
