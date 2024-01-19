<?php
add_action('wp_ajax_nopriv_loadpost', 'prefix_loadpost');
add_action('wp_ajax_loadpost', 'prefix_loadpost');
function prefix_loadpost()
{
    $offset = !empty($_GET['offset']) ? intval($_GET['offset']) : 0;
    $term_id = !empty($_GET['termid']) ? intval($_GET['termid']) : '';
    $term_name = !empty($_GET['termname']) ? $_GET['termname'] : '';
    $args =  array(
        'post_type' => 'property',
        'post_status' => 'publish',
        'posts_per_page' => 20,
        'offset' => $offset,
    );
    if ($term_id != '' && $term_name != '') {
        $args_term = array(
            'taxonomy' => $term_name,
            'field'    => 'id',
            'terms' => $term_id,
        );
        $tax_query[] = $args_term;
        $args['tax_query'] = $tax_query;
    }


    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) : ?>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <div class="col-lg-5 col-md-4 col-6">
                <div class="grid__item">
                    <div class="grid__gallery">
                        <a href="<?php the_permalink(); ?>">
                            <div class="imgbox">
                                <button>
                                    <img src="<?= PAS ?>/assets/img/icon-favorite.png" alt="#">
                                </button>
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'houzez-item-image-1', array('alt' => esc_html(get_the_title()))); ?>
                            </div>
                        </a>
                    </div>
                    <div class="grid__title d-flex flex-wrap justify-content-between">
                        <a href="<?php the_permalink(); ?>">
                            <h3 class="title-grid"><?php the_title(); ?></h3>
                        </a>
                        <p class="likes">4k</p>
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
        <?php endwhile; ?>
<?php
    else :
        echo 'end';
    endif;

    wp_reset_postdata();
    die();
}
?>

<?php
add_action('wp_ajax_nopriv_loadnews', 'prefix_loadnews');
add_action('wp_ajax_loadnews', 'prefix_loadnews');
function prefix_loadnews()
{
    $notIn = !empty($_POST['notIn']) ? $_POST['notIn'] : '';
    $catId = !empty($_POST['catId']) ? intval($_POST['catId']) : '';
    $args =  array(
        'post_type' => 'post',
        'post_status' =>  'publish',
        'posts_per_page' => 20,
        'orderby' => 'date',
        'order' => 'DESC',
        'post__not_in' => $notIn,
    );

    if ($catId != '') {
        $args_term = array(
            'taxonomy' => 'category',
            'field'    => 'id',
            'terms' => $catId,
        );
        $tax_query[] = $args_term;
        $args['tax_query'] = $tax_query;
    }

    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) : ?>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <div class="col-lg-3 col-md-4 col-6 js-post-item" data-id="<?= get_the_ID(); ?>">
                <a href="<?php the_permalink() ?>" class="category__item">
                    <div class="imgbox">
                        <img class="w-100" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" alt="<?php the_title(); ?>">
                    </div>
                    <div class="category__details">
                        <h3 class="title-small"><?php the_title(); ?></h3>
                        <span class="light"><?php echo get_the_date(); ?></span>
                    </div>
                </a>
            </div>
        <?php endwhile;  ?>
<?php
    else :
        return false;
    endif;

    wp_reset_postdata();
    die();
}
?>


<?php
// add_action('wp_ajax_nopriv_updateLike', 'prefix_updateLike');
// add_action('wp_ajax_updateLike', 'prefix_updateLike');
// function prefix_updateLike()
// {
//     $like = !empty($_POST['like']) ? intval($_POST['like']) : '';
//     $id = !empty($_POST['id']) ? intval($_POST['id']) : '';
//     update_field('like', $like, $id);
//     die();
// }
?>