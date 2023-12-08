<?php
/*
Template Name: Шаблон ИГР - Устройиства
*/

get_header(); ?>
<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
					<div class="block">
							<?php 
							$args = array(
									   'post_type' => 'games',
									   'publish' => true,
									   'paged' => get_query_var('paged'),
								   );
							if($_GET['genre']!="" and $_GET['genre']!="all") { $args['taxonomy_games_genre']=mysql_escape_string(htmlspecialchars(strip_tags($_GET['genre']))); }
							if($_GET['type']!="" and $_GET['type']!="all") { $args['taxonomy_games_ustroistva']=mysql_escape_string(htmlspecialchars(strip_tags($_GET['type']))); }
								
								query_posts($args);
							if ( have_posts() ) : ?>
									<div class="block__title">
										<span><? the_title( '<span>', '</span>' ); ?></span>
									</div>
										<?php /* the_archive_description( '<div class="taxonomy-description">', '</div>' ); */ ?>
							<?php endif; ?>
												
							
							<!--event list-->
							<div class="game">
								<!--filter-->
								<div class="filter">
									<?php 
										$args = array(
										  'taxonomy'     => 'taxonomy_games_genre', // название таксономии
										  'orderby'      => 'name',  // сортируем по названиям
										  'show_count'   => 0,       // не показываем количество записей
										  'pad_counts'   => 0,       // не показываем количество записей у родителей
										  'hierarchical' => 1,       // древовидное представление
										  'title_li'     => '',       // список без заголовка
										  'echo' => 0, // Выводить на экран или созвращать для обработки
										  "walker"=>new TaxFilWalker()
										);	
										$genre_list = wp_list_categories($args);
										$args = array(
										  'taxonomy'     => 'taxonomy_games_ustroistva', // название таксономии
										  'orderby'      => 'name',  // сортируем по названиям
										  'show_count'   => 0,       // не показываем количество записей
										  'pad_counts'   => 0,       // не показываем количество записей у родителей
										  'hierarchical' => 1,       // древовидное представление
										  'title_li'     => '',       // список без заголовка
										  'echo' => 0, // Выводить на экран или созвращать для обработки
										  "walker"=>new TaxFilWalker()
										);	
										$type_list = wp_list_categories($args);
									?>
									<script type="text/javascript" language="javascript"> 
										fireSubmit = function(event) {
											document.forms["gameFilter"].submit();
										}
										jQuery(function($){
											getFil = parseGetParams();
											if(getFil['genre']!="") { $('select#on-genre').val(decodeURI(getFil['genre'])); }
											if(getFil['type']!="") { $('select#on-type').val(decodeURI(getFil['type'])); }
											if(getFil['genre']==undefined) { $('select#on-genre').val('all'); }
											if(getFil['type']==undefined) { $('select#on-type').val('all'); }
										});
										function parseGetParams() { 
										   var $_GET = {}; 
										   var __GET = window.location.search.substring(1).split("&"); 
										   for(var i=0; i<__GET.length; i++) { 
											  var getVar = __GET[i].split("="); 
											  $_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1]; 
										   } 
										   return $_GET; 
										} 
									</script>
									<form name="gameFilter" action="" method="get">
										<div class="filter__block filter__block_horizontal">
											<div class="filter__block-cell filter__block-label">
												Выберете тип:
											</div>
											<div class="filter__block-cell filter__block-select filter__block-select_inline">
												<select name="type" id="on-type" class="filter__select" onchange="fireSubmit(event)">
													<option value="all">Все</option>
													<? echo $type_list; ?>
												</select>
											</div>
										</div>
										<div class="filter__block filter__block_horizontal">
											<div class="filter__block-cell filter__block-label">
												Жанр:
											</div>
											<div class="filter__block-cell filter__block-select filter__block-select_inline">
												<select name="genre" id="on-genre" class="filter__select" onchange="fireSubmit(event)">
													<option value="all">Все</option>
													<? echo $genre_list; ?>
												</select>
											</div>
										</div>
										<!--
										<div class="filter__block filter__block_horizontal">
											<div class="filter__block-cell filter__block-label">
												Категория:
											</div>
											<div class="filter__block-cell filter__block-select filter__block-select_inline">
												<select name="category" id="on-category" class="filter__select" onchange="fireSubmit(event)">
													<option value="all">Все</option>
													<? echo $category_list; ?>
												</select>
											</div>
										</div> -->
									</form>
								</div>
								<!--/filter-->
								<div class="gamelist">
								
									<?php
										if ( have_posts() ) : ?>
											<?php
											/* Start the Loop */
											while ( have_posts() ) : the_post();

												?>
													<div class="gamelist__item">
														<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
														<div class="gamelist__thumbnail">
															<a href="<?php the_permalink(); ?>" class="posts__thumbnail news__thumbnail">
																	<?php the_post_thumbnail('afisha-event-thumb'); ?>
															</a>
														</div>		
														<?php endif; ?>
														<div class="gamelist__item-content">
															<div class="rating rating__game"><?php echo get_post_meta ($post->ID,'on_game_rating',true); ?></div>
															<? the_title( '<div class="posts__title gamelist__item-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></div>' ); ?>	
															<div class="gamelist__item-desc">
																<div>Разработчик: <span class="strong"> <?php echo get_the_term_list( $post->ID, 'games-razrab', ' ', ',', '' ); ?></span></div>
																<div>Год: <span class="strong"> <?php echo get_the_term_list( $post->ID, 'games-year', ' ', ',', '' ); ?></span></div>
																<div>Жанр: <span class="strong"><?php echo get_the_term_list( $post->ID, 'games-genre', ' ', ',', '' ); ?></span></div>
																<div>Платформа: <span class="strong"><?php echo get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ); ?></span></div>
																<div>Доступна для устройств: <span class="strong"><?php echo get_the_term_list( $post->ID, 'games-ustroistva', ' ', ',', '' ); ?></span></div>
																<div>Локализация:<span class="strong"> <?php echo get_post_meta ($post->ID,'on_game_rus_locate',true); ?> </span></div>
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
							<? the_posts_pagination( array('screen_reader_text' => ' ', 'mid_size' => 9, ) ); ?>
						</div>
					</div>
				</div>
			</div>

	<?php get_sidebar(); ?>
<?php get_footer(); ?>
