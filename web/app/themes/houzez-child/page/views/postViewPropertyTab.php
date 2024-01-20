<?php 

$propertyList = $args['propertyList'];
$page = $args['page'];
$cate_id = $args['term_id'];
$label = isset($args['label']) ? $args['label'] : '';

$totalPage = $propertyList->max_num_pages;
$count = 0;

?>
<div class="c-postNews-grid c-postNews-grid4">
<?php
    $totalPage = $propertyList->max_num_pages;
    $count = 0;
    while ( $propertyList->have_posts() ):
        $propertyList->the_post();
        $count++;
        get_template_part('page/views/postViewPropertyItem', '', [
            'label' => $label
        ]);
        if ($count % 6 == 3) {
            get_template_part('page/views/postViewPropertyBanner');
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
    <div class="">Trang <input type="text" name="page" class="c-postNews-pagi__pagiInput js-pagi-page" value="<?php echo $page ?>">/<?php echo $totalPage ?></div>
</div>