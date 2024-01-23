<?php
    global $hide_fields;

    $address    = houzez_get_listing_data('property_address');
    $phone    = houzez_get_listing_data('c491ie1bb87n-thoe1baa1i');
    $city       = houzez_taxonomy_simple('property_city');
    $area       = houzez_taxonomy_simple('property_area');
    $zipcode    = houzez_get_listing_data('property_zip');

?>

<div class="c-singleInfoDetail">
    <div class="c-singleInfoDetail-title">Thông Tin Địa Điểm</div>
    <div class="c-singleInfoDetail-map">Xem trên Google map</div>
    <dl class="c-singleInfoDetail-list">
        <dt>Loại dịch vụ</dt>
        <dd>
            <?php get_template_part('page/views/postTermList') ?>  
        </dd>
        <dt>Địa chỉ</dt>
        <dd><?php echo esc_attr( $address ) ?></dd>
        <dt>Thành phố</dt>
        <dd><?php echo esc_attr( $city ) ?></dd>
        <dt>Phường</dt>
        <dd><?php echo esc_attr( $area ) ?></dd>
        <dt>Liên hệ</dt>
        <dd><a href="tel:<?php echo esc_attr( $phone ) ?>"><?php echo esc_attr( $phone ) ?></a></dd>
    </dl>
</div>

