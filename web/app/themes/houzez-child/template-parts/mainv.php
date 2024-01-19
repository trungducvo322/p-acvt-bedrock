<?php if (get_field('banner')) :
    $banners = get_field('banner');
?>
    <section class="mainv__inner">
        <div class="mainv__imageBox">
            <div class="swiper-container mainv-container">
                <div class="swiper-wrapper">
                    <?php foreach ($banners as $banner) { ?>
                        <div class="swiper-slide">
                            <img class="mainv__image" src="<?= $banner['image']; ?>" width="1980" height="1042" alt="">
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="swiper-pagination sp-none"></div>
        </div>
    </section>
<?php endif; ?>


