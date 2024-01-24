</main>

	<a class="c-backToTop js-backToTop"></a>
<!--▼ Footer ▼-->
</main>
<footer class="c-footer">
	<div class="l-container c-footer-grid">
		<div class="c-footerLogo c-footer-grid__full">
			<div class="c-footerLogo-icon">
				<picture>
					<img srcset="<?php echo PAS ?>/assets/img/logo/logo_footer-white.png, <?php echo PAS ?>/assets/img/logo/logo_footer-white@2x.png 2x" src="<?php echo PAS ?>/assets/img/logo/logo_footer-white@2x.png" alt="Ăn chơi vũng tàu logo">
				</picture>
			</div>
		</div>
		<div class="c-footerContact c-footer-grid__left">
			<div class="c-footerContact-each c-footerContact-email">
				<a href="mailto:anchoivungtau72@gmail.com">
					<img src="<?php echo PAS ?>/assets/img/ico/ico_email.png" alt="Email icon">
					Email: anchoivungtau72@gmail.com
				</a>
			</div>
			<div class="c-footerContact-each c-footerContact-phone">
				<a href="tel:0917728668">
					<img src="<?php echo PAS ?>/assets/img/ico/ico_phone.png" alt="Phone icon">
					Hotline: <span class="highlight">09117 28668</span>
				</a>
			</div>
		</div>
		<div class="c-footerSocial c-footer-grid__right">
			<p class="c-footerSocial__header">Kết nối với chúng tôi</p>
			<div class="c-footerSocial-facebook">
				<a href="http://" target="_blank" rel="noopener noreferrer">
					<img src="<?php echo PAS ?>/assets/img/ico/ico_facebook-white.png" alt="Facebook logo">
				</a>
			</div>
			<div class="c-footerSocial-tiktok">
				<a href="http://" target="_blank" rel="noopener noreferrer">
					<img src="<?php echo PAS ?>/assets/img/ico/ico_tiktok-white.png" alt="Tiktok logo">
				</a>

			</div>
			<div class="c-footerSocial-instagram">
				<a href="http://" target="_blank" rel="noopener noreferrer">
					<img src="<?php echo PAS ?>/assets/img/ico/ico_instagram-white.png" alt="Instagram logo">
				</a>

			</div>
			<div class="c-footerSocial-youtube">
				<a href="http://" target="_blank" rel="noopener noreferrer">
					<img src="<?php echo PAS ?>/assets/img/ico/ico_youtube.png" alt="Youtube logo">
				</a>

			</div>
			<div class="c-footerSocial-zalo">
				<a href="http://" target="_blank" rel="noopener noreferrer">
					<img src="<?php echo PAS ?>/assets/img/ico/ico_zalo-white.png" alt="Zalo logo">
				</a>
			</div>
		</div>
		<div class="c-footerCopyright c-footer-grid__full">
			<p class="">© 2023 Bản quyền thuộc về <span class="dib">Công ty Cổ Phần Truyền Thông Du Phong</span></p>
		</div>
	</div>

</footer>

<!--▲ Footer ▲-->
<script>var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/lightgallery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/plugins/autoplay/lg-autoplay.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/video/lg-video.min.js"></script>
<script src="<?= PAS ?>assets/js/main.js"></script>

</body>
<?php wp_footer(); ?>
<!--
<?php if (get_field('footer_script', 'option')) : ?>
  <?php the_field('footer_script', 'option'); ?>
<?php endif; ?> -->

</html>
