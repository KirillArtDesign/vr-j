
	<!--sidebar-->
	<div class="col-md-3 col-xs-12">
		<div class="aside" id="sticky">
			<div class="sticky-anchor"></div>
			<div id="sidebar-2" class="widget block video-sidaber">
				<div class="block__title">
					<span>Категории</span>
				</div>
				<div class="list-cat">
					<ul>
					<?php 

						$args = array(
							'taxonomy' => 'video_cat', 
							'hide_empty' => false,
						);
						$terms = get_terms( $args );

						foreach ($terms as $term) { 
							$term_id = $term->term_id;
							$term_link = get_term_link($term_id, 'video_cat');
							?>
							<li><a href="<?php echo $term_link ?>"><?php echo $term->name; ?></a></li>
						<?php
						}

					?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--/sidebar-->
