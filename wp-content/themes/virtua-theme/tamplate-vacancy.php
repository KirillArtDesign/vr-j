<?php
/*
Template Name: Шаблон Вакансий
*/

get_header(); ?>
<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
					<div class="block">
					
												
					
							<?php 
							$date_now = date("Ymd");
							$date_now_if = '>=';
							if ($_GET['orday']!="") { $date_now=$_GET['orday']; $date_now_if='=='; }
							
							$args = array(
									   'post_type' => array('vacancies'), /* on_resume */
									   'publish' => true,
									   'posts_per_page' => 20,
									   'paged' => get_query_var('paged'),
								   );
							
							
							$args['meta_key'] = 'on_date_add';
							$args['orderby'] =  'meta_value_num';
							$args['order'] =  'DESC';
							$args['meta_query'] =  array( array('key' => 'on_date_add') );
							
								   
							if ($_GET['on-city']) {
								$args['meta_key']='on_vacancy_city';								
						//		$args['meta_value']=$_GET['on-city'];								
						//		$args['meta_compare']='LIKE';
								$args['meta_query'] = array(
														array(
															  'key' => 'on_vacancy_city',
															  'value' => $_GET['on-city'],
															  'compare' => 'LIKE',
															  'type' => 'CHAR'
															  )
														);
							} 	   
							if ($_GET['on-name']) {
								$args['s']=$_GET['on-name'];
							}
							if ($_GET['filter']=='dateup') {
							//	$args['orderby']='date';
								$args['order']='ASC';
								$url_filter='?filter=datedown';
								 $sort_icon='sort__down';
							}
							elseif ($_GET['filter']=='datedown') {
							//	$args['orderby']='date';
								$args['order']='DESC';
								$url_filter='?filter=dateup';
								 $sort_icon='sort__up';
							} else { $url_filter='?filter=dateup'; $sort_icon='sort__up'; }
							
							
							
							query_posts($args);
							if ( have_posts() ) : ?>
									<h1 class="block__title">
										<span><? the_title( '<span>', '</span>' ); ?></span>
									</h1>
							<?php endif; ?>
								
								<?php echo do_shortcode('[on_job_buttom]'); ?>
														
								<!--filter vacancy-->
								<div class="filter filter_vacancy">
									<form method="GET" action="" id="">
									<div class="filter__form">
										<div class="filter__vacancy-cell filter__vacancy-cell_text filter__vacancy-cell_prof">
											<input type="text" name="on-name" class="filter__input filter__input_vacancy" value="<? echo $_GET['on-name']; ?>" placeholder="Вакансия">
										</div>
										<div class="filter__vacancy-cell filter__vacancy-cell_text filter__vacancy-cell_city">
											<input type="text" name="on-city" class="filter__input filter__input_city" value="<? echo $_GET['on-city']; ?>" placeholder="Город">
										</div>
										<div class="filter__vacancy-cell filter__vacancy-cell_button">
											<input type="submit" class="filter__submit" value="Найти">
										</div>
									</div>
									</form>
								</div>
								<!--filter vacancy-->
								<div class="sort">
									<span>Сортировать:</span>
									<a href="<?=$url_filter?>" class="sort__active <?=$sort_icon;?>">Дате добавления</a>
									<a href="<?php echo get_permalink('408');?>" class="strong">Вакансии</a>
									<a href="<?php echo get_permalink('411');?>">Резюме</a>
								</div>
							<!--vacancy list-->
							<div class="job">
							
								<?php
									if ( have_posts() ) : ?>
										<?php
										/* Start the Loop */
										while ( have_posts() ) : the_post();
										
												$img_adds = get_the_post_thumbnail_url(get_post_meta($post->ID,'on_vacancy_id_company',true), 'full' );
												if ($img_adds=='') {$img_adds=get_template_directory_uri().'/images/no-logo.svg';} //Дефолтная картинка
												if ($post->post_type=='vacancies') {$print_icon='job__icon_vacancy';  $edit_url=get_permalink('403').'?add=vacancy&edit='.$post->ID;}
												if ($post->post_type=='resume') { $print_icon='job__icon_resume';  $edit_url=get_permalink('364').'?edit='.$post->ID; }
												
												// Зарплата
												$ot =  number_format(get_post_meta($post->ID,'on_vacancy_zp_ot',true), 0, '.', ' ');
												$do =  number_format(get_post_meta($post->ID,'on_vacancy_zp_do',true), 0, '.', ' ');
												$valuta =  get_post_meta($post->ID,'on_vacancy_valuta',true);
												
												if (!empty($ot)) { $print_price = 'от '.$ot.' '.$valuta.' '; }
												if (!empty($do)) { $print_price.= 'до '.$do.' '.$valuta; }
												if ($ot==$do) { $print_price = $do.' '.$valuta; }
												if (empty($ot) and empty($do)) { $print_price = ''; }
												
												$print_city = get_post_meta($post->ID,'on_vacancy_city',true);
												$print_city = explode(', ', $print_city);

											?>
												<div class="job__item">
													<div class="job__item-cell job__item-thumbnail">
														<a href="<? echo esc_url( get_permalink() ); ?>">
																<div class="job__icon <? echo $print_icon; ?>"></div>
																<img src="<? echo $img_adds; ?>" alt="<? $post->post_title; ?>">
														</a>
													</div>
													<div class="job__item-cell job__item-title">
														<a href="<? echo esc_url( get_permalink() ); ?>"><? the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' ); ?></a>
														<div class="job__item-cost"><? echo $print_price; ?></div>
													</div>
													<div class="job__item-cell job__item-date">
														<div class="job__item-city">
															<?php echo $print_city[0]; ?>
														</div>
														<div class="job__item-date_peaceduke">
														<?php  echo mysql2date("j F Y", date('Y-m-d H:i:s',get_post_meta($post->ID,'on_date_add',true)) ); ?>
														</div>
													</div>
												</div>						
											<?

										endwhile;
/**/
									else :

//										get_template_part( 'template-parts/post/content', 'none' );

									endif; ?>
								
							</div>
							<!--navigation-->
							<? the_posts_pagination( array('screen_reader_text' => ' ', 'mid_size' => 9, ) ); ?>
							<!--/navigation-->
							<!--/vacancy list-->



							
								
								
								
							
					</div>
				</div>
			</div>

	<?php get_sidebar(); ?>
<?php get_footer(); ?>
