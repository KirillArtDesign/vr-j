<?php
/**
 * The template for displaying all pages.

 */

get_header(); ?>

				<!--section-->
				<div class="col-md-8 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
						<div class="block">
							
							<?php while ( have_posts() ) : the_post(); ?>

								<?php  $id_post_sim = get_the_ID(); get_template_part( 'template-parts/content', 'single' ); ?>

							<?php endwhile; // End of the loop. ?>
						</div>
						
						<?  
							$category_list = get_the_category(); 
							$id_cat = $category_list[0]->cat_ID;
							echo do_shortcode('[on_similar_news_in_home id_cat="'.$id_cat.'" id_post="'.$id_post_sim.'"]');  
						?>
						
						<!--reviews-->
						<div class="block">
							<div class="block__title comments-block__title">
								<span>Комментарии</span>
							</div>
							<div class="row">
								<div class="col-sm-12 col-xs-12 comments-block">
									
									<?php 

										// if(get_the_ID() == 465 ) {
											comments_template();  
										// } else {
											// disqus_embed('http-vr-j-ru-1'); 
										// }


										
										
									?> 
									
								</div>
							</div>
		<!--				<div class="more more_border">
								<a href="#" class="more__link">Показать еще отзывы</a>
							</div> -->
						</div>
						<!--/reviews-->
					</div>
				</div>
				<!--/section-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
