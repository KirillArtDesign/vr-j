<?php
/*
Template Name: Страница видео
*/

get_header(); ?>

	<?php get_sidebar('video'); ?>
	<!--section-->
	<div class="col-md-9 col-xs-12">
		<div class="section">
			<div class="block all-video"> 
				 
				<?php

					$args = array(
						'taxonomy' => 'video_cat', 
						'hide_empty' => false, 
					);
					$terms = get_terms( $args );

					foreach ($terms as $term) { 
						$term_id = $term->term_id;
						$term_link = get_term_link($term_id, 'video_cat');

						$query = new WP_Query([ 
							'post_type' => 'video', 
							'posts_per_page' => 3,
							'video_cat' => $term->slug 
						]); 
						?>
						<div class="list-video__wrap-title">
							<a href="<?php echo $term_link ?>" class="list-video__title"><?php echo $term->name; ?></a>
						</div>
						<div class="list-video">
						<?php
						while ( $query->have_posts() ) {
							$query->the_post(); ?>

							<div class="list-video__item">
								
									<div class="list-video__img">
										<a href="<?php the_permalink() ?>">
										<?php the_post_thumbnail(['280', '120']) ?>
										</a>
									</div>
									<a href="<?php the_permalink() ?>"><sapn class="list-video__name"><?php the_title() ?></sapn></a>
									<span class="view-ico_black view_in-cat"><?php echo get_post_meta (get_the_ID(),'views',true) ? get_post_meta (get_the_ID(),'views',true) : 0; ?> просмотров</span>
									<?php echo do_shortcode('[likebtn lang="ru" white_label="'.get_the_id().'" popup_disabled="1"]') ?>
								
							</div>

							<?php
						} 
						?>
						</div>
						<div class="video-cat">
							<a href="<?php echo $term_link ?>" class="video-cat__link">Все видео из раздела</a>
						</div>
						<?php
						

						wp_reset_postdata(); 
						?>
					<?php
					} 

					
				?>
				
				<?php

				while ( have_posts() ) : the_post(); ?>

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


<?php get_footer(); ?>
