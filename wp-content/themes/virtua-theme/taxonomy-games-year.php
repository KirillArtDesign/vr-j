<?php
/**
 * The template for displaying all pages.

 */

get_header(); ?>
<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
						<? $category = get_queried_object();  $category_ID = $category->term_id; ?>
						<? $descr_top = get_metadata('term', $category->term_id, 'txseo_seo_top_description', 1 ); ?>
						<? if ($descr_top) { ?>
								<div class="block">
									<div class="article">
										<div class="article__body">
											<?php echo $descr_top; // выводим нижнее описание тега ?>
										</div>
									</div>
								</div>
						<? } ?>
						
					<? /* $query->set('posts_per_page',3); */ ?>
					<div class="block">
							<?php if ( have_posts() ) : ?>
									<h1 class="block__title">
										<? the_archive_title( '<div class="page-title"><span>', '</span></div>' ); ?>
									</h1>
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
													<?php if (get_post_meta($post->ID,'on_game_rating',true)) { echo '<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>'; } ?>
													<div class="postlist__thumbnail alignleft">
														<a href="<? echo get_permalink($post->ID); ?>" class="postlist__link">
															<? echo get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ); ?>
														</a>
													</div>
													<div class="postlist__item-title  posts__title_fix">
														<a href="<? echo get_permalink($post->ID).'">'.$post->post_title; ?></a>
													</div>
													<div class="posts__options">
														<div>Дата релиза: <span class="strong"><? echo get_post_meta ($post->ID,'on_game_data_realise',true); ?></span></div>
														<div>Платформа: <span class="strong"><? echo get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ); ?></span></div>
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
					<? $descr_down = get_metadata('term', $category->term_id, 'txseo_seo_down_description', 1 );
								if ($descr_down) { ?>
									<div class="block">
										<div class="article">
											<div class="article__body">
												<?php echo $descr_down; // выводим нижнее описание тега ?>
											</div>
										</div>
									</div>
								<? } ?>
							<!--reviews-->
				<? /*			<div class="block">
								<div class="block__title">
									<span>Комментарии</span>
								</div>
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<?php disqus_embed('vr-j-ru'); ?>
									</div>
								</div>
			<!--				<div class="more more_border">
									<a href="#" class="more__link">Показать еще отзывы</a>
								</div> -->
							</div>
					*/ ?>	<!--/reviews-->
				</div>
			</div>

	<?php get_sidebar(); ?>
<?php get_footer(); ?>
