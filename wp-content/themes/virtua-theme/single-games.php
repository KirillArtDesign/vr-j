<?php
/**
 * The template for displaying all pages.

 */

get_header(); ?>

				<!--section-->
				<div class="col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
						<div class="block">
							
							<?php while ( have_posts() ) : the_post(); ?>
								
								<?php get_template_part( 'template-parts/content', 'single-games' ); ?>

								<?php
									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;
								?>

							<?php endwhile; // End of the loop. ?>
							
						</div>
						<!--reviews-->
						<div class="block">
					
							<div class="row">
								<div class="col-sm-12 col-xs-12">
						
								</div>
							</div>
		<!--				<div class="more more_border">
								<a href="#" class="more__link">Показать еще отзывы</a>
							</div> -->
						</div>
						<!--/reviews-->
						<?php echo do_shortcode("[on_similar_games]"); ?>
					</div>
				</div>
				<!--/section-->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
