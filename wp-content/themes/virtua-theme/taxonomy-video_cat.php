<?php get_header(); ?>

	<?php get_sidebar('video'); ?>
	<!--section-->
	<div class="col-md-9 col-xs-12">
		<div class="section">
			<div class="list-video__wrap-title">
				<h1 class="list-video__title"><?php echo get_queried_object()->name ?></h1>
				<?php 
					$orderby = "date";
					$order = "DESC"; 
					$meta_key = "";
					$s2 = ' class="active"';
					if ($_POST['select'] == 'newest') { $orderby = "date"; $order = "DESC"; $s2 = ' class="active"'; } 
					if ($_POST['select'] == 'lastest') { $orderby = "date"; $order = "ASC"; $s3 = ' class="active"'; $s2 = ''; }
					if ($_POST['select'] == 'view_more') { $meta_key = "views"; $orderby = "meta_value_num"; $order = "DESC"; $s4 = ' class="active"'; $s2 = ''; }
					if ($_POST['select'] == 'view_less') { $meta_key = "views"; $orderby = "meta_value_num"; $order = "ASC"; $s5 = ' class="active"'; $s2 = ''; }

					if ($_POST['select'] == 'rating_more') { $meta_key = "all_like"; $orderby = "meta_value_num"; $order = "DESC"; $s6 = ' class="active"'; $s2 = ''; }
					if ($_POST['select'] == 'rating_less') { $meta_key = "all_like"; $orderby = "meta_value_num"; $order = "ASC"; $s7 = ' class="active"'; $s2 = ''; }
				?>
				 <form method="POST" id="order" class="order_video">
					 <span class="show-order-list-c"><span class="icon-s-list"></span>Упорядочить</span>
					 <ul class="order-list-c">
					 	<li data-value="newest"<?=$s2?>>По дате (сначала новые)</li>
					 	<li data-value="lastest"<?=$s3?>>По дате (сначала старые)</li>
					 	<li data-value="rating_more"<?=$s6?>>По рейтингу (Наивысший)</li>
					 	<li data-value="rating_less"<?=$s7?>>По рейтингу (Наименьший)</li>
					 	<li data-value="view_more"<?=$s4?>>По числу просмотров (Больше)</li>
					 	<li data-value="view_less"<?=$s5?>>По числу просмотров (Меньше)</li>
					 </ul>
					 <input type="hidden" name="select" class="value">
					<!--  <select name="select" onchange='this.form.submit()' style="width:200px; display: none;">
						 <option value="newest"<?=$s2?>>по дате (сначала новые)</option>
						 <option value="lastest"<?=$s3?>>по дате (сначала старые)</option>
						 <option value="rating_more"<?=$s6?>>по рейтингу (Наивысший)</option>
						 <option value="rating_less"<?=$s7?>>по рейтингу (Наименьший)</option>
						 <option value="view_more"<?=$s4?>>по числу просмотров (Больше)</option>
						 <option value="view_less"<?=$s5?>>по числу просмотров (Меньше)</option>
				 	</select>  -->
				 </form>
			</div>
			<div class="block all-video"> 
				<?php


					$id_term = get_queried_object()->term_id; 

					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					$query = new WP_Query([
						'post_type' => 'video',
						'posts_per_page' => 15, 
						'meta_key' => $meta_key,
						'orderby' => $orderby,
						'order' => $order,
						'paged' => $paged,
						'tax_query' => array( 
							array(
								'taxonomy' => 'video_cat',
								'field'    => 'id',
								'terms'    => $id_term
							)
						)
					]); 

					?>
					<div class="list-video">
					<?php
					while ($query->have_posts()) {
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
					<?php if (  $query->max_num_pages > 1 ) : ?>
						<script>
						var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
						var true_posts = '<?php echo serialize($query->query_vars); ?>';
						var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
						var max_pages = '<?php echo $query->max_num_pages; ?>';
						</script>   
						<div class="more_center" id="true_loadmore">
							<a href="#" class="more__link">Показать еще</a>
						</div>
					<?php endif; ?>
					<?php


					// wp_reset_postdata();  
				?>
				<p class="article__body_desc-video">Описание данного раздела</p>

				<div class="video__body">

					<?php  
						$queried_object = get_queried_object(); 
						$taxonomy = $queried_object->taxonomy;$term_id = $queried_object->term_id; 
						the_field('content', $taxonomy . '_' .$term_id); 
					?>

				</div>
				
			</div>
		</div>
	</div>
	<!--/section-->


<?php get_footer(); ?>
