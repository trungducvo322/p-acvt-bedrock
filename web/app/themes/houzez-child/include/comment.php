<?php
//comment for CPT
add_filter('comments_open', 'my_comments_open', 10, 2);

function my_comments_open($open, $post_id)
{

	$post = get_post($post_id);

	if ('property' == $post->post_type)
		$open = true;

	return $open;
}

add_filter('comment_form_default_fields', 'website_remove');
function website_remove($fields)
{
	if (isset($fields['url']))
		unset($fields['url']);
	return $fields;
}

add_action( 'comment_form_logged_in_after', 'ci_comment_rating_rating_field' );
add_action( 'comment_form_before_fields', 'ci_comment_rating_rating_field' );
function ci_comment_rating_rating_field () {
	?>
	<label for="rating" class="rating__title">Đánh giá<span class="required">*</span></label>
	<fieldset class="comments-rating">
		<span class="rating-container">
			<?php for ( $i = 5; $i >= 1; $i-- ) : ?>
				<input type="radio" id="rating-<?php echo esc_attr( $i ); ?>" name="rating" value="<?php echo esc_attr( $i ); ?>" /><label for="rating-<?php echo esc_attr( $i ); ?>"><?php //echo esc_html( $i ); ?></label>
			<?php endfor; ?>
			<input type="radio" id="rating-0" class="star-cb-clear" name="rating" value="0" /><label for="rating-0">0</label>
		</span>
	</fieldset>
	<?php
}

//Save the rating submitted by the user.
add_action( 'comment_post', 'ci_comment_rating_save_comment_rating' );
function ci_comment_rating_save_comment_rating( $comment_id ) {
	// if( ! isset( $_POST['rating'] ) || ! wp_verify_nonce( $_POST['rating'], 'rating' ) ) wp_die();
	if ( ( isset( $_POST['rating'] ) ) && ( '' !== $_POST['rating'] ) )
	$rating = htmlspecialchars(intval( $_POST['rating'] ));
	add_comment_meta( $comment_id, 'rating', $rating );
}

//Make the rating required.
add_filter( 'preprocess_comment', 'ci_comment_rating_require_rating' );
function ci_comment_rating_require_rating( $commentdata ) {
	if ( ! is_admin() && ( ! isset( $_POST['rating'] ) || 0 === intval( $_POST['rating'] ) ) )
	wp_die( __( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.' ) );
	return $commentdata;
}

//Display the rating on a submitted comment.
add_filter( 'comment_text', 'ci_comment_rating_display_rating');
function ci_comment_rating_display_rating( $comment_text ){

	if ( $rating = get_comment_meta( get_comment_ID(), 'rating', true ) ) {
		$stars = '<p class="stars">';
		for ( $i = 1; $i <= $rating; $i++ ) {
			$stars .= '<span class="dashicons dashicons-star-filled"></span>';
		}
		$stars .= '</p>';
		$comment_text = $comment_text . $stars;
		return $comment_text;
	} else {
		return $comment_text;
	}
}