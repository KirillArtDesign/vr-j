<?php
/**
 * The template for displaying all pages.

 */

get_header(); ?>
	

		<!--section-->
		<div class="col-md-8 col-xs-12">
			<div class="section">
				<div class="block"> 
					
					<?php while ( have_posts() ) : the_post(); ?>

						<div class="article video-single">
							
							<?php the_field('video') ?>
							<? the_title( '<h1 class="video__title">', '</h1>' ); ?>
							<span class="view-ico_black"><?php echo get_post_meta ($post->ID,'views',true); ?> просмотров</span>
							<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
							<script src="//yastatic.net/share2/share.js"></script>

							<div class="posts__data posts__data_big video_share">
								
								<span class="date-video"><?php  echo get_the_date('d F Y'); ?></span>
								
								<?php echo do_shortcode('[likebtn lang="ru" white_label="'.get_the_id().'" popup_disabled="1"]') ?>
								<div class="ya-share2" data-services="vkontakte,facebook,twitter,telegram"></div>
							</div>
							
							<div class="article__body">
								<p class="article__body_desc-video">Описание видео</p>
								<?php the_content() ?>	
							</div>

							<div class="article__body no-border-top">
								<strong>Подписывайтесь на наш</strong> <a href="https://tgclick.com/VR_Journal">Telegram</a>
							</div> 
									
							
							
						</div>

					<?php endwhile; ?>
				</div>
				
				
				<!--reviews-->
				<div class="block">
					<div class="block__title comments-block__title">
						<span>Комментарии</span>
					</div>
					<div class="row">
						<div class="col-sm-12 col-xs-12 comments-block">
							
							<?php 

								comments_template();  
								
							?> 
							
						</div>
					</div>

				</div>
				<!--/reviews-->
			</div>
		</div>
		<!--/section-->

			<!--sidebar-->
	<div class="col-md-4 col-xs-12">
		<div class="aside">

			<div id="sidebar-2" class="widget block">
				<div class="block__title">
					<span>Похожие видео</span>
				</div>
				<div class="list-cat">
					<ul>
					<?php 

						$term = get_the_terms(get_the_id(), 'video');

						// var_dump( $term);
						$query = new WP_Query([
							'post_type' => 'video_post',
							'posts_per_page' => 3,  
							'orderby' => 'rand',
							'post__not_in' => [get_the_id()], 
							'tax_query' => array( 
								array(
									'taxonomy' => 'video',
									'field'    => 'id',
									'terms'    => $term[0]->term_id 
								)
							)
						]); 

						while ($query->have_posts()) {
							$query->the_post(); ?>

							<div class="list-video__item list-video__item_full">
								
								<div class="list-video__img"> 
									<a href="<?php the_permalink() ?>"> 
									<?php the_post_thumbnail(['220', '220']) ?>
									</a>
								</div>
								<a href="<?php the_permalink() ?>">
									<sapn class="list-video__name"><?php the_title() ?></sapn>
								</a>  
								<span class="view-ico_black view_in-cat"><?php echo get_post_meta (get_the_ID(),'views',true) ? get_post_meta (get_the_ID(),'views',true) : 0; ?> просмотров</span>
								<?php echo do_shortcode('[likebtn lang="ru" white_label="'.get_the_id().'" popup_disabled="1"]') ?>
							</div> 

							<?php
						}
					?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--/sidebar-->

<?php get_footer(); ?>
