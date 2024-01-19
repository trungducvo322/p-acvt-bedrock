<section class="grid-container">
    <div class="l-container">
        <div class="grid-container__comment swiper-container">
            <div class="swiper-wrapper">
                <?php
                global $houzez_local;
                ?>
                <?php
                $args = array(
                    'post_type' => 'houzez_testimonials',
                    'posts_per_page' => 10,
                );
                $loop = new WP_Query($args);
                ?>
                <?php if ($loop->have_posts()) { ?>
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                        <?php
                        $text = get_post_meta(get_the_ID(), 'fave_testi_text', true);
                        $name = get_post_meta(get_the_ID(), 'fave_testi_name', true);
                        $position = get_post_meta(get_the_ID(), 'fave_testi_position', true);
                        $company = get_post_meta(get_the_ID(), 'fave_testi_company', true);
                        $photo_id = get_post_meta(get_the_ID(), 'fave_testi_photo', true);
                        $photo_link = wp_get_attachment_image_src($photo_id, 'thumbnail');
                        $logo_id = get_post_meta(get_the_ID(), 'fave_testi_logo', true);
                        ?>
                        <div class="grid-container__box swiper-slide">
                            <div class="grid-container__avatar">
                                <div class="imgbox">
                                    <img class="user" src="<?= $photo_link[0] ?>" alt="#">
                                    <?php echo get_the_post_thumbnail($photo_id, 'houzez-item-image-1', array('alt' => esc_html(get_the_title()), 'class' => 'user')); ?>
                                </div>
                            </div>
                            <h3 class="title-grid"><?= $name; ?></h3>
                            <p class="light">
                                <?= $text; ?>
                            </p>
                        </div>
                <?php endwhile;
                }
                wp_reset_postdata();
                ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>