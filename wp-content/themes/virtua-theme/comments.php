<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="block">
	<div class="block__title"><span>Последние комментарии</span></div>
	<div class="comments row">
						<?php
							// You can start editing here -- including this comment!
							if ( have_comments() ) : ?>
								<h2 class="comments-title">
									<?php
										$comments_number = get_comments_number();
										if ( '1' === $comments_number ) {
											/* translators: %s: post title */
											printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'twentyseventeen' ), get_the_title() );
										} else {
											printf(
												/* translators: 1: number of comments, 2: post title */
												_nx(
													'%1$s Reply to &ldquo;%2$s&rdquo;',
													'%1$s Replies to &ldquo;%2$s&rdquo;',
													$comments_number,
													'comments title',
													'twentyseventeen'
												),
												number_format_i18n( $comments_number ),
												get_the_title()
											);
										}
									?>
								</h2>

								
								<div class="comments__item">
									<?php
							
										wp_list_comments([
											'type' => 'comment',
											'callback' => 'mytheme_comment',
											'short_ping'  => true,
											'style'       => 'div',
											'reply_text'  => 'Ответить',
											'per_page' => 0
										]);
									
									?>
															
								</div>
														

								<?php the_comments_pagination( );

							endif; // Check for have_comments().

							// If comments are closed and there are comments, let's leave a little note, shall we?
							if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

								<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyseventeen' ); ?></p>
							<?php
							endif;
							$arg = [
								'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8"  aria-required="true" placeholder="Написать комментарий..." required="required"></textarea></p>'
							];

							comment_form($arg);
							?>	
	
	</div>
</div>




