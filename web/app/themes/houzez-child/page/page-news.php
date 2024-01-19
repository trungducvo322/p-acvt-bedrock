<?php
/*
Template Name: Tin tức
*/
?>

<?php get_header(); ?>

<?php $not__in = []; ?>
<section class="top-post">
    <div class="l-container">
        <?php
        $args = array(
            'post_type' => 'post',
            'post_status' =>  'publish',
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $sticky = get_option('sticky_posts');
        if ($sticky) {
            $args['post__in'] = $sticky;
        }
        $loop = new WP_Query($args);
        ?>
        <?php if ($loop->have_posts()) { ?>
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                <?php $not__in[] = get_the_ID(); ?>
                <div class="top-post__inner row align-items-center justify-content-between js-post-item" data-id="<?= get_the_ID(); ?>">
                    <div class="col-md-4 col-12 order-md-1 order-2">
                        <div class="top-post__text">
                            <span class="light"><?php echo get_the_date(); ?></span>
                            <h3 class="title"><?php the_title(); ?></h3>
                            <a href="<?php the_permalink(); ?>" class="button d-flex justify-content-center align-items-center">Xem thêm</a>
                        </div>
                    </div>
                    <div class="col-md-7 col-12 order-md-2 order-1">
                        <a href="<?php the_permalink(); ?>">
                            <div class="top-post__imgbox">
                                <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" alt="#">
                            </div>
                        </a>
                    </div>
                </div>
        <?php endwhile;
        }
        wp_reset_postdata();
        ?>
    </div>
</section>

<section class="newest">
    <div class="l-container">
        <div class="newest__inner d-flex flex-lg-row flex-column justify-content-between">
            <div class="newest__left">
                <h2 class="title">Tin mới nhất</h2>
                <div class="newest__content row">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'post_status' =>  'publish',
                        'posts_per_page' => 4,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'post__not_in' => $not__in
                    );

                    $loop = new WP_Query($args);
                    ?>
                    <?php if ($loop->have_posts()) { ?>
                        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                            <?php $not__in[] = get_the_ID(); ?>
                            <div class="col-lg-6 col-md-4 col-6 js-post-item" data-id="<?= get_the_ID(); ?>">
                                <a href="<?php the_permalink(); ?>" class="newest__item d-flex flex-lg-row flex-column">
                                    <div class="newest__img">
                                        <div class="imgbox">
                                            <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" alt="<?php the_title(); ?>">
                                        </div>
                                    </div>
                                    <div class="newest__text">
                                        <h3 class="title-small"><?php the_title(); ?></h3>
                                        <span class="light"><?php echo get_the_date(); ?></span>
                                    </div>
                                </a>
                            </div>
                    <?php endwhile;
                    }
                    wp_reset_postdata();
                    ?>

                </div>
            </div>
            <div class="newest__right">
                <div class="newest__share">
                    <p>Chia sẻ trên mạng xã hội</p>
                    <div class="social d-flex justify-content-lg-start justify-content-center align-items-end">
                        <a href="#">
                            <img src="<?= PAS ?>assets/img/icon-facebook.png" alt="Facebook">
                        </a>
                        <a href="#">
                            <img src="<?= PAS ?>assets/img/icon-twitter.png" alt="Twitter">
                        </a>
                        <a href="#">
                            <img src="<?= PAS ?>assets/img/icon-pinterest.png" alt="Pinterest">
                        </a>
                        <a href="#">
                            <img src="<?= PAS ?>assets/img/icon-instagram.png" alt="Instagram">
                        </a>
                        <a href="#">
                            <img src="<?= PAS ?>assets/img/icon-youtube.png" alt="Youtube">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="video">
    <div class="l-container">
        <div class="video__inner">
            <h2 class="title">Video</h2>
            <div class="video__content swiper-container">
                <div id="gallery-videos-demo" class="swiper-wrapper">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'post_status' =>  'publish',
                        'posts_per_page' => 6,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'category__in' => array(156),
                    );

                    $loop = new WP_Query($args);
                    ?>
                    <?php if ($loop->have_posts()) { ?>
                        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                            <?php $videolink = get_field('fave_video_post'); ?>
                            <a class="video__item swiper-slide js-post-item" data-id="<?= get_the_ID(); ?>" data-lg-size="1280-720" data-src="<?= $videolink ?>" data-poster="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" data-sub-html="<h4><?php the_title(); ?></h4><p><?php the_excerpt(); ?></p>">
                                <div class="video__itemBox">
                                    <img class="w-100" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" alt="#">
                                </div>
                            </a>
                    <?php endwhile;
                    }
                    wp_reset_postdata();
                    ?>

                </div>
            </div>

            <div class="video__description swiper-container">
                <div class="video__details swiper-wrapper">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'post_status' =>  'publish',
                        'posts_per_page' => 6,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'category__in' => array(156),
                    );

                    $loop = new WP_Query($args);
                    ?>
                    <?php if ($loop->have_posts()) { ?>
                        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                            <div class="swiper-slide">
                                <div class="video__detailsWrap">
                                    <h3 class="title-small"><?php the_title(); ?></h3>
                                    <span class="light"><?php echo get_the_date(); ?></span>
                                </div>
                            </div>
                    <?php endwhile;
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <ul>
                    <li class="swiper-button-prev"></li>
                    <li class="swiper-button-next"></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="category">
    <div class="l-container">
        <div class="category__inner">
            <h2 class="title">Danh mục</h2>
            <div class="category__tags d-flex flex-wrap justify-content-start ">
                <a href="/tin-tuc/" class="active">TẤT CẢ</a>
                <?php $categories = get_categories(); ?>
                <?php foreach ($categories as $item) : ?>
                    <a href="<?= get_category_link($item->term_id); ?>"><?= $item -> name; ?></a>
                <?php endforeach; ?>
            </div>
            <div class="category__content">
                <div class="row row gx-md-5 gx-4 js-addnews">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'post_status' =>  'publish',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'post__not_in' => $not__in
                    );

                    $loop = new WP_Query($args);
                    ?>
                    <?php if ($loop->have_posts()) { ?>
                        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                            <?php $not__in[] = get_the_ID(); ?>
                            <div class="col-md-4 col-6 js-post-item" data-id="<?= get_the_ID(); ?>">
                                <a href="<?php the_permalink() ?>" class="category__item">
                                    <div class="imgbox">
                                        <img class="w-100" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" alt="<?php the_title(); ?>">
                                    </div>
                                    <div class="category__details">
                                        <h3 class="title-small"><?php the_title(); ?></h3>
                                        <span class="light"><?php echo get_the_date(); ?></span>
                                    </div>
                                </a>
                            </div>
                    <?php endwhile;
                    }
                    wp_reset_postdata();
                    ?>

                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'post_status' =>  'publish',
                        'posts_per_page' => 8,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'post__not_in' => $not__in
                    );

                    $loop = new WP_Query($args);
                    ?>
                    <?php if ($loop->have_posts()) { ?>
                        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                            <?php $not__in[] = get_the_ID(); ?>
                            <div class="col-lg-3 col-md-4 col-6 js-post-item" data-id="<?= get_the_ID(); ?>">
                                <a href="<?php the_permalink() ?>" class="category__item">
                                    <div class="imgbox">
                                        <img class="w-100" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" alt="<?php the_title(); ?>">
                                    </div>
                                    <div class="category__details">
                                        <h3 class="title-small"><?php the_title(); ?></h3>
                                        <span class="light"><?php echo get_the_date(); ?></span>
                                    </div>
                                </a>
                            </div>
                    <?php endwhile;
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="button d-flex justify-content-center align-items-center js-loadnews">Xem thêm <img class="js-loadnews-icon" src="<?= PAS ?>assets/img/loading.svg" width="20" height="20" alt="#"></div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>