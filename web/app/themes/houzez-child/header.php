<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
global $houzez_local;
$houzez_local = houzez_get_localization();
/**
 * @package Houzez
 * @since Houzez 1.0
 */
?>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no,address=no,email=no">
	<link rel="icon" href="">
	<link rel="apple-touch-icon" href="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
	<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/css/lightgallery.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/css/lg-thumbnail.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/css/lg-autoplay.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lg-video.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= PAS; ?>assets/css/style.css">
	<meta name="agd-partner-manual-verification" />
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-EGK9C4PJ1V"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'G-EGK9C4PJ1V');
	</script>
	<?php wp_head(); ?>
	<?php if (get_field('header_script', 'option')) : ?>
		<?php the_field('header_script', 'option'); ?>
	<?php endif; ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<!--▼ Header ▼-->
	<header>
		<div class="header__upper">
			<div class="l-container">
				<div class="d-flex justify-content-between align-items-center">
					<div class="header__logo">
						<div class="header__logo">
							<a href="<?= home_url('/'); ?>">
								<?php $custom_logo_id = get_theme_mod('custom_logo');
								$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
								if (has_custom_logo()) {
									echo '<img class="w-100" src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
								} else {
									echo '<h1>' . get_bloginfo('name') . '</h1>';
								}
								?>
							</a>
						</div>
					</div>

					<div class="header__nav">
						<ul class="d-flex align-items-center">
							<li>
								<a href="javascript:void(0)">
									<?php echo do_shortcode('[ivory-search id="24241" title="Default Search Form"]'); ?>
								</a>
							</li>

							<li class="menu__inner">
								<a href="#" class="header__navLink">
									<a href="javascript:void(0)" class="menu__button"><span>MENU</span></a>
								</a>
							</li>
						</ul>

						<?php
						wp_nav_menu(array(
							'menu_class' => "header__navList",
							'container' => "ul",
							'container_class' => "1",
							'theme_location' => "main-menu",
							'list_item_class'  => 'header__navItem',
							'link_class'   => 'header__navLink',
						));
						?>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!--▲ Header ▲-->
	<main id="main-wrap" class="main-wrap ">
