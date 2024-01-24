<?php

/**
 * Taxonomy Loại
 */
get_header(); 

$term = (get_queried_object());

$breadcrumbs = [
    [
        'url' => home_url(),
        'name' => "Trang chủ"
    ],
    [
        'url' => get_the_permalink(),
        'name' => $term->name,
    ],
];

$args = [
    'post_type' => 'property',
    'posts_per_page' => 12,
    'tax_query' => array(
        array(
            'taxonomy' => 'property_type',
            'terms' => $term->term_id,
            'field' => 'term_id',
        )
    ),

];
$propertyList = new WP_Query( $args );

?>
<section class="p-propertyTaxo">
    <div class="l-container">
        <div class="breadcrumbs mt-50 mt-s-30">
            <?php get_template_part('page/views/breadcrumbsView', '', ['breadcrumbs_list' => $breadcrumbs]) ?>
        </div>
        <h1 class="c-single-header c-titleStyle2"><?php single_term_title(); ?></h1>

    </div>

    <div class="p-propertyTaxo-inner">
        <div class="l-container">
        <div class="c-gridPost-tabcontent mt-50 mt-s-30 js-propertyTab">
            <div id="js-property-content" class="c-gridPost-tabcontent-left">
                <?php
                    if ( $propertyList->have_posts() ): ?>
                        <?php get_template_part('page/views/postViewPropertyTab', '', [
                            'propertyList' => $propertyList,
                            'term_id' => $term->term_id,
                            'page' => 1
                            ]); ?>
                    <?php
                    else:
                        get_template_part('page/views/empty-box');
                    endif;
                wp_reset_postdata();
                ?>
                </div>
				<div class="c-gridPost-tabcontent-right">
					<?php get_template_part('page/views/postViewPropertyBanner') ?>
				</div>
            </div>

        </div>
    </div>
</section>


<?php get_footer(); ?>