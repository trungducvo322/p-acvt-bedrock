<?php
    $banners = isset( $args['list-banner'] ) ? $args['list-banner'] : '';
?>
<div class="banner">
    <?php
        if (!empty($banners)):
            foreach ($banners as $key => $banner): ?>
                <div class="banner-item">
                    <a href="http://" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo PAS . $banner ?>" alt="">
                    </a>
                </div>
            <?php
            endforeach;
        endif;
    ?>
</div>
