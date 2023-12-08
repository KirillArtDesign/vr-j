<?php
/*
Template Name: Шаблон событий
*/

get_header(); ?>
<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
					<div class="block">
					
							<!--event carousel-->
							<div class="event-carousel">
								   
								<!--carousel item-->
									<?  
										 $pred_month = strtotime(date("Y-m-01", strtotime("-1 month") ) );
										 $pred_year = date('Y', $pred_month.' 01:01:01');
										 $pred_month = date('m', $pred_month.' 01:01:01');
										 echo get_calendar_events_new( $pred_month, $pred_year ); // Предыдущий месяц
										 echo get_calendar_events_new();	// Текущий месяц
										 // Другие месяцы
										 for ($x=1; $x<11; $x++) {
											 $t_date = strtotime(date("Y-m-01", strtotime("+".$x." month") ) );
											 $t_year = date('Y', $t_date.' 01:01:01');
											 $t_month = date('m', $t_date.' 01:01:01');
											 echo get_calendar_events_new( $t_month, $t_year );
										 }
									?>
								
							</div>
							<!--/event carousel-->
					
					
							<?php 
							// echo '<pre>';
							// echo 'asd';
							// print_r(get_posts(array('events')));
							// echo '</pre>';
							$date_now = date("Ymd");
							$date_now_if = '>=';
							if ($_GET['orday']!="") { $date_now=$_GET['orday']; $date_now_if='=='; }
							
							$args = array(
									   'post_type' => 'events',
									   'publish' => true,
									   'paged' => get_query_var('paged'),
								   );
								 
							if ($_GET['orcount']=="count") {
								$args['meta_key']='on_event_members';
								$args['orderby']='meta_value_num';
								$args['order']='DESC';
								$args['meta_query']=array(
														   'relation' => 'AND',
														   array(
																'key' => 'on_event_members'
														   ),
														   array(
																'key' => 'on_event_data_start_int',
																'value' => $date_now,
																'compare' => $date_now_if,
														   )
													   );
								$sort_type="count";
							}
							elseif ($_GET['ordate']=="date" or $_GET['orcount']!="count") {
								$args['meta_key']='on_event_data_start_int';
								$args['orderby']='meta_value_num';
								$args['order']='ASC';
								$args['meta_query']=array(
														   array(
																'key' => 'on_event_data_start_int',
																'value' => $date_now,
																'compare' => $date_now_if,
														   )
													   );
								$sort_type="date";
							}
								
								query_posts($args);
							/* if ( have_posts() ) : */ ?>
									<h1 class="block__title">
										<? 
											//<span> the_title( '<span>', '</span>' ); </span>
										?>
										<span>События</span>
									</h1>
										<?php /* the_archive_description( '<div class="taxonomy-description">', '</div>' ); */ ?>
							<?php /* endif; */ ?>
												
							
							<!--event list-->
							<div class="event-list">
								<div class="event-list__header">
									<span>Сортировать:</span>
									<? if ($sort_type=="date") { echo "<span><b>Дата</b></span>"; } else { echo "<span><a href=\"?ordate=date&orday=".$_GET['orday']."\">Дата</a></span>"; } ?>
									<? if ($sort_type=="count") { echo "<span><b>Количество участников</b></span>"; } else { echo "<span><a href=\"?orcount=count&orday=".$_GET['orday']."\">Количество участников</a></span>"; } ?>
								</div>
								<div class="event-list__body">
								
								<?php
									if ( have_posts() ) : ?>
										<?php
										/* Start the Loop */
										while ( have_posts() ) : the_post();

											?>
												<!--event item-->
												<div class="event-list__item">
													<div class="event-list__thumbnail">
														<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
															<a href="<?php the_permalink(); ?>" class="posts__thumbnail news__thumbnail">
																<?php the_post_thumbnail('afisha-event-thumb'); ?>
															</a>
														<? else : echo '<img src="'.get_bloginfo("template_url").'/images/no-events.jpg" class="posts__thumbnail news__thumbnail" />'; ?>
														<?php endif; ?>
													</div>
													<div class="event-list__item-content">
														<? the_title( '<div class="posts__title event-list__item-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></div>' ); ?>													
														<div class="event-list__item-data">
															Начало: <span class="strong"> <?php echo get_post_meta ($post->ID,'on_event_data_start',true); ?>  в <?php echo get_post_meta ($post->ID,'on_event_time_start',true); ?> </span> Участников :  <span class="strong"><?php echo get_post_meta ($post->ID,'on_event_members',true); ?></span>
														</div>
														<div class="event-list__item-text">
															<? the_excerpt(); ?>  
														</div>
														<div class="event-list__item-footer">
															Вход: <?php echo get_post_meta ($post->ID,'on_event_enter',true); ?>
														</div>
													</div>
												</div>						
											<?

										endwhile;
/*
										the_posts_pagination( array(
											'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
											'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
											'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
										) );
*/
									else :

//										get_template_part( 'template-parts/post/content', 'none' );

									endif; ?>
								
							</div>
						</div>
							<? the_posts_pagination( array('screen_reader_text' => ' ', ) ); ?>
					</div>
					<?php /* the_content(); */ ?>
				</div>
			</div>

	<?php get_sidebar(); ?>
<?php get_footer(); ?>
