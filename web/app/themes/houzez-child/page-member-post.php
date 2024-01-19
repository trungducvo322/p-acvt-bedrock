<?php 
/*
 Template Name: Member Post
 */
 get_header();
 ?>
 <main>
 	<div class="container mt-30 member-post">
 		<h1><?php the_title(); ?></h1>
 		<div><?php the_content(); ?></div>
 		<?php echo do_shortcode('[ap-form]'); ?>
 		<?php  if( !is_user_logged_in() ){ ?>
 		<div class="login-register">
 			<ul class="login-register-nav">
 				<li class="login-link">
 					<a class="btn btn-primary btn-memberpost" href="#" data-toggle="modal" data-target="#login-register-form"><?php esc_html_e('Login', 'houzez'); ?></a>
 				</li>					
 				<li class="register-link">
 					<a class="btn btn-success btn-memberpost" href="#" data-toggle="modal" data-target="#login-register-form"><?php esc_html_e('Register', 'houzez'); ?></a>
 				</li>
 			</ul>
 		</div>
 	</div>
<?php } ?>
 </main>



 <?php get_footer(); ?>