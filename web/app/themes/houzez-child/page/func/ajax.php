<?php

function nothingFound() {
    ob_start();
    get_template_part('page/views/empty-box');
    wp_reset_postdata();

    $content = ob_get_contents();

    ob_end_clean();

    return $content;
}

function ajax_property_loaihinh(){

$result['type'] = 'error';
$result['message'] = "Error";

$cate_id = $_REQUEST["cate_id"];
$cate_page = $_REQUEST["cate_page"];
$cate_totalPage = $_REQUEST["cate_totalPage"];

$args = [
    'post_type' => 'property' ,
    'posts_per_page' => 12,
    'paged' => $cate_page ,
    'tax_query' => array(
        array(
            'taxonomy' => 'property_type',
            'terms' => $cate_id,
            'field' => 'term_id',
        )
    ),

];

$the_query = new WP_Query( $args );

if (is_wp_error($the_query) ) {
    $result = nothingFound();

} elseif (!is_wp_error($the_query) && $the_query->post_count == 0) {
    $result = nothingFound();

} else{
    ob_start();
        get_template_part('page/views/postViewPropertyTab', '', [ 'propertyList' => $the_query, 
        'term_id' => $cate_id,
        'page' => $cate_page]);
    wp_reset_postdata();

    $content = ob_get_contents();

    ob_end_clean();
    // $result['type'] = "success";
    // $result['message'] = "Thanh cong";
    // $result['content'] = $content;

    // $result = json_encode($result);

    echo $content;
    die;
}

echo $result;

die();
}

add_action( 'wp_ajax_nopriv_ajax_property_loaihinh', 'ajax_property_loaihinh' );
add_action( 'wp_ajax_ajax_property_loaihinh', 'ajax_property_loaihinh' );


// Page news Post - tab

function ajax_news_post(){

$result['type'] = 'error';
$result['message'] = "Error";

$cate_id = $_REQUEST["cate_id"];
$cate_page = $_REQUEST["cate_page"];
$cate_totalPage = $_REQUEST["cate_totalPage"];

$args = [
    'post_type' => 'post' ,
    'posts_per_page' => 16,
    'paged' => $cate_page ,
];

if ($cate_id >= 0 && $cate_id !== 'all') {
    $args['tax_query'] =  array(
        array(
            'taxonomy' => 'category',
            'terms' => $cate_id,
            'field' => 'term_id',
        )
    );
;
}

$the_query = new WP_Query( $args );

if (is_wp_error($the_query) ) {
    // $result = json_encode($result);
    $result = nothingFound();

} elseif (!is_wp_error($the_query) && $the_query->post_count == 0) {
    // $result['type'] = 'empty';
    // $result['message'] = "Khong co du lieu";
    // $result = json_encode($result);
    $result = nothingFound();

} else{
    ob_start();
        get_template_part('page/views/postViewNewTab', '', [
            'cat_id' => $cate_id,
            'newsList' => $the_query,
            'class' => "c-pagePostNews-categories-list",
            "page" => $cate_page

    ]);
    wp_reset_postdata();

    $content = ob_get_contents();

    ob_end_clean();
    // $result['type'] = "success";
    // $result['message'] = "Thanh cong";
    // $result['content'] = $content;

    // $result = json_encode($result);

    echo $content;
    die;
}

echo $result;

die();
}

add_action( 'wp_ajax_nopriv_ajax_news_post', 'ajax_news_post' );
add_action( 'wp_ajax_ajax_news_post', 'ajax_news_post' );
