<?php 

$newsList = $args['newsList'];
$page = isset($args['page']) ? $args['page'] : 1;
$cate_id = isset($args['cat_id']) ? $args['cat_id'] : 'all';
$label = isset($args['label']) ? $args['label'] : '';
$class = isset( $args['class'] ) ? $args['class'] : '';

$totalPage = $newsList->max_num_pages;

?>
<div class="c-postNews-grid c-postNews-grid4 <?php echo $class ?>">
<?php
    $totalPage = $newsList->max_num_pages;
    while ( $newsList->have_posts() ):
        $newsList->the_post();
        get_template_part('page/views/postViewNewsItem', '', []);
    endwhile;
?>
</div>
<div class="c-postNews-pagi js-newsTab__page" data-tab-id="<?php echo $cate_id ?>" data-tab-content="js-post-news-content" data-tab-totalPage="<?php echo $totalPage ?>">
    <?php 
        if ( $totalPage > 1 && $page > 1): ?>
            <a href="" class="c-postNews-pagi__pagiPrev c-postNews-pagi__pagiBtn js-pagi2-change" data-pagi="<?php echo $page - 1 ?>">< Trang trước</a>
        <?php 
        endif;
        if ( $totalPage > 1 && $page < $totalPage): ?>
            <a href="" class="c-postNews-pagi__pagiNext c-postNews-pagi__pagiBtn js-pagi2-change" data-pagi="<?php echo $page + 1 ?>">Trang tiếp theo ></a>
        <?php 
        endif;
    ?>
    <div class="c-postNews-pagi__pagiPage">Trang <input type="text" name="page" class="c-postNews-pagi__pagiInput js-pagi-page" value="<?php echo $page ?>">/<?php echo $totalPage ?></div>
</div>