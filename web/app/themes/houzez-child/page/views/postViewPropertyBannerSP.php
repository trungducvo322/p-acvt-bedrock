<?php
    $banners = isset( $args['list-banner'] ) ? $args['list-banner'] : '';
?>
<div class="banner">
    <?php 
        if (!empty($banners)): 
            foreach ($banners as $key => $banner): ?>
                <div class="banner-item">
                    <img src="<?php echo PAS . $banner ?>" alt="">
                </div>
            <?php
            endforeach;        
        endif;
    ?>
</div>
