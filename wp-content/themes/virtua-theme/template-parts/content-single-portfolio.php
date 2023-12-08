<?php
/**
 * The template used for displaying page content in page.php

 */

?>
							<div class="block__title">
								<? the_title( '<span> ', '</span>' ); ?>
							</div>
							
							<?
									$img_adds = get_the_post_thumbnail_url($post->ID, 'afisha-event-thumb' );
									if ($img_adds=='') {$img_adds=get_template_directory_uri().'/images/avatar.png';} //Дефолтная картинка
									
									$img_adds_big = get_the_post_thumbnail_url($post->ID, 'large' );
									if ($img_adds_big=='') {$img_adds_big=get_template_directory_uri().'/images/avatar.png';} //Дефолтная картинка 2
									
									
												$id_resume = get_post_meta($post->ID,'on_portfolio_id_resume',true);
									// Зарплата
												$ot =  get_post_meta($id_resume,'on_resume_jelanie_zp_ot',true);
												$do =  get_post_meta($id_resume,'on_resume_jelanie_zp_do',true);
												$valuta =  get_post_meta($id_resume,'on_resume_jelanie_zp_valuta',true);
												
												if (!empty($ot)) { $print_price = 'От '.$ot.' '.$valuta.'<br>'; }
												if (!empty($do)) { $print_price.= 'До '.$do.' '.$valuta; }
												if ($ot==$do) { $print_price = $do.' '.$valuta; }
												
												
									
							?>
							
							<div class="lk resume">
								<div class="resume__vcard">
									<div class="resume__avatar resume__avatar_lk">
										<a href="<?=$img_adds_big;?>" class="fancybox"><img src="<?=$img_adds;?>" alt=""></a>
									</div>
									<div class="resume__message">
										<a href="#" class="btn btn_blue btn_large">Написать</a>
									</div>
									<div class="resume__price">
										заработная плата:
										<div class="strong">
											<?=$print_price;?>
										</div>
									</div>
								</div>

								<div class="resume__content">
									<div class="back">
										<a href="<? echo get_permalink($id_resume); ?>" class="btn btn_blue btn_ico btn_back"><div class="btn__ico btn__ico_back"></div> <span>Назад к резюме</span></a>
									</div>
									<div class="portfolio__date">
										Год выполнения: <strong> <? echo get_post_meta($post->ID,'on_portfolio_data',true); ?> </strong>
									</div>
									<div class="resume__title">
										Примененные навыки
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

									<div class="resume__title">
										Описание проекта
									</div>
									<div class="article__body article__body_lk">
										<? the_content(); ?>
									</div>

								</div>

							</div>