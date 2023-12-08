<?php
/**
 * The template used for displaying page content in page.php

 */

?>
							<div class="block__title">
								<? the_title( '<span>', '</span>' ); ?>
							</div>
							
							<div class="resume">
								<div class="resume__vcard">
									<div class="resume__avatar">
										<?php the_post_thumbnail('afisha-event-thumb'); ?>
									</div>
									<div class="resume__message">
										<a class="eModal-2" href="#" class="btn btn_blue btn_large">Написать</a>
									</div>
								</div>
								<div class="resume__content">
									<div class="resume__textblock resume__textblock_first">
										<div class="resume__title">
											О вакансии:
										</div>
										<div class="resume__text">
											<?php the_content(); ?>
										</div>
									</div>
									<div class="resume__textblock">
										<div class="resume__title">
											Навыки:
										</div>
										<div class="resume__text">
											<p><?php echo get_post_meta ($post->ID,'on_vacancy_navik',true); ?></p>
									<!--	<ul>
												<li>- Программирование, Разработка</li>
												<li>- Системная интеграция</li>
												<li>- Системы автоматизированного проектирования</li>
											</ul> -->
										</div>
									</div>
									<div class="resume__textblock">
										<div class="resume__title">
											Занятость:
										</div>
										<div class="resume__text">
											<p><?php echo get_the_term_list( $post->ID, 'zanyatost', ' ', ',', '' ); ?></p>
											<p>График работы: <?php echo get_the_term_list( $post->ID, 'grafik-work', ' ', ',', '' ); ?></p>
										</div>
									</div>									
									<div class="resume__textblock">
										<div class="resume__title">
											Владение языками:
										</div>
										<div class="resume__text">
											<?php echo get_the_term_list( $post->ID, 'langwich', ' ', ',', '' ); ?>
										</div>
									</div>									
									<div class="resume__textblock">
										<div class="resume__title">
											Образование, курсы, тренинги:
										</div>
										<div class="resume__text">
											<?php echo get_post_meta ($post->ID,'on_vacancy_obraz',true); ?>
										</div>
									</div>									
									<div class="resume__textblock">
										<div class="resume__title">
											Опыт работы:
										</div>
										<?php 					
												// $xopit = json_decode(trim(str_replace("\\", "",  get_post_meta ($post->ID,'on_vacancy_mesta_works',true))), true);
												$xopit = unserialize (get_post_meta ($post->ID,'on_vacancy_mesta_works',true));
										?>
										
										<div class="resume__text">
											<table class="resume__table">
												<? 
													foreach ($xopit as $key => $value) {
														print '<tr>
																	<td class="resume__key">
																		'.$value['work_time'].'
																	</td>
																	<td class="resume__value">
																		'.$value['work_place'].'
																	</td>
																</tr>';
													}
												?>
												
											</table>
										</div>
									</div>
									<div class="resume__textblock resume__tags">
										<div class="resume__title">
											Ключевые навыки
										</div>
										<div class="resume__text tag-naviki">
											<?php echo get_the_term_list( $post->ID, 'key-naviki', ' ', ' ', '' ); ?>
										</div>
									</div>
									<div class="resume__textblock resume__portfolio">
										<div class="resume__title">
											Портфолио
										</div>
										
										<div class="resume__text">
											<ul class="resume__portfoliolist">
												<?php
												$images = twp_get_post_images($post->ID);
												foreach ($images as $im) {
												$thumb_url = wp_get_attachment_image_src($im->id, 'exlusive-post-thumb', true);
												$thumb_url_orig = wp_get_attachment_image_src($im->id, 'large', true);
												?>
													<li>
														<?/*  print_r($thumb_url); */ ?>
														<a href="<?php echo $thumb_url_orig[0]; ?>" class="modal" rel="group"><img src="<?php echo $thumb_url[0]; ?>" alt=""></a>
													</li>
												<?php
												}
												?>
											</ul>
										</div>
									</div>
									<div class="resume__textblock">
										<div class="resume__title">
											Гражданство, время в пути до работы:
										</div>
										<div class="resume__text">											
											Гражданство: <? echo get_post_meta ($post->ID,'on_vacancy_grazdanstvo',true); ?><br>
											Разрешение на работу: <? echo get_post_meta ($post->ID,'on_vacancy_razreshenie',true); ?><br>
											Желательное время в пути до работы: <? echo get_post_meta ($post->ID,'on_vacancy_time',true); ?>
										</div>
									</div>	
								</div>
							</div>