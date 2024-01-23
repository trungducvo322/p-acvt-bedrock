<?php
$taxos = get_the_terms( get_the_ID(), 'property_type' );

if ($taxos) {
    echo "<div class=\"c-propertyTypeTag\">";
    foreach ($taxos as $key => $taxo) {
        $term_link = (get_term_link( $taxo->term_id , 'property_type'));
        $color = get_field('color', 'property_type_'.$taxo->term_id);
        ?>
        <a href="<?php echo $term_link ?>" class="">
            <div class="c-propertyTypeTag__each" style="background-color: <?php echo $color ? $color : '#000' ?>;"><?php echo $taxo->name ?></div>
        </a>
        <?php
    }

    echo "</div>";
}
