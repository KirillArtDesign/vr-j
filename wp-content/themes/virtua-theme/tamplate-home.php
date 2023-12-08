<?php
/*
Template Name: Главная страница
*/
get_header(); ?>

				<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
						
						<!--hotnews-->
						<div class="block">
							<?php while ( have_posts() ) : the_post(); ?>

								<?php the_content(); /* [on_new_hot_news] */ ?>

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
	<?php echo do_shortcode('[on_new_exlusive_news][on_new_last_news]'); ?>
<?php get_footer(); ?>