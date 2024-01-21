<?php 
    /*
    Template Name: Gioi thieu
    */

    get_header();

    $category = get_the_category(get_the_ID()); 

    $breadcrumbs = [
        [
            'url' => home_url(),
            'name' => "Trang chủ"
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

            <div class="-----inner">
                <div class="row justify-content-between  mt-50 mt-s-30">
                    <div class="col-lg-3 col-12">

                    </div>

                    <div class="col-lg-6 col-md-12">
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
</div>

<?php get_footer(); ?>