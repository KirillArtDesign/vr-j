<?php




// ПОПУЛЯРНЫЕ ЖАНРЫ В ИГРАХ
function func_on_pop_genre_in_game($atts)
{
				
// Заголовки колонок
				$args = array(
										  'taxonomy'     => 'games-genre', // название таксономии
										  'orderby'      => 'count',  // сортируем по названиям
										  'order'		 => 'DESC',
										  'show_count'   => 0,       // не показываем количество записей
										  'pad_counts'   => 0,       // не показываем количество записей у родителей
										  'hierarchical' => 0,       // древовидное представление
										  'title_li'     => '',       // список без заголовка
										  'number'		 => 6,
										  'echo' => 0, // Выводить на экран или созвращать для обработки
										  "walker"=>new TagsNewsWalkerIDs()
										);	
				$tagsList = wp_list_categories($args);
				
				// Собираем массив
				$tagsList = explode("|", $tagsList);
				foreach ($tagsList as $key => $value) {
					$value = explode("=", $value);
					$tagsListArray[$key]['id']=$value[0];
					$tagsListArray[$key]['name']=$value[1];
					$tagsListArray[$key]['slug']=$value[2];
				}
				
				//Формируем заголовки
				foreach ($tagsListArray as $key => $value) {
					if ($key==0) {$active="active"; } else { $active=""; }
					$print_tab.= '\n <div class="cat-nav__item"><a href="'.get_site_url().'/games-genre/'.$value['slug'].'/" class="cat-nav__link">'.$value['name'].'</a></div>';
				}
				
				
				$result =  '
						<div class="block">
							<div class="block__title">
								<span>Популярные жанры</span>
							</div>
							<div class="cat-nav row">
								'.$print_tab.'
							</div>
						</div>
				';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_pop_genre_in_game', 'func_on_pop_genre_in_game' );






// ТОП Рейтинг на ИГРЫ
function func_on_top_rating_in_game($atts)
{
			
				// Первый блок
				global $post; 
				$news_list_args = array(
									   'post_type' => 'games',
									   'publish' => true,
									   'numberposts' => 15,
							//		   'games-platform' => $value['slug'],
									   'meta_key' => 'on_game_rating',
									   'orderby' => 'meta_value_num',
									   'order' => 'DESC',
									   'meta_query' => array(
															   array(
																	'key' => 'on_game_rating'
															   )
														   )
								    );
				$news_list = get_posts( $news_list_args );
				foreach( $news_list as $post ){ setup_postdata($post);
						if (get_post_meta($post->ID,'on_game_rating',true)) {$print_rating_game='<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>'; } else {$print_rating_game='';}
						$gameListOne.='
									<div class="posts__item posts__item_col posts__item_col-three">
										<div class="postlist__item postlist__item_related">
											'.$print_rating_game.'
											<div class="postlist__thumbnail alignleft">
												<a href="'.get_permalink($post->ID).'" class="postlist__link">
													'.get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ).'
												</a>
											</div>
											<div class="postlist__item-title posts__title_fix">
												<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
											</div>
											<div class="posts__options">
												<div>Дата релиза: <span class="strong">'.get_post_meta ($post->ID,'on_game_data_realise',true).'</span></div>
												<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
											</div>
										</div>
									</div>';
					
				}
				wp_reset_postdata();
				
				
										$args = array(
										  'taxonomy'     => 'games-genre', // название таксономии
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
										  'taxonomy'     => 'games-ustroistva', // название таксономии
										  'orderby'      => 'name',  // сортируем по названиям
										  'show_count'   => 0,       // не показываем количество записей
										  'pad_counts'   => 0,       // не показываем количество записей у родителей
										  'hierarchical' => 1,       // древовидное представление
										  'title_li'     => '',       // список без заголовка
										  'echo' => 0, // Выводить на экран или созвращать для обработки
										  "walker"=>new TaxFilWalker()
										);	
										$type_list = wp_list_categories($args);
									
				
				$result =  '
						<div class="block">
							<div class="block__title">
								<span>Лучшие VR игры по рейтингу</span>
							</div>
							<div class="related related_withfilter">
								<!--filter-->
								<script type="text/javascript" language="javascript"> 
									on_top_rating_in_game_Submit = function(event) {
										document.forms["on_top_rating_in_game_gameFilter"].submit();
									} 
								</script>
								<div class="filter">
									<form name="on_top_rating_in_game_gameFilter" action="'.get_permalink('149').'" method="get">
										<div class="filter__block filter__block_horizontal">
											<div class="filter__block-cell filter__block-label">
												Выберете тип:
											</div>
											<div class="filter__block-cell filter__block-select filter__block-select_inline">
												<select name="type" id="on-type" class="filter__select" onchange="on_top_rating_in_game_Submit(event)">
													<option value="all">Все</option>
													'.$type_list.'
												</select>
											</div>
										</div>
										<div class="filter__block filter__block_horizontal">
											<div class="filter__block-cell filter__block-label">
												Жанр:
											</div>
											<div class="filter__block-cell filter__block-select filter__block-select_inline">
												<select name="genre" id="on-genre" class="filter__select" onchange="on_top_rating_in_game_Submit(event)">
													<option value="all">Все</option>
													'.$genre_list.'
												</select>
											</div>
										</div>
									</form>
								</div>
								<!--/filter-->
								<div>
									'.$gameListOne.'
								</div>
							</div>
							<div class="more">
								<a href="'.get_permalink('149').'" class="more__link">Больше игр</a>
							</div>	
						</div>
				';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_top_rating_in_game', 'func_on_top_rating_in_game' );








// ТОП ИГР В РАДЕЛЕ ИГРЫ
function func_on_top_games_in_game_trio($atts)
{
			
								//Для фильтра
								$args = array(
										  'taxonomy'     => 'games-genre', // название таксономии
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
										  'taxonomy'     => 'games-ustroistva', // название таксономии
										  'orderby'      => 'name',  // сортируем по названиям
										  'show_count'   => 0,       // не показываем количество записей
										  'pad_counts'   => 0,       // не показываем количество записей у родителей
										  'hierarchical' => 1,       // древовидное представление
										  'title_li'     => '',       // список без заголовка
										  'echo' => 0, // Выводить на экран или созвращать для обработки
										  "walker"=>new TaxFilWalker()
										);	
								$type_list = wp_list_categories($args);
								
								
								$gameFilter1 = '<!--filter-->
										<div class="filter">
											<script type="text/javascript" language="javascript"> 
												on_top_rating_in_game_trio_1_Submit = function(event) {
													document.forms["on_top_rating_in_game_trio_1_gameFilter"].submit();
												} 
											</script>
											<form name="on_top_rating_in_game_trio_1_gameFilter" action="'.get_permalink('149').'" method="get">
												<div class="filter__block filter__block_table">
													<div class="filter__block-cell filter__block-label">
														Выберете тип:
													</div>
													<div class="filter__block-cell filter__block-select">
														<select name="type" id="on-type" class="filter__select" onchange="on_top_rating_in_game_trio_1_Submit(event)">
														<option value="all">Все</option>
														'.$type_list.'
													</select>
													</div>
												</div>
												<div class="filter__block filter__block_table">
													<div class="filter__block-cell filter__block-label">
														Жанр:
													</div>
													<div class="filter__block-cell filter__block-select">
														<select name="genre" id="on-genre" class="filter__select" onchange="on_top_rating_in_game_trio_1_Submit(event)">
														<option value="all">Все</option>
														'.$genre_list.'
													</select>
													</div>
												</div>
											</form>
										</div>
										<!--/filter-->';
										
								$gameFilter2 = '<!--filter-->
										<div class="filter">
											<script type="text/javascript" language="javascript"> 
												on_top_rating_in_game_trio_2_Submit = function(event) {
													document.forms["on_top_rating_in_game_trio_2_gameFilter"].submit();
												} 
											</script>
											<form name="on_top_rating_in_game_trio_2_gameFilter" action="'.get_permalink('149').'" method="get">
												<div class="filter__block filter__block_table">
													<div class="filter__block-cell filter__block-label">
														Выберете тип:
													</div>
													<div class="filter__block-cell filter__block-select">
														<select name="type" id="on-type" class="filter__select" onchange="on_top_rating_in_game_trio_2_Submit(event)">
														<option value="all">Все</option>
														'.$type_list.'
													</select>
													</div>
												</div>
												<div class="filter__block filter__block_table">
													<div class="filter__block-cell filter__block-label">
														Жанр:
													</div>
													<div class="filter__block-cell filter__block-select">
														<select name="genre" id="on-genre" class="filter__select" onchange="on_top_rating_in_game_trio_2_Submit(event)">
														<option value="all">Все</option>
														'.$genre_list.'
													</select>
													</div>
												</div>
											</form>
										</div>
										<!--/filter-->';
										
								$gameFilter3 = '<!--filter-->
										<div class="filter">
											<script type="text/javascript" language="javascript"> 
												on_top_rating_in_game_trio_3_Submit = function(event) {
													document.forms["on_top_rating_in_game_trio_3_gameFilter"].submit();
												} 
											</script>
											<form name="on_top_rating_in_game_trio_3_gameFilter" action="'.get_permalink('149').'" method="get">
												<div class="filter__block filter__block_table">
													<div class="filter__block-cell filter__block-label">
														Выберете тип:
													</div>
													<div class="filter__block-cell filter__block-select">
														<select name="type" id="on-type" class="filter__select" onchange="on_top_rating_in_game_trio_3_Submit(event)">
														<option value="all">Все</option>
														'.$type_list.'
													</select>
													</div>
												</div>
												<div class="filter__block filter__block_table">
													<div class="filter__block-cell filter__block-label">
														Жанр:
													</div>
													<div class="filter__block-cell filter__block-select">
														<select name="genre" id="on-genre" class="filter__select" onchange="on_top_rating_in_game_trio_3_Submit(event)">
														<option value="all">Все</option>
														'.$genre_list.'
													</select>
													</div>
												</div>
											</form>
										</div>
										<!--/filter-->';
			
				// Первый блок 
				global $post; 
				$news_list_args = array(
									   'post_type' => 'games',
									   'publish' => true,
									   'numberposts' => 4,
							//		   'games-platform' => $value['slug'],
									   'meta_key' => 'on_game_rating',
									   'orderby' => 'meta_value_num',
									   'order' => 'DESC',
									   'meta_query' => array(
															   array(
																	'key' => 'on_game_rating'
															   )
														   )
								    );
				$news_list = get_posts( $news_list_args );
				$xxx=0; $gameListOne="";
				foreach( $news_list as $post ){ setup_postdata($post);
				//	if ($xxx==0) {
					if (get_post_meta($post->ID,'on_game_rating',true)) {$print_rating_game='<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>'; } else {$print_rating_game='';}
						$gameListOne.='
						
									<div class="posts__item">
										<div class="postlist__item postlist__item_related">
											'.$print_rating_game.'
											<div class="postlist__thumbnail alignleft">
												<a href="'.get_permalink($post->ID).'" class="postlist__link">
													'.get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ).'
												</a>
											</div>
											<div class="postlist__item-title posts__title_fix">
												<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
											</div>
												<div class="posts__options">
													<div>Дата релиза: <span class="strong">'.get_post_meta ($post->ID,'on_game_data_realise',true).'</span></div>
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
										</div>
									</div>';
		/*			}
					else {
						$gameListOne.='<div class="postlist__item">
												<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>
												<div class="postlist__item-title">
													<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
												</div>
												<div class="posts__options">
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
									</div>';
					}
					$xxx++; 
		*/
				}
				wp_reset_postdata();
				
				
				// Второй блок
				global $post; 
				$news_list_args = array(
									   'post_type' => 'games',
									   'publish' => true,
									   'numberposts' => 4,
							//		   'games-platform' => $value['slug'],
									   'meta_key' => 'on_game_rating',
									   'orderby' => 'date meta_value_num',
									   'order' => 'DESC',
									   'meta_query' => array(
															   array(
																	'key' => 'on_game_rating'
															   )
														   )
								    );
				$news_list = get_posts( $news_list_args );
				$xxx=0; $gameListTwo="";
				foreach( $news_list as $post ){ setup_postdata($post);
				//	if ($xxx==0) {
					if (get_post_meta($post->ID,'on_game_rating',true)) {$print_rating_game='<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>'; } else {$print_rating_game='';}
						$gameListTwo.='
						
									<div class="posts__item">
										<div class="postlist__item postlist__item_related">
											'.$print_rating_game.'
											<div class="postlist__thumbnail alignleft">
												<a href="'.get_permalink($post->ID).'" class="postlist__link">
													'.get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ).'
												</a>
											</div>
											<div class="postlist__item-title posts__title_fix">
												<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
											</div>
												<div class="posts__options">
													<div>Дата релиза: <span class="strong">'.get_post_meta ($post->ID,'on_game_data_realise',true).'</span></div>
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
										</div>
									</div>';
		/*			}
					else {
						$gameListOne.='<div class="postlist__item">
												<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>
												<div class="postlist__item-title">
													<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
												</div>
												<div class="posts__options">
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
									</div>';
					}
					$xxx++; 
		*/
				}
				wp_reset_postdata();
				
				
				// Третий блок
				global $post; 
				$news_list_args = array(
									   'post_type' => 'games',
									   'publish' => true,
									   'numberposts' => 4,
							//		   'games-platform' => $value['slug'],
							//		   'meta_key' => 'on_game_rating',
									   'orderby' => 'date',
									   'order' => 'DESC',
							//		   'meta_query' => array(
							//								   array(
							//										'key' => 'on_game_rating'
							//								   )
							//							   )
								    );
				$news_list = get_posts( $news_list_args );
				$xxx=0; $gameListThree="";
				foreach( $news_list as $post ){ setup_postdata($post);
				//	if ($xxx==0) {
						if (get_post_meta($post->ID,'on_game_rating',true)) {$print_rating_game='<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>'; } else {$print_rating_game='';}
						$gameListThree.='
						
									<div class="posts__item">
										<div class="postlist__item postlist__item_related">
											'.$print_rating_game.'
											<div class="postlist__thumbnail alignleft">
												<a href="'.get_permalink($post->ID).'" class="postlist__link">
													'.get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ).'
												</a>
											</div>
											<div class="postlist__item-title posts__title_fix">
												<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
											</div>
												<div class="posts__options">
													<div>Дата релиза: <span class="strong">'.get_post_meta ($post->ID,'on_game_data_realise',true).'</span></div>
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
										</div>
									</div>';
		/*			}
					else {
						$gameListOne.='<div class="postlist__item">
												<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>
												<div class="postlist__item-title">
													<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
												</div>
												<div class="posts__options">
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
									</div>';
					}
					$xxx++; 
		*/
				}
				wp_reset_postdata();
				
				
				
				$result =  '
							<div class="row">
							<div class="col-sm-4 col-xs-12">
								<div class="block">
									<div class="block__title block__title_medium">
										<span>Популярные новинки</span>
									</div>
									<div class="related related_withfilter related_withfilter-games">
										'.$gameFilter1.'
										<div class="postlist">
											'.$gameListOne.'
										</div>
										<div class="more">
											<a href="'.get_permalink('149').'" class="more__link">Больше игр</a>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-4 col-xs-12">
								<div class="block">
									<div class="block__title block__title_medium">
										<span>Самые ожидаемые</span>
									</div>
									<div class="related related_withfilter related_withfilter-games">
										'.$gameFilter2.'
										<div class="postlist">
											'.$gameListTwo.'
										</div>
										<div class="more">
											<a href="'.get_permalink('149').'" class="more__link">Больше игр</a>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-sm-4 col-xs-12">
								<div class="block">
									<div class="block__title block__title_medium">
										<span>Текущие акции и скидки</span>
									</div>
									<div class="related related_withfilter related_withfilter-games">
										'.$gameFilter3.'
										<div class="postlist">
											'.$gameListThree.'
										</div>
										<div class="more">
											<a href="'.get_permalink('149').'" class="more__link">Больше игр</a>
										</div>
									</div>
								</div>
							</div>							
						</div>
				';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_top_games_in_game_trio', 'func_on_top_games_in_game_trio' );









// ТОП ИГР НА ГЛВНОЙ
function func_on_top_games_in_home($atts)
{
			
				// Первый блок
				global $post; 
				$news_list_args = array(
									   'post_type' => 'games',
									   'publish' => true,
									   'numberposts' => 6,
							//		   'games-platform' => $value['slug'],
									   'meta_key' => 'on_game_rating',
									   'orderby' => 'meta_value_num',
									   'order' => 'DESC',
									   'meta_query' => array(
															   array(
																	'key' => 'on_game_rating'
															   )
														   )
								    );
				$news_list = get_posts( $news_list_args );
				$xxx=0; $gameListOne="";
				foreach( $news_list as $post ){ setup_postdata($post);
					if ($xxx==0) {
						if (get_post_meta($post->ID,'on_game_rating',true)) {$print_rating_game='<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>'; } else {$print_rating_game='';}
						$gameListOne.='
						
										<div class="postlist__item postlist__item_related">
											'.$print_rating_game.'
											<div class="postlist__thumbnail alignleft">
												<a href="'.get_permalink($post->ID).'" class="postlist__link">
													'.get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ).'
												</a>
											</div>
											<div class="postlist__item-title posts__title_fix">
												<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
											</div>
												<div class="posts__options">
													<div>Дата релиза: <span class="strong">'.get_post_meta ($post->ID,'on_game_data_realise',true).'</span></div>
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
										</div>';
					}
					else {
						$gameListOne.='
									<div class="postlist__item">
												<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>
												<div class="postlist__item-title posts__title_fix">
													<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
												</div>
												<div class="posts__options">
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
									</div>';
					}
					$xxx++; 
		
				}
				wp_reset_postdata();
				
				
				// Второй блок
				global $post; 
				$news_list_args = array(
									   'post_type' => 'games',
									   'publish' => true,
									   'numberposts' => 6,
							//		   'games-platform' => $value['slug'],
									   'meta_key' => 'on_game_rating',
									   'orderby' => 'date meta_value_num',
									   'order' => 'DESC',
									   'meta_query' => array(
															   array(
																	'key' => 'on_game_rating'
															   )
														   )
								    );
				$news_list = get_posts( $news_list_args );
				$xxx=0; $gameListTwo="";
				foreach( $news_list as $post ){ setup_postdata($post);
					if ($xxx==0) {
						if (get_post_meta($post->ID,'on_game_rating',true)) {$print_rating_game='<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>'; } else {$print_rating_game='';}
						$gameListTwo.='
						
										<div class="postlist__item postlist__item_related">
											'.$print_rating_game.'
											<div class="postlist__thumbnail alignleft">
												<a href="'.get_permalink($post->ID).'" class="postlist__link">
													'.get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ).'
												</a>
											</div>
											<div class="postlist__item-title posts__title_fix">
												<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
											</div>
												<div class="posts__options">
													<div>Дата релиза: <span class="strong">'.get_post_meta ($post->ID,'on_game_data_realise',true).'</span></div>
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
										</div>';
					}
					else {
						$gameListTwo.='
									<div class="postlist__item">
												<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>
												<div class="postlist__item-title posts__title_fix">
													<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
												</div>
												<div class="posts__options">
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
									</div>';
					}
					$xxx++;
				}
				wp_reset_postdata();
				
				
				// Третий блок
				global $post; 
				$news_list_args = array(
									   'post_type' => 'games',
									   'publish' => true,
									   'numberposts' => 6,
							//		   'games-platform' => $value['slug'],
							//		   'meta_key' => 'on_game_rating',
									   'orderby' => 'date',
									   'order' => 'DESC',
							//		   'meta_query' => array(
							//								   array(
							//										'key' => 'on_game_rating'
							//								   )
							//							   )
								    );
				$news_list = get_posts( $news_list_args );
				$xxx=0; $gameListThree="";
				foreach( $news_list as $post ){ setup_postdata($post);
					if ($xxx==0) {
						if (get_post_meta($post->ID,'on_game_rating',true)) {$print_rating_game='<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>'; } else {$print_rating_game='';}
						$gameListThree.='
										<div class="postlist__item postlist__item_related">
											'.$print_rating_game.'
											<div class="postlist__thumbnail alignleft">
												<a href="'.get_permalink($post->ID).'" class="postlist__link">
													'.get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ).'
												</a>
											</div>
											<div class="postlist__item-title posts__title_fix">
												<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
											</div>
												<div class="posts__options">
													<div>Дата релиза: <span class="strong">'.get_post_meta ($post->ID,'on_game_data_realise',true).'</span></div>
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
										</div>';
					}
					else {
						$gameListThree.='
									<div class="postlist__item">
												<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>
												<div class="postlist__item-title posts__title_fix">
													<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
												</div>
												<div class="posts__options">
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
									</div>';
					}
					$xxx++;
				}
				wp_reset_postdata();
				
				$result =  '
							<!--ratings blocks-->
							<div class="row">
								<div class="col-sm-4 col-xs-12">
									<div class="block">
										<div class="block__title block__title_medium">
											<span>Топ игр</span>
										</div>
										<div class="postlist">
											<div class="posts__item">
												'.$gameListOne.'
											</div>
										</div>
										<div class="more">
											<a href="'.get_permalink('939').'" class="more__link">Больше игр</a>
										</div>
									</div>
								</div>
								<div class="col-sm-4 col-xs-12">
									<div class="block">
										<div class="block__title block__title_medium">
											<span>Новинки игр</span>
										</div>
										<div class="postlist">
											<div class="posts__item">
												'.$gameListTwo.'
											</div>
										</div>
										<div class="more">
											<a href="'.get_permalink('937').'" class="more__link">Больше игр</a>
										</div>
									</div>
								</div>
								<div class="col-sm-4 col-xs-12">
									<div class="block">
										<div class="block__title block__title_medium">
											<span>Последние добавленные</span>
										</div>
										<div class="postlist">
											<div class="posts__item">
												'.$gameListThree.'
											</div>
										</div>
										<div class="more">
											<a href="'.get_permalink('934').'" class="more__link">Больше игр</a>
										</div>
									</div>
								</div>
							</div>
							<!--/ratings blocks-->	
				';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_top_games_in_home', 'func_on_top_games_in_home' );









// Похожие игры
function func_on_similar_games($atts)
{
			
				// Первый блок
				global $post; 
				$news_list_args = array(
									   'post_type' => 'games',
									   'publish' => true,
									   'numberposts' => 6,
							//		   'games-platform' => $value['slug'],
									   'meta_key' => 'on_game_rating',
									   'orderby' => 'meta_value_num',
									   'order' => 'DESC',
									   'meta_query' => array(
															   array(
																	'key' => 'on_game_rating'
															   )
														   )
								    );
				$news_list = get_posts( $news_list_args );
				foreach( $news_list as $post ){ setup_postdata($post);
						if (get_post_meta($post->ID,'on_game_rating',true)) {$print_rating_game='<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>'; } else {$print_rating_game='';}
						$gameListOne.='
						
									<div class="posts__item posts__item_col posts__item_col-three">
												<div class="postlist__item postlist__item_related">
													'.$print_rating_game.'
													<div class="postlist__thumbnail alignleft">
														<a href="'.get_permalink($post->ID).'" class="postlist__link">
															'.get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ).'
														</a>
													</div>
													<div class="postlist__item-title  posts__title_fix">
														<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
													</div>
													<div class="posts__options">
														<div>Дата релиза: <span class="strong">'.get_post_meta ($post->ID,'on_game_data_realise',true).'</span></div>
														<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
													</div>
												</div>
									</div>
									
									';
	
				}
				wp_reset_postdata();
				if ($gameListOne!="") {
						$result =  '
						<div class="block">
								<div class="block__title">
											<div class="page-title"><span> Похожие игры </span></div>
										</div>
								<div class="related related_withfilter">
										'.$gameListOne.'		
								</div>
						</div>
					';
				}
				
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_similar_games', 'func_on_similar_games' );








// ПОПУЛЯРНЫЕ ИГРЫ НА ГЛВНОЙ
function func_on_pop_games_in_home($atts)
{
				
// Заголовки колонок
				$args = array(
										  'taxonomy'     => 'games-platform', // название таксономии
										  'orderby'      => 'count',  // сортируем по названиям
										  'order'		 => 'DESC',
										  'show_count'   => 0,       // не показываем количество записей
										  'pad_counts'   => 0,       // не показываем количество записей у родителей
										  'hierarchical' => 0,       // древовидное представление
										  'title_li'     => '',       // список без заголовка
										  'number'		 => 6,
										  'echo' => 0, // Выводить на экран или созвращать для обработки 
										  "walker"=>new TagsNewsWalkerIDs()
										);	
				$tagsList = wp_list_categories($args);
			//	print_r()
			
				$content_tab="";
				$print_tab="";
				
				// Собираем массив
				$tagsList = explode("|", $tagsList);
				foreach ($tagsList as $key => $value) {
					$value = explode("=", $value);
					$tagsListArray[$key]['id']=$value[0];
					$tagsListArray[$key]['name']=$value[1];
					$tagsListArray[$key]['slug']=$value[2];
				}
				
				//Формируем заголовки
				foreach ($tagsListArray as $key => $value) {
					if ($key==0) {$active="active"; } else { $active=""; }
					$print_tab.= '\n <a href="#pop-games-'.$key.'" class="tabs__link '.$active.'"><span>'.$value['name'].'</span></a>';
				}
				
				//Формируем контент (списки новстей)
				foreach ($tagsListArray as $key => $value) {
					
					// Список постов
					$news_list_args = array(
									   'post_type' => 'games',
									   'publish' => true,
									   'numberposts' => 6,
									   'games-platform' => $value['slug'],
									   'orderby' => 'date',
									   'order' => 'DESC',
						/*			   'meta_key' => 'on_game_rating',
									   'orderby' => 'meta_value_num',
									   'meta_query' => array(
															   array(
																	'key' => 'on_game_rating'
															   )
														   )
						*/		    );
					$news_list = get_posts( $news_list_args );
					
					$print_news_list="";
					global $post; 
					foreach( $news_list as $post ){ setup_postdata($post);
						$print_news_list.='<div class="posts__item posts__item_col posts__item_col-six">
												<a href="'.get_permalink($post->ID).'" class="posts__thumbnail">
													'.get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ).'
													<span class="posts__meta">
														<span class="posts__icon comment-ico" title="Комментариев: '.get_comments_number($post->ID).'">'.get_comments_number($post->ID).'</span>
														<span class="posts__icon view-ico" title="Просмотров: '.get_post_meta($post->ID,'views',true).'">'.get_post_meta($post->ID,'views',true).'</span>
													</span>
												</a>
												<div class="posts__title posts__title_fix">
													<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
												</div>
												<div class="posts__options">
													<div>Дата релиза: <span class="strong">'.get_post_meta ($post->ID,'on_game_data_realise',true).'</span></div>
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
											</div>';
					}
					wp_reset_postdata();					
					
					if ($key==0) {$active="active"; } else { $active=""; }
					$content_tab.='<!--tab-->
										<div class="tab '.$active.'" id="pop-games-'.$key.'">
											'.$print_news_list.'
											<div class="more" style="margin-top: 15px;">
												<a href="'.get_site_url().'/games-platform/'.$value['slug'].'/" class="more__link">Больше игр</a>
											</div>
										</div>
										<!--/tab-->';
				}
				
				$result =  '
							<!--tags news-->
							<div class="block">
								<div class="block__title">
									<span>САМЫЕ ПОПУЛЯРНЫЕ ИГРЫ</span>
								</div>
								<div class="tabs">
									<div class="tabs__links">
										'.$print_tab.'
									</div>
									<div class="tabs__content">
										'.$content_tab.'
									</div>
								</div>
							</div>
							<!--/tags news-->
				';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_pop_games_in_home', 'func_on_pop_games_in_home' );







// ИГРЫ НА СТРАНИЦАХ УСТРОЙСТВА
function func_on_pop_games_in_device($atts)
{
		$params = shortcode_atts( array( // в массиве укажите значения параметров по умолчанию
		'device' => 'PSVR', // Продукт
		), $atts );
					
					// Список постов
					global $post; 
					$news_list_args = array(
									   'post_type' => 'games',
									   'publish' => true,
									   'numberposts' => 8,
									   'games-ustroistva' => $params['device'], 
							//		   'meta_key' => 'on_game_rating',
									   'orderby' => 'meta_value_num',
									   'order' => 'DESC',
							//		   'meta_query' => array(
							//								   array(
							//										'key' => 'on_game_rating'
							//								   )
							//							   )
								    );
					$news_list = get_posts( $news_list_args );
					
					$print_news_list="";
					foreach( $news_list as $post ){ setup_postdata($post);
						$print_news_list.='
											<div class="posts__item posts__item_col posts__item_col-eight">
												<a href="'.get_permalink($post->ID).'" class="posts__thumbnail">
													'.get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ).'
													<span class="posts__meta">
														<span class="posts__icon comment-ico" title="Комментариев: '.get_comments_number($post->ID).'">'.get_comments_number($post->ID).'</span>
														<span class="posts__icon view-ico" title="Просмотров: '.get_post_meta($post->ID,'views',true).'">'.get_post_meta($post->ID,'views',true).'</span>
													</span>
												</a>
												<div class="posts__title posts__title_fix">
													<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
												</div>
												<div class="posts__options">
													<div>Дата релиза: <span class="strong">'.get_post_meta ($post->ID,'on_game_data_realise',true).'</span></div>
													<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
												</div>
											</div>';
					}
					wp_reset_postdata();					
					
					
				
				$result =  '<!--content-->
								<div class="device__block device__block_content" id="content">
									<div class="container">
										<div class="device__block-title">Игры</div>
										<div class="content__list text-center">
											'.$print_news_list.'
										</div>
										<div class="more more_center">
											<a href="'.get_permalink('149').'" class="more__link">Больше игр</a>
										</div>
									</div>
								</div>
								<!--/content-->
				';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_pop_games_in_device', 'func_on_pop_games_in_device' );





// НОВОСТИ ПО ТЕГАМ НА ГЛВНОЙ
function func_on_tags_news_in_home($atts)
{
				
				// Заголовки колонок
				$args = array(
										  'taxonomy'     => 'post_tag', // название таксономии
										  'orderby'      => 'count',  // сортируем по названиям
										  'order'		 => 'DESC',
										  'show_count'   => 0,       // не показываем количество записей
										  'pad_counts'   => 0,       // не показываем количество записей у родителей
										  'hierarchical' => 0,       // древовидное представление
										  'title_li'     => '',       // список без заголовка
										  'number'		 => 6,
										  'echo' => 0, // Выводить на экран или созвращать для обработки
										  "walker"=>new TagsNewsWalkerIDs()
										);	
				$tagsList = wp_list_categories($args);
				
				// Собираем массив
				$tagsList = explode("|", $tagsList);
				foreach ($tagsList as $key => $value) {
					$value = explode("=", $value);
					$tagsListArray[$key]['id']=$value[0];
					$tagsListArray[$key]['name']=$value[1];
					$tagsListArray[$key]['slug']=$value[2];
				}
				
				$print_tab=""; $content_tab="";
				//Формируем заголовки
				foreach ($tagsListArray as $key => $value) {
					if ($key==0) {$active="active"; } else { $active=""; }
					$print_tab.= '\n <a href="#tag-news-'.$key.'" class="tabs__link '.$active.'"><span>'.$value['name'].'</span></a>';
				}
				
				//Формируем контент (списки новстей)
				foreach ($tagsListArray as $key => $value) {
					
					// Список постов
					global $post; 
					$news_list_args = array( 'post_type' => 'post', 'numberposts' => 3, 'tag'=>$value['slug'], 'orderby' => 'date', 'order' => 'DESC' ); 
					$news_list = get_posts( $news_list_args );
					
					$print_news_list=""; 
					foreach( $news_list as $post ){ setup_postdata($post);
						$print_news_list.='<div class="posts__item posts__item_col posts__item_col-three">
												<div class="posts__title">
													<div class="posts__title posts__title_fix">
														<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
													</div>
													<a href="'.get_permalink($post->ID).'" class="posts__thumbnail">
														'.get_the_post_thumbnail( $post->ID, 'last-post-thumb' ).'
														<span class="posts__meta">
															<span class="posts__icon comment-ico" title="Комментариев: '.get_comments_number($post->ID).'">'.get_comments_number($post->ID).'</span>
															<span class="posts__icon view-ico" title="Просмотров: '.get_post_meta($post->ID,'views',true).'">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</a>
												</div>
												<div class="posts__excerpt">
													
												</div>
												<div class="posts__data">
													Автор: '.get_the_author().',  '.get_the_date('d F Y', $post->ID ).'
												</div>
											</div>';
					}
					wp_reset_postdata();					
					
					if ($key==0) {$active="active"; } else { $active=""; }
					$content_tab.='<!--tab-->
										<div class="tab '.$active.'" id="tag-news-'.$key.'">
											'.$print_news_list.'
											<div class="more" style="margin-top: 15px;">
												<a href="'.get_site_url().'/tag/'.$value['slug'].'/" class="more__link">Больше новостей</a>
											</div>
										</div>
										<!--/tab-->';
				}
				
				$result =  '
							<!--tags news-->
							<div class="block">
								<div class="block__title">
									<span>новости по меткам</span>
								</div>
								<div class="tabs">
									<div class="tabs__links">
										'.$print_tab.'
									</div>
									<div class="tabs__content">
										'.$content_tab.'
									</div>
								</div>
							</div>
							<!--/tags news-->
				';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_tags_news_in_home', 'func_on_tags_news_in_home' );


	// Волкер для списка тегов для новостей
	class TagsNewsWalker extends Walker_Category { 
		function start_el(&$output, $item, $depth=0, $args=array(), $id=0) {
			if ($output=="") {$active="active"; } else { $active=""; }
			$output .= '\n <a href="#tab'.esc_attr($item->term_id).'" class="tabs__link '.$active.'"><span>'.esc_attr($item->name).'</span></a>';
		}  

		function end_el(&$output, $item, $depth=0, $args=array()) {  
			$output .= "";  
		}  
	}
	
	// Волкер для списка тегов для новостей
	class TagsNewsWalkerIDs extends Walker_Category { 
		function start_el(&$output, $item, $depth=0, $args=array(), $id=0) {
			if ($output=="") {$active=""; } else { $active="|"; }
			$output .= $active.''.esc_attr($item->term_id).'='.esc_attr($item->name).'='.esc_attr($item->slug);
		}  

		function end_el(&$output, $item, $depth=0, $args=array()) {  
			$output .= "";  
		}  
	} 
	
	
	// Волкер для списка тегов для новостей
	class TagsNewsWalkerIDs_array extends Walker_Category { 
		function start_el(&$output, $item, $depth=0, $args=array(), $id=0) {
			if ($output=="") {$active=""; } else { $active="|"; }
			$output .= $active.''.esc_attr($item->term_id).'='.esc_attr($item->name).'='.esc_attr($item->slug);
		}  
		function end_el(&$output, $item, $depth=0, $args=array()) {  
			$output .= "";  
		}  
	}









// Последние НОВОСТИ НА ГЛВНОЙ
function func_on_banner_in_home($atts)
{		
	$w = get_option('widget_text'); // массив элементов
	$ban="";
    foreach ($w as $value ) {
        if ( isset($value['title']) && $value['title'] == 'Баннеры' ) {
            $ban = trim($value['text']); // нужное значение
            break;
        }
    }
	//dynamic_sidebar( 'sidebar-1' );
	$result='<!--banner--><div class="block"><div class="asd">
			'.$ban.'
			 </div></div><!--/banner-->';
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_banner_in_home', 'func_on_banner_in_home' );







// Последние НОВОСТИ НА ГЛВНОЙ
function func_on_last_news_in_home($atts)
{
				global $post; 
				// Ищем ИД статьи Первой горячей
				$news_list = get_posts( array( 'post_type' => 'post', 'numberposts' => 1, 'meta_key' => 'on_hot_news', 'orderby' => 'date', 'order' => 'DESC' ) );				
				foreach( $news_list as $post ){ setup_postdata($post); $no_post_id=$post->ID; }
				wp_reset_postdata();
				
				// Вертикальный слайдер
				$news_list_args = array( 'post_type' => 'post', 'numberposts' => 12, 'exclude' => $no_post_id, 'orderby' => 'date', 'order' => 'DESC' ); 
				$news_list = get_posts( $news_list_args );
				
				$lastNews="";
				foreach( $news_list as $post ){ setup_postdata($post);
					
					$lastNews.='<!--last news item-->
									<div class="posts__item posts__item_col posts__item_col-three">
										<a href="'.get_permalink($post->ID).'" class="posts__thumbnail">
											'.get_the_post_thumbnail( $post->ID, 'last-post-thumb' ).'
											<span class="posts__meta">
												<span class="posts__icon comment-ico" title="Комментариев: '.get_comments_number($post->ID).'">'.get_comments_number($post->ID).'</span>
												<span class="posts__icon view-ico" title="Просмотров: '.get_post_meta($post->ID,'views',true).'">'.get_post_meta($post->ID,'views',true).'</span>
											</span>
										</a>
										<div class="posts__title posts__title_fix_autor2">
											<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
										</div>
										<div class="posts__excerpt">
										
										</div>
										<div class="posts__data">
											Автор: '.get_the_author().',  '.get_the_date('d F Y', $post->ID ).'
										</div>
									</div>
									<!--/last news item-->';
				}
				wp_reset_postdata();
				
				$result =  '
							<!--last news-->
							<div class="block">
								<div class="block__title">
									<span>Последние новости</span>
								</div>
								<div class="posts posts_bordered">
									'.$lastNews.'
								</div>
								<div class="more">
									<a href="'.get_category_link( '42' ).'" class="more__link">Больше новостей</a>
								</div>
							</div>
							<!--last news-->
				';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_last_news_in_home', 'func_on_last_news_in_home' );





// Похожие НОВОСТИ НА ГЛВНОЙ
function func_on_similar_news_in_home($atts)
{
				$params = shortcode_atts( array( // в массиве укажите значения параметров по умолчанию
					'id_cat' => '42', // Категория
					'id_post' => '', // ID поста
				), $atts );
			
				// Вертикальный слайдер
				global $post; 
				$news_list_args = array( 'post_type' => 'post', 'category' => $params['id_cat'], 'exclude' => $params['id_post'], 'numberposts' => 3, 'orderby' => 'date', 'order' => 'DESC' ); 
				$news_list = get_posts( $news_list_args );
				
				foreach( $news_list as $post ){ setup_postdata($post);
					
					$lastNews.='<!--last news item-->
									<div class="posts__item posts__item_col posts__item_col-three">
										<a href="'.get_permalink($post->ID).'" class="posts__thumbnail">
											'.get_the_post_thumbnail( $post->ID, 'last-post-thumb' ).'
											<span class="posts__meta">
												<span class="posts__icon comment-ico" title="Комментариев: '.get_comments_number($post->ID).'">'.get_comments_number($post->ID).'</span>
												<span class="posts__icon view-ico" title="Просмотров: '.get_post_meta($post->ID,'views',true).'">'.get_post_meta($post->ID,'views',true).'</span>
											</span>
										</a>
										<div class="posts__title">
											<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
										</div>
										<div class="posts__excerpt">
										
										</div>
										<div class="posts__data">
											Автор: '.get_the_author().',  '.get_the_date('d F Y', $post->ID ).'
										</div>
									</div>
									<!--/last news item-->';
				}
				wp_reset_postdata();
				
				$result =  '
							<!--last news-->
							<div class="block">
								<div class="block__title">
									<span>Похожие новости </span>
								</div>
								<div class="posts posts_bordered">
									'.$lastNews.'
								</div>
								<div class="more">
									<a href="'.get_category_link( $params['id_cat'] ).'" class="more__link">Больше новостей</a>
								</div>
							</div>
							<!--last news-->
				';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_similar_news_in_home', 'func_on_similar_news_in_home' );





// ГОРЯЧИЕ НОВОСТИ НА ГЛВНОЙ
function func_on_hot_news_in_home($atts)
{
				// Горизонтальный слайдер
				global $post; 
				$news_list_args = array( 'post_type' => 'post', 'numberposts' => 10, 'meta_key' => 'on_hot_news', 'orderby' => 'date', 'order' => 'DESC' ); 
				$news_list = get_posts( $news_list_args );
				
				$gSlider_list="";
				foreach( $news_list as $post ){ setup_postdata($post);
					$hot_news = get_post_meta($post->ID,'on_hot_news',true); if($hot_news!='') {$hot_news_print='<div class="hot">HOT NEWS</div>';}					
					$gSlider_list.='<!--slider item-->
											<div class="slider__item">'.$hot_news_print.'
												<a href="'.get_permalink($post->ID).'" class="slider__image">
													'.get_the_post_thumbnail( $post->ID, 'hot-post-thumb' ).'
												</a>
												<div class="slider__desc">
													<div class="slider__title"><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></div>
													<div class="slider__excerpt">
														'.str_replace($post->ID, "", kama_excerpt( array('maxchar'=>630, 'text'=>get_the_content($post->ID)) )).'
													</div>
													<div class="slider__meta">
														<div class="alignleft">
															<span class="slider__icon comment-ico comment-ico_gray" title="Комментариев: '.get_comments_number($post->ID).'">'.get_comments_number($post->ID).'</span>
															<span class="slider__icon view-ico view-ico_gray" title="Просмотров: '.get_post_meta($post->ID,'views',true).'">'.get_post_meta($post->ID,'views',true).'</span>
														</div>
														<div class="alignright">
															<span class="slider__date">
																'.get_the_date('d F Y', $post->ID ).'
															</span>
														</div>
													</div>
												</div>
											</div>
											<!--/slider item-->';
				}
				wp_reset_postdata();
				
				// Вертикальный слайдер
				global $post; 
				$news_list_args = array( 'post_type' => 'post', 'numberposts' => 10, 'meta_key' => 'on_exlusive_news', 'orderby' => 'date', 'order' => 'DESC' ); 
				$news_list = get_posts( $news_list_args );
				
				$vSlider_list="";
				foreach( $news_list as $post ){ setup_postdata($post);
				
					$vSlider_list.='<!--vertical slider item-->
											<div class="scroller__item ">
												<a href="'.get_permalink($post->ID).'" class="scroller__image">
													'.get_the_post_thumbnail( $post->ID, 'exlusive-post-thumb' ).'
													<div class="scroller__splash">
														<span class="scroller__icon comment-ico" title="Комментариев: '.get_comments_number($post->ID).'">'.get_comments_number($post->ID).'</span>
														<span class="scroller__icon view-ico" title="Просмотров: '.get_post_meta($post->ID,'views',true).'">'.get_post_meta($post->ID,'views',true).'</span>
													</div>
												</a>
												<div class="scroller__content">
													<div class="scroller__title">
														<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
													</div>
													<div class="scroller__date">'.get_the_date('d F Y', $post->ID ).'</div>
												</div>
											</div>
											<!--/vertical slider item-->';
				}
				wp_reset_postdata();
				
				$result =  '
							<div class="block__title mobile-hidden">
								<span>Горячие новости</span>
							</div>
							<div class="row mobile-hidden">
									<div class="col-sm-8 col-xs-12">
										<!--horizontal slider-->
										<div class="slider">
											'.$gSlider_list.'											
										</div>
										<!--/horizontal slider-->
									</div>
									<div class="col-sm-4 col-xs-12">
										<!--vertical slider-->
										<div class="scroller">
											'.$vSlider_list.'
										</div>
										<!--/vertical slider-->
									</div>
								</div>
								<div class="more mobile-hidden">
									<a href="'.get_category_link( '42' ).'" class="more__link">Больше новостей</a>
								</div>
							</div>
						<!--/hotnews-->
				';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_hot_news_in_home', 'func_on_hot_news_in_home' );









// САМЫЕ ГОРЯЧИЕ НОВОСТИ 
function func_on_samie_hot_news_in_home($atts)
{
				// Горизонтальный слайдер
				global $post; 
				$news_list_args = array( 'post_type' => 'post', 'numberposts' => 6, 'meta_key' => 'on_hot_news', 'orderby' => 'date', 'order' => 'DESC' ); 
				$news_list = get_posts( $news_list_args );
				
				foreach( $news_list as $post ){ setup_postdata($post);
					$gSlider_list.='
								<div class="posts__item news__item posts__item_col posts__item_col-three">
									<a href="'.get_permalink($post->ID).'" class="posts__thumbnail">
										'.get_the_post_thumbnail( $post->ID, 'hot-post-thumb' ).'
										<span class="posts__meta">
											<span class="posts__icon comment-ico" title="Комментариев: '.get_comments_number($post->ID).'">'.get_comments_number($post->ID).'</span>
											<span class="posts__icon view-ico" title="Просмотров: '.get_post_meta($post->ID,'views',true).'">'.get_post_meta($post->ID,'views',true).'</span>
										</span>
									</a>
									<div class="posts__title posts__title_bold posts__title_fix_autor2">
										<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
									</div>
									<div class="posts__data">
										'.get_the_date('d F Y', $post->ID ).'
									</div>
								</div>';
				}
				wp_reset_postdata();
				
				
				$result =  '
						<div class="block">
							<div class="block__title">
								<span>
									Самые «горячие» новости 
								</span>
							</div>
							<div class="posts posts_borderbottom">
								'.$gSlider_list.'
							</div>
							<div class="more">
								<a href="'.get_category_link( '42' ).'" class="more__link">Больше новостей</a>
							</div>
						</div>
				';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_samie_hot_news_in_home', 'func_on_samie_hot_news_in_home' );







// САМЫЕ ГОРЯЧИЕ НОВОСТИ - НОВЫЙ вариант
function func_on_new_hot_news($atts)
{
				// Горизонтальный слайдер
				global $post; 
				$news_list_args = array( 'post_type' => 'post', 'numberposts' => 4, 'meta_key' => 'on_hot_news', 'orderby' => 'date', 'order' => 'DESC' ); 
				$news_list = get_posts( $news_list_args );
				
				foreach( $news_list as $post ){ setup_postdata($post);
					$gSlider_list.='
								<div class="post_top posts__item posts__item_new posts__item_col-two posts__item_flex">
									<a href="'.get_permalink($post->ID).'" class="posts__box">
										<span class="posts__box-img">
											'.get_the_post_thumbnail( $post->ID, 'hot-post-thumb' ).'
											<span class="posts__box-splash">
												<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
												<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
											</span>
										</span>
										<span class="posts__box-title posts__box-title-minus">'.$post->post_title.'</span>
									</a>
								</div>';
				}
				wp_reset_postdata();
				
				
				$result =  '
							<div class="block__title">
								<span>Горячие новости</span>
							</div>
							<div class="posts posts_flex posts_flex-new">
								'.$gSlider_list.'
							</div>'; /*
							<div class="more">
								<a href="'.get_category_link( '42' ).'" class="more__link">Больше новостей</a>
							</div>
							'; */
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_new_hot_news', 'func_on_new_hot_news' );







// Экслюзив - НОВЫЙ вариант
function func_on_new_exlusive_news($atts)
{
				// Горизонтальный слайдер
				global $post; 
				$news_list_args = array( 'post_type' => 'post', 'numberposts' => 4, 'meta_key' => 'on_exlusive_news', 'orderby' => 'date', 'order' => 'DESC' ); 
				$news_list = get_posts( $news_list_args );
				
				foreach( $news_list as $post ){ setup_postdata($post);
					$gSlider_list.='
										<!--new item-->
										<div class="posts__item posts__item_new posts__item_col-four posts__item_flex">
											<a href="'.get_permalink($post->ID).'" class="posts__box">
												<span class="posts__box-mark">ЭКСКЛЮЗИВ</span>
												<span class="posts__box-img">
													'.get_the_post_thumbnail( $post->ID, 'new-exlusive-thumb' ).'
													<span class="posts__box-splash">
														<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
														<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														<span class="posts__box-title posts__box-title_min">'.$post->post_title.'</span>
													</span>
												</span>
											</a>
										</div>
										<!--/new item-->
									';
				}
				wp_reset_postdata();
				
				$result =  '<div class="block">	
								<div class="container">
									<div class="posts posts_flex posts_flex-new">
										'.$gSlider_list.'
									</div>
								</div>
							</div>
						';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_new_exlusive_news', 'func_on_new_exlusive_news' );










// Последние НОВОСТИ НА ГЛВНОЙ - Новый вариант
add_action('wp_ajax_on_do_load_last_news_in_home', 'func_on_new_last_news');
add_action('wp_ajax_nopriv_on_do_load_last_news_in_home', 'func_on_new_last_news');
function func_on_new_last_news($atts){		
		$params = shortcode_atts( array( // в массиве укажите значения параметров по умолчанию
		'title' => '',
		), $atts );
		
		$second='no';
		if($_POST['on_page']=='') { $offset=0; } 
		else { 
				$offset=($_POST['on_page']-1)*18;
				if(($_POST['on_page'] % 2) == 0){ $second='yes'; } else { $second='no'; }
		}
		
		
				global $post; 
				
					// Ищем ИД статьи Первой горячей
					$news_list = get_posts( array( 'post_type' => 'post', 'numberposts' => 4, 'meta_key' => 'on_hot_news', 'orderby' => 'date', 'order' => 'DESC' ) );				
					foreach( $news_list as $post ){ setup_postdata($post); if ($no_post_id!='') {$no_post_id.=',';} $no_post_id.=$post->ID; }
					wp_reset_postdata();
					
					// Ищем ИД статьи Эклюзива
					$news_list = get_posts( array( 'post_type' => 'post', 'numberposts' => 4, 'meta_key' => 'on_exlusive_news', 'orderby' => 'date', 'order' => 'DESC' ) );
					foreach( $news_list as $post ){ setup_postdata($post); if ($no_post_id!='') {$no_post_id.=',';} $no_post_id.=$post->ID; }
					wp_reset_postdata();
				
				if($_POST['on_page']=='') { $numpost=18; } else { $numpost=19; }
				
				// Вертикальный слайдер
				$useragent=$_SERVER['HTTP_USER_AGENT'];
				

				$news_list_args = array( 'post_type' => 'post', 'numberposts' => $numpost, 'exclude' => $no_post_id, 'offset' => $offset, 'orderby' => 'date', 'order' => 'DESC' ); 
				$news_list = get_posts( $news_list_args );
				
				// Определям мобила или нет
				function isMobile() {
			    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
				}
				if (!isMobile()) {
					$lastNews="";
				if($_POST['on_page']=='') { $x=1; } else { $x=0; }
				foreach( $news_list as $post ){ setup_postdata($post);
				
					$lastNews.='';

					if($x==0) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-title posts__box-title_medium posts__box-title_outer bold">'.$post->post_title.'</span>
													<span class="posts__box-excerpt">
														<p>'.get_the_excerpt($post->ID).'</p>
													</span>
													<span class="posts__box-splash posts__box-splash_outer">
														<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
														<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
													</span>
												</a>
											</div>'; }
				
					if($x==1) { $lastNews.='<div class="grid__box grid__box_big">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-big' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==2) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-title posts__box-title_medium posts__box-title_outer bold">'.$post->post_title.'</span>
													<span class="posts__box-excerpt">
														<p>'.get_the_excerpt($post->ID).'</p>
													</span>
													<span class="posts__box-splash posts__box-splash_outer">
														<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
														<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
													</span>
												</a>
											</div>'; }
					if($x==3) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==4) { $lastNews.='<div class="grid__box grid__box_large">
												<a href="'.get_permalink($post->ID).'" class="posts__box posts__box_large">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-large' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==5) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-title posts__box-title_medium posts__box-title_outer bold">'.$post->post_title.'</span>
													<span class="posts__box-excerpt">
														<p>'.get_the_excerpt($post->ID).'</p>
													</span>
													<span class="posts__box-splash posts__box-splash_outer">
														<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
														<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
													</span>
												</a>
											</div>'; }
					if($x==6) { $lastNews.='<div class="grid__box grid__box_large">
												<a href="'.get_permalink($post->ID).'" class="posts__box posts__box_large">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-large' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==7) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==8) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==9) { $lastNews.='<div class="grid__box grid__box_large">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-title posts__box-title_medium posts__box-title_outer posts__box-title_large bold">'.$post->post_title.'</span>
													<span class="posts__box-excerpt">
														<p>'.get_the_excerpt($post->ID).'</p>
													</span>
													<span class="posts__box-splash posts__box-splash_outer">
														<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
														<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
													</span>
												</a>
											</div>'; }
					if($x==10) { $lastNews.='<div class="grid__box grid__box_double">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-title posts__box-title_medium posts__box-title_outer bold">'.$post->post_title.'</span>
													<span class="posts__box-splash posts__box-splash_outer">
														<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
														<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
													</span>
												</a>'; }
					if($x==11) { $lastNews.='
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-title posts__box-title_medium posts__box-title_outer bold">'.$post->post_title.'</span>
													<span class="posts__box-splash posts__box-splash_outer">
														<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
														<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
													</span>
												</a>
											</div>'; }
					if($x==12) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==13) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==14) { $lastNews.='<div class="grid__box grid__box_big">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-big' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==15) { $lastNews.='<div class="grid__box grid__box_large">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-title posts__box-title_medium posts__box-title_outer posts__box-title_large bold">'.$post->post_title.'</span>
													<span class="posts__box-excerpt">
														<p>'.get_the_excerpt($post->ID).'</p>
													</span>
													<span class="posts__box-splash posts__box-splash_outer">
														<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
														<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
													</span>
												</a>
											</div>'; }
					if($x==16) { $lastNews.='<div class="grid__box grid__box_large grid__box_last">
												<a href="'.get_permalink($post->ID).'" class="posts__box posts__box_large">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-large' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==17) { $lastNews.='<div class="grid__box grid__box_last">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-title posts__box-title_medium posts__box-title_outer bold">'.$post->post_title.'</span>
													<span class="posts__box-excerpt">
														<p>'.get_the_excerpt($post->ID).'</p>
													</span>
													<span class="posts__box-splash posts__box-splash_outer">
														<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
														<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
													</span>
												</a>
											</div>'; }
					if($_POST['on_page']=='') { if($x==18) { $lastNews.='<div class="grid__box grid__box_telegram">
					
												<a href="https://t.me/VR_Journal" class="grid__telegram">
													<img src="/wp-content/themes/virtua-theme/images/telegram-ex1.png" alt="">
												</a>
											 </div>'; }
					}
					
					
					
				
				
				
					$x++;
				}
			} else {
				$lastNews="";
				if($_POST['on_page']=='') { $x=1; } else { $x=0; }
				foreach( $news_list as $post ){ setup_postdata($post);
				
					$lastNews.='';
					if($x==0) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
				
					if($x==1) { $lastNews.='<div class="grid__box grid__box_big">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-big' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==2) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==3) { $lastNews.='<div class="grid__box grid__box_big">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-big' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==4) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==5) { $lastNews.='<div class="grid__box grid__box_big">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-big' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==6) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==7) { $lastNews.='<div class="grid__box grid__box_big">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-big' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==8) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==9) { $lastNews.='<div class="grid__box grid__box_big">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-big' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==10) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==11) { $lastNews.='<div class="grid__box grid__box_big">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-big' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==12) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==13) { $lastNews.='<div class="grid__box grid__box_big">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-big' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==14) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==15) { $lastNews.='<div class="grid__box grid__box_big">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-big' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($x==16) { $lastNews.='<div class="grid__box">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-small' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
														</span>
													</span>
													<span class="posts__box-title posts__box-title_medium">'.$post->post_title.'</span>
												</a>
											</div>'; }
					if($x==17) { $lastNews.='<div class="grid__box grid__box_big">
												<a href="'.get_permalink($post->ID).'" class="posts__box">
													<span class="posts__box-img">
														'.get_the_post_thumbnail( $post->ID, 'last-news-thumb-big' ).'
														<span class="posts__box-splash">
															<span class="posts__data">'.get_the_date('d F Y', $post->ID ).'</span>
															<span class="comment-ico view-ico_gray">'.get_post_meta($post->ID,'views',true).'</span>
															<span class="posts__box-title bold">'.$post->post_title.'</span>
														</span>
													</span>
												</a>
											</div>'; }
					if($_POST['on_page']=='') { if($x==18) { $lastNews.='<div class="grid__box grid__box_telegram">
												<a href="https://t.me/VR_Journal" class="grid__telegram">
														<img src="/wp-content/themes/virtua-theme/images/telegram-ex1.jpg" alt="">
												</a>
											 </div>'; }
					}
					
					
					
				
				
				
					$x++;
				}
			}
				
			

			
				
				
				if($_POST['on_page']>0) {
					print $lastNews; wp_die(); exit();
				} else {
					$result =  '<div class="block">
									<div class="container">
										<div class="block__title">
											<span> Последние новости </span>
										</div>
										<!--grid-->
										<div class="grid loadgrid">
											'.$lastNews.'
										</div> 
										<!--/grid-->
										<div class="loadmore">
											<span class="loadmore__button" rel="2" id="loadLastNewsBut">Загрузить еще</span>
											<img src="'.get_bloginfo("template_url").'/images/newloader.gif" alt="Загрузка" class="load-more-img">
										</div>
									</div>
								</div>
					';
				}
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_new_last_news', 'func_on_new_last_news' );







// ГОРЯЧИЕ Игры НА ГЛВНОЙ
function func_on_hot_news_in_game($atts)
{
				// Горизонтальный слайдер
				global $post; 
				$news_list_args = array( 'post_type' => 'post', 'numberposts' => 6, 'meta_key' => 'on_hot_news', 'orderby' => 'date', 'order' => 'DESC' ); 
				$news_list = get_posts( $news_list_args );
				
				foreach( $news_list as $post ){ setup_postdata($post);
				
					$gSlider_list.='
								<div class="posts__item news__item posts__item_col posts__item_col-three">
									<a href="'.get_permalink($post->ID).'" class="posts__thumbnail">
										'.get_the_post_thumbnail( $post->ID, 'last-post-thumb' ).'
										<span class="posts__meta">
											<span class="posts__icon comment-ico" title="Комментариев: '.get_comments_number($post->ID).'">'.get_comments_number($post->ID).'</span>
											<span class="posts__icon view-ico" title="Просмотров: '.get_post_meta($post->ID,'views',true).'">'.get_post_meta($post->ID,'views',true).'</span>
										</span>
									</a>
									<div class="posts__title">
										<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
									</div>
									<div class="posts__data">
										'.get_the_date('d F Y', $post->ID ).'
									</div>
								</div>
					';
				}
				wp_reset_postdata();
				
				
				
				$result =  '
						<!--hot-->
						<div class="block">
							<div class="block__title">
								<span>
									Самые «горячие» новости 
								</span>
							</div>
							<div class="posts posts_borderbottom">
								'.$gSlider_list.'
							</div>
							<div class="more">
								<a href="'.get_category_link( '42' ).'" class="more__link">Больше новостей</a>
							</div>
						</div>
						<!--/hot-->
				';
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_hot_news_in_game', 'func_on_hot_news_in_game' );















// Для страница платформы
function func_on_platform_in_game($atts)
{
			$params = shortcode_atts( array( // в массиве укажите значения параметров по умолчанию
				'platform' => 'PSVR', // Продукт
			), $atts );
			
				// Первый блок
				global $post; 
				$news_list_args = array(
									   'post_type' => 'games',
									   'publish' => true,
									   'numberposts' => 12,
									   'games-platform' => $params['platform'],
									   'meta_key' => 'on_game_rating',
									   'orderby' => 'meta_value_num',
									   'order' => 'DESC',
									   'posts_per_page' => 3,
									   'paged' => 2,
									   'meta_query' => array(
															   array(
																	'key' => 'on_game_rating'
															   )
														   )
								    );
				$news_list = get_posts( $news_list_args );
				foreach( $news_list as $post ){ setup_postdata($post);
					
						if (get_post_meta($post->ID,'on_game_rating',true)) {$print_rating_game='<div class="rating">'.get_post_meta ($post->ID,'on_game_rating',true).'</div>'; } else {$print_rating_game='';}
						$gameListOne.='
									<div class="posts__item posts__item_col posts__item_col-three">
										<div class="postlist__item postlist__item_related">
											'.$print_rating_game.'
											<div class="postlist__thumbnail alignleft">
												<a href="'.get_permalink($post->ID).'" class="postlist__link">
													'.get_the_post_thumbnail( $post->ID, 'afisha-event-thumb' ).'
												</a>
											</div>
											<div class="postlist__item-title  posts__title_fix">
												<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
											</div>
											<div class="posts__options">
												<div>Дата релиза: <span class="strong">'.get_post_meta ($post->ID,'on_game_data_realise',true).'</span></div>
												<div>Платформа: <span class="strong">'.get_the_term_list( $post->ID, 'games-platform', ' ', ',', '' ).'</span></div>
											</div>
										</div>
									</div>';
					
				}
				wp_reset_postdata();
				
				$result =  '
						<div class="block">
							<div class="block__title">
								<span>Игры для платформы: '.$params['platform'].'</span>
							</div>
							<div class="related related_withfilter">
									'.$gameListOne.'
							</div>
						</div>
				 '.get_the_posts_pagination( array('screen_reader_text' => ' Пагинация ', ) ).'
				';
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_platform_in_game', 'func_on_platform_in_game' );





















// СТРАНИЦА РЕЗЮМЭ

function func_on_resume_form($atts)
{
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		
		$on_block_time = get_option('on_form_time_block');
		$on_block_time2 = $on_block_time + 3;   // можно поставить 2 секунды
		$on_date_now = date('U');
		if ($on_block_time2 > $on_date_now ) { $on_block_time_yes='yes'; } else { update_option( 'on_form_time_block', $on_date_now ); }
				
		if ( empty($_POST) || !wp_verify_nonce($_POST['_wp_nonce_resume'],'on_send_resume_x') or $on_block_time_yes=='yes' )
		{
		   $print_status = "ОШИБКА! ВЫ СПАМЕР!";
		}
		else
		{
			if( empty($_POST['on_resume_imya']) or empty($_POST['on_resume_otchestvo']) or empty($_POST['on_resume_familia']) ) {
				$print_status = "<div class='wpcf7-validation-errors'><center>Некоторые поля пустые, проверьте и повторите отправку</center></div>";
				$error = 'yes';
			} else {
				$_GET['edit'] = preg_replace('/[^0-9]/', '', $_GET['edit']);
				if (empty($_GET['edit'])) {
						
					// Ошибок нет, обрабатываем резюме. 
					$new_resume = array(
						'post_type'    => 'resume',
						'post_title'    => $_POST['on_resume_familia'].' '.$_POST['on_resume_imya'].' '.$_POST['on_resume_otchestvo'],
					//	'post_content'    => $_POST['on_res_obo_mne'],
						'post_status'   => 'pending' // опубликованный пост
					);
					
					// добавляем пост и получаем его ID 
					$new_resume_id = wp_insert_post( $new_resume );
					
					update_post_meta($new_resume_id, 'on_resume_familia', $_POST['on_resume_familia']);
					update_post_meta($new_resume_id, 'on_resume_imya', $_POST['on_resume_imya']);
					update_post_meta($new_resume_id, 'on_resume_otchestvo', $_POST['on_resume_otchestvo']);
					
					update_post_meta($new_resume_id, 'on_resume_dataday', $_POST['on_resume_dataday']);
					update_post_meta($new_resume_id, 'on_resume_city', $_POST['on_resume_city']);
					update_post_meta($new_resume_id, 'on_resume_stage', $_POST['stage']);
					update_post_meta($new_resume_id, 'on_resume_jelanie_opit_da_net', $_POST['on_resume_opit']);
					update_post_meta($new_resume_id, 'on_resume_jelanie_rang', $_POST['on_resume_rang']);
					update_post_meta($new_resume_id, 'on_resume_jelanie_zp_ot', $_POST['on_resume_zp_ot']);
					update_post_meta($new_resume_id, 'on_resume_jelanie_zp_do', $_POST['on_resume_zp_do']);
					update_post_meta($new_resume_id, 'on_resume_jelanie_zp_valuta', $_POST['on_resume_valute']);
					
					update_post_meta($new_resume_id, 'on_date_add', date("U"));
					
					// Навыки Проф областей
				//	$print_on_key_prof_obl=implode(', ',$_POST['on_key_prof_obl']);
					foreach ( $_POST['on_key_prof_obl'] as $key_navik => $value_navik) {
									if ($print_on_key_prof_obl) {$zpt=', ';}
									$print_on_key_prof_obl.=$zpt.$key_navik;
					}
					update_post_meta($new_resume_id, 'on_resume_profobl', $print_on_key_prof_obl);
					
					// Навыки 
				//	$print_on_key_naviki=implode(', ',$_POST['on_key_naviki']);
					foreach ( $_POST['on_key_naviki'] as $key_navik => $value_navik) {
									if ($print_on_key_naviki) {$zpt=', ';}
									$print_on_key_naviki.=$zpt.$key_navik;
					}
					update_post_meta($new_resume_id, 'on_resume_naviki', $print_on_key_naviki);
					
					update_post_meta($new_resume_id, 'on_resume_zanyatost', $_POST['on_resume_zanyatost']);
					update_post_meta($new_resume_id, 'on_resume_typework', $_POST['on_resume_typework']);
					
					update_post_meta($new_resume_id, 'on_resume_land', $_POST['on_resume_land']);
					update_post_meta($new_resume_id, 'on_resume_grajdanstvo', $_POST['on_resume_grajdanstvo']);
					
					// загрузка ФОТО
					if (!empty($_FILES['on_resume_photo'])) {
							if ( ! function_exists( 'wp_handle_upload' ) ) 
								require_once( ABSPATH . 'wp-admin/includes/image.php' );
								require_once( ABSPATH . 'wp-admin/includes/file.php' );
								require_once( ABSPATH . 'wp-admin/includes/media.php' );
						//	$file = $_FILES['on_resume_photo'];
							$movefile = media_handle_upload( 'on_resume_photo', $new_resume_id ); // Вместо 0 ставим ID POSTA

							if ( is_wp_error( $movefile ) ) {
								$status_file = "Ошибка загрузки медиафайла.";
							} else {
								$status_file = "Медиафайл был успешно загружен! =".$movefile."= ";
								set_post_thumbnail( $new_resume_id, $movefile ); // Устанавливаем миниатюру
							}

							$status_file.= " = OK = ";
					} else { $status_file = 'ФАЙЛА НЕТ!'; }
					
					/* ОБРАБАТЫВАЕМ И СОХРАНЯЕМ ПОРТФОЛИО */
					$files = $_FILES["infor"]; // Сохраняем массив фоток 
					foreach ($_POST['infor']["'portfolio'"] as $key_port => $value_port) {
							if ($value_port["'name'"]!='') {
								$new_portfollio = array(
									'post_type'    => 'portfolio',
									'post_title'    => $value_port["'name'"],
									'post_content'    => $value_port["'opis'"],
									'post_status'   => 'pending' // опубликованный пост
								);
								$new_portfollio_id = wp_insert_post( $new_portfollio ); // добавляем пост и получаем его ID 

								update_post_meta($new_portfollio_id, 'on_portfolio_id_resume', $new_resume_id);
								update_post_meta($new_portfollio_id, 'on_portfolio_data', $value_port["'year'"]);
								// Навыки 
							//	$print_on_key_naviki_port=implode(', ',$_POST['on_key_naviki_port']);
								foreach ( $value_port["'on_key_naviki_port'"] as $key_navik => $value_navik) {
									if ($print_on_key_naviki_port) {$zpt=', ';}
									$print_on_key_naviki_port.=$zpt.$key_navik;
								}
								update_post_meta($new_portfollio_id, 'on_portfolio_naviki', $print_on_key_naviki_port);
								
								// Собираем фотки (обложки)
								foreach ($files['name']["'portfolio'"] as $key => $value) { 
									//	$test_pro.="<br> $key_port == $key <br>";			
										if ($files['name']["'portfolio'"][$key] and $key_port==$key) { 
											if ($files['name']["'portfolio'"][$key]['img']!=='') { // Если название не пусто
												$file = array( 
													'name' => $files['name']["'portfolio'"][$key]["'img'"],
													'type' => $files['type']["'portfolio'"][$key]["'img'"], 
													'tmp_name' => $files['tmp_name']["'portfolio'"][$key]["'img'"], 
													'error' => $files['error']["'portfolio'"][$key]["'img'"],
													'size' => $files['size']["'portfolio'"][$key]["'img'"]
												); 
												$_FILES = array ("portfolio_pro" => $file); 
											//	foreach ($_FILES as $file => $array) {				
													// загрузка ФОТО
													if (!empty($_FILES['portfolio_pro'])) {
															if ( ! function_exists( 'wp_handle_upload' ) ) 
																require_once( ABSPATH . 'wp-admin/includes/image.php' );
																require_once( ABSPATH . 'wp-admin/includes/file.php' );
																require_once( ABSPATH . 'wp-admin/includes/media.php' );
															$movefile = media_handle_upload( 'portfolio_pro', $new_portfollio_id ); // Вместо 0 ставим ID POSTA
													} else { $status_file = 'ФАЙЛА НЕТ!'; }
													if ( is_wp_error( $movefile ) ) { $status_file = "Ошибка загрузки медиафайла."; } else {
														$status_file.= "Медиафайл был успешно загружен! =".$movefile."= ";
														set_post_thumbnail( $new_portfollio_id, $movefile ); // Устанавливаем миниатюру
													}
											//	}
											}
										} 
								} 
							}
					}
										 
					// Сохраняем большой массив
					unset($_POST['infor']["'portfolio'"] );  // Удаляем из него портфолио
					$infor = serialize($_POST['infor']);
					update_post_meta($new_resume_id, 'on_resume_infor', $infor);
					
					$print_status = "<div class='wpcf7-mail-sent-ok'><center>Ваше резюме успешно отправлено.</center></div>";
				
				// ЕСЛИ ОБНОВЛЯЕМ РЕЗЮМЕ
				} else {
					
					// Сохраняем большой массив
					$infor = serialize($_POST['infor']);
					update_post_meta($_GET['edit'], 'on_resume_infor', $infor);
					
					
					update_post_meta($_GET['edit'], 'on_resume_familia', $_POST['on_resume_familia']);
					update_post_meta($_GET['edit'], 'on_resume_imya', $_POST['on_resume_imya']);
					update_post_meta($_GET['edit'], 'on_resume_otchestvo', $_POST['on_resume_otchestvo']);
					
					update_post_meta($_GET['edit'], 'on_resume_dataday', $_POST['on_resume_dataday']);
					update_post_meta($_GET['edit'], 'on_resume_city', $_POST['on_resume_city']);
					update_post_meta($_GET['edit'], 'on_resume_stage', $_POST['stage']);
					update_post_meta($_GET['edit'], 'on_resume_jelanie_opit_da_net', $_POST['on_resume_opit']);
					update_post_meta($_GET['edit'], 'on_resume_jelanie_rang', $_POST['on_resume_rang']);
					update_post_meta($_GET['edit'], 'on_resume_jelanie_zp_ot', $_POST['on_resume_zp_ot']);
					update_post_meta($_GET['edit'], 'on_resume_jelanie_zp_do', $_POST['on_resume_zp_do']);
					update_post_meta($_GET['edit'], 'on_resume_jelanie_zp_valuta', $_POST['on_resume_valute']);
					
					update_post_meta($_GET['edit'], 'on_date_add', date("U"));
					
					// Навыки Проф областей
				//	$print_on_key_prof_obl=implode(', ',$_POST['on_key_prof_obl']);
					foreach ( $_POST['on_key_prof_obl'] as $key_navik => $value_navik) {
									if ($print_on_key_prof_obl) {$zpt=', ';}
									$print_on_key_prof_obl.=$zpt.$key_navik;
					}
					update_post_meta($_GET['edit'], 'on_resume_profobl', $print_on_key_prof_obl);
					
					// Навыки 
				//	$print_on_key_naviki=implode(', ',$_POST['on_key_naviki']);
					foreach ( $_POST['on_key_naviki'] as $key_navik => $value_navik) {
									if ($print_on_key_naviki) {$zpt=', ';}
									$print_on_key_naviki.=$zpt.$key_navik;
					}
					update_post_meta($_GET['edit'], 'on_resume_naviki', $print_on_key_naviki);
					
					// Занятость и Тип Работы
					update_post_meta($_GET['edit'], 'on_resume_zanyatost', $_POST['on_resume_zanyatost']);
					update_post_meta($_GET['edit'], 'on_resume_typework', $_POST['on_resume_typework']);
					
					update_post_meta($_GET['edit'], 'on_resume_land', $_POST['on_resume_land']);
					update_post_meta($_GET['edit'], 'on_resume_grajdanstvo', $_POST['on_resume_grajdanstvo']);
					
					// загрузка ФОТО
					if (!empty($_FILES['on_resume_photo'])) {
							if ( ! function_exists( 'wp_handle_upload' ) ) 
								require_once( ABSPATH . 'wp-admin/includes/image.php' );
								require_once( ABSPATH . 'wp-admin/includes/file.php' );
								require_once( ABSPATH . 'wp-admin/includes/media.php' );
						//	$file = $_FILES['on_resume_photo'];
							$movefile = media_handle_upload( 'on_resume_photo', $_GET['edit'] ); // Вместо 0 ставим ID POSTA

							if ( is_wp_error( $movefile ) ) {
								$status_file = "Ошибка загрузки медиафайла.";
							} else {
								$status_file = "Медиафайл был успешно загружен! =".$movefile."= ";
								set_post_thumbnail( $_GET['edit'], $movefile ); // Устанавливаем миниатюру
							}

							$status_file.= " = OK = ";
					} else { $status_file = 'ФАЙЛА НЕТ!'; }
					
					$print_status = "<div class='wpcf7-mail-sent-ok'><center>Ваше резюме успешно ОБНОВЛЕНО.</center></div>";
				}
			}
		} 
		
		$result='<div class="article__body">'.$print_status.$test_pro.'</div>';
		
	} else {
		// Если форма редактирования
		$_GET['edit'] = preg_replace('/[^0-9]/', '', $_GET['edit']);
		if (!empty($_GET['edit'])) {
					$my_resume = get_post( $_GET['edit'] );
					$on_resume_title = $my_resume->post_title;
					$on_resume_familia = get_post_meta ($_GET['edit'],'on_resume_familia',true);
					$on_resume_imya = get_post_meta ($_GET['edit'],'on_resume_imya',true);
					$on_resume_otchestvo = get_post_meta ($_GET['edit'],'on_resume_otchestvo',true);
					$on_resume_dataday = get_post_meta ($_GET['edit'],'on_resume_dataday',true);
					$on_resume_city = get_post_meta ($_GET['edit'],'on_resume_city',true);
					$on_resume_stage = get_post_meta ($_GET['edit'],'on_resume_stage',true);
					$on_resume_jelanie_opit_da_net = get_post_meta ($_GET['edit'],'on_resume_jelanie_opit_da_net',true);
					$on_resume_jelanie_rang = get_post_meta ($_GET['edit'],'on_resume_jelanie_rang',true);
					$on_resume_jelanie_zp_ot = get_post_meta ($_GET['edit'],'on_resume_jelanie_zp_ot',true);
					$on_resume_jelanie_zp_do = get_post_meta ($_GET['edit'],'on_resume_jelanie_zp_do',true);
					$on_resume_jelanie_zp_valuta = get_post_meta ($_GET['edit'],'on_resume_jelanie_zp_valuta',true);
					
					$on_resume_profobl = get_post_meta ($_GET['edit'],'on_resume_profobl',true);
					$on_resume_naviki = get_post_meta ($_GET['edit'],'on_resume_naviki',true);
					$on_resume_zanyatost = get_post_meta ($_GET['edit'],'on_resume_zanyatost',true);
					$on_resume_typework = get_post_meta ($_GET['edit'],'on_resume_typework',true);
					
					$on_resume_land = get_post_meta($_GET['edit'],'on_resume_land',true);
					$on_resume_grajdanstvo = get_post_meta($_GET['edit'],'on_resume_grajdanstvo',true);
					
					$on_resume_infor = unserialize(get_post_meta($_GET['edit'],'on_resume_infor',true));
					
		//			print "+++++++++++++";
		//			print_r($on_resume_infor);
					
					$text_buttom = 'Обновить резюме';
					$update_url="?edit=".$_GET['edit'];
		} else { $text_buttom = 'Создать резюме'; }
	
	
				// Ключевые навыки
				$args = array(
										  'taxonomy'     => 'key-naviki', // название таксономии
										  'orderby'      => 'count',  // сортируем по названиям
										  'order'		 => 'DESC',
										  'show_count'   => 0,       // не показываем количество записей
										  'pad_counts'   => 0,       // не показываем количество записей у родителей
										  'hierarchical' => 0,       // древовидное представление
										  'title_li'     => '',       // список без заголовка
										  'show_option_none'   => 'нет ключевых навыков',
										  'echo' => 0, // Выводить на экран или созвращать для обработки
										  'hide_empty' => 0,
										  "walker"=>new TagsNewsWalkerIDs()
										);	
				$tagsList = wp_list_categories($args);
				
				// Собираем массив
				$tagsList = explode("|", $tagsList);
				foreach ($tagsList as $key => $value) {
					$value = explode("=", $value);
					$tagsListArray[$key]['id']=$value[0];
					$tagsListArray[$key]['name']=$value[1];
					$tagsListArray[$key]['slug']=$value[2];
				}
				
			
				
				//Формируем заголовки
				foreach ($tagsListArray as $key => $value) {
					if (!empty($_GET['edit'])) { if (strpos($on_resume_naviki, $tagsListArray[$key]['name']) === false) {$checked='';}  else {$checked='checked';}  }
					$print_key_navik.= '<label class="lk__check" style="display: inline-block;" for="check'.$key.'"><input '.$checked.' type="checkbox" name="on_key_naviki['.$tagsListArray[$key]['name'].']" class="lk__checkbox" val="" rel="'.$value['name'].'" id="check'.$key.'">'.$value['name'].$check.'</label>';
				}
				//Формируем заголовки - для проф.области
				foreach ($tagsListArray as $key => $value) {
					if (!empty($_GET['edit'])) { if (strpos($on_resume_profobl, $tagsListArray[$key]['name']) === false) {$checked='';}  else {$checked='checked';}  }
					$print_key_prof_obl.= '<label class="lk__check" style="display: inline-block;" for="check3'.$key.'"><input '.$checked.' type="checkbox" name="on_key_prof_obl['.$tagsListArray[$key]['name'].']" class="lk__checkbox" val="" rel="'.$value['name'].'" id="check3'.$key.'">'.$value['name'].'</label>';
				}
				
				
				
				/*
				// Проф Области
				$args = array(
										  'taxonomy'     => 'prof-obl', // название таксономии
										  'orderby'      => 'count',  // сортируем по названиям
										  'order'		 => 'DESC',
										  'show_count'   => 0,       // не показываем количество записей
										  'pad_counts'   => 0,       // не показываем количество записей у родителей
										  'hierarchical' => 0,       // древовидное представление
										  'title_li'     => '',       // список без заголовка
										  'show_option_none'   => 'нет ключевых навыков',
										  'echo' => 0, // Выводить на экран или созвращать для обработки
										  'hide_empty' => 0,
										  "walker"=>new TagsNewsWalkerIDs()
										);	
				$tagsList = wp_list_categories($args);
				
				// Собираем массив
				$tagsList = explode("|", $tagsList);
				foreach ($tagsList as $key => $value) {
					$value = explode("=", $value);
					$tagsListArray[$key]['id']=$value[0];
					$tagsListArray[$key]['name']=$value[1];
					$tagsListArray[$key]['slug']=$value[2];
				}
				
				//Формируем заголовки
				foreach ($tagsListArray as $key => $value) {
					$print_key_navik_profobl.= '<label class="label_check" style="display: inline-block;" for="check'.$key.'"><input type="checkbox" name="on_key_profobl['.$tagsListArray[$key]['slug'].']" val="" rel="'.$value['name'].'" id="check'.$key.'"><span>'.$value['name'].'</span></label>';
				}
				*/
				
				// Гражданство
				$args = array(
										  'taxonomy'     => 'grajdanstvo', // название таксономии
										  'orderby'      => 'count',  // сортируем по названиям
										  'order'		 => 'DESC',
										  'show_count'   => 0,       // не показываем количество записей
										  'pad_counts'   => 0,       // не показываем количество записей у родителей
										  'hierarchical' => 0,       // древовидное представление
										  'title_li'     => '',       // список без заголовка
										  'show_option_none'   => 'нет ключевых навыков',
										  'echo' => 0, // Выводить на экран или созвращать для обработки
										  'hide_empty' => 0,
										  "walker"=>new TagsNewsWalkerIDs()
										);	
				$tagsList2 = wp_list_categories($args);
				
				// Собираем массив
				$tagsList2 = explode("|", $tagsList2);
				foreach ($tagsList2 as $key2 => $value2) {
					$value2 = explode("=", $value2);
					$tagsListArray2[$key2]['id']=$value2[0];
					$tagsListArray2[$key2]['name']=$value2[1];
					$tagsListArray2[$key2]['slug']=$value2[2];
				}
				
				//Формируем заголовки
				foreach ($tagsListArray2 as $key2 => $value2) {
					if ($on_resume_grajdanstvo==$value2['name']) { $checked='selected'; } else { $checked=''; }
					$print_grajdanstvo_list.= '<option '.$checked.' value="'.$value2['name'].'">'.$value2['name'].'</option>';
				}
				
				
				// Занятость
				$args = array(
										  'taxonomy'     => 'zanyatost', // название таксономии
										  'orderby'      => 'count',  // сортируем по названиям
										  'order'		 => 'DESC',
										  'show_count'   => 0,       // не показываем количество записей
										  'pad_counts'   => 0,       // не показываем количество записей у родителей
										  'hierarchical' => 0,       // древовидное представление
										  'title_li'     => '',       // список без заголовка
										  'show_option_none'   => 'нет ключевых навыков',
										  'echo' => 0, // Выводить на экран или созвращать для обработки
										  'hide_empty' => 0,
										  "walker"=>new TagsNewsWalkerIDs()
										);	
				$tagsList3 = wp_list_categories($args);
				
				// Собираем массив
				$tagsList3 = explode("|", $tagsList3);
				foreach ($tagsList3 as $key3 => $value3) {
					$value3 = explode("=", $value3);
					$tagsListArray3[$key3]['id']=$value3[0];
					$tagsListArray3[$key3]['name']=$value3[1];
					$tagsListArray3[$key3]['slug']=$value3[2];
				}
				
				//Формируем заголовки
				foreach ($tagsListArray3 as $key3 => $value3) {
					if ($on_resume_zanyatost==$value3['name']) { $checked='selected'; } else { $checked=''; }
					$print_zanyatost.= '<option '.$checked.' value="'.$value3['name'].'">'.$value3['name'].'</option>';
				}
				
				
				// Страны и города
				$categories1 = get_terms( array ('taxonomy' => 'city', 'orderby' => 'name', 'hide_empty' => false, 'fields' => 'id=>parent', 'count' => false, 'child_of' => '' ));
				$categories2 = get_terms( array ('taxonomy' => 'city', 'orderby' => 'name', 'hide_empty' => false, 'fields' => 'id=>name', 'count' => false, 'child_of' => '' ));
				// СОбираем страны
				foreach ($categories1 as $key4 => $value4) {
					if ($value4==0) {
						if ($on_resume_land==$categories2[$key4]) { $checked='selected'; } else { $checked=''; }
						$print_land_list.= '<option '.$checked.' value="'.$categories2[$key4].'">'.$categories2[$key4].'</option>';
						// собираем массив стран и городов
						foreach ($categories1 as $key_city => $value_city) {
							if ($value_city==$key4) {
								$lands_city[$categories2[$key4]][$key_city]=$categories2[$key_city];
							}
						}
					}					
				}
				//	print_r($lands_city);
				
				
				// Тип работы
				$categories1 = get_terms( array ('taxonomy' => 'typework', 'orderby' => 'name', 'hide_empty' => false, 'fields' => 'id=>name', 'count' => false, 'child_of' => '' ));
				// СОбираем страны
				foreach ($categories1 as $key_type => $value_type) {
						if ($on_resume_typework==$value_type) { $checked='selected'; } else { $checked=''; }
						$print_worktype_list.= '<option '.$checked.' value="'.$value_type.'">'.$value_type.'</option>';				
				}
				
				// Учебные заведения
				$categories1 = get_terms( array ('taxonomy' => 'ucheb-zaved', 'orderby' => 'name', 'hide_empty' => false, 'fields' => 'id=>parent', 'count' => false, 'child_of' => '' ));
				$categories2 = get_terms( array ('taxonomy' => 'ucheb-zaved', 'orderby' => 'name', 'hide_empty' => false, 'fields' => 'id=>name', 'count' => false, 'child_of' => '' ));
				// СОбираем страны
				foreach ($categories1 as $key4 => $value4) {
					if ($value4==0) {
						$print_land_uch_list.= '<option value="'.$categories2[$key4].'">'.$categories2[$key4].'</option>';
						// собираем массив стран и уч заведений
						foreach ($categories1 as $key_city => $value_city) {
							if ($value_city==$key4) {
								$ucheb_zaved[$categories2[$key4]][$key_city]=$categories2[$key_city];
							}
						}
					}					
				}
				// Проходимся по массиву и собираем список
				$print_list_uch_zaved='';
				foreach ($ucheb_zaved as $strana => $uch_list) {
							$print_list_uch_zaved.='<option disabled value="'.$strana.'"><b>'.$strana.'</b></option>';
							foreach ($uch_list as $uch_id => $uch_zaved) {
								$print_list_uch_zaved.='<option value="'.$uch_zaved.'">&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;'.$uch_zaved.'</option>';
							}
				}
				
				
				//Года окончания ОБРАЗОВАНИЕ
				$last_year = date('Y');
				$print_list_years_obraz='<option disabled selected value="">Выберите год</option>';
				for ($i = 1; $i <= 15; $i++) {
					$print_list_years_obraz.='<option value="'.$last_year.'">'.$last_year.'</option>';
					$last_year=$last_year-1;
				}
				
				//Года окончания КУРСЫ
				$last_year = date('Y');
				$print_list_years_kursy='<option disabled selected value="">Выберите год</option>';
				for ($i = 1; $i <= 15; $i++) {
					$print_list_years_kursy.='<option value="'.$last_year.'">'.$last_year.'</option>';
					$last_year=$last_year-1;
				}
				//Года окончания ПОРТФОЛИО
				$last_year = date('Y');
				$print_list_years_port='<option disabled selected value="">Выберите год</option>';
				for ($i = 1; $i <= 15; $i++) {
					$print_list_years_port.='<option value="'.$last_year.'">'.$last_year.'</option>';
					$last_year=$last_year-1;
				}
				
				//Года окончания СТАНДАРТ
				$last_year = date('Y');
				$print_list_years='<option disabled selected value="">Выберите год</option>';
				for ($i = 1; $i <= 15; $i++) {
					$print_list_years.='<option value="'.$last_year.'">'.$last_year.'</option>';
					$last_year=$last_year-1;
				}
				
				
				//Опыт работы
				$print_list_opit='<option disabled selected value="">Выберите</option>';
				$y=0;
				for ($i = 1; $i <= 15; $i++) {
					if ($i==1) {$print_list_opit.='<option value="до года">До года</option>';}
					else { $y++; $print_list_opit.='<option value=" от '.$y.' до '.$i.' лет"> от '.$y.' до '.$i.' лет</option>'; }
				}
				
				// Языки
				$categories1 = get_terms( array ('taxonomy' => 'langwich', 'orderby' => 'name', 'hide_empty' => false, 'fields' => 'id=>name', 'count' => false, 'child_of' => '' ));
				// СОбираем страны
				$print_langwich_list='<option disabled selected value="">Язык</option>';
				foreach ($categories1 as $key_type => $value_type) {
						$print_langwich_list.= '<option value="'.$value_type.'">'.$value_type.'</option>';				
				}
				
				// Степень владения языками
				$categories1 = get_terms( array ('taxonomy' => 'langwich-stepen', 'orderby' => 'name', 'hide_empty' => false, 'fields' => 'id=>name', 'count' => false, 'child_of' => '' ));
				// СОбираем страны
				$print_langwich_stepen_list='<option disabled selected value="">Степень владения</option>';
				foreach ($categories1 as $key_type => $value_type) {
						$print_langwich_stepen_list.= '<option value="'.$value_type.'">'.$value_type.'</option>';				
				}
				
				// Образования
				$categories1 = get_terms( array ('taxonomy' => 'resume-obrazovaie', 'orderby' => 'name', 'hide_empty' => false, 'fields' => 'id=>name', 'count' => false, 'child_of' => '' ));
				// СОбираем страны
				$print_obrazov_list='<option disabled selected value="">Выберите</option>';
				foreach ($categories1 as $key_type => $value_type) {
						$print_obrazov_list.= '<option value="'.$value_type.'">'.$value_type.'</option>';				
				}
				
				// Степени образования
				$categories1 = get_terms( array ('taxonomy' => 'resume-obrazovaie-stepen', 'orderby' => 'name', 'hide_empty' => false, 'fields' => 'id=>name', 'count' => false, 'child_of' => '' ));
				// СОбираем страны
				$print_obrazov_stepen_list='<option disabled selected value="">Нет</option>';
				foreach ($categories1 as $key_type => $value_type) {
						$print_obrazov_stepen_list.= '<option value="'.$value_type.'">'.$value_type.'</option>';				
				}
				
							
				
				
				
				// Блок КЛОН - ОБразование
				if (!empty($_GET['edit'])) {
					$count_obrazov_block=count($on_resume_infor["'obrazovanie'"])-1;
				} else { $count_obrazov_block=0; }
				
				$print_obrazov_block_list='<input type="hidden" name="count_obrazov_block" id="count_obrazov_block" value="'.$count_obrazov_block.'">
										   <div id="addobrazv">';
				for ($i = 0; $i <= $count_obrazov_block; $i++) {
					
					// Обнуляем selected
					$print_obrazov_list=str_replace('selected','',$print_obrazov_list);
					$print_obrazov_stepen_list=str_replace('selected','',$print_obrazov_stepen_list);
					$print_list_uch_zaved=str_replace('selected','',$print_list_uch_zaved);
					$print_list_years_obraz=str_replace('selected','',$print_list_years_obraz);
					
					$print_obrazov_list=str_replace('<option value="'.$on_resume_infor["'obrazovanie'"][$i]["'type'"].'">', '<option selected value="'.$on_resume_infor["'obrazovanie'"][$i]["'type'"].'">', $print_obrazov_list);
					$print_obrazov_stepen_list=str_replace('<option value="'.$on_resume_infor["'obrazovanie'"][$i]["'type_stepen'"].'">', '<option selected value="'.$on_resume_infor["'obrazovanie'"][$i]["'type_stepen'"].'">', $print_obrazov_stepen_list);
					$print_list_uch_zaved=str_replace('<option value="'.$on_resume_infor["'obrazovanie'"][$i]["'zaved'"].'">', '<option selected value="'.$on_resume_infor["'obrazovanie'"][$i]["'zaved'"].'">', $print_list_uch_zaved);
					$print_list_years_obraz=str_replace('<option value="'.$on_resume_infor["'obrazovanie'"][$i]["'god_okonchania'"].'">', '<option selected value="'.$on_resume_infor["'obrazovanie'"][$i]["'god_okonchania'"].'">', $print_list_years_obraz);
										
					$print_obrazov_block_list.='
									<div class="obrazovanie">
										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Уровень
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<select class="obrazov_select" datt="INN" name="infor[\'obrazovanie\']['.$i.'][\'type\']" class="lk__select">
													'.$print_obrazov_list.'
												</select>
											</div>
										</div>

										<div class="row stepen_viski dopcls_INN">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Степень
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<select  name="infor[\'obrazovanie\']['.$i.'][\'type_stepen\']" class="lk__select">
													'.$print_obrazov_stepen_list.'
												</select>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-8 col-sm-offset-4 col-xs-12">
												<div class="lk__title lk__title_sep">Основное образование</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Выбор учебного заведения
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<select name="infor[\'obrazovanie\']['.$i.'][\'zaved\']" id="on_resume_ucheb_zaveden" size="8" style="height: 250px;" class="lk__select lk__select_multiple">
													'.$print_list_uch_zaved.'
												</select>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
											</div>
											<div class="col-sm-8 col-xs-12">
												<input  name="infor[\'obrazovanie\']['.$i.'][\'zaved_text\']" type="text" class="lk__input" value="'.$on_resume_infor["'obrazovanie'"][$i]["'zaved_text'"].'" placeholder="Напишите учебное заведение, если его нет в катлоге">
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Факультет</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<input  name="infor[\'obrazovanie\']['.$i.'][\'facultet\']" type="text" class="lk__input" value="'.$on_resume_infor["'obrazovanie'"][$i]["'facultet'"].'" placeholder="Введите название">
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Специальность</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<input  name="infor[\'obrazovanie\']['.$i.'][\'cpecialnost\']" type="text" class="lk__input" value="'.$on_resume_infor["'obrazovanie'"][$i]["'cpecialnost'"].'" placeholder="Введите название">
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Год окончания</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<select name="infor[\'obrazovanie\']['.$i.'][\'god_okonchania\']" class="lk__select">
													'.$print_list_years_obraz.'
												</select>
											</div>
										</div>
									</div>';
				}
				$print_obrazov_block_list.='</div>';
					
				
				// Блок КЛОН - КУРСЫ
				if (!empty($_GET['edit'])) {
					$count_kursi_block=count($on_resume_infor["'kursi'"])-1;
				} else { $count_kursi_block=0; }
				
				$print_kursi_block_list='<input type="hidden" name="count_kursi_block" id="count_kursi_block" value="'.$count_kursi_block.'">
										 <div id="addkursi">';
				for ($i = 0; $i <= $count_kursi_block; $i++) {
										
					$print_list_years_obraz=str_replace('selected','',$print_list_years_obraz);	// Обнуляем selected				
					$print_list_years_kursy=str_replace('<option value="'.$on_resume_infor["'kursi'"][$i]["'year'"].'">', '<option selected value="'.$on_resume_infor["'kursi'"][$i]["'year'"].'">', $print_list_years_kursy);
										
					$print_kursi_block_list.='
									<div class="kursi">
										<div class="row">
											<div class="col-sm-8 col-sm-offset-4 col-xs-12">
												<div class="lk__title lk__title_sep">Курсы</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Назание курсов</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<input name="infor[\'kursi\']['.$i.'][\'name\']" type="text" value="'.$on_resume_infor["'kursi'"][$i]["'name'"].'" class="lk__input" placeholder="Введите название">
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Год</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<select  name="infor[\'kursi\']['.$i.'][\'year\']"class="lk__select">
													'.$print_list_years_kursy.'
												</select>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Образовательный центр</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<input name="infor[\'kursi\']['.$i.'][\'centre\']" type="text" value="'.$on_resume_infor["'kursi'"][$i]["'centre'"].'" class="lk__input"  placeholder="Введите название">
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">О курсах</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<textarea  placeholder="Описание курсов" name="infor[\'kursi\']['.$i.'][\'opis\']" class="lk__textarea">'.$on_resume_infor["'kursi'"][$i]["'opis'"].'</textarea>
											</div>
										</div>
									</div>
									';
				}
				$print_kursi_block_list.='</div>'; 
				
				
				// Блок КЛОН - ЯЗЫК
				if (!empty($_GET['edit'])) {
					$count_lang_block=count($on_resume_infor["'lang'"])-1;
				} else { $count_lang_block=0; }
				
				$print_lang_block_list='<input type="hidden" name="count_lang_block" id="count_lang_block" value="'.$count_lang_block.'">
										<div id="addlangs">';
				for ($i = 0; $i <= $count_lang_block; $i++) {
										
					$print_langwich_list=str_replace('selected','',$print_langwich_list); // Обнуляем selected
					$print_langwich_stepen_list=str_replace('selected','',$print_langwich_stepen_list); // Обнуляем selected	
					
					$print_langwich_list=str_replace('<option value="'.$on_resume_infor["'lang'"][$i]["'type'"].'">', '<option selected value="'.$on_resume_infor["'lang'"][$i]["'type'"].'">', $print_langwich_list);
					$print_langwich_stepen_list=str_replace('<option value="'.$on_resume_infor["'lang'"][$i]["'lang_stepen'"].'">', '<option selected value="'.$on_resume_infor["'lang'"][$i]["'lang_stepen'"].'">', $print_langwich_stepen_list);
							
					$print_lang_block_list.='
								<div class="langs">
										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Укажите язык</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<div class="row">
													<div class="col-sm-5 col-xs-6">
														<select name="infor[\'lang\']['.$i.'][\'type\']" class="lk__select">
															'.$print_langwich_list.'
														</select>
													</div>
													<div class="col-sm-5 col-xs-6">
														<select name="infor[\'lang\']['.$i.'][\'lang_stepen\']" class="lk__select">
															'.$print_langwich_stepen_list.'
														</select>
													</div>
												</div>												
											</div>
										</div>
								</div>';
				}
				$print_lang_block_list.='</div>';
				
				
				
				
				
				
				
		echo '<div class="back">
								<a href="#" onclick="javascript:history.back(); return false;" class="btn btn_blue btn_ico btn_back"><div class="btn__ico btn__ico_back"></div> <span>Назад</span></a>
								<span class="back__strong">Заполните данные</span>
							</div>
							<div class="lk">
								<form action="'.$update_url.'" method="POST" class="resume__form" id="on-form-submit" enctype="multipart/form-data">
									<input type="hidden" name="action" value="on_send_resume">';
		echo wp_nonce_field( 'on_send_resume_x', '_wp_nonce_resume', true, false );
		echo '                  <div class="lk__form-in">
										<div class="lk__title">Основная информация</div>
										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Имя
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<input name="on_resume_imya" id="on_resume_imya" type="text" placeholder="Введите Ваше имя" value="'.$on_resume_imya.'" class="lk__input required">													
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Отчество
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<input name="on_resume_otchestvo" id="on_resume_otchestvo" placeholder="Введите Ваше отчество" value="'.$on_resume_otchestvo.'" type="text" class="lk__input required">													
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Фамилия
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<input name="on_resume_familia" id="on_resume_familia" type="text" value="'.$on_resume_familia.'" class="lk__input required" placeholder="Введите Вашу фамилию">													
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Дата рождения
												</label>
											</div>
											<div class="col-sm-4 col-xs-12">
												<div class="lk__flex">
													<input name="on_resume_dataday" id="on_resume_dataday" placeholder="Дата рождения" value="'.$on_resume_dataday.'" type="text" class="lk__input lk__input_min datepicker required">
												</div>													
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Фото
												</label>
											</div>
											<div class="col-sm-2 col-xs-12">
												<div class="lk__file">
													<a href="#" class="btn btn_blue">Загрузить</a>
													<input name="on_resume_photo" id="on_resume_photo" type="file" accept="image/jpeg,image/png,image/gif" class="lk__file-input file__in">
													<span class="file__output"></span>
												</div>													
											</div>
													<div class="col-sm-6 col-xs-12">
														<label style="font-size: 12px;">
															Разрешенные форматы: JPG, PNG, GIF. (Макс.размер файла: 8Mb.)
														</label>												
													</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Страна проживания
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<select name="on_resume_land" data-country="'.$on_resume_land.'" class="lk__select on-strana-tool">
													<option value="0">Выберете страну</option>
												</select>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Город проживания
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<input name="on_resume_city" id="on_resume_city" type="text" value="'.$on_resume_city.'" class="lk__input on-city-tool" placeholder="Введите город проживания">
												<div class="city_tooltype_text" ><select class="fongors" size="50"></select></div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Гражданство
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<input name="on_resume_grajdanstvo" id="on_resume_grajdanstvo" type="text" value="'.get_post_meta($_GET['edit'],'on_resume_grajdanstvo',true).'" class="lk__input" placeholder="Введите Ваше гражданство">
											</div>
										</div>

									</div>
					
									<div class="lk__form-in">
										<div class="lk__title">Желаемая работа</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Опыт работы
												</label>
											</div>
											<div class="col-sm-4 col-xs-6">
												<span class="lk__check">
													<input type="radio" name="stage" class="lk__checkbox opit-on" value="1">
													Есть 
												</span>
											</div>
											<div class="col-sm-4 col-xs-6">
												<span class="lk__check">
													<input type="radio" checked name="stage" class="lk__checkbox opit-off" value="2">
													Нет
												</span>
											</div>
										</div>

										<div style="display: none;" class="row list-opit">
											<div class="col-sm-4 col-xs-12">
											</div>
											<div class="col-sm-8 col-xs-12">
												<select name="on_resume_opit" class="lk__select">
													'.$print_list_opit.'
												</select>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Название должности
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<input name="on_resume_rang" type="text"  placeholder="Введите название должности" value="'.$on_resume_jelanie_rang.'" class="lk__input required">													
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Желаемую ЗП
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<div class="row">
													<div class="col-sm-4 col-xs-6">
														<div class="lk__flex">
															<span>От</span>					
															<input name="on_resume_zp_ot" type="text" value="'.$on_resume_jelanie_zp_ot.'" class="lk__input">	
														</div>
													</div>
													<div class="col-sm-4 col-xs-6">
														<div class="lk__flex">
															<span>До</span>
															<input name="on_resume_zp_do" type="text" value="'.$on_resume_jelanie_zp_do.'" class="lk__input">	
														</div>
													</div>
													<div class="col-sm-4 col-xs-6">
														<div class="lk__flex">
															<span>Валюта</span>
															<select name="on_resume_valute" class="lk__select">
																<option value="руб">руб</option>
																<option value="$">$</option>
																<option value="евро">евро</option>
															</select>
														</div>
													</div>
												</div>
											</div>					
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Профессиональная область
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												'.$print_key_prof_obl.'
											</div>
										</div>

									</div>

									<div class="lk__form-in">
										<div class="lk__title">Образование</div>
								'.$print_obrazov_block_list.'
										<div class="row">
											<div class="col-sm-8 col-sm-offset-4 col-xs-12">
												<a class="btn btn_resume-new btn_blue addobrazov">Добавить еще одно заведение</a>
											</div>
										</div>
								'.$print_kursi_block_list.'
										<div class="row">
											<div class="col-sm-8 col-sm-offset-4 col-xs-12">
												<a class="btn btn_resume-new btn_blue addkursbut">Добавить еще курс</a>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-8 col-sm-offset-4 col-xs-12">
												<div class="lk__title lk__title_sep">Владение языками</div>
											</div>
										</div>
							'.$print_lang_block_list.'
										<div class="row">
											<div class="col-sm-8 col-sm-offset-4 col-xs-12">
												<a class="btn btn_resume-new btn_blue addlang">Добавить еще язык</a>
											</div>
										</div>

									</div>

									<div class="lk__form-in">
										<div class="lk__title">Дополнительная информация</div>
										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Занятость</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<select name="on_resume_zanyatost" class="lk__select">
													'.$print_zanyatost.'
												</select>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Тип работы</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<select name="on_resume_typework" class="lk__select">
													'.$print_worktype_list.'
												</select>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Облако навыков</label>
											</div>
											<div class="col-md-8 col-sm-6 col-xs-12">
												'.$print_key_navik.'
											</div>
										</div>
								<!--
										<div class="row">
											<div class="col-sm-8 col-sm-offset-4 col-xs-12">
												<a href="#" class="btn btn_resume-new btn_blue">Добавить еще навык</a>
											</div>
										</div>
								-->
									</div>
									';
		// Блок КЛОН - ПОРТФОЛИО
				if (!empty($_GET['edit'])) {
					global $post; 
					$portfolio_list_args = array(
										   'post_type' => 'portfolio',
										   'numberposts' => -1,
										   'author' => get_current_user_id(),
										   'post_status' => 'any',
										   'meta_key'    => 'on_portfolio_id_resume',
										   'meta_value'  => $_GET['edit'],
										);
					$portfolio_list = get_posts( $portfolio_list_args );
					foreach( $portfolio_list as $post ){ setup_postdata($post);
						$portfolio_title[]= $post->post_title;
						$portfolio_year[]= get_post_meta($post->ID,'on_portfolio_data',true);
						$portfolio_navik[]= explode(', ',get_post_meta($post->ID,'on_portfolio_naviki',true));
						$portfolio_opis[]= $post->post_content;
					}
					wp_reset_postdata();
					$count_portfolio_block=count($portfolio_list)-1;
				} else { $count_portfolio_block=0; }
				
				echo'<input type="hidden" name="count_portfolio_block" id="count_portfolio_block" value="'.$count_portfolio_block.'">
										<div id="addportfolio-block">';
				print "+++++"; print_r($portfolio_navik);
				for ($i = 0; $i <= $count_portfolio_block; $i++) {
										
					$print_list_years_port=str_replace('selected','',$print_list_years_port); // Обнуляем selected	
					$print_list_years_port=str_replace('<option value="'.$portfolio_year[$i].'">', '<option selected value="'.$portfolio_year[$i].'">', $print_list_years_port);
					
					$print_key_navik_port='';
					//Формируем заголовки - для портфолио
					foreach ($tagsListArray as $key => $value) {
						if (!empty($_GET['edit'])) { if (array_search($tagsListArray[$key]['name'], $portfolio_navik[$i])) { $checked='checked'; } else {$checked='';}  }
						$print_key_navik_port.= '<label class="lk__check" style="display: inline-block;" for="check2'.$key.$i.'"><input '.$checked.' type="checkbox" class="lk__checkbox" name="infor[\'portfolio\'][0][\'on_key_naviki_port\']['.$tagsListArray[$key]['name'].']" val="" rel="'.$value['name'].'" id="check2'.$key.$i.'"><span>'.$value['name'].'</span></label>';
					}
				
				echo '			
								<div class="portfolio-block-1">
									<div class="lk__form-in">
										<div class="lk__title">Портфолио</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Название проекта</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<input name="infor[\'portfolio\'][0][\'name\']" value="'.$portfolio_title[$i].'" type="text" class="lk__input" placeholder="Ведите название проекта">
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for=""> Год выполнения</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<div class="row">
													<div class="col-sm-5 col-xs-12">
														<select name="infor[\'portfolio\'][0][\'year\']" class="lk__select">
															'.$print_list_years_port.'
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Фото
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<div class="row">
													<div class="col-sm-3 col-xs-12">
														<div class="lk__file lk__file_toggle">
															<a href="#" class="btn btn_blue">Загрузить</a>
															<input  name="infor[\'portfolio\'][0][\'img\']" type="file" accept="image/jpeg,image/png,image/gif" class="lk__file-input file__in">
															<span class="file__output"></span>
														</div>		
													</div>
													<div class="col-sm-5 col-xs-12">
														<label style="font-size: 12px;">
															Разрешенные форматы: JPG, PNG, GIF. (Макс.размер файла: 8Mb.)
														</label>												
													</div>

												</div>																							
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Облако навыков</label>
											</div>
											<div class="col-md-8 col-sm-6 col-xs-12">
												'.$print_key_navik_port.'
											</div>
										</div>
									<!--
										<div class="row">
											<div class="col-sm-8 col-sm-offset-4 col-xs-12">
												<a href="#" class="btn btn_resume-new btn_blue">Добавить еще навык</a>
											</div>
										</div>
									-->
										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Описание проекта
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">';
											wp_editor($portfolio_opis[$i], 'on_res_potfolio_content_'.$i, array(
														'wpautop'       => 1,
														'media_buttons' => 1,
														'textarea_name' => 'infor[\'portfolio\']['.$i.'][\'opis\']', //нужно указывать!
														'textarea_rows' => 20,
														'tabindex'      => null,
														'editor_css'    => '<style> .wp-editor-wrap input, .wp-editor-wrap button, .wp-editor-wrap textarea, .wp-editor-wrap select { width: auto; }</style>',
														'editor_class'  => '',
														'teeny'         => 1,
														'dfw'           => 0,
														'tinymce'       => 1,
														'quicktags'     => array( 'bold', 'italic', 'strikethrough', 'bullist', 'numlist', 'blockquote', 'hr', 'alignleft', 'aligncenter', 'alignright', 'wp_more', 'spellchecker' ),
														'drag_drop_upload' => false
													) );	
													// $mce_buttons = ;
				echo '						</div>
										</div>
										<!--
										<div class="row">
											<div class="col-sm-8 col-sm-offset-4 col-xs-12">
												<a href="#" class="btn btn_resume-new btn_blue">Дабавить еше портфолио</a>
											</div>
										</div>
										-->
									</div>
								</div>';
				}				
				$yer = (int)date('Y') - 19;
				echo '		</div>
											<div class="text-right">
												<a class="btn btn_resume-new btn_blue addportfolio">Дабавить еше портфолио</a>
											</div>	
											<div class="text-right">
												<input id="on-button-submit" type="button" value="'.$text_buttom.'" class="lk__submit lk__submit_big">
											</div>	
								</form>
							</div>
							<script type="text/javascript">
								jQuery(document).ready(function($){
									\'use strict\';
									// настройки по умолчанию. Их можно добавить в имеющийся js файл, 
									// если datepicker будет использоваться повсеместно на проекте и предполагается запускать его с разными настройками

									// Инициализация
									$.datepicker.setDefaults({
										dateFormat: \'dd.mm.yy\',
										minDate: \'01.01.1950\',
										maxDate: \'31.12.'.$yer.'\',
										firstDay: 0,
										dayNamesMin: [\'Вс\',\'Пн\',\'Вт\',\'Ср\',\'Чт\',\'Пт\',\'Сб\'],
										monthNames: [\'Январь\',\'Февраль\',\'Март\',\'Апрель\',\'Май\',\'Июнь\',\'Июль\',\'Август\',\'Сентябрь\',\'Октябрь\',\'Ноябрь\',\'Декабрь\'],
										monthNamesShort: [\'Январь\',\'Февраль\',\'Март\',\'Апрель\',\'Май\',\'Июнь\',\'Июль\',\'Август\',\'Сентябрь\',\'Октябрь\',\'Ноябрь\',\'Декабрь\'],
										changeYear: true,
										yearRange: \'1940:'.$yer.'\'
										
								   });       
								});
								</script>
				';
	}
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_resume_form', 'func_on_resume_form' );

















// СТРАНИЦА ВАКАНСИЙ

function func_on_vacancy_form($atts)
{ 
	if (is_user_logged_in()) {
	
		if ($_GET['add']=='company') {
			// Получение формы компании
			if ($_GET['action']=='add') {
				if($_SERVER["REQUEST_METHOD"]=="POST"){
					
					$on_block_time = get_option('on_form_time_block');
					$on_block_time2 = $on_block_time + 3;   // можно поставить 2 секунды
					$on_date_now = date('U');
					if ($on_block_time2 > $on_date_now ) { $on_block_time_yes='yes'; } else { update_option( 'on_form_time_block', $on_date_now ); }
					
					if ( empty($_POST) || !wp_verify_nonce($_POST['_wp_nonce_company'],'on_send_company_x') or $on_block_time_yes=='yes' )
					{
					   $print_status = "<div class='wpcf7-validation-errors'><center>ОШИБКА! ВЫ СПАМЕР!</center></div>";
					}
					else
					{   // Обработка фаормы
						if( empty($_POST['on_company_name']) or empty($_POST['on_company_email']) ) {
							$print_status = "<div class='wpcf7-validation-errors'><center>Некоторые поля пустые, проверьте форму подачи вакансии еще раз и повторите отправку.</center></div>";
							$error = 'yes';
						} else {
							$_GET['edit'] = preg_replace('/[^0-9]/', '', $_GET['edit']);
							if(empty($_GET['edit'])) {
								// Ошибок нет, обрабатываем Компанию. 
								$new_resume = array(
									'post_type'    => 'company',
									'post_title'    => $_POST['on_company_name'],
									'post_content'    => $_POST['on_company_opis'],
									'post_status'   => 'pending' // опубликованный пост
								);
								
								// добавляем пост и получаем его ID 
								$new_resume_id = wp_insert_post( $new_resume );
								
								update_post_meta($new_resume_id, 'on_company_imya', $_POST['on_company_imya']);
								update_post_meta($new_resume_id, 'on_company_familia', $_POST['on_company_familia']);
								update_post_meta($new_resume_id, 'on_company_otchestvo', $_POST['on_company_otchestvo']);
								update_post_meta($new_resume_id, 'on_company_phone', $_POST['on_company_phone']);
								update_post_meta($new_resume_id, 'on_company_email', $_POST['on_company_email']);
								update_post_meta($new_resume_id, 'on_company_website', $_POST['on_company_website']);
								update_post_meta($new_resume_id, 'on_company_kolvo_sotrud', $_POST['on_company_kolvo_sotrud']);
								update_post_meta($new_resume_id, 'on_company_password', $_POST['on_company_password']);
								update_post_meta($new_resume_id, 'on_company_rang_input', $_POST['on_company_rang_input']);
								update_post_meta($new_resume_id, 'on_company_city', $_POST['on_company_city']);
								update_post_meta($new_resume_id, 'on_company_land', $_POST['on_company_land']);
								
								// загрузка LOGOтипа
								if (!empty($_FILES['on_company_logo'])) {
										if ( ! function_exists( 'wp_handle_upload' ) ) 
											require_once( ABSPATH . 'wp-admin/includes/image.php' );
											require_once( ABSPATH . 'wp-admin/includes/file.php' );
											require_once( ABSPATH . 'wp-admin/includes/media.php' );
									//	$file = $_FILES['on_company_logo'];
										$movefile = media_handle_upload( 'on_company_logo', $new_resume_id ); // Вместо 0 ставим ID POSTA

										if ( is_wp_error( $movefile ) ) {
											$status_file = "Ошибка загрузки медиафайла.";
										} else {
											$status_file = "Медиафайл был успешно загружен! =".$movefile."= ";
											set_post_thumbnail( $new_resume_id, $movefile );
										}
										$status_file.= " = OK = ";
								} else { $status_file = 'ФАЙЛА НЕТ!'; }
								$url_redir = get_permalink().'?add=vacancy&comp='.$new_resume_id;
								$print_status = "<div class='wpcf7-mail-sent-ok'><center><br> Компания создана. <br><br><a href='".$url_redir."'>Создать вакансию</a><br></center></div> <meta http-equiv=\"refresh\" content=\"0; URL='".$url_redir."'\" />";
								// wp_redirect( $url_redir, 301  ); exit;
							} else {
								// Обновляем компанию
								
								$my_post['ID'] = $_GET['edit'];
								$my_post['post_title'] = $_POST['on_company_name'];
								$my_post['post_content'] = $_POST['on_company_opis'];
								wp_update_post( $my_post ); // Обновляем данные в БД
								
								update_post_meta($_GET['edit'], 'on_company_imya', $_POST['on_company_imya']);
								update_post_meta($_GET['edit'], 'on_company_familia', $_POST['on_company_familia']);
								update_post_meta($_GET['edit'], 'on_company_otchestvo', $_POST['on_company_otchestvo']);
								update_post_meta($_GET['edit'], 'on_company_phone', $_POST['on_company_phone']);
								update_post_meta($_GET['edit'], 'on_company_email', $_POST['on_company_email']);
								update_post_meta($_GET['edit'], 'on_company_website', $_POST['on_company_website']);
								update_post_meta($_GET['edit'], 'on_company_kolvo_sotrud', $_POST['on_company_kolvo_sotrud']);
								update_post_meta($_GET['edit'], 'on_company_password', $_POST['on_company_password']);
								update_post_meta($_GET['edit'], 'on_company_rang_input', $_POST['on_company_rang_input']);
								update_post_meta($_GET['edit'], 'on_company_city', $_POST['on_company_city']);
								update_post_meta($_GET['edit'], 'on_company_land', $_POST['on_company_land']);
								
								// загрузка LOGOтипа
								if (!empty($_FILES['on_company_logo'])) {
										if ( ! function_exists( 'wp_handle_upload' ) ) 
											require_once( ABSPATH . 'wp-admin/includes/image.php' );
											require_once( ABSPATH . 'wp-admin/includes/file.php' );
											require_once( ABSPATH . 'wp-admin/includes/media.php' );
									//	$file = $_FILES['on_company_logo'];
										$movefile = media_handle_upload( 'on_company_logo', $_GET['edit'] ); // Вместо 0 ставим ID POSTA

										if ( is_wp_error( $movefile ) ) {
											$status_file = "Ошибка загрузки медиафайла.";
										} else {
											$status_file = "Медиафайл был успешно загружен! =".$movefile."= ";
											set_post_thumbnail( $_GET['edit'], $movefile );
										}
										$status_file.= " = OK = ";
								} else { $status_file = 'ФАЙЛА НЕТ!'; }
								
								$print_status = "<div class='wpcf7-mail-sent-ok'><center> Компанию обновили. </center></div>";								
							}
							
						}
					}
					$result='<div class="article__body">'.$print_status.'</div>';
				}
			} else {
				$_GET['edit'] = preg_replace('/[^0-9]/', '', $_GET['edit']);
				if(!empty($_GET['edit'])) {
					$my_company = get_post( $_GET['edit'] );
					$company_title = $my_company->post_title;
					$company_imya = get_post_meta ($_GET['edit'],'on_company_imya',true);
					$company_familia = get_post_meta ($_GET['edit'],'on_company_familia',true);
					$company_otchest = get_post_meta ($_GET['edit'],'on_company_otchestvo',true);
					$company_phone = get_post_meta ($_GET['edit'],'on_company_phone',true);
					$company_email = get_post_meta ($_GET['edit'],'on_company_email',true);
					$company_web = get_post_meta ($_GET['edit'],'on_company_website',true);
					$company_kolvo_sotr = get_post_meta ($_GET['edit'],'on_company_kolvo_sotrud',true);
					$company_city = get_post_meta ($_GET['edit'],'on_company_city',true);
					$company_prof = get_post_meta ($_GET['edit'],'on_company_prof_obl',true);
					$company_pass = get_post_meta ($_GET['edit'],'on_company_password',true);
					$on_company_land = get_post_meta ($_GET['edit'],'on_company_land',true);
					$on_company_rang_input = get_post_meta ($_GET['edit'],'on_company_rang_input',true);
					$text_buttom = 'Обновить компанию';
					$text_header = 'Редактирование компании';
					$update_url="&edit=".$_GET['edit'];
				} else {
					$text_buttom = 'Создать компанию';
					$text_header = 'Добавление компании';
				}
			// Форма создания компании
				$result='		<div class="back">
									<a href="#" onclick="javascript:history.back(); return false;" class="btn btn_blue btn_ico btn_back"><div class="btn__ico btn__ico_back"></div> <span>Назад</span></a>
									<span class="back__strong">'.$text_header.'</span>
								</div>
								<div class="notice">
									Для того чтоб создать вакансию вам надо сперва создать компанию
								</div>';
				$result.='<div class="lk">
									<div>
										<form action="?add=company&action=add'.$update_url.'" method="POST" class="resume__form" id="on-form-submit" enctype="multipart/form-data">
										<input type="hidden" name="action" value="on_send_company">
										'.wp_nonce_field( 'on_send_company_x', '_wp_nonce_company', true, false ).'
											<div class="lk__form-in">
												<div class="lk__title">Основные данные о компании</div>
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															Имя
														</label>
													</div>
													<div class="col-sm-8 col-xs-12">
														<input type="text" placeholder="Введите Ваше имя" name="on_company_imya" id="on_company_imya" class="lk__input" value="'.$company_imya.'">
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															Отчество
														</label>
													</div>
													<div class="col-sm-8 col-xs-12">
														<input type="text" placeholder="Введите Ваше отчество" name="on_company_otchestvo" id="on_company_otchestvo" class="lk__input" value="'.$company_otchest.'">
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															Фамилия
														</label>
													</div>
													<div class="col-sm-8 col-xs-12">
														<input type="text" name="on_company_familia" id="on_company_familia" class="lk__input" placeholder="Введите Вашу Фамилию" value="'.$company_familia.'">
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															Телефон
														</label>
													</div>
													<div class="col-sm-8 col-xs-12">
														<input  placeholder="Введите Ваш номер телефона" type="tel" name="on_company_phone" id="on_company_phone" class="lk__input" value="'.$company_phone.'">
													</div>
												</div>
												
													<div class="row">
														<div class="col-sm-4 col-xs-12">
															<label for="">
																Страна
															</label>
														</div>
														<div class="col-sm-8 col-xs-12">
															<select name="on_company_land" data-country="'.$on_company_land.'" class="lk__select on-strana-tool">
																<option value="0">Выберете страну</option>
															</select>
														</div>
													</div>
													
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															Город головного офиса
														</label>
													</div>
													<div class="col-sm-8 col-xs-12">
														<input  placeholder="Введите город" name="on_company_city" type="text" class="lk__input on-city-tool" value="'.$company_city.'">
														<div class="city_tooltype_text" ><select class="fongors" size="50"></select></div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															E-mail*
														</label>
													</div>
													<div class="col-sm-8 col-xs-12">
														<input placeholder="Введите Email" type="email" name="on_company_email" id="on_company_email" class="lk__input required" value="'.$company_email.'">
													</div>
												</div>											
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															Пароль
														</label>
													</div>
													<div class="col-sm-8 col-xs-12">
														<input type="password" placeholder="Введите пароль" name="on_company_password" id="on_company_password" class="lk__input">
													</div>
												</div>
											</div>

											<div class="lk__form-in">
												<div class="lk__title">Информация о компании</div>
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															Логотип
														</label>
													</div>
													<div class="col-sm-2 col-xs-12">
														<div class="lk__file">
															<a href="#" class="btn btn_blue">Загрузить</a>
															<input type="file" name="on_company_logo" id="on_company_logo" accept="image/jpeg,image/png,image/gif" class="lk__file-input file__in">
															<span class="file__output"></span>
														</div>												
													</div>
													<div class="col-sm-6 col-xs-12">
														<label style="font-size: 12px;">
															Разрешенные форматы: JPG, PNG, GIF. (Макс.размер файла: 8Mb.)
														</label>												
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															Название
														</label>
													</div>
													<div class="col-sm-8 col-xs-12">
														<input placeholder="Введите название" type="text" name="on_company_name" id="on_company_name" class="lk__input required" value="'.$company_title.'">
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															Профессиональная область
														</label>
													</div>
													<div class="col-sm-8 col-xs-12">
														<textarea placeholder="Короткое описание" name="on_company_opis" id="on_company_opis" class="lk__textarea"></textarea>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															Веб-сайт
														</label>
													</div>
													<div class="col-sm-8 col-xs-12">
														<input type="text" placeholder="Введите Веб-сайт компании"  name="on_company_website" id="on_company_website" class="lk__input required" value="'.$company_web.'">
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															Количество сотрудинков
														</label>
													</div>
													<div class="col-sm-8 col-xs-12">
														<input type="text" name="on_company_kolvo_sotrud" id="on_company_kolvo_sotrud" class="lk__input" placeholder="100" value="'.$company_kolvo_sotr.'">
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4 col-xs-12">
														<label for="">
															Ваша должность
														</label>
													</div>
													<div class="col-sm-8 col-xs-12">
														<input type="text" placeholder="Введите Вашу должность"  name="on_company_rang_input" id="on_company_rang_input" class="lk__input required" value="'.$on_company_rang_input.'">
													</div>
												</div>											
											</div>


											<div class="text-right">
												<input id="on-button-submit" type="button" value="'.$text_buttom.'" class="lk__submit lk__submit_big">
											</div>						
										</form>
									</div>

								</div>
								<!--/lk-->
								<script type="text/javascript">
								   jQuery(function($){
								   $("#on_company_phone").mask("+9 (999) 999 99 99");
								   });
								</script>';
			}	
		} elseif ($_GET['add']=='vacancy') {
			// Получение формы компании
			if ($_GET['action']=='add') {
				if($_SERVER["REQUEST_METHOD"]=="POST"){
					
					$on_block_time = get_option('on_form_time_block');
					$on_block_time2 = $on_block_time + 3;  // можно поставить 2 секунды
					$on_date_now = date('U');
					if ($on_block_time2 > $on_date_now ) { $on_block_time_yes='yes'; } else { update_option( 'on_form_time_block', $on_date_now ); }
					
					if ( empty($_POST) || !wp_verify_nonce($_POST['_wp_nonce_company'],'on_send_company_x') or $on_block_time_yes=='yes' )
					{
					   $print_status = "<div class='wpcf7-validation-errors'><center>ОШИБКА! ВЫ СПАМЕР!</center></div>";
					}
					else
					{   // Обработка фаормы
						if( empty($_POST['on_vacancy_name']) or empty($_POST['on_vacancy_id_company']) ) {
							$print_status = "<div class='wpcf7-validation-errors'><center>Некоторые поля пустые, проверьте форму подачи вакансии еще раз и повторите отправку.</center></div>";
							$error = 'yes';
						} else {
							$_GET['edit'] = preg_replace('/[^0-9]/', '', $_GET['edit']);
							if(empty($_GET['edit'])) {
								// Ошибок нет, обрабатываем Компанию. 
								$new_resume = array(
									'post_type'    => 'vacancies',
									'post_title'    => $_POST['on_vacancy_name'],
									'post_content'    => $_POST['on_vacancy_opis'],
							//		'post_excerpt'    => $_POST['on_vacancy_excerpt'],
									'post_status'   => 'pending' // опубликованный пост
								);
								
								// добавляем пост и получаем его ID 
								$new_resume_id = wp_insert_post( $new_resume );
								
								update_post_meta($new_resume_id, 'on_vacancy_zp_ot', $_POST['on_vacancy_zp_ot']);
								update_post_meta($new_resume_id, 'on_vacancy_zp_do', $_POST['on_vacancy_zp_do']);
								update_post_meta($new_resume_id, 'on_vacancy_valuta', $_POST['on_vacancy_valuta']);
								update_post_meta($new_resume_id, 'on_vacancy_id_company', $_POST['on_vacancy_id_company']);
								
								foreach ( $_POST['on_vacancy_prof_deyat'] as $key_navik => $value_navik) {
												if ($print_on_key_prof_obl) {$zpt=', ';}
												$print_on_key_prof_obl.=$zpt.$key_navik;
								}
								update_post_meta($new_resume_id, 'on_vacancy_prof_deyat', $print_on_key_prof_obl);
								update_post_meta($new_resume_id, 'on_vacancy_opit', $_POST['on_opit']);
								update_post_meta($new_resume_id, 'on_vacancy_obrazovalie', $_POST['on_obrazovaie']);
								update_post_meta($new_resume_id, 'on_vacancy_zanyatost', $_POST['on_zanyatost']);
								update_post_meta($new_resume_id, 'on_vacancy_typework', $_POST['on_typework']);
								update_post_meta($new_resume_id, 'on_vacancy_city', $_POST['on_city']);
								update_post_meta($new_resume_id, 'on_vacancy_land', $_POST['on_vacancy_land']);
								
								wp_set_post_terms( $new_resume_id, $_POST['on_obrazovaie'], 'obrazovaie' );
								wp_set_post_terms( $new_resume_id, $_POST['on_typework'], 'typework' );
								wp_set_post_terms( $new_resume_id, $_POST['on_opit'], 'opit' );
								wp_set_post_terms( $new_resume_id, $_POST['on_zanyatost'], 'zanyatost' );
								wp_set_post_terms( $new_resume_id, $_POST['on_city'], 'city' );
								
								update_post_meta($new_resume_id, 'on_date_add', date("U"));
								
							//	$url_redir = get_permalink().'?add=vacancy&comp='.$new_resume_id;
								$print_status = "<div class='wpcf7-mail-sent-ok'><center> Вакансия создана. <br><br><a href='".get_permalink($new_resume_id)."'>Посмотреть</a> | <a href='".get_permalink('403')."?add=vacancy'>Разместить другую вакансию</a><br></center></div>";
							} else {
								//Обновляем вакансию
								$my_post['ID'] = $_GET['edit'];
								$my_post['post_title'] = $_POST['on_vacancy_name'];
								$my_post['post_content'] = $_POST['on_vacancy_opis'];
								wp_update_post( $my_post ); // Обновляем данные в БД
								
								update_post_meta($_GET['edit'], 'on_vacancy_zp_ot', $_POST['on_vacancy_zp_ot']);
								update_post_meta($_GET['edit'], 'on_vacancy_zp_do', $_POST['on_vacancy_zp_do']);
								update_post_meta($_GET['edit'], 'on_vacancy_valuta', $_POST['on_vacancy_valuta']);
								update_post_meta($_GET['edit'], 'on_vacancy_id_company', $_POST['on_vacancy_id_company']);
								
								foreach ( $_POST['on_vacancy_prof_deyat'] as $key_navik => $value_navik) {
												if ($print_on_key_prof_obl) {$zpt=', ';}
												$print_on_key_prof_obl.=$zpt.$key_navik;
								}
								update_post_meta($_GET['edit'], 'on_vacancy_prof_deyat', $print_on_key_prof_obl);
								update_post_meta($_GET['edit'], 'on_vacancy_opit', $_POST['on_opit']);
								update_post_meta($_GET['edit'], 'on_vacancy_obrazovalie', $_POST['on_obrazovaie']);
								update_post_meta($_GET['edit'], 'on_vacancy_zanyatost', $_POST['on_zanyatost']);
								update_post_meta($_GET['edit'], 'on_vacancy_typework', $_POST['on_typework']);
								update_post_meta($_GET['edit'], 'on_vacancy_city', $_POST['on_city']);
								update_post_meta($_GET['edit'], 'on_vacancy_land', $_POST['on_vacancy_land']);
								
								update_post_meta($_GET['edit'], 'on_date_add', date("U"));
								
								$print_status = "<div class='wpcf7-mail-sent-ok'><center> Вакансия обновлена. </center></div>";
							}
						}
					}
					$result='<div class="article__body">'.$print_status.'</div>';
				}
			} else {
				
				// Делаем проверку есть ли у пользователя компании (если нет. отправляем его на создание компании)
				global $post; 
				$company_list_args = array(
									   'post_type' => 'company',
									   'numberposts' => -1,
									   'author' => get_current_user_id(),
									   'post_status' => 'any'
								    );
				$company_list = get_posts( $company_list_args );
				foreach( $company_list as $post ){ setup_postdata($post);
							if(!empty($_GET['edit'])) { $on_vacancy_id_company = get_post_meta ($_GET['edit'],'on_vacancy_id_company',true); }
							if ( $post->ID==$_GET['comp'] or count($company_list)==1 or $post->ID==$on_vacancy_id_company ) { $print_selected_company = 'selected'; } else { $print_selected_company = ''; }
							$print_company_list.='<option '.$print_selected_company.' value="'.$post->ID.'">'.$post->post_title.'</option>'; 
				}
				wp_reset_postdata();
				
				// Если нет компаний то отправляем сразу на создание компании
				if (count($company_list)>0) {  
					
					// Если открыта страница редавтирования
					$_GET['edit'] = preg_replace('/[^0-9]/', '', $_GET['edit']);
					if(!empty($_GET['edit'])) {
						$my_company = get_post( $_GET['edit'] );
						$on_vacancy_title = $my_company->post_title;
						$on_vacancy_opis = $my_company->post_content;
						
						$on_vacancy_zp_ot = get_post_meta ($_GET['edit'],'on_vacancy_zp_ot',true);
						$on_vacancy_zp_do = get_post_meta ($_GET['edit'],'on_vacancy_zp_do',true);
						$on_vacancy_valuta = get_post_meta ($_GET['edit'],'on_vacancy_valuta',true);
						
						$on_vacancy_prof_deyat = get_post_meta ($_GET['edit'],'on_vacancy_prof_deyat',true);
						$on_vacancy_opit = get_post_meta ($_GET['edit'],'on_vacancy_opit',true);
						$on_vacancy_obrazovalie = get_post_meta ($_GET['edit'],'on_vacancy_obrazovalie',true);
						$on_vacancy_zanyatost = get_post_meta ($_GET['edit'],'on_vacancy_zanyatost',true);
						$on_vacancy_typework = get_post_meta ($_GET['edit'],'on_vacancy_typework',true);
						$on_vacancy_city = get_post_meta ($_GET['edit'],'on_vacancy_city',true);
						$on_vacancy_land = get_post_meta ($_GET['edit'],'on_vacancy_land',true);
						
						$text_header="Редактирование вакансии";
						$text_bottom="Редактировать вакансию";
						$url_edit="&edit=".$_GET['edit'];
					} else {
						$text_header="Добавление вакансии";
						$text_bottom="Добавить вакансию";
					}
				
					// Форма создания вакансии
					if (empty($_GET['comp'])) { $print_add_company="Выбираем компанию"; } // Форма выбора компании
					
					
					// Опыт работы
					$args = array(
											  'taxonomy'     => 'experience', // название таксономии
											  'orderby'      => 'count',  // сортируем по названиям
											  'order'		 => 'DESC',
											  'show_count'   => 0,       // не показываем количество записей
											  'pad_counts'   => 0,       // не показываем количество записей у родителей
											  'hierarchical' => 0,       // древовидное представление
											  'title_li'     => '',       // список без заголовка
											  'show_option_none'   => 'нет образования',
											  'echo' => 0, // Выводить на экран или созвращать для обработки
											  'hide_empty' => 0,
											  "walker"=>new TagsNewsWalkerIDs()
											);	
					$tagsList5 = wp_list_categories($args);
					// Собираем массив
					$tagsList5 = explode("|", $tagsList5);
					foreach ($tagsList5 as $key5 => $value5) {
						$value5 = explode("=", $value5);
						$tagsListArray5[$key5]['id']=$value5[0];
						$tagsListArray5[$key5]['name']=$value5[1];
						$tagsListArray5[$key5]['slug']=$value5[2];
					}
					//Формируем заголовки
					foreach ($tagsListArray5 as $key5 => $value5) {
						if ($on_vacancy_opit==$value5['name']) { $selected='selected'; } else { $selected='';}
						$print_opit.= '<option '.$selected.' value="'.$value5['name'].'">'.$value5['name'].'</option>';
					}
					
					// Тип работы
					$args = array(
											  'taxonomy'     => 'typework', // название таксономии
											  'orderby'      => 'count',  // сортируем по названиям
											  'order'		 => 'DESC',
											  'show_count'   => 0,       // не показываем количество записей
											  'pad_counts'   => 0,       // не показываем количество записей у родителей
											  'hierarchical' => 0,       // древовидное представление
											  'title_li'     => '',       // список без заголовка
											  'show_option_none'   => 'нет образования',
											  'echo' => 0, // Выводить на экран или созвращать для обработки
											  'hide_empty' => 0,
											  "walker"=>new TagsNewsWalkerIDs()
											);	
					$tagsList4 = wp_list_categories($args);
					// Собираем массив
					$tagsList4 = explode("|", $tagsList4);
					foreach ($tagsList4 as $key4 => $value4) {
						$value4 = explode("=", $value4);
						$tagsListArray4[$key4]['id']=$value4[0];
						$tagsListArray4[$key4]['name']=$value4[1];
						$tagsListArray4[$key4]['slug']=$value4[2];
					}
					//Формируем заголовки
					foreach ($tagsListArray4 as $key4 => $value4) {
						if ($on_vacancy_typework==$value4['name']) { $selected='selected'; } else { $selected='';}
						$print_typework.= '<option '.$selected.' value="'.$value4['name'].'">'.$value4['name'].'</option>';
					}
					
					// Образование
					$args = array(
											  'taxonomy'     => 'obrazovaie', // название таксономии
											  'orderby'      => 'count',  // сортируем по названиям
											  'order'		 => 'DESC',
											  'show_count'   => 0,       // не показываем количество записей
											  'pad_counts'   => 0,       // не показываем количество записей у родителей
											  'hierarchical' => 0,       // древовидное представление
											  'title_li'     => '',       // список без заголовка
											  'show_option_none'   => 'нет образования',
											  'echo' => 0, // Выводить на экран или созвращать для обработки
											  'hide_empty' => 0,
											  "walker"=>new TagsNewsWalkerIDs()
											);	
					$tagsList2 = wp_list_categories($args);
					// Собираем массив
					$tagsList2 = explode("|", $tagsList2);
					foreach ($tagsList2 as $key2 => $value2) {
						$value2 = explode("=", $value2);
						$tagsListArray2[$key2]['id']=$value2[0];
						$tagsListArray2[$key2]['name']=$value2[1];
						$tagsListArray2[$key2]['slug']=$value2[2];
					}
					//Формируем заголовки
					foreach ($tagsListArray2 as $key2 => $value2) {
						if ($on_vacancy_obrazovalie==$value2['name']) { $selected='selected'; } else { $selected='';}
						$print_obrazovaie.= '<option '.$selected.' value="'.$value2['name'].'">'.$value2['name'].'</option>';
					}
					
					// Занятость
					$args = array(
											  'taxonomy'     => 'zanyatost', // название таксономии
											  'orderby'      => 'count',  // сортируем по названиям
											  'order'		 => 'DESC',
											  'show_count'   => 0,       // не показываем количество записей
											  'pad_counts'   => 0,       // не показываем количество записей у родителей
											  'hierarchical' => 0,       // древовидное представление
											  'title_li'     => '',       // список без заголовка
											  'show_option_none'   => 'нет ключевых навыков',
											  'echo' => 0, // Выводить на экран или созвращать для обработки
											  'hide_empty' => 0,
											  "walker"=>new TagsNewsWalkerIDs()
											);	
					$tagsList3 = wp_list_categories($args);
					// Собираем массив
					$tagsList3 = explode("|", $tagsList3);
					foreach ($tagsList3 as $key3 => $value3) {
						$value3 = explode("=", $value3);
						$tagsListArray3[$key3]['id']=$value3[0];
						$tagsListArray3[$key3]['name']=$value3[1];
						$tagsListArray3[$key3]['slug']=$value3[2];
					}
					//Формируем заголовки
					foreach ($tagsListArray3 as $key3 => $value3) {
						if ($on_vacancy_zanyatost==$value3['name']) { $selected='selected'; } else { $selected='';}
						$print_zanyatost.= '<option '.$selected.' value="'.$value3['name'].'">'.$value3['name'].'</option>';
					}
					
					// ВАЛЮТА
					$valute_arr[]='руб';
					$valute_arr[]='$';
					$valute_arr[]='евро';
					foreach ($valute_arr as $valute_value) {
						if ($on_vacancy_valuta==$valute_value) { $selected='selected'; } else { $selected='';}
						$valute_list.='<option '.$selected.' value="'.$valute_value.'">'.$valute_value.'</option>';
					}
					
									
					// Проф.Области
					$categories1 = get_terms( array ('taxonomy' => 'prof-obl-vacan', 'orderby' => 'name', 'hide_empty' => false, 'fields' => 'id=>name', 'count' => false, 'child_of' => '' ));
					// СОбираем области
					foreach ($categories1 as $key_type => $value_type) {
						if (!empty($_GET['edit'])) { if (strpos($on_vacancy_prof_deyat, $value_type) === false) {$checked='';}  else {$checked='checked';}  }
						$print_key_prof_obl.= '<label class="lk__check" style="display: inline-block;" for="check-prof'.$key_type.'"><input '.$checked.' type="checkbox" class="lk__checkbox" name="on_vacancy_prof_deyat['.$value_type.']" val="" rel="'.$value_type.'" id="check-prof'.$key_type.'"><span>'.$value_type.'</span></label>';				
					}
					
					
					echo '<div class="back">
										<a href="#" onclick="javascript:history.back(); return false;" class="btn btn_blue btn_ico btn_back"><div class="btn__ico btn__ico_back"></div> <span>Назад</span></a>
										<span class="back__strong">'.$text_header.'</span>
									</div>';
					echo '<div class="lk">
										<div>
											<form action="?add=vacancy&action=add'.$url_edit.'" method="POST" class="resume__form" id="on-form-submit" enctype="multipart/form-data">
											<input type="hidden" name="action" value="on_send_company">
											'.wp_nonce_field( 'on_send_company_x', '_wp_nonce_company', true, false ).'
												<div class="lk__form-in">
													<div class="lk__title">Основные данные о вакансии</div>
													<div class="row">
														<div class="col-sm-4 col-xs-12">
															<label for="">
																Для компании
															</label>
														</div>
														<div class="col-sm-8 col-xs-12">
															<select name="on_vacancy_id_company" id="on_vacancy_id_company" class="lk__select">
																'.$print_company_list.'	
															</select>
																											
														</div>
													</div>
													<div class="row">
														<div class="col-sm-4 col-xs-12">
															<label for="">
																Название вакансии
															</label>
														</div>
														<div class="col-sm-8 col-xs-12">
															<input placeholder="Введите название" type="text" name="on_vacancy_name" id="on_vacancy_name" value="'.$on_vacancy_title.'" class="lk__input required">													
														</div>
													</div>
													<div class="row">
														<div class="col-sm-4 col-xs-12">
															<label for="">
																Профессиональная деятельность
															</label>
														</div>
														<div class="col-sm-8 col-xs-12">
															'.$print_key_prof_obl.'
														</div>
													</div>
													<div class="row">
														<div class="col-sm-4 col-xs-12">
															<label for="">
																Уровень заработной платы
															</label>
														</div>
														<div class="col-sm-8 col-xs-12">
															<div class="row">
																<div class="col-sm-4 col-xs-6">
																	<div class="lk__flex">
																		<span>От</span>
																		<input name="on_vacancy_zp_ot" id="on_vacancy_zp_ot" type="text" value="'.$on_vacancy_zp_ot.'" class="lk__input required">	
																	</div>
																</div>
																<div class="col-sm-4 col-xs-6">
																	<div class="lk__flex">
																		<span>До</span>
																		<input name="on_vacancy_zp_do" id="on_vacancy_zp_do" type="text" value="'.$on_vacancy_zp_do.'" class="lk__input required">	
																	</div>
																</div>
																<div class="col-sm-4 col-xs-6">
																	<div class="lk__flex">
																		<span>Валюта</span>
																		<select name="on_vacancy_valuta" id="on_vacancy_valuta" class="lk__select">
																			'.$valute_list.'
																		</select>
																	</div>
																</div>
															</div>
														</div>					

													</div>
													<div class="row">
														<div class="col-sm-4 col-xs-12">
															<label for="">
																Опыт работы
															</label>
														</div>
														<div class="col-sm-8 col-xs-12">
															<select name="on_opit" id="on__opit" class="lk__select">
																<option value=""></option>
																'.$print_opit.'
															</select>
														</div>
													</div>

													<div class="row">
														<div class="col-sm-4 col-xs-12">
															<label for="">
																Образование
															</label>
														</div>
														<div class="col-sm-8 col-xs-12">
															<select name="on_obrazovaie" id="on_obrazovaie" class="lk__select">
																<option value=""></option>
																'.$print_obrazovaie.'
															</select>
														</div>
													</div>

													<div class="row">
														<div class="col-sm-4 col-xs-12">
															<label for="">
																Занятость
															</label>
														</div>
														<div class="col-sm-8 col-xs-12">
															<select name="on_zanyatost" id="on_zanyatost" class="lk__select required">
																<option value=""></option>
																'.$print_zanyatost.'
															</select>
														</div>
													</div>

													<div class="row">
														<div class="col-sm-4 col-xs-12">
															<label for="">
																Тип работы
															</label>
														</div>
														<div class="col-sm-8 col-xs-12">
															<select name="on_typework" id="on_typework" class="lk__select">
																<option value=""></option>
																'.$print_typework.'
															</select>
														</div>
													</div>
													
													<div class="row">
														<div class="col-sm-4 col-xs-12">
															<label for="">
																Страна
															</label>
														</div>
														<div class="col-sm-8 col-xs-12">
															<select name="on_vacancy_land" data-country="'.$on_vacancy_land.'" class="lk__select on-strana-tool">
																<option value="0">Выберете страну</option>
															</select>
														</div>
													</div>
													
													<div class="row">
														<div class="col-sm-4 col-xs-12">
															<label for="">
																Город
															</label>
														</div>
														<div class="col-sm-8 col-xs-12">
															<input placeholder="Введите город" name="on_city" id="on_city" value="'.$on_vacancy_city.'" type="text" class="lk__input on-city-tool required">
															<div class="city_tooltype_text" ><select class="fongors" size="50"></select></div>															
														</div>
													</div>
													<div class="row">
														<div class="col-sm-4 col-xs-12">
															<label for="">
																Описание вакансии
															</label>
														</div>
														<div class="col-sm-8 col-xs-12">
															';
														
														wp_editor($on_vacancy_opis, 'on_vacancy_opis', array(
															'wpautop'       => 1,
															'media_buttons' => 1,
															'textarea_name' => 'on_vacancy_opis', //нужно указывать!
															'textarea_rows' => 20,
															'tabindex'      => null,
															'editor_css'    => '<style> .wp-editor-wrap input, .wp-editor-wrap button, .wp-editor-wrap textarea, .wp-editor-wrap select { width: auto; }</style>',
															'editor_class'  => '',
															'teeny'         => 0,
															'dfw'           => 0,
															'tinymce'       => 1,
															'quicktags'     => 1,
															'toolbar1' 		=> implode($mce_buttons, ','),
															'drag_drop_upload' => false
														) );
														$mce_buttons = array( 'bold', 'italic', 'strikethrough', 'bullist', 'numlist', 'blockquote', 'hr', 'alignleft', 'aligncenter', 'alignright', 'wp_more', 'spellchecker' );
														
								echo '							
														</div>
													</div>											
												</div>


												<div class="text-right">
													<input id="on-button-submit" type="button" value="'.$text_bottom.'" class="lk__submit lk__submit_big">
													<!-- <input type="submit" value="'.$text_bottom.'" class="lk__submit lk__submit_big"> -->
												</div>						
											</form>
										</div>

									</div>
									<!--/lk-->';
						$result='';
					
					// ЕСЛИ КОМПАНИЙ НЕТ
					} else {
						$url_redir = get_permalink().'?add=company';
						header('Location: '.$url_redir.'');
						print "<div class='notice'>Для того чтоб создать вакансию вам надо сперва создать компанию</div>";
						print "<meta http-equiv=\"refresh\" content=\"0; URL='".$url_redir."'\" />";
						exit;
					}
				}
				
		} else {
			$url_redir = get_permalink().'?add=vacancy';
			header('Location: '.$url_redir.'');
			$result = "<meta http-equiv=\"refresh\" content=\"0; URL='".$url_redir."'\" />";
			exit;
		}
		

	return $result;
	
	} else { return "<meta http-equiv=\"refresh\" content=\"0; URL='".wp_login_url( get_permalink() )."'\" />"; }
}
// регистрируем шорткод
add_shortcode( 'on_vacancy_form', 'func_on_vacancy_form' );









//Втсавка текста
function on_text_shortcode( $atts, $content = null ) {
	return '
									<div class="block">
										<div class="article">
											<div class="article__body">
												' . $content . '
											</div>
										</div>
									</div>
	';
}
add_shortcode( 'on_text', 'on_text_shortcode' );








// Адрес до темы
function func_on_url_theme($atts)
{
	$result = get_template_directory_uri();
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_url_theme', 'func_on_url_theme' );



function load_on_res_postfolio($file_handler,$post_id,$set_thu=false) {
	// check to make sure its a successful upload
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload( $file_handler, $post_id );

         // If you want to set a featured image frmo your uploads. 
	if ($set_thu) set_post_thumbnail($post_id, $attach_id);
	return $attach_id;
}





//  НОВЫЕ ШОРТКОДЫ    ЛК   ВАКАНСИИ И Т,Д.



// Кнопки Добавить вакансию и резюме (БОЛЬШИЕ)
function func_on_job_buttom($atts)
{
	$result = '				<!--buttons-->
							<div class="job__buttons">
								<div class="job__button"><a href="'.get_permalink('403').'?add=vacancy" class="btn btn_blue btn_big"><span class="btn__ico btn__ico_vac"></span><span>Разместить вакансию</span></a></div>
								<div class="job__button"><a href="'.get_permalink('364').'" class="btn btn_blue btn_big"><span class="btn__ico btn__ico_res"></span><span>Разместить резюме</span></a></div>
							</div>
							<!--/buttons-->';
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_job_buttom', 'func_on_job_buttom' );





// Список обьявления (Вакансий и резюме)
function func_on_my_list_vac_job($atts)
{
	// Список обьявления (Вакансий и резюме)
				global $post; 
				$company_list_args = array(
									   'post_type' => array('vacancies','resume'),
									   'numberposts' => -1,
								//	   'posts_per_page' => -1,
									   'author' => get_current_user_id(),
									   'post_status' => 'any'
								    );
				$company_list = get_posts( $company_list_args );
			if (count($company_list)>0) {	
				foreach( $company_list as $post ){ setup_postdata($post);
				
							// Зарплата
										if ($post->post_type=='resume') {
												$ot =  get_post_meta($post->ID,'on_resume_jelanie_zp_ot',true);
												$do =  get_post_meta($post->ID,'on_resume_jelanie_zp_do',true);
												$valuta =  get_post_meta($post->ID,'on_resume_jelanie_zp_valuta',true);
										}
										if ($post->post_type=='vacancies') {
												$ot =  get_post_meta($post->ID,'on_vacancy_zp_ot',true);
												$do =  get_post_meta($post->ID,'on_vacancy_zp_do',true);
												$valuta =  get_post_meta($post->ID,'on_vacancy_valuta',true);
										}										
												if (!empty($ot)) { $print_price = 'От '.$ot.' '.$valuta.' '; }
												if (!empty($do)) { $print_price.= 'До '.$do.' '.$valuta; }
												if ($ot==$do) { $print_price = $do.' '.$valuta; }
										$print_zp = $print_price;
							
							//Картинка
							if ($post->post_type=='vacancies') { $img_adds = get_the_post_thumbnail_url(get_post_meta($post->ID,'on_vacancy_id_company',true), 'exlusive-post-thumb' ); }
							else { $img_adds = get_the_post_thumbnail_url($post->ID, 'exlusive-post-thumb' ); }
							if ($img_adds=='') {$img_adds=get_template_directory_uri().'/images/vacancy__avatar.png';} //Дефолтная картинка
							
							if ($post->post_type=='vacancies') {$print_icon='job__icon_vacancy';  $edit_url=get_permalink('403').'?add=vacancy&edit='.$post->ID;}
							if ($post->post_type=='resume') { $print_icon='job__icon_resume';  $edit_url=get_permalink('364').'?edit='.$post->ID; }
							$print_adds_list.='
								<div class="job__item">
									<div class="job__item-cell job__item-thumbnail">
										<div class="job__icon '.$print_icon.'"></div>
										<img src="'.$img_adds.'" alt="'.$post->post_title.'">
									</div>
									<div class="job__item-cell job__item-title">
										<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
										<div class="job__item-cost">'.$print_zp.'</div>
									</div>
									<div class="job__item-cell job__item-date">
										<div class="job__item-city">
											'.get_the_term_list( $post->ID, 'city', ' ', ',', '' ).'
										</div>
										'.get_the_date('d F Y', $post->ID ).'
									</div>
								</div>
								<div class="job__edit">
									<a href="'.get_permalink('364').'?delete='.$post->ID.'" class="btn btn_blue btn_ico">
										<span class="btn__ico btn__ico_remove"></span><span>Удалить</span>
									</a>
									<a href="'.$edit_url.'" class="btn btn_blue btn_ico">
										<span class="btn__ico btn__ico_edit"></span><span>Редактировать</span>
									</a>
								</div>'; 
				}
				wp_reset_postdata();
				$result = '	<!--job list-->
							<div class="section__title">Ваши объявления</div>
							<div class="job">
								'.$print_adds_list.'
							</div>
							<!--job list-->';
			}
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_my_list_vac_job', 'func_on_my_list_vac_job' );




// Личный кабинет
function func_on_lk_form($atts)
{
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
					
					if ( empty($_POST) || !wp_verify_nonce($_POST['_wp_nonce_user'],'on_send_user_x') )
					{
					   $print_status = "<div class='wpcf7-validation-errors'><center>ОШИБКА! ВЫ СПАМЕР!</center></div>";
					}
					else
					{   // Обработка фаормы
						if( empty($_POST['on_login']) or empty($_POST['on_user_email']) ) {
							$print_status = "<div class='wpcf7-validation-errors'><center>Некоторые поля пустые, проверьте форму подачи вакансии еще раз и повторите отправку.</center></div>";
							$error = 'yes';
						} else {
							// Обновляем информацию об юзере
							if ( !empty($_POST['on_user_pass']) and !empty($_POST['on_user_pass_2']) ) { 
								if ($_POST['on_user_pass']==$_POST['on_user_pass_2']) { 
									$user_up = wp_update_user( array( 'ID' => get_current_user_id(), 'user_pass' => $_POST['on_user_pass'] ) ); 
									$print_status = "<div class='wpcf7-mail-sent-ok'><center>Пароль изменен</center></div> <meta http-equiv=\"refresh\" content=\"0; URL='".get_permalink()."'\" />"; } 
								else {  $print_status = "<div class='wpcf7-validation-errors'><center>Пароли не совпадают</center></div>"; }  
							}
							if (!empty($_POST['on_display_name'])) {
								$user_info = get_userdata(get_current_user_id());
								if ($_POST['on_display_name']!=$user_info->display_name) {
									$user_up = wp_update_user( array( 'ID' => get_current_user_id(), 'display_name' => $_POST['on_display_name'] ) ); 
									$print_status.= "<div class='wpcf7-mail-sent-ok'><center>Имя обновлено</center></div>"; 
								}
							} 
							if ($print_status=='') { $print_status = "<div class='wpcf7-validation-errors'><center>Ничего не поменялось</center></div>"; }
							
						}
					}
					$result='<div class="article__body">'.$print_status.'</div>';
					print $result;
	}
	
	
	// Список компаний у пользователя
				global $post; 
				$company_list_args = array(
									   'post_type' => 'company',
									   'numberposts' => -1,
									   'author' => get_current_user_id(),
									   'post_status' => 'any'
								    );
				$company_list = get_posts( $company_list_args );
				if (count($company_list)>0) {	
					foreach( $company_list as $post ){ setup_postdata($post);
								if ( $post->ID==$_GET['comp'] or count($company_list)==1 ) { $print_selected_company = 'selected'; } else { $print_selected_company = ''; }
								$print_company_list.='
											<div class="posts__item posts__item_col posts__item_col-three">
												<a href="'.get_permalink('403').'?add=company&edit='.$post->ID.'" class="company__preview"><img src="'.get_the_post_thumbnail_url(get_post_meta($post->ID,'on_vacancy_id_company',true), 'widget-post-thumb' ).'" alt="" class="company__avatar alignleft"><span class="company__title strong">'.$post->post_title.'</span></a>
											</div>'; 
					}
					wp_reset_postdata();
					$list_my_company='          <div class="section__title">Мои компании</div>
									<div class="lk__block">
										<div class="lk__companies">
											'.$print_company_list.'
										</div>
										<div class="text-right">
											<a href="'.get_permalink('403').'?add=company" class="btn btn_blue">Создать компанию</a>
										</div>
									</div>';
				}
				
				
			$user_info = get_userdata(get_current_user_id());
			
			$result = '
							<div class="section__title">
								Личные данные
							</div>
							<div class="lk">
								<div class="lk__form">
									<form action="" method="POST" class="user__form" id="on_send_user_form" enctype="multipart/form-data">
										<input type="hidden" name="action" value="on_send_user">
										'.wp_nonce_field( 'on_send_user_x', '_wp_nonce_user', true, false ).'
										<div class="lk__form-in">
											<div class="row">
												<div class="col-sm-4 col-xs-12">
													<label for="">
														Логин*
													</label>
												</div>
												<div class="col-sm-8 col-xs-12">
													<input type="text" name="on_login" readonly value="'.$user_info->user_login.'" class="lk__input lk__input_prepend">
												</div>
											</div>
											<div class="row">
												<div class="col-sm-4 col-xs-12">
													<label for="">
														Имя
													</label>
												</div>
												<div class="col-sm-8 col-xs-12">
													<input type="text" name="on_display_name" value="'.$user_info->display_name.'" class="lk__input lk__input_prepend">
												</div>
											</div>
											<div class="row">
												<div class="col-sm-4 col-xs-12">
													<label for="">
														E-mail*
													</label>
												</div>
												<div class="col-sm-8 col-xs-12">
													<input type="email" name="on_user_email" readonly value="'.$user_info->user_email.'" class="lk__input lk__input_prepend">
												</div>
											</div>
											<div class="row">
												<div class="col-sm-4 col-xs-12">
													<label for="">
														Сменить пароль
													</label>
												</div>
												<div class="col-sm-8 col-xs-12">
													<input type="password" name="on_user_pass" placeholder="Оставить пустым, если не хотите изменить пароль" class="lk__input lk__input_prepend">
												</div>
											</div>
											<div class="row">
												<div class="col-sm-4 col-xs-12">
													<label for="">
														Повторите пароль
													</label>
												</div>
												<div class="col-sm-8 col-xs-12">
													<input type="password" name="on_user_pass_2" placeholder="Оставить пустым, если не хотите изменить пароль" class="lk__input lk__input_prepend">
												</div>
											</div>
										</div>
										<div class="text-right">
											<input type="submit" value="Обновить" class="lk__submit">
										</div>						
									</form>
								</div>
								'.$list_my_company.'
							</div>
							';
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_lk_form', 'func_on_lk_form' );









// Похожие игры
function func_on_header_widget($atts) {
	if (wp_is_mobile()) {	
		// Мобильная версия
		$result='<div class="nav-image">
							<ul class="nav-image__menu">
								<li><a title="Все новости по PlatStation VR" href="https://vr-j.ru/tag/psvr/"><img src="/wp-content/themes/virtua-theme/images/button1.png" alt=""></a></li>
								<li><a title="Все новости по Oculus" href="https://vr-j.ru/tag/oculus-rift/"><img src="/wp-content/themes/virtua-theme/images/button2.png" alt=""></a></li>
								<li><a title="Все новости по VIVEX" href="https://vr-j.ru/tag/htc-vive/"><img src="/wp-content/themes/virtua-theme/images/button3.png" alt=""></a></li>
								<li><a title="Все новости по Samsung Gear VR" href="https://vr-j.ru/tag/gear-vr/"><img src="/wp-content/themes/virtua-theme/images/button4.png" alt=""></a></li>
							</ul>
						</div>';
	} else {
		// Десктоп версия.
		$result='<div class="nav-image">
							<ul class="nav-image__menu">
								<li><a title="Все новости по PlatStation VR" href="https://vr-j.ru/tag/psvr/"><img src="/wp-content/themes/virtua-theme/images/button1.png" alt=""></a></li>
								<li><a title="Все новости по Oculus" href="https://vr-j.ru/tag/oculus-rift/"><img src="/wp-content/themes/virtua-theme/images/button2.png" alt=""></a></li>
								<li><a title="Все новости по VIVEX" href="https://vr-j.ru/tag/htc-vive/"><img src="/wp-content/themes/virtua-theme/images/button3.png" alt=""></a></li>
								<li><a title="Все новости по Samsung Gear VR" href="https://vr-j.ru/tag/gear-vr/"><img src="/wp-content/themes/virtua-theme/images/button4.png" alt=""></a></li>
							</ul>
						</div>';
	}		
				
	return $result;
}
// регистрируем шорткод
add_shortcode( 'on_header_widget', 'func_on_header_widget' );

?>