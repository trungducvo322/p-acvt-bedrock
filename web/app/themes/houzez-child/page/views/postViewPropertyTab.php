<?php 

$propertyList = $args['propertyList'];
$page = $args['page'];
$cate_id = $args['term_id'];
$label = isset($args['label']) ? $args['label'] : '';

$totalPage = $propertyList->max_num_pages;
$count = 0;

$banner = [
    "assets/img/banner/img_banner-side1.jpg",
    "assets/img/banner/img_banner-side2.jpg",
    "assets/img/banner/img_banner-side3.jpg",
    "assets/img/banner/img_banner-side4.jpg",
];

$banner_index = 0;

?>
<div class="c-postNews-grid c-postNews-grid3">
<?php
    $totalPage = $propertyList->max_num_pages;
    $count = 0;
    while ( $propertyList->have_posts() ):
        $propertyList->the_post();
        $count++;
        get_template_part('page/views/postViewPropertyItem', '', [
            'label' => $label
        ]);
        if ($count % 6 == 0) {
            get_template_part('page/views/postViewPropertyBannerSP', '' , [
                'list-banner' => [
                    $banner[$banner_index++],
                    $banner[$banner_index++],
                ]
            ]);
        }
    endwhile;
?>
</div>
<div class="c-gridPost-tabcontent__pagi c-postNews-pagi js-propertyTab__page" data-tab-id="<?php echo $cate_id ?>" data-tab-content="js-property-content" data-tab-totalPage="<?php echo $totalPage ?>">
    <?php 
        if ( $totalPage > 1 && $page > 1): ?>
            <a href="" class="c-postNews-pagi__pagiPrev c-postNews-pagi__pagiBtn js-pagi-change" data-pagi="<?php echo $page - 1 ?>">< Trang trước</a>
        <?php 
        endif;
        if ( $totalPage > 1 && $page < $totalPage): ?>
            <a href="" class="c-postNews-pagi__pagiNext c-postNews-pagi__pagiBtn js-pagi-change" data-pagi="<?php echo $page + 1 ?>">Trang tiếp theo ></a>
        <?php 
        endif;
    ?>
    <div class="c-postNews-pagi__pagiPage">Trang <input type="text" name="page" class="c-postNews-pagi__pagiInput js-pagi-page" value="<?php echo $page ?>"> / <?php echo $totalPage ?></div>
</div>