<?php
/**
 * The template for displaying all pages.

 */

get_header(); ?>
<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
						
						<?
						$args = array('post_type' => 'post' );
						$args = array(
									   'post_type' => array('post'), 
									   'publish' => true,
								//	   'posts_per_page' => 12,
									   'paged' => get_query_var('paged'),
									   's' => $_GET['s']
								   );
						query_posts($args);
						?>
						
					<div class="block news">
							<?php if ( have_posts() ) : ?>
									<div class="block__title">
										<div class="page-title"><span>Поиск: <? echo $_GET['s']; ?></span></div>
									</div>
										<?php /* the_archive_description( '<div class="taxonomy-description">', '</div>' ); */ ?>
							<?php endif; ?>
												
							<div class="posts posts_borderbottom posts_flex">
								<?php
									if ( have_posts() ) : ?>
										<?php
										/* Start the Loop */
										while ( have_posts() ) : the_post();

											?>
											<div class="posts__item news__item posts__item_col posts__item_col-two posts__item_flex">
												<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
													<a href="<?php the_permalink(); ?>" class="posts__thumbnail news__thumbnail">
														<?php the_post_thumbnail( 'post-list-thumb' ); ?>
													</a>
												<?php endif; ?>
												<? the_title( '<div class="posts__title news__title posts__title_bold"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></div>' ); ?>
																								
												<div class="posts__excerpt">
													<? the_excerpt(); echo ' <a class="strong" href="'. get_permalink($post->ID) . '">' . '«Показать полностью»' . '</a> '; ?>   
												</div>
												<div class="posts__data-flex">
													<div class="posts__meta posts__meta_static alignleft">
														<span class="comment-ico view-ico_gray"><?php echo get_post_meta ($post->ID,'views',true); ?></span>
														<span class="view-ico comment-ico_gray"><?php comments_number('0', '1', '%'); ?></span>
													</div>
													<div class="alignright posts__data">
														<?php /* the_author(); */ ?> <?php  echo get_the_date('d F Y'); ?>
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
							
							<? the_posts_pagination( array('screen_reader_text' => ' ', 'mid_size'     => 9, ) ); ?>
					</div>
				</div>
			</div>

	<?php get_sidebar(); ?>
<?php get_footer(); ?>
