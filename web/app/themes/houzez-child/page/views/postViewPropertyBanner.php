<?php 

    $banners = [
        "assets/img/banner/img_banner-side1.jpg",
        "assets/img/banner/img_banner-side2.jpg",
        "assets/img/banner/img_banner-side3.jpg",
        "assets/img/banner/img_banner-side4.jpg",
    ];

?>

<div class="bannerSide">
    <?php 
        if (!empty($banners)): 
            foreach ($banners as $key => $banner): ?>
                <div class="bannerSide-item">
                    <img src="<?php echo PAS . $banner ?>" alt="">
                </div>
            <?php
            endforeach;        
        endif;
    ?>
</div>
