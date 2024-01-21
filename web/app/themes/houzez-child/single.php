<?php get_header();

    $category = get_the_category(get_the_ID()); 

    $breadcrumbs = [
        [
            'url' => home_url(),
            'name' => "Trang chủ"
        ],
        [
            'url' => home_url($category[0]->slug),
            'name' => $category[0]->name
        ],
        [
            'url' => get_the_permalink(),
            'name' => get_the_title(),
        ],
    ];

?>
<div class="p-news-detail">
    <section class="location">
        <div class="l-container">
            <div class="breadcrumbs">
                <?php get_template_part('page/views/breadcrumbsView', '', ['breadcrumbs_list' => $breadcrumbs]) ?>
            </div>
            <h1 class="c-single-header c-titleStyle2"><?php the_title(); ?></h1>
            <div class="c-single-info">
                <div class="c-single-date"><?php echo get_the_date( 'd/m/Y' ) ?></div>
                <div class="c-single-infoShare">
                    <?php get_template_part('page/views/singleShare') ?>
                </div>
            </div>

            <div class="-----inner">
                <div class="c-singleGallery-main">
                    <div class="c-singleGallery-list__each">
                        <a class="" href="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" data-fancybox="gallery">
                            <div class="image-box image-box-main">
                                <img class="w-100" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" alt="#">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row justify-content-between  mt-50 mt-s-30">
                    <div class="col-lg-8 col-md-12 bt-content-wrap">
                        <?php the_content(); ?>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="location__statistic mt-s-30">
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
                <div class="">
                    <?php
                    $args = [
                        'post_type' => 'post' ,
                        'posts_per_page' => 16,
                    ];

                    if (!empty($category)) {
                        $args['tax_query'] =  array(
                            array(
                                'taxonomy' => 'category',
                                'terms' => $category[0]->term_id,
                                'field' => 'term_id',
                            )
                        );
                    ;
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
</div>

<?php get_footer(); ?>