<?php
/*
Template Name: Обычные страницы
*/
get_header(); ?>

				<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
						
						<!--hotnews-->
						<div class="block">
							<?php while ( have_posts() ) : the_post(); ?>

								<?php the_content(); ?>

							<?php endwhile; // End of the loop. ?>
						</div>
				</div>
				<!--/section-->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	<!--/main-->
<?php get_footer(); ?>