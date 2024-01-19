<?php
function like()
{
    if (get_field('like')) {
        $crLike = get_field('like');
    } else{
        $crLike = 2000;
    }

    if($crLike > 999) {
        $crLikeRound = round($crLike/1000,1);

        $show = $crLikeRound.'k';
    } else {
        $show = $crLike;
    }
    ?>

    <div class="likes js-like" data-post="<?= get_the_ID() ?>" data-like="<?= $crLike ?>"><?= $show ?><div class="likes__note"><span class="likes__noteNumber"><?= $crLike ?></span> lượt thích</div></div>
<?php } ?>
