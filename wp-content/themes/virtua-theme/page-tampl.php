<?php
/*
Template Name: Обчная страница ON
*/

get_header(); ?>

				<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
						<div class="block">
							
							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'template-parts/content', 'page' ); ?>

								<?php
									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;
								?>

							<?php endwhile; // End of the loop. ?>
							
						</div>
					</div>
				</div>
				<!--/section-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
