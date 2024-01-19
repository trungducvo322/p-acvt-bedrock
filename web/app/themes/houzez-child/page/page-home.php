<?php
/*
Template Name: Trang chủ
*/
?>
<?php get_header(); ?>

<?php if (is_front_page()) {
	get_template_part("template-parts/mainv");
} ?>

<?php get_template_part("template-parts/clients");  ?>

<?php get_footer(); ?>