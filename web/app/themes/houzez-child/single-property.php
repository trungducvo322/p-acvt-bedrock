<?php get_header(); ?>
<?php global $post, $hide_fields, $top_area, $property_layout, $map_street_view; ?>
<?php
$single_top_area = get_post_meta(get_the_ID(), 'fave_single_top_area', true);
$single_content_area = get_post_meta(get_the_ID(), 'fave_single_content_area', true);
$map_street_view = get_post_meta(get_the_ID(), 'fave_property_map_street_view', true);
$loggedin_to_view = get_post_meta(get_the_ID(), 'fave_loggedintoview', true);
$property_live_status = get_post_status();
$hide_fields = houzez_option('hide_detail_prop_fields');
houzez_count_property_views($post->ID);

$enable_disclaimer = houzez_option('enable_disclaimer', 1);
$global_disclaimer = houzez_option('property_disclaimer');
$property_disclaimer = get_post_meta(get_the_ID(), 'fave_property_disclaimer', true);

if (!empty($property_disclaimer)) {
    $global_disclaimer = $property_disclaimer;
}

if (($property_live_status == 'on_hold') && ($post->post_author != get_current_user_id())) {
    wp_redirect(home_url());
}

$is_sticky = '';
$sticky_sidebar = houzez_option('sticky_sidebar');
if ($sticky_sidebar['single_property'] != 0) {
    $is_sticky = 'houzez_sticky';
}

$is_full_width = houzez_option('is_full_width');
$top_area = houzez_option('prop-top-area');
$property_layout = houzez_option('prop-content-layout');

if (isset($_GET['is_full_width'])) {
    $is_full_width = 1;
}

if ($is_full_width == 1) {
    $content_classes = 'col-lg-12 col-md-12 bt-full-width-content-wrap';
} else {
    $content_classes = 'col-lg-8 col-md-12 bt-content-wrap';
}

if (!empty($single_top_area) && $single_top_area != 'global') {
    $top_area = $single_top_area;
}

if (!empty($single_content_area) && $single_content_area != 'global') {
    $property_layout = $single_content_area;
}


?>

<section class="location">
    <div class="l-container-sm">
        <div class="location__inner">
            <h1 class="title-small"><?php the_title(); ?></h1>
            <div class="location__detail d-flex justify-content-md-start justify-content-between">
                <?php
                if (get_field('like')) {
                    $crLike = get_field('like');
                } else {
                    $crLike = 2000;
                }

                if ($crLike > 999) {
                    $crLikeRound = round($crLike / 1000, 1);

                    $show = $crLikeRound . 'k';
                } else {
                    $show = $crLike;
                }
                ?>
                <p class="likes"><?php echo $show; ?></p>
                <?php
                $allstatus = get_the_terms(get_the_ID(), 'property_status');
                ?>
                <?php
                $allType = get_the_terms(get_the_ID(), 'property_type');
                ?>
                <?php
                $allTag = get_the_terms(get_the_ID(), 'property_label');
                ?>
                <div class="tags">
                    <?php if ($allstatus) : ?>
                        <?php foreach ($allstatus as $item) { ?>
                            <a href="<?php echo get_term_link($item->term_id, 'property_status'); ?>" style="color:<?= get_field('color', $item) ?>"><?= $item->name ?></a>,&nbsp;
                        <?php } ?>
                    <?php endif; ?>
                    <?php if ($allType) : ?>
                        <?php foreach ($allType as $item) { ?>
                            <a href="<?php echo get_term_link($item->term_id, 'property_type'); ?>" style="color:<?= get_field('color', $item) ?>"><?= $item->name ?></a>,&nbsp;
                        <?php } ?>
                    <?php endif; ?>
                    <?php if ($allTag) : ?>
                        <?php foreach ($allTag as $item) { ?>
                            <a href="<?php echo get_term_link($item->term_id, 'property_label'); ?>" style="color:<?= get_field('color', $item) ?>"><?= $item->name ?></a>,&nbsp;
                        <?php } ?>
                    <?php endif; ?>
                </div>
                <?php $address = houzez_get_listing_data('property_map_address');
                if (!empty($address)) {
                    echo '<span>' . esc_attr($address) . '</span>';
                } ?>
            </div>
            <?php
            $properties_images = rwmb_meta('fave_property_images', 'type=plupload_image&size=' . $size, $post->ID);
            $total_images = count($properties_images) + 1;
            ?>
            <div class="location__gallery row">
                <div class="location__thumb--large col-lg-6 col-12">
                    <a class="location__thumbbox--large" href="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" data-fancybox="gallery">
                        <img class="w-100" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" alt="#">
                        <div class="viewall d-flex align-items-center">
                            <img src="<?= PAS ?>assets/img/icon-viewall.png" alt="#">
                            Xem <?= $total_images; ?> ảnh
                        </div>
                    </a>
                </div>
                <div class="location__thumb col-lg-6 col-12">
                    <div class="row">
                        <?php
                        $i = 0;
                        foreach ($properties_images as $image) {
                            ++$i;
                        ?>
                            <div class="col-6 <?= ($i > 4) ? 'd-none' : ''; ?>">
                                <a class="location__thumbbox--small" href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery">
                                    <img class="w-100" src="<?php echo esc_url($image['url']); ?>" alt="#">
                                </a>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>
            <div class="location__description row justify-content-between">
                <div class="<?php echo esc_attr($content_classes); ?>">
                    <div class="property-view">
                        <?php
                        get_template_part('property-details/single-property', 'simple');

                        if (houzez_option('enable_next_prev_prop')) {
                            get_template_part('property-details/next-prev');
                        }
                        ?>

                    </div>
                </div>
                <!-- side bar  -->
                <div class="col-lg-3 col-12">
                    <div class="location__statistic">
                        <h4 class="title-small">Liên hệ chúng tôi</h4>
                        <?php get_sidebar('property'); ?>
                    </div>
                </div>
            </div>

            <div class="location__comment">
                <?php
                $argsBL = array(
                    'status'  => 'approve',
                    'number'  => '15',
                    'post_id' => get_the_ID(),
                    'post_type' => array('property'),
                );
                $argsBLCount = array(
                    'status'  => 'approve',
                    'number'  => '15',
                    'post_id' => get_the_ID(),
                    'post_type' => array('property'),
                    'count' => true
                );
                $comments_count = get_comments($argsBLCount);
                $comments = get_comments($argsBL);
                ?>
                <div class="location__titleComment d-flex align-items-baseline">
                    <h2 class="title-small">Bình luận</h2>
                    <a href="#slide-comment" class="location__commentNumber"><?= $comments_count; ?> bình luận</a>
                </div>
                <div class="location__commentForm">
                    <?php
                    // comment_form();
                    ?>
                </div>
                <div class="location__slider swiper-container" id="slide-comment">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($comments as $item) { ?>
                            <?php
                            $d = "j F, Y";
                            $comment_date = get_comment_date($d, $item->comment_ID);
                            $rating = get_comment_meta($item->comment_ID, 'rating', true) ? get_comment_meta($item->comment_ID, 'rating', true) : 5;
                            ?>
                            <div class="location__box d-flex flex-column swiper-slide">
                                <div>
                                    <?php for ($i = 1; $i <= $rating; $i++) { ?>
                                        <span><img class="location__star" src="<?= PAS ?>assets/img/icon-star.svg" alt="#"></span>
                                    <?php } ?>
                                </div>
                                <p class="light">
                                    <?= $item->comment_content; ?>
                                </p>
                                <div class="location__user d-flex align-items-center">
                                    <div class="location__avatar">
                                        <div class="imgbox">
                                            <img src="<?= PAS ?>assets/img/logo.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="text">
                                        <h5><?= $item->comment_author; ?></h5>
                                        <span class="light"><?= $comment_date; ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>

            </div>
        </div>
    </div>
</section>



<section class="others">
    <div class="l-container-sm">
        <div class="others__inner">
            <h2 class="title-small">Các địa điểm khác</h2>
            <div class="grid row gx-md-5 gx-4">
                <?php
                $args = array(
                    'post_type' => 'property',
                    'posts_per_page' => 12,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand',
                    'order' => 'DESC',
                );

                if (current_term_id) {
                    $args_tax = array(
                        'taxonomy' => current_tax,
                        'field' => 'id',
                        'terms' => current_term_id,
                    );
                    $tax_query[] = $args_tax;
                    $args['tax_query'] = $tax_query;
                }

                $loop = new WP_Query($args);
                ?>
                <?php if ($loop->have_posts()) { ?>
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="grid__item">
                                <div class="grid__gallery">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="imgbox">
                                            <button>
                                                <img src="<?= PAS ?>assets/img/icon-favorite.png" alt="#">
                                            </button>
                                            <?php echo get_the_post_thumbnail(get_the_ID(), 'houzez-item-image-1', array('alt' => esc_html(get_the_title()))); ?>
                                        </div>
                                    </a>
                                </div>
                                <div class="grid__title d-flex flex-wrap justify-content-between">
                                    <a href="<?php the_permalink(); ?>">
                                        <h3 class="title-grid"><?php the_title(); ?></h3>
                                    </a>
                                    <?php like(); ?>
                                </div>
                                <div class="light"><?php the_excerpt(); ?></div>
                                <?php $address = houzez_get_listing_data('property_map_address');
                                if (!empty($address)) {
                                    echo '<span>' . esc_attr($address) . '</span>';
                                } ?>
                                <?php
                                $allstatus = get_the_terms(get_the_ID(), 'property_status');
                                ?>
                                <?php
                                $allType = get_the_terms(get_the_ID(), 'property_type');
                                ?>
                                <?php
                                $allTag = get_the_terms(get_the_ID(), 'property_label');
                                ?>
                                <div class="tags">
                                    <?php if ($allstatus) : ?>
                                        <?php foreach ($allstatus as $item) { ?>
                                            <a href="<?php echo get_term_link($item->term_id, 'property_status'); ?>" style="color:<?= get_field('color', $item) ?>"><?= $item->name ?></a>,&nbsp;
                                        <?php } ?>
                                    <?php endif; ?>
                                    <?php if ($allType) : ?>
                                        <?php foreach ($allType as $item) { ?>
                                            <a href="<?php echo get_term_link($item->term_id, 'property_type'); ?>" style="color:<?= get_field('color', $item) ?>"><?= $item->name ?></a>,&nbsp;
                                        <?php } ?>
                                    <?php endif; ?>
                                    <?php if ($allTag) : ?>
                                        <?php foreach ($allTag as $item) { ?>
                                            <a href="<?php echo get_term_link($item->term_id, 'property_label'); ?>" style="color:<?= get_field('color', $item) ?>"><?= $item->name ?></a>,&nbsp;
                                        <?php } ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                <?php endwhile;
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>