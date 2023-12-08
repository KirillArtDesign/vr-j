<?php
/**
 * The template used for displaying page content in page.php

 */

?>
							<div class="block__title">
								<? the_title( '<span>', '</span>' ); ?>
							</div>
							
							<?
									// Зарплата
												$ot =  number_format(get_post_meta($post->ID,'on_vacancy_zp_ot',true), 0, '.', ' ');
												$do =  number_format(get_post_meta($post->ID,'on_vacancy_zp_do',true), 0, '.', ' ');
												$valuta =  get_post_meta($post->ID,'on_vacancy_valuta',true);
												if ($valuta=='') {$valuta = 'руб';}
												
												if (!empty($ot)) { $print_price = 'от '.$ot.' '.$valuta.'<br>'; }
												if (!empty($do)) { $print_price.= 'до '.$do.' '.$valuta; }
												if ($ot==$do) { $print_price = $do.' '.$valuta; }
												if (empty($ot) and empty($do)) { $print_price = ''; }
												
									
								
									$id_company = get_post_meta($post->ID,'on_vacancy_id_company',true);
									$my_company = get_post( $id_company );
									$company_title = $my_company->post_title;
									$company_content = $my_company->post_content;		
									$company_url = get_post_meta($id_company,'on_company_website',true);
									
									$img_adds = get_the_post_thumbnail_url($id_company, 'large' ); // afisha-event-thumb
									if ($img_adds=='') {$img_adds=get_template_directory_uri().'/images/no-logo.svg';} //Дефолтная картинка
									
									$img_adds_big = get_the_post_thumbnail_url($id_company, 'large' );
									if ($img_adds_big=='') {$img_adds_big=get_template_directory_uri().'/images/no-logo.svg';} //Дефолтная картинка 2
								
							
							?>
							
										<?  
											$parse_url = get_post_meta($post->ID,'on_vacancy_url_parser',true);
											if ($parse_url!='') { $print_url_message='href="'.$parse_url.'" target="_blanck"'; } else {$print_url_message='href="#message"';}
										?>
										
							<div class="lk resume">
								<div class="resume__vcard">
									<div class="resume__avatar resume__avatar_lk">
									<? /*	<a href="<?=$img_adds_big;?>" class="fancybox"><img src="<?=$img_adds;?>" alt=""></a> */ ?>
									<a <?=$print_url_message;?> class=""><img src="<?=$img_adds;?>" alt=""></a>
									</div>
									<div class="resume__message">
										<a <?=$print_url_message;?> class="fancybox btn btn_blue btn_large">Откликнуться</a>
										<input type="hidden" name="author_otklik" id="author_otklik" value="<? echo the_author_meta( 'ID' ); ?>">
									</div>
									<div class="resume__price text-center">
										<? if(!empty($print_price)) { echo 'заработная плата:';} ?>
										<div class="strong">
											<? echo $print_price; ?>
										</div>
									</div>
								</div>
								<div class="resume__content">
									<div class="resume__title">
										О компании:
									</div>
									<div class="resume__text">
										<? echo $company_content; ?>
									</div>
									<table class="job__table">
										<tr>
											<td>
												Веб-сайт: 
											</td>
											<td class="text-right strong">
												<a href="<?=$company_url;?>"><?=$company_url;?></a>
											</td>
										</tr>
										<tr>
											<td>
												Количество сотрудников:  
											</td>
											<td class="text-right strong">
												<? echo get_post_meta($id_company,'on_company_kolvo_sotrud',true); ?>
											</td>
										</tr>
										<tr>
											<td>
												Ваша должность:  
											</td>
											<td class="text-right strong">
												 <? echo get_post_meta($id_company,'on_company_rang_input',true); ?>
											</td>
										</tr>
									</table>

									<div class="resume__title">
										Требуется
									</div>
									<table class="job__table">
										<tr>
											<td>
												Профессиональная область:  
											</td>
											<td class="text-right strong">
												 <?php echo get_post_meta($post->ID,'on_vacancy_prof_deyat',true); ?>
											</td>
										</tr>
										<tr>
											<td>
												Опыт работы:  
											</td>
											<td class="text-right strong">
												 <?php echo get_post_meta($post->ID,'on_vacancy_opit',true); ?>
											</td>
										</tr>
										<tr>
											<td>
												Образование:  
											</td>
											<td class="text-right strong">
												 <?php echo get_post_meta($post->ID,'on_vacancy_obrazovalie',true); ?>
											</td>
										</tr>
										<tr>
											<td>
												Занятость:  
											</td>
											<td class="text-right strong">
												 <?php echo get_post_meta($post->ID,'on_vacancy_zanyatost',true); ?>
											</td>
										</tr>
										<tr>
											<td>
												Тип работы:  
											</td>
											<td class="text-right strong">
												 <?php echo get_post_meta($post->ID,'on_vacancy_typework',true); ?>
											</td>
										</tr>
										<tr>
											<td>
												Город:  
											</td>
											<td class="text-right strong">
												 <?php echo get_post_meta($post->ID,'on_vacancy_city',true); ?>
											</td>
										</tr>
									</table>

									<div class="resume__title resume__title_min">
										О вакансии:
									</div>
									<div class="resume__text">
										<?php the_content(); ?>
									</div>


								</div>

							</div>
<div id="message" class="popup message">
	<div class="message__title">Написать автору объявления</div>
<!--	<div class="message__text">Для редактирования и удаления
пройдите в личный кабинет</div> -->
	
			<? echo do_shortcode('[contact-form-7 id="4817" title="Написать (Вкансии)"]'); ?>
			<? echo '<style> .hidden { display: none; } </style>'; ?>
			<script type="text/javascript">
                jQuery(document).ready(function( $ ) {
						jQuery('#on_popup').click(function() {
							jQuery('#on_secyr_text').val(jQuery('#author_otklik').val());
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
							