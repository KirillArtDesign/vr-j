<?php
/**
 * The template used for displaying page content in page.php

 */

?>
							<div class="article">
								<? the_title( '<h1 class="block__title"><span>', '</span></h1>' ); ?>
								<div class="game">
									<div class="row">
										<div class="game__gallery col-xs-12">
											<div class="game__thumb">
												<?php  
													if (class_exists('MultiPostThumbnails')) { 
															if ( MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'secondary-img' )) {
																MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'secondary-img', NULL, 'original');
															} else {
																the_post_thumbnail('original'); 
															}
													} else { the_post_thumbnail('original'); }
													
												?>  
											</div>
											<div class="game__thumb game__thumb_video">
												<? echo do_shortcode('[video src="'.get_post_meta ($post->ID,'on_game_video',true).'"]'); ?>
											</div>
											<div class="game__thumb game__carousel">
												<?php
												$images = twp_get_post_images($post->ID);
												foreach ($images as $im) {
												$thumb_url = wp_get_attachment_image_src($im->id, 'exlusive-post-thumb', true);
												$thumb_url_orig = wp_get_attachment_image_src($im->id, 'large', true);
												?>
													<div class="game__carousel-item">
														<?/*  print_r($thumb_url); */ ?>
														<a href="<?php echo $thumb_url_orig[0]; ?>" class="modal" rel="group"><img src="<?php echo $thumb_url[0]; ?>"></a>
													</div>
												<?php
												}
												?>
											</div>
										</div>
										<div class="game__content col-xs-12">
											<?php if (get_post_meta($post->ID,'on_game_rating',true)) { echo '<div class="rating rating__game">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>'; } ?>
											<div class="game__content-title">
											<?	$top_text = get_post_meta ($post->ID,'on_game_top_text',true);
												if ($top_text=='') {
													echo "<div> &nbsp; &nbsp; </div>&nbsp; ";
												} else {
													echo $top_text;
												}
											?>
											</div>
											<div class="game__block-gray" style="clear:right;">
												Рейтинг: Steam: <?php echo get_post_meta ($post->ID,'on_game_otsenka_stream',true); ?> | PlayStation Store: <?php echo get_post_meta ($post->ID,'on_game_otsenka_ps',true); ?>
											</div>
											<div class="game__block-gray">
												<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
											</div>
											<div class="game__info">
												<div><span class="strong">Жанр:</span> <?php echo str_replace(",",", ", get_the_term_list( $post->ID, 'games-genre', ' ', ',', '' )); ?></div>
												<div><span class="strong">Разработчик: </span> <?php echo str_replace(",",", ", get_the_term_list( $post->ID, 'games-razrab', ' ', ',', '' )); ?></div>
												<div><span class="strong">Издатель: </span> <?php echo str_replace(",",", ", get_the_term_list( $post->ID, 'games-izdatel', ' ', ',', '' )); ?></div>
												<div><span class="strong">Доступные платформы:</span> <?php echo str_replace(",",", ", get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' )); ?></div>
												<div><span class="strong">Поддерживаемые устройства:</span> <?php echo str_replace(",",", ", get_the_term_list( $post->ID, 'games-ustroistva', ' ', ',', '' )); ?></div>
												<div><span class="strong">Дата релиза:</span> <?php echo get_post_meta ($post->ID,'on_game_data_realise',true); ?></div> 
												<div><span class="strong">Год выпуска:</span><?php echo str_replace(",",", ", get_the_term_list( $post->ID, 'games-year', ' ', ',', '' )); ?></div> 
												<div><span class="strong">Системные требования: </span> <?php echo get_post_meta ($post->ID,'on_game_sis',true); ?></div>
												<div><span class="strong">Наличие русской локализации: </span> <?php echo get_post_meta ($post->ID,'on_game_rus_locate',true); ?></div>
											</div>
										</div>
										<div class="col-xs-12">
											<div class="game__desc">
												<span class="strong">Описание: </span> <?php the_content(); ?>
											</div>
										</div>
									</div>
								</div>
							</div>