<?php
/*
Template Name: Trang chủ
*/
?>
<?php get_header(); ?>

<?php get_template_part("template-parts/mainv");  ?>

<section class="c-gridNewPost">
    <div class="l-container">
        <div class="c-gridNewPost-header">
            <h2 class="c-titleStyle1">ĐỊA ĐIỂM MỚI </h2>
        </div>
        <div class="c-gridNewPost-content mt-50 mt-s-30">
            <?php
            $args = [
                'post_type' => 'property',
                'posts_per_page' => 4,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'property_status',
                        'terms' => '30',
                        'field' => 'term_id',
                        'operator' => 'NOT IN'
                    )
                ),
            ];
            $propertyListNew = new WP_Query( $args );

            $args = [
                'post_type' => 'property',
                'posts_per_page' => 2,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'property_status',
                        'terms' => '30',
                        'field' => 'term_id',
                    )
                ),
            ];
            $propertyListHot = new WP_Query( $args );
            ?>
            <div class="c-postNews-grid c-postNews-gridSpecial c-gridNewPost__pcview">
            <?php

            if ( $propertyListHot->have_posts() ):
                $count = 0;
                while ( $propertyListHot->have_posts() ):
                    $order = $count = ($count % 2 == 0) ? $count + 1 : $count + 5 ;
                    $propertyListHot->the_post();
                    get_template_part('page/views/postViewPropertyItem', '', [
                        'label' => 'label-hot',
                        'order' => $order,
                        'column' => 2
                    ]);
                endwhile;

            endif;
            if ( $propertyListNew->have_posts() ):
                $count = 0;
                while ( $propertyListNew->have_posts() ):
                    ++$count;
                    $loop = floor($count / 6) + 1;
                    $order = $count = ($count % 6 == 1 || $count % 6 == 6) ? $count + 1 : $count;

                    $propertyListNew->the_post();
                    get_template_part('page/views/postViewPropertyItem', '', [
                        'label' => 'label-new',
                        'order' => $order
                    ]);
                endwhile;

            endif;

            ?>
            </div>

            <div class="c-gridNewPost__spview">
                <div class="c-gridNewPost__spviewHot">
                    <?php
                    if ( $propertyListHot->have_posts() ): ?>
                    <div class="swiper-container js-propertyNew-slide">
                        <div class="swiper-wrapper">
                        <?php
                            while ( $propertyListHot->have_posts() ):
                                $propertyListHot->the_post();
                                echo "<div class=\"swiper-slide\">";
                                get_template_part('page/views/postViewPropertyItem', '', [
                                    'label' => 'label-hot'
                                ]);
                                echo "</div>";
                            endwhile;
                        ?>
                        </div>
                    </div>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="c-gridNewPost__spviewNew">
                    <?php
                    if ( $propertyListNew->have_posts() ): ?>
                    <div class="swiper-container js-propertyNew-slide">
                        <div class="swiper-wrapper">
                        <?php
                            while ( $propertyListNew->have_posts() ):
                                $propertyListNew->the_post();
                                echo "<div class=\"swiper-slide\">";
                                get_template_part('page/views/postViewPropertyItem', '', [
                                    'label' => 'label-new'
                                ]);
                                echo "</div>";
                            endwhile;
                        ?>
                        </div>
                    </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="c-banner">
	<div class="l-container-sp--full">
		<div class="c-banner-item">
            <a href="http://" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo PAS ?>assets/img/banner/img_bannerLong1.jpg" alt="">                
            </a>
		</div>
	</div>
</div>
<section class="c-gridPost">
    <div class="l-container">
        <div class="c-gridPost-header">
            <h2 class="c-titleStyle1">KHÁM PHÁ VŨNG TÀU</h2>
        </div>
    </div>
    <div class="c-gridPost-content mt-50 mt-s-30">
        <?php
            $terms = get_terms( array(
                'taxonomy'   => 'property_type',
                'hide_empty' => false,
                'posts_per_page' => 12
            ) );

            $defaultTerm = $terms[0]->term_id;

            $args = [
                'post_type' => 'property',
                'posts_per_page' => 12,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'property_type',
                        'terms' => $defaultTerm,
                        'field' => 'term_id',
                    )
                ),

            ];
            $propertyList = new WP_Query( $args );

        ?>
        <?php if (have_posts($terms)): ?>
            <div class="c-gridPost-tab js-propertyTab swiper-container js-propertyTab-slider">
				<div class="swiper-wrapper">
					<?php foreach ($terms as $key => $value): 
                        $tab_icon_field = get_field('tab_icon', 'property_type_'. $value->term_id);
                        $tab_icon = !empty($tab_icon_field) ? $tab_icon_field['sizes']['medium'] : PAS.'/assets/img/ico/ico_tra-sua.svg' 
                        ?>
						<div class="swiper-slide">
							<div class="js-propertyTab__each c-gridPost-tab__each <?php echo $key == 0 ? 'is-active' : '' ?> " data-tab-id="<?php echo $value->term_id ?>" data-tab-content="js-property-content">
								<div class="icon">
									<img src="<?php echo $tab_icon ?>" alt="<?php echo $value->name ?>">
								</div>
								<div class=""><?php echo  str_replace("Du Lịch", "DL", $value->name); ?></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
        <?php endif; ?>
		<div class="l-container">
        	<div class="c-gridPost-tabcontent mt-50 mt-s-30">
                <div id="js-property-content" class="c-gridPost-tabcontent-left">
                <?php
                    if ( $propertyList->have_posts() ): ?>
                        <?php get_template_part('page/views/postViewPropertyTab', '', [
                            'propertyList' => $propertyList,
                            'term_id' => $defaultTerm,
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
<div class="c-banner">
	<div class="l-container-sp--full">
		<div class="c-banner-item">
        <a href="http://" target="_blank" rel="noopener noreferrer">
			<img src="<?php echo PAS ?>assets/img/banner/img_bannerLong2.jpg" alt="">
        </a>
		</div>
	</div>
</div>
<section class="c-comment">
    <div class="l-container">
    <div class="c-comment-header">
        <h2 class="c-titleStyle2">KHÁCH HÀNG NÓI GÌ <span class="dib">VỀ ĂN CHƠI VŨNG TÀU</span></h2>
    </div>
    <div class="c-comment-box mt-s-30">
        <div class="grid-container__comment c-comment-boxList swiper-container">
            <div class="swiper-wrapper">
                <?php
                global $houzez_local;
                ?>
                <?php
                $args = array(
                    'post_type' => 'houzez_testimonials',
                    'posts_per_page' => 10,
                );
                $loop = new WP_Query($args);
                ?>
                <?php if ($loop->have_posts()) { ?>
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                        <?php
                        $text = get_post_meta(get_the_ID(), 'fave_testi_text', true);
                        $name = get_post_meta(get_the_ID(), 'fave_testi_name', true);
                        $position = get_post_meta(get_the_ID(), 'fave_testi_position', true);
                        $company = get_post_meta(get_the_ID(), 'fave_testi_company', true);
                        $photo_id = get_post_meta(get_the_ID(), 'fave_testi_photo', true);
                        $photo_link = wp_get_attachment_image_src($photo_id, 'thumbnail');
                        $logo_id = get_post_meta(get_the_ID(), 'fave_testi_logo', true);
                        ?>
                        <div class="swiper-slide">
                            <div class="c-comment-boxList__each">
                                <div class="each-content">
                                    <p><?= $text; ?></p>
                                </div>
                                <div class="each-avatar">
                                    <img class="user" src="<?= $photo_link[0] ?>" alt="#">
                                    <?php echo get_the_post_thumbnail($photo_id, 'houzez-item-image-1', array('alt' => esc_html(get_the_title()), 'class' => 'user')); ?>
                                </div>
                                <h3 class="each-title"><?= $name; ?></h3>
                            </div>
                        </div>
                <?php endwhile;
                }
                wp_reset_postdata();
                ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
    </div>
</section>
<section class="c-doitac">
    <div class="l-containerFull">
        <div class="c-doitac-header">
            <h2 class="c-titleStyle2">ĐỐI TÁC</h2>
        </div>
        <div class="c-doitac-box mt-50 mt-s-30">
            <?php
                $doitacList = [
                    [
                        "alt" => 'Cellphone S',
                        "image" => "doitac/ico_cellphone.png",
                        "image2x" => "doitac/ico_cellphone@2x.png",
                    ],
                    [
                        "alt" => 'Agoda',
                        "image" => "doitac/ico_agoda.png",
                        "image2x" => "doitac/ico_agoda@2x.png",
                    ],
                    [
                        "alt" => 'KFC',
                        "image" => "doitac/ico_kfc.png",
                        "image2x" => "doitac/ico_kfc@2x.png",
                    ],
                    [
                        "alt" => 'Kiotviet',
                        "image" => "doitac/ico_kiotviet.png",
                        "image2x" => "doitac/ico_kiotviet@2x.png",
                    ],
                    [
                        "alt" => 'King BBQ',
                        "image" => "doitac/ico_kingbbq.png",
                        "image2x" => "doitac/ico_kingbbq@2x.png",
                    ],
                    [
                        "alt" => 'Grab',
                        "image" => "doitac/ico_grab.png",
                        "image2x" => "doitac/ico_grab@2x.png",
                    ],
                    [
                        "alt" => 'Lazada',
                        "image" => "doitac/ico_lazada.png",
                        "image2x" => "doitac/ico_lazada@2x.png",
                    ],
                    [
                        "alt" => 'Mobifone',
                        "image" => "doitac/ico_mobifone.png",
                        "image2x" => "doitac/ico_mobifone@2x.png",
                    ]
                ];

                if ( $doitacList ): ?>
                    <div class="swiper-container js-doitac-slide">
                        <div class="swiper-wrapper">
                        <?php
                            foreach ($doitacList as $value): ?>
                                <div class="swiper-slide">
                                <img srcset="<?php echo PAS ?>/assets/img/<?php echo $value['image'] ?>, <?php echo PAS ?>/assets/img/<?php echo $value['image2x'] ?> 2x" src="<?php echo PAS ?>/assets/img/<?php echo $value['image2x'] ?>" alt="<?php echo $value['alt'] ?>">

                                </div>
                            <?php
                            endforeach;
                            foreach ($doitacList as $value): ?>
                                <div class="swiper-slide">
                                <img srcset="<?php echo PAS ?>/assets/img/<?php echo $value['image'] ?>, <?php echo PAS ?>/assets/img/<?php echo $value['image2x'] ?> 2x" src="<?php echo PAS ?>/assets/img/<?php echo $value['image2x'] ?>" alt="<?php echo $value['alt'] ?>">

                                </div>
                            <?php
                            endforeach;

                            ?>
                        </div>
                    </div>
                <?php
                endif;
                ?>
        </div>
    </div>
</section>
<section class="c-tintuc">
    <div class="l-container">
        <?php
            $args = [
                'post_type' => 'post',
                'posts_per_page' => 8
            ];
            $postList = new WP_Query( $args );
        ?>
        <div class="c-tintuc-header">
            <h2 class="c-titleStyle2">TIN TỨC</h2>
            <a href="<?php echo home_url('/tin-tuc/') ?>" class="c-tintuc-header__xemthem">Xem thêm</a>
        </div>
        <div class="c-tintuc-box mt-50 mt-s-30">
            <?php
            if ( $postList->have_posts() ): ?>
            <div class="swiper-container js-tintuc-slide">
                <div class="swiper-wrapper">
                <?php
                    while ( $postList->have_posts() ):
                        $postList->the_post();
                        echo "<div class=\"swiper-slide\">";
                        get_template_part('page/views/postViewNewsItem');
                        echo "</div>";
                    endwhile;
                ?>
                </div>
            </div>
            <?php
            endif;
            ?>
        </div>
		<div class="c-tintuc-bottom">
			<a href="<?php echo home_url('/tin-tuc/') ?>" class="c-tintuc-bottom__xemthem">Xem thêm</a>
		</div>
    </div>
</section>

<?php get_footer(); ?>
