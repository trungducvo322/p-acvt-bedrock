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
            // 'name' => get_the_title(),
            'name' => "Về chúng tôi",
        ],
    ];

?>
<div class="p-about">
    <section class="location">
        <div class="l-container">
            <div class="breadcrumbs">
                <?php get_template_part('page/views/breadcrumbsView', '', ['breadcrumbs_list' => $breadcrumbs]) ?>
            </div>
            <div class="p-about-inner">
                <div class="row justify-content-between">
                    <div class="col-lg-9 col-md-12">
                        <div class="row">
                            <h1 class="c-titleStyle2"><?php the_title(); ?></h1>
                            <div class="col-lg-4 col-12 mt-50 mt-s-30">
                                <img src="<?php echo PAS ?>assets/img/logo/logo.png" alt="Ăn chơi vũng tàu">
                            </div>
                            <div class="col-lg-8 col-md-12 mt-50 mt-s-30">
                                <?php the_content(); ?>
                            </div>
                        </div>
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