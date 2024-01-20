<?php 
    get_header(); 

    global $post, $hide_fields, $top_area, $property_layout, $map_street_view;

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

    // breadcrumb

    $taxos = get_the_terms( get_the_ID(), 'property_type' );

    $breadcrumbs = [
        [
            'url' => home_url(),
            'name' => "Trang chủ"
        ],
        [
            'url' => home_url($taxos[0]->slug),
            'name' => $taxos[0]->name
        ],
        [
            'url' => get_the_permalink(),
            'name' => get_the_title(),
        ],
    ];

    // address

    $address = houzez_get_listing_data('property_map_address');
?>

<section class="location">
    <div class="l-container">
        <div class="breadcrumbs">
            <?php get_template_part('page/views/breadcrumbsView', '', ['breadcrumbs_list' => $breadcrumbs]) ?>
        </div>
        <h1 class="c-single-header c-titleStyle2"><?php the_title(); ?></h1>
        <div class="c-single-info">
            <div class="c-single-infoTerm">
                <?php get_template_part('page/views/postTermList') ?>  
            </div>
            <div class="c-c-single-infoRating"></div>
            <div class="c-single-infoAddress c-propertyAddress">
                <div class="c-propertyAddress-address">
                    <?php echo !empty($address) ? $address : '' ?>
                </div>
                <a href="" target="_blank" rel="noopener noreferrer" class="c-propertyAddress-map">Xem bản đồ</a>
            </div>
            <div class="c-single-infoShare">
                <?php get_template_part('page/views/singleShare') ?>
            </div>
        </div>
        <div class="location__inner">
            <?php
            $properties_images = rwmb_meta('fave_property_images', 'type=plupload_image&size=', $post->ID);

            $total_images = count($properties_images) + 1;
            ?>
            <div class="c-singleGallery">
                <div class="c-singleGallery-inner c-singleGallery-list">
                    <div class="c-singleGallery-list__each">
                        <a class="" href="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" data-fancybox="gallery">
                            <div class="image-box">
                                <img class="w-100" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" alt="#">
                            </div>
                        </a>
                    </div>
    
                    <?php
                    $i = 0;
                    foreach ($properties_images as $image) {
                        ++$i;
                    ?>
                        <div class="c-singleGallery-list__each <?= ($i > 6) ? 'd-none' : ''; ?>">
                            <a class="" href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery">
                                <div class="image-box">
                                <img class="w-100" src="<?php echo esc_url($image['url']); ?>" alt="#">
                                <?php
                                    if (count($properties_images) > 6 && $i == 6 ):
                                        echo "<div class=\"c-singleGallery-list__viewall\"><span>Xem tất cả hình ảnh</span></div>";
                                    endif;
                                ?>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="location__description row justify-content-between">
                <div class="<?php echo esc_attr($content_classes); ?>">
                    <div class="property-view">
                        <?php
                        get_template_part('property-details/single-property', 'simple');
                        ?>
                        <?php get_template_part('page/views/singleInfo') ?>  

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
        </div>
    </div>
</section>

<section class="others c-singleRetated">
    <div class="l-container">
        <div class="others__inner">
            <h2 class="c-titleStyle2">Các địa điểm khác</h2>
            <div class="grid row gx-md-5 gx-4">
                <?php
                $args = array(
                    'post_type' => 'property',
                    'posts_per_page' => 12,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand',
                    'order' => 'DESC',
                );

                $taxos = get_the_terms( get_the_ID(), 'property_type' );
                $current_term_id = [];

                if (!empty($taxos)) {
                    foreach ($taxos as $key => $taxo) {
                        $current_term_id[] = $taxo->term_id;
                    }
                }
                
                if (!empty($current_term_id)) {
                    $args_tax = array(
                        'taxonomy' => 'property_type',
                        'field' => 'id',
                        'terms' => $current_term_id,
                    );
                    $tax_query[] = $args_tax;
                    $args['tax_query'] = $tax_query;
                }

                $loop = new WP_Query($args);
                if ( $loop->have_posts() ): ?>
                    <div class="swiper-container js-tintuc-slide">
                        <div class="swiper-wrapper">
                        <?php
                            while ( $loop->have_posts() ):
                                $loop->the_post();
                                echo "<div class=\"swiper-slide\">";
                                get_template_part('page/views/postViewPropertyItem');
                                echo "</div>";
                            endwhile;
                        ?>
                        </div>
                    </div>
                    <?php
                    endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>