<?php
/**
 * The sidebar containing the main widget area.
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<?php
if ( wp_is_mobile() ) {
	// тут выполняем действия только для мобильных устройств.
} elseif (is_single()) { ?>
				<!--sidebar-->
				<div class="col-md-4 col-xs-12">
					<div class="aside">
                        <div id="sidebar-2" class="widget block">
							<div class="block__title">
								<span>ТЕГИ</span>
							</div>
							<div class="tagcloud">
								<?php 
									$args = array(
										'smallest' => 10, 
										'largest' => 32, 
										'unit' => 'px',
										'number' => 28,
										'format' => 'flat', 
										'separator' => '', 
										'orderby' => 'count', 
										'order' => 'ASC',
										'exclude' => '1607', 
										'include' => '', 
										'link' => 'view',
										'taxonomy' => 'post_tag',
										'echo' => 0,
										'format' => 'array'
									); 

									$list = wp_tag_cloud( $args ); 
									$first = "";

									//ADD META TAG
									//array_unshift($list, '<a href="'.get_tag_link(1559).'" class="tag-cloud-link tag-link-1559 tag-link-position-'.(count($list) + 1).'" style="font-size: 32px;" aria-label="Meta">Meta</a>');
									array_splice($list, 14, 0, '<a href="'.get_tag_link(1607).'" class="tag-cloud-link tag-link-1607 tag-link-position-15" style="font-size: 32px" aria-label="Метавселенные">Метавселенные</a>');
									array_splice($list, 15, 0, '<a href="'.get_tag_link(1701).'" class="tag-cloud-link tag-link-1701 tag-link-position-16" style="font-size: 32px" aria-label="Apple Vision Pro">Apple Vision Pro</a>');


									foreach ($list as $key => $value) {
										if(strip_tags($value) == 'Magic Leap' ) {
											$first = $value;
											unset($list[$key]);
										}
									}

									// array_unshift($list, $first);
									$i=0;
									foreach ($list as $key => $value) {
										$i++;
										if($i == 4) {
											$list[4] = $first;
											$i++;
											$list[$i] = $value; 
										} 
										if( $i > 4 ) {
											$list[$i] = $value;
										}
									}

									foreach ($list as $key => $value) {
										echo $value;
									}

								?>
						</div>
                            <?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div>
			</div>
                </div>

	<?php
} else { ?>
				<!--sidebar-->
				<div class="col-md-3 col-xs-12">
					<div class="aside">
                        <div id="sidebar-2" class="widget block">
							<div class="block__title">
								<span>ТЕГИ</span>
							</div>
							<div class="tagcloud">
								<?php 
						
									$args = array(
										'smallest' => 10, 
										'largest' => 32, 
										'unit' => 'px',
										'number' => 28,
										'format' => 'flat', 
										'separator' => '', 
										'orderby' => 'count', 
										'order' => 'ASC',
										'exclude' => '1607', 
										'include' => '', 
										'link' => 'view',
										'taxonomy' => 'post_tag',
										'echo' => 0,
										'format' => 'array'
									); 

									$list = wp_tag_cloud( $args ); 
									$first = "";

									//ADD META TAG
									//array_unshift($list, '<a href="'.get_tag_link(1559).'" class="tag-cloud-link tag-link-1559 tag-link-position-'.(count($list) + 1).'" style="font-size: 32px;" aria-label="Meta">Meta</a>');
									array_splice($list, 14, 0, '<a href="'.get_tag_link(1607).'" class="tag-cloud-link tag-link-1607 tag-link-position-15" style="font-size: 32px" aria-label="Метавселенные">Метавселенные</a>');									
									array_splice($list, 15, 0, '<a href="'.get_tag_link(1701).'" class="tag-cloud-link tag-link-1701 tag-link-position-16" style="font-size: 32px" aria-label="Apple Vision Pro">Apple Vision Pro</a>');


									foreach ($list as $key => $value) {
										if(strip_tags($value) == 'Magic Leap' ) {
											$first = $value;
											unset($list[$key]);
										}
									} 
									// array_unshift($list, $first); 

									$i=0;
									foreach ($list as $key => $value) {
										$i++;
										if($i == 4) {
											$list[4] = $first;
											$i++;
											$list[$i] = $value; 
										} 
										if( $i > 4 ) { 
											$list[$i] = $value;
										}
									}

									foreach ($list as $key => $value) {
										echo $value;
									}

							?>
						</div>

						<?php dynamic_sidebar( 'sidebar-1' ); ?>
						</div>
				</div>
    </div>

	<?php } ?>
