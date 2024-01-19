<?php get_header(); ?>

<?php $not__in = []; ?>

<section class="category">
    <div class="l-container">
        <div class="category__inner">
            <h1 class="title"><?= title ?></h1>
            <div class="category__tags d-flex flex-wrap justify-content-start ">
                <a href="/tin-tuc/">TẤT CẢ</a>
                <?php $categories = get_categories(); ?>
                <?php foreach ($categories as $item) : ?>
                    <a href="<?= get_category_link($item->term_id); ?>" class="<?= ($item->term_id == current_term_id) ? 'active' : ''; ?>"><?= $item -> name; ?></a>
                <?php endforeach; ?>
            </div>
            <div class="category__content">
                <div class="row gx-md-5 gx-4 js-addnews">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'post_status' =>  'publish',
                        'posts_per_page' => 20,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'post__not_in' => $not__in,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'id',
                                'terms' => current_term_id,
                            ),
                        ),
                    );

                    $loop = new WP_Query($args);
                    ?>
                    <?php if ($loop->have_posts()) { ?>
                        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                            <?php $not__in[] = get_the_ID(); ?>
                            <div class="col-lg-3 col-md-4 col-6 js-post-item js-post-item-main" data-id="<?= get_the_ID(); ?>">
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