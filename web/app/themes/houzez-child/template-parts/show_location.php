<section class="grid-container">
    <div class="l-container">
        <div class="grid row gx-md-5 gx-4">
            <?php
            if (get_query_var('paged')) {
                $paged = get_query_var('paged');
            } elseif (get_query_var('page')) {
                $paged = get_query_var('page');
            } else {
                $paged = 1;
            }
            $args = array(
                'post_type' => 'property',
                'posts_per_page' => 20,
                'paged' => $paged,
            );

            $loop = new WP_Query($args);
            ?>
            <?php if ($loop->have_posts()) { ?>
                <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                    <div class="col-lg-5 col-md-4 col-6 js-location-item">
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
            } ?>
            <?php wp_reset_postdata(); ?>
        </div>



      
    </div>
</section>