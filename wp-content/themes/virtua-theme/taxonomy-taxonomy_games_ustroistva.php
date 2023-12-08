<?php
/**
 * The template for displaying all pages.

 */

get_header(); ?>
<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
						
					<? /* $query->set('posts_per_page',3); */ ?>
					<div class="block">
							<?php if ( have_posts() ) : ?>
									<div class="block__title">
										<? the_archive_title( '<div class="page-title"><span>', '</span></div>' ); ?>
									</div>
										<?php /* the_archive_description( '<div class="taxonomy-description">', '</div>' ); */ ?>
							<?php endif; ?>
							
							<div class="related related_withfilter">
								
								<?php
									if ( have_posts() ) : ?>
										<?php
										/* Start the Loop */
										while ( have_posts() ) : the_post();

											?>
											
											<div class="posts__item posts__item_col posts__item_col-three">
												<div class="postlist__item postlist__item_related">
													<div class="rating"><? echo get_post_meta ($post->ID,'on_game_rating',true) ?></div>
													<div class="postlist__thumbnail alignleft">
														<a href="<? echo get_permalink($post->ID); ?>" class="postlist__link">
															<? echo get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ); ?>
														</a>
													</div>
													<div class="postlist__item-title  posts__title_fix">
														<a href="<? echo get_permalink($post->ID).'">'.$post->post_title; ?></a>
													</div>
													<div class="posts__options">
														<div>Дата релиза: <strong><? echo get_post_meta ($post->ID,'on_game_data_realise',true); ?></strong></div>
														<div>Платформа: <strong><? echo get_the_term_list( $post->ID, 'taxonomy_games_platform', ' ', ',', '' ); ?></strong></div>
													</div>
												</div>
											</div>
																		
											<?

										endwhile;
/*
										the_posts_pagination( array(
											'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
											'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
											'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
										) );
*/
									else :

//										get_template_part( 'template-parts/post/content', 'none' );

									endif; ?>
								
							</div>
							<? the_posts_pagination( array('screen_reader_text' => ' ', ) ); ?>
					</div>
				</div>
			</div>

	<?php get_sidebar(); ?>
<?php get_footer(); ?>
