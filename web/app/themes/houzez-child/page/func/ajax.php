<?php
function ajax_property_loaihinh(){

$result['type'] = 'error';
$result['message'] = "Error";
$data_cate = $_REQUEST["cate"];
$paged = $_REQUEST["page"];
$args = [
    'post_type' => 'post' ,
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'paged' => $paged ,
];
if ($data_cate != 'all'){
    $args['cat'] = $data_cate;
}

$the_query = new WP_Query( $args );
$total_pages = $the_query->max_num_pages;
if (is_wp_error($the_query) ) {
    $result = json_encode($result);

} elseif (!is_wp_error($the_query) && $the_query->post_count == 0) {
    $result['type'] = 'empty';
    $result['message'] = "Khong co du lieu";

    $result = json_encode($result);

} else{

    $posts = $the_query->posts;
    ob_start();

    foreach ($posts as $item) {
        ?>

        <li class="c-listpost__item">
            <div class="c-listpost__info">
                <span class="datepost"><?php echo date('Y年m月d日', strtotime($item->post_date)) ?></span>
                <span class="cat">
                    <?php
                        $cate = (wp_get_post_categories($item->ID));
                        if (!empty($cate)){
                            foreach ($cate as $key => $value) {
                                echo '<div class="cat-each">';
                                $cat = get_category($value);
                                $cat_color = get_field('category_color', $cat->taxonomy.'_'.$cat->term_id);
                                echo '<i class="c-dotcat" style="background-color: '.$cat_color.'"></i>';
                                echo '<a href="'.get_category_link($cat->term_id).'" class="">'.$cat->name.'</a> ';
                                echo '</div>';
                            }
                        }
                    ?>
                </span>
            </div>
            <h3 class="titlepost"><a href="<?php echo get_post_permalink($item->ID) ?>"><?php echo $item->post_title ?></a></h3>
        </li>
    <?php
    }
    if ( $total_pages > 1) {
        $pagination = array(
            'base' => parse_url(trailingslashit( home_url() ), PHP_URL_PATH) . "news/?pages=%#%",
            'format' => '?pages=%#%',
            'current' => $paged,
            'total' => $total_pages,
            'prev_next' => True,
            'prev_text' => ( '' ),
            'next_text' => ( '' ),
            'mid_size'  => 4,
        );

        $ttt = (paginate_links( $pagination ));

        echo '<li class="c-pagination is-newspages" data-cates="'. $data_cate.'">'.paginate_links( $pagination ).'</li>';
    }

    wp_reset_postdata();

    $content = ob_get_contents();
    ob_end_clean();
    $result['type'] = "success";
    $result['message'] = "Thanh cong";
    $result['content'] = $content;
    $result = json_encode($result);
}

echo $result;

die();
}

add_action( 'wp_ajax_nopriv_ajax_property_loaihinh', 'ajax_property_loaihinh' );
add_action( 'wp_ajax_ajax_property_loaihinh', 'ajax_property_loaihinh' );
