<?php
/*
Template Name: Tin tức
*/
?>

<?php 
    get_header(); 
    $not__in = []; 
    $breadcrumbs = [
        [
            'url' => home_url(),
            'name' => "Trang chủ",
        ],
        [
            'url' => get_the_permalink(),
            'name' => get_the_title(),
        ]
    ]
?>
<div class="">
    <?php get_template_part('page/views/breadcrumbsView', '' , [ 'breadcrumbs_list' => $breadcrumbs]) ?>
</div>

<section class="c-pagePostNews-new">
    <div class="l-container">
        <div class="c-pagePostNews-new-header">
            <h2 class="c-titleStyle2">TIN MỚI NHẤT</h2>
        </div>
        <div class="c-pagePostNews-new-box mt-50 mt-s-30">
            <div class="c-pagePostNews-new-list c-postNews">
                <?php
                    $args = array(
                        'post_type' => 'post',
                        'post_status' =>  'publish',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'post__not_in' => $not__in
                    );
        
                    $newPosts = new WP_Query($args);
                    if ($newPosts->have_posts()):
                        $count = 0;
                        while ($newPosts->have_posts()) : $newPosts->the_post();
                            ++$count;
                            $template_data = [
                                "class" => 'c-pagePostNews-new-list__each'
                            ];
                            if ($count == 1) {
                                $template_data['column'] = 2;
                            }
                            
                            get_template_part('page/views/postViewNewsItem', '', $template_data);
                        endwhile;
                    endif;
                    wp_reset_postdata();
                ?>
            </div>
        </div>

    </div>
</section>

<section class="c-pagePostNews-categories">
    <div class="l-container">
        <div class="c-pagePostNews-categories-header">
            <h2 class="c-titleStyle2">DANH MỤC</h2>
        </div>
        
        <ul class="c-pagePostNews-categories-tab js-newsTab">
            <?php
                $categories = get_categories();
                if (!empty( $categories )): ?>
                    <li class="c-pagePostNews-categories-tab__each js-newsTab__each is-active" data-tab-id="-1" data-tab-content="js-post-news-content">
                        <span>Tất cả</span>
                    </li>
                    <?php                    
                    foreach ($categories as $key => $category): ?>
                        <li class="c-pagePostNews-categories-tab__each js-newsTab__each" data-tab-id="<?php echo $category->term_id ?>" data-tab-content="js-post-news-content">
                            <span><?php echo $category->name ?></span>
                        </li>
                    <?php
                    endforeach;
                endif;
            ?>
        </ul>
        <div class="c-pagePostNews-categories-box" id="js-post-news-content">
            <?php

                $args = array(
                    'post_type' => 'post',
                    'post_status' =>  'publish',
                    'posts_per_page' => 16,
                    'orderby' => 'date',
                    'order' => 'DESC',
                );

                $postsList = new WP_Query($args);

                if ( $postsList->have_posts() ): ?>
                    <div class="c-pagePostNews-categories-content c-postNews">
                        <?php get_template_part('page/views/postViewNewTab', '', [ 
                            'newsList' => $postsList,
                            'class' => "c-pagePostNews-categories-list",
                            'cat_id' => -1,
                            "page" => 1
                            ]) ?>
                    </div>
                    <?php
                endif;
            ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>