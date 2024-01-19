<?php get_header(); ?>
<?php $category = get_the_category(get_the_ID()); ?>
<div class="p-news-detail">
    <section class="single">
        <div class="l-container-sm">
            <div class="single__inner">
                <?php
                // Start the Loop.
                while (have_posts()) : the_post(); ?>
                    <article>
                        <div class="single__title">
                            <h1 class="title"><?php the_title(); ?></h1>
                            <div class="single__credit light">
                                <span>By <?php the_author(); ?></span>
                                <img src="<?= PAS ?>assets/img/icon-dot.png" alt="">
                                <span><?php echo get_the_date(); ?></span>
                                <img src="<?= PAS ?>assets/img/icon-dot.png" alt="">
                                <a href="/" target="_blank">anchoivungtau.vn</a>
                            </div>
                            <div class="social d-flex justify-content-lg-start justify-content-center align-items-end">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>">
                                    <img src="<?= PAS ?>assets/img/icon-facebook.png" alt="Facebook">
                                </a>
                                <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink() ?>">
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
                        <!-- check video  -->
                        <?php $video_url = get_field('fave_video_post'); ?>
                        <?php if ($video_url) : ?>
                            <div id="gallery-videos-demo">
                                <a class="video__item single__featureVideo" data-id="<?= get_the_ID(); ?>" data-lg-size="1280-720" data-src="<?= $video_url ?>" data-poster="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" data-sub-html="<h4><?php the_title(); ?></h4><p><?php the_excerpt(); ?></p>">
                                    <div class="single__featurebox">
                                        <img class="single__featureImg w-100" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" alt="#">
                                    </div>
                                </a>
                            </div>
                        <?php else : ?>
                            <div class="single__featurebox">
                                <img class="single__featureImg w-100" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" alt="<?php the_title(); ?>">
                            </div>
                        <?php endif; ?>

                        <div class="single__body post-content-wrap">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <section class="category">
        <div class="l-container">
            <div class="category__inner">
                <h3 class="title">Bài viết liên quan</h3>
                <div class="category__content">
                    <div class="row row gx-md-5 gx-4">
                        <?php
                        $args = array(
                            'post_type' => 'post',
                            'post_status' =>  'publish',
                            'posts_per_page' => 3,
                            'orderby' => 'rand',
                            'order' => 'DESC',
                            'post__not_in' => array(get_the_ID()),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'id',
                                    'terms' => $category[0]->term_id,
                                ),
                            ),
                        );

                        $loop = new WP_Query($args);
                        ?>
                        <?php if ($loop->have_posts()) { ?>
                            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                                <div class="col-md-4 col-6">
                                    <a href="<?php the_permalink() ?>" class="category__item">
                                        <div class="imgbox">
                                            <img class="w-100" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" alt="<?php the_title(); ?>">
                                        </div>
                                        <div class="category__details">
                                            <h4 class="title-small"><?php the_title(); ?></h4>
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
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>