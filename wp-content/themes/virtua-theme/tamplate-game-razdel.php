<?php
/*
Template Name: Раздел: Игры
*/
get_header(); ?>

				<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
						
						<!--hotnews-->
						
						<div class="block">
							<h1 class="block__title">
										<span><? the_title( '<span>', '</span>' ); ?></span>
							</h1>
							<?php while ( have_posts() ) : the_post(); ?>

								<?php the_content(); ?>

							<?php endwhile; // End of the loop. ?>

						</div>
					</div>
				</div>
				<!--/section-->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	<!--/main-->
<?php get_footer(); ?>