</main>

<!--▼ Footer ▼-->
<footer class="footer">
	<div class="l-container">
		<div class="footer__inner d-flex flex-lg-row flex-column justify-content-between align-items-center">
			<div class="footer__copyright d-flex flex-wrap justify-content-md-end justify-content-around align-items-center">
				<?php if (get_field('copyright', 'option')) { ?>
					<span class="light">
						<?php the_field('copyright', 'option'); ?>
					</span>
				<?php } ?>
				<div class="footer__btn d-flex align-items-center justify-content-around">
					<a href="tel:<?php the_field('hotline', 'option'); ?>">
						<img src="<?= PAS ?>assets/img/icon-tel.png" alt="#">
					</a>
					<a href="#">
						<img src="<?= PAS ?>assets/img/icon-chat.png" alt="#">
					</a>
				</div>

			</div>

			<a href="tel:<?php the_field('hotline', 'option'); ?>" class="phone">
				<div class="ring">
					<div class="alo-phone alo-green alo-show">
						<div class="alo-ph-circle"></div>
						<div class="alo-ph-circle-fill"></div>
						<div class="alo-ph-img-circle"></div>
					</div>
				</div>
			</a>

			<a href="#" class="c-backtop js-backtop d-flex justify-content-center align-items-center">
				<div class="c-backtop__btn">&nbsp;</div>
			</a>
		</div>
	</div>
</footer>

<!--▲ Footer ▲-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/lightgallery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.5/plugins/autoplay/lg-autoplay.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/video/lg-video.min.js"></script>

<script src="<?= PAS ?>assets/js/main.js"></script>

</body>
<?php wp_footer(); ?>

<?php if (get_field('footer_script', 'option')) : ?>
  <?php the_field('footer_script', 'option'); ?>
<?php endif; ?>

</html>