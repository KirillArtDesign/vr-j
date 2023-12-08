<?php
/**
 * The template used for displaying page content in page.php

 */

?>
							<div class="block__title">
								<? the_title( '<span> Резюме: ', '</span>' ); ?>
							</div>
							
							<?
							
									// Зарплата
												$ot =  get_post_meta($post->ID,'on_resume_jelanie_zp_ot',true);
												$do =  get_post_meta($post->ID,'on_resume_jelanie_zp_do',true);
												$valuta =  get_post_meta($post->ID,'on_resume_jelanie_zp_valuta',true);
												
												if (!empty($ot)) { $print_price = 'от '.$ot.' '.$valuta.'<br>'; }
												if (!empty($do)) { $print_price.= 'до '.$do.' '.$valuta; }
												if ($ot==$do) { $print_price = $do.' '.$valuta; }
							
							
									$img_adds = get_the_post_thumbnail_url($post->ID, 'afisha-event-thumb' );
									if ($img_adds=='') {$img_adds=get_template_directory_uri().'/images/no-logo.svg';} //Дефолтная картинка
									
									$img_adds_big = get_the_post_thumbnail_url($post->ID, 'large' );
									if ($img_adds_big=='') {$img_adds_big=get_template_directory_uri().'/images/no-logo.svg';} //Дефолтная картинка 2
							?>
							
							<div class="lk resume">
								<div class="resume__vcard">
									<div class="resume__avatar resume__avatar_lk">
										<a href="<?=$img_adds_big;?>" class="fancybox"><img src="<?=$img_adds;?>" alt=""></a>
									</div>
									<div class="resume__message">
										<a href="#message" id="on_popup" class="fancybox btn btn_blue btn_large">Написать</a>
										<input type="hidden" id="author_otklik" name="author_otklik" value="<? echo the_author_meta( 'user_email' ); ?>">
									</div>
									<div class="resume__price text-center">
										заработная плата:
										<div class="strong">
											<?=$print_price;?>
										</div>
									</div>
								</div>
								<div class="resume__content">
									<div class="resume__title">
										Основная информация
									</div>
									<table class="job__table">
										<tr>
											<td>
												ФИО
											</td>
											<td class="text-right strong">
												<? the_title( '', '' ); ?>
											</td>
										</tr>
										<tr>
											<td>
												Дата рождения: 
											</td>
											<td class="text-right strong">
												<? echo get_post_meta($post->ID,'on_resume_dataday',true); ?>
											</td>
										</tr>
										<tr>
										<!--	<td>
												Пол:   
											</td>
											<td class="text-right strong">
												 Мужской
											</td>
										-->
										</tr>
										<tr>
											<td>
												Страна проживания:  
											</td>
											<td class="text-right strong">
												 <? echo get_post_meta($post->ID,'on_resume_land',true); ?>
											</td>
										</tr>
										<tr>
											<td>
												Город проживания:  
											</td>
											<td class="text-right strong">
												 <? echo get_post_meta($post->ID,'on_resume_city',true); ?>
											</td>
										</tr>
										<tr>
											<td>
												Гражданство:
											</td>
											<td class="text-right strong">
												<? echo get_post_meta($post->ID,'on_resume_grajdanstvo',true); ?>
											</td>
										</tr>
									</table>

									<div class="resume__title">
										Желаемая работа
									</div>
									<table class="job__table">
										<tr>
											<td>
												Опыт работы:  
											</td>
											<td class="text-right strong">
												<? echo get_post_meta($post->ID,'on_resume_stage',true); ?>
											</td>
										</tr>
										<tr>
											<td>
												Название должности: 
											</td>
											<td class="text-right strong">
												<? echo get_post_meta($post->ID,'on_resume_jelanie_rang',true); ?>
											</td>
										</tr>
										<tr>
											<td>
												Профессиональная область:
											</td>
											<td class="text-right strong">
												<? echo get_post_meta($post->ID,'on_resume_profobl',true); ?>
											</td>
										</tr>
									</table>

									
									<?
										$on_resume_infor = unserialize(get_post_meta($post->ID,'on_resume_infor',true));
										
										// Образрвание КЛОНЫ
										$count_obrazov_block=count($on_resume_infor["'obrazovanie'"])-1;
										for ($i = 0; $i <= $count_obrazov_block; $i++) {
											
											if (!empty($on_resume_infor["'obrazovanie'"][$i]["'zaved_text'"])) {$zaved=$on_resume_infor["'obrazovanie'"][$i]["'zaved_text'"];}
											else {$zaved=$on_resume_infor["'obrazovanie'"][$i]["'zaved'"];}
											
											$print_obrazov_block_list.='
														<div class="resume__title">
															Образование
														</div>
														<table class="job__table">
															<tr>
																<td>
																	Уровень:
																</td>
																<td class="text-right strong">
																	'.$on_resume_infor["'obrazovanie'"][$i]["'type'"].'
																</td>
															</tr>
															<tr>
																<td>
																	Степень:
																</td>
																<td class="text-right strong">
																	'.$on_resume_infor["'obrazovanie'"][$i]["'type_stepen'"].'
																</td>
															</tr>
														</table>

														<div class="lk__form-in lk__form-in_toleft">
															<div class="lk__title lk__title_gray">
																Основное образование
															</div>
															<table class="job__table job__table_in">
																<tr>
																	<td>
																		Закончил:    
																	</td>
																	<td class="text-right strong">
																		'.$zaved.'
																	</td>
																</tr>
																<tr>
																	<td>
																		Факультет:
																	</td>
																	<td class="text-right strong">
																		'.$on_resume_infor["'obrazovanie'"][$i]["'facultet'"].'
																	</td>
																</tr>
																<tr>
																	<td>
																		Специальность:     
																	</td>
																	<td class="text-right strong">
																		'.$on_resume_infor["'obrazovanie'"][$i]["'cpecialnost'"].'
																	</td>
																</tr>
																<tr>
																	<td>
																		Год окончания:  
																	</td>
																	<td class="text-right strong">
																		'.$on_resume_infor["'obrazovanie'"][$i]["'god_okonchania'"].'
																	</td>
																</tr>
															</table>
														</div>
											';
										}
										print $print_obrazov_block_list;
										
										
										
										// Образрвание КУРСЫ
										$count_obrazov_block=count($on_resume_infor["'kursi'"])-1;
										for ($i = 0; $i <= $count_obrazov_block; $i++) {
																						
											$print_kursi_list.='
													<div class="lk__form-in lk__form-in_toleft">
														<div class="resume__title">
															Курсы
														</div>
														<table class="job__table job__table_in">
															<tr>
																<td>
																	Название:
																</td>
																<td class="text-right strong">
																	'.$on_resume_infor["'kursi'"][$i]["'name'"].'
																</td>
															</tr>
															<tr>
																<td>
																	Год:
																</td>
																<td class="text-right strong">
																	'.$on_resume_infor["'kursi'"][$i]["'year'"].'
																</td>
															</tr>
															<tr>
																<td>
																	Образовательный центр:
																</td>
																<td class="text-right strong">
																	'.$on_resume_infor["'kursi'"][$i]["'centre'"].'
																</td>
															</tr><tr>
																<td colspan="2">
																	О курсах: '.$on_resume_infor["'kursi'"][$i]["'opis'"].'
																</td>
															</tr>
														</table>
													</div>
											';
										}
										print $print_kursi_list;
										
										
										// Образрвание ЯЗЫКИ
										$count_obrazov_block=count($on_resume_infor["'lang'"])-1;
										$print_lang_list='<div class="lk__form-in lk__form-in_toleft">
														<div class="resume__title">
															Владение языками
														</div>
														<table class="job__table job__table_in">';
										for ($i = 0; $i <= $count_obrazov_block; $i++) {
																						
											$print_lang_list.='
															<tr>
																<td>
																	'.$on_resume_infor["'lang'"][$i]["'lang_stepen'"].'
																</td>
																<td class="text-right strong">
																	'.$on_resume_infor["'lang'"][$i]["'type'"].'
																</td>
															</tr>
														
											';
										}
										$print_lang_list.='</table></div>';
										print $print_lang_list;
										
									?>
									
									
									
									

									<div class="resume__title">
										Дополнительная информация:
									</div>
									<table class="job__table">
										<tr>
											<td>
												Занятость:
											</td>
											<td class="text-right strong">
												<? echo get_post_meta($post->ID,'on_resume_zanyatost',true); ?>
											</td>
										</tr>
										<tr>
											<td>
												Тип работы:
											</td>
											<td class="text-right strong">
												<? echo get_post_meta($post->ID,'on_resume_typework',true); ?>
											</td>
										</tr>
									</table>

									<div class="resume__title">
										Навыки:
									</div>
									<div class="resume__text">
									<?
										$naviki = explode(', ', get_post_meta($post->ID,'on_resume_naviki',true));
										foreach ($naviki as $key => $value) {
											$print_naviki.= '<li><a href="#">'.$value.'</a></li>';
										}
									?>
										<ul class="tags__lis">
											<?=$print_naviki;?>
										</ul>
									</div>
					<?				
									$id_resume = $post->ID;
									global $post; 
									$portfolio_list_args = array(
														   'post_type' => 'portfolio',
														   'numberposts' => -1,
														   'author' => get_current_user_id(),
													//	   'post_status' => 'any',
														   'meta_key'    => 'on_portfolio_id_resume',
														   'meta_value'  => $id_resume,
														);
									$portfolio_list = get_posts( $portfolio_list_args );
									foreach( $portfolio_list as $post ){ setup_postdata($post);
										$portfolio_title= $post->post_title;
										$portfolio_year= get_post_meta($post->ID,'on_portfolio_data',true);
										$portfolio_navik= explode(', ',get_post_meta($post->ID,'on_portfolio_naviki',true));
										$portfolio_opis= $post->post_content;
										
										$print_list_portfolio.='
											<div class="lk__portfolio-item">
												<a href="'.get_permalink($post->ID).'" class="lk__portfolio-title">
													'.$portfolio_title.'
													<img src="'.get_the_post_thumbnail_url($post->ID, 'post-list-thumb' ).'" alt="" class="lk__portfolio-image">
												</a>
												<div class="more more_left">
													<a href="'.get_permalink($post->ID).'" class="more__link">Подробнее</a>
												</div>
											</div>
										';
									}
									wp_reset_postdata();
									
					?>
									
									<div class="resume__title">
											Портфолио
									</div>
									
									<div class="lk__portolio">
										<?=$print_list_portfolio;?>
									</div>


								</div>

							</div>
							
<div id="message" class="popup message">
	<div class="message__title">Написать автору объявления</div>
<!--	<div class="message__text">Для редактирования и удаления
пройдите в личный кабинет</div> -->
	
			<? echo do_shortcode('[contact-form-7 id="4816" title="Написать (Резюме)"]'); ?>
			<? echo '<style> .hidden { display: none; } </style>'; ?>
			<script type="text/javascript">
                jQuery(document).ready(function( $ ) {
						jQuery('#on_popup').click(function() {
							jQuery('#on_secyr_text').val(jQuery('#author_otklik').val());
						//	alert(jQuery('#on_secyr_text').val());
						});
				});
			</script>
	<div class="message__phone">
	<!--	Или позвоните по телефону: 
		<div class="strong">
			+ 7 980 454-45-45
		</div> -->
	</div>
</div>