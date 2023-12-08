<?php
header("HTTP/1.0 404 Not Found");
?>
<?php
/*
Template Name: Шаблон 404
*/
?>
<?php get_header(); ?>

				<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
						<div class="block">
							
							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'template-parts/content', 'page' ); ?>
<?php endwhile; // End of the loop. ?>
						</div>
					</div>
				</div>
				<!--/section-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>