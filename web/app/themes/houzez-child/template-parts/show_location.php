<section class="grid-container">
    <div class="l-container">
        <div class="grid row gx-md-5 gx-4 js-loadmore">
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
        <?php
        $current_page = max(1, get_query_var('paged'));
        $total_pages = $loop->max_num_pages;
        $big = 999999999; ?>
        <div class="pagination js-pagination">
            <?php
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                'format' => '?paged=%#%',
                'current' => $paged,
                'total' => $total_pages,
                'prev_text'    => __('← Previous'),
                'next_text'    => __('Next  →'),
            ));
            ?>
        </div>


        <div class="scroller-status">
            <div class="infinite-scroll-request ">
                <ul class="dotted">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <p class="infinite-scroll-last"></p>
            <p class="infinite-scroll-error"></p>
        </div>
    </div>
</section>