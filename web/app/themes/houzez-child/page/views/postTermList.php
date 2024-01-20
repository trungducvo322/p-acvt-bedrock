<?php
$taxos = get_the_terms( get_the_ID(), 'property_type' );

if ($taxos) {
    echo "<div class=\"c-propertyTypeTag\">";
    foreach ($taxos as $key => $taxo) {
        $color = get_field('color', 'property_type_'.$taxo->term_id);
        ?>
        <div class="c-propertyTypeTag__each" style="background-color: <?php echo $color ? $color : '#000' ?>;"><?php echo $taxo->name ?></div>
        <?php
    }

    echo "</div>";
}
