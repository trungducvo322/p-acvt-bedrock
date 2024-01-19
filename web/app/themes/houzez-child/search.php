<?php
get_header();
?>

<section class="grid-container">
    <div class="l-container">
        <div class="grid row gx-md-5 gx-4">
            <?php if (have_posts()) { ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-lg-5 col-md-4 col-6 js-location-item" data-id="<?= get_the_ID() ?>">
                        <div class="grid__item">
                            <div class="grid__gallery">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="imgbox">
                                        <?php echo get_the_post_thumbnail(get_the_ID(), 'houzez-item-image-1', array('alt' => esc_html(get_the_title()))); ?>
                                    </div>
                                </a>
                            </div>
                            <div class="grid__title d-flex flex-wrap justify-content-between">
                                <a href="<?php the_permalink(); ?>">
                                    <h3 class="title-grid"><?php the_title(); ?></h3>
                                </a>
                            </div>
                            <div class="light"><?php the_excerpt(); ?></div>
                        </div>
                    </div>
            <?php endwhile;
            } else {
                echo '<p>Không có kết quả phù hợp với từ khóa tìm kiếm của bạn.</p>';
            } 
            ?>

        </div>

    </div>
</section>

<?php get_footer(); ?>