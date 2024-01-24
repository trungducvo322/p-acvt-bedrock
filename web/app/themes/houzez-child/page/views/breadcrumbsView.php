<?php
    $breadcrumbs = isset( $args['breadcrumbs_list'] ) ? $args['breadcrumbs_list']  : '';
    if (!empty($breadcrumbs)): ?>
        <div class="c-breadcrumbs">
            <?php 
            foreach ($breadcrumbs as $key => $breadcrumb):
                echo "<a href=\" ". $breadcrumb['url'] ." \" class=\"c-breadcrumbs__each\">" . $breadcrumb['name'] . "</a>";
                if ($key < count($breadcrumbs) - 1) {
                    echo "<span class\"c-breadcrumbs__slash\">\</span>";
                }
            endforeach; ?>
        </div>
    <?php   
    endif;