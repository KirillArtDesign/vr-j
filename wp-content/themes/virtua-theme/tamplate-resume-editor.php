<?php
/*
Template Name: Шаблон Резюме - EDITOR.MODE
*/
$number = preg_replace('/[^0-9]/', '', $_GET['ids']);
$number_minus = $number-1;

			//Года окончания
				$last_year = date('Y');
				$print_list_years='<option disabled selected value="">Выберите год</option>';
				for ($i = 1; $i <= 15; $i++) {
					$print_list_years.='<option value="'.$last_year.'">'.$last_year.'</option>';
					$last_year=$last_year-1;
				}


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
				
				//Формируем заголовки - для портфолио
				foreach ($tagsListArray as $key => $value) {
					$print_key_navik_port.= '<label  class="label_check" style="display: inline-block;" for="check'.$key.$number_minus.'"><input type="checkbox" name="infor[\'portfolio\']['.$number_minus.'][\'on_key_naviki_port\']['.$tagsListArray[$key]['slug'].']" val="" rel="'.$value['name'].'" id="check'.$key.$number_minus.'"><span>'.$value['name'].'</span></label>';
				}

				
				
echo '							<div class="portfolio-block-'.$number.'">
									<div class="lk__form-in">
										<div class="lk__title">Портфолио</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">Название проекта</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<input name="infor[\'portfolio\']['.$number_minus.'][\'name\']" type="text" class="lk__input" placeholder="Ведите название проекта">
											</div>
										</div>

										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for=""> Год выполнения</label>
											</div>
											<div class="col-sm-8 col-xs-12">
												<div class="row">
													<div class="col-sm-5 col-xs-12">
														<select name="infor[\'portfolio\']['.$number_minus.'][\'year\']" class="lk__select">
															'.$print_list_years.'
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
													<div class="col-sm-7 col-xs-12">
														<div class="lk__file lk__file_toggle">
															<a href="#" class="btn btn_blue">Загрузить</a>
															<input  name="infor[\'portfolio\']['.$number_minus.'][\'img\']" type="file" class="lk__file-input file__in">
															<span class="file__output"></span>
														</div>		
													</div>
													<!--
													<div class="col-sm-5 col-xs-12">
														<span class="lk__check">
															<input type="radio" name="stage" class="lk__checkbox" value="1">
															Сделать обложкой
														</span>
													</div>
													-->
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
										<div class="row">
											<div class="col-sm-4 col-xs-12">
												<label for="">
													Описание проекта
												</label>
											</div>
											<div class="col-sm-8 col-xs-12">';
											wp_editor('', 'on_res_potfolio_content_'.$number, array(
														'wpautop'       => 1,
														'media_buttons' => 1,
														'textarea_name' => 'infor[\'portfolio\']['.$number_minus.'][\'opis\']', //нужно указывать!
														'textarea_rows' => 20,
														'tabindex'      => null,
												//		'editor_css'    => '<style> .wp-editor-wrap input, .wp-editor-wrap button, .wp-editor-wrap textarea, .wp-editor-wrap select { width: auto; }</style>',
														'editor_class'  => '',
														'teeny'         => 1,
														'dfw'           => 0,
														'tinymce'       => 1,
														'quicktags'     => 1,
														'drag_drop_upload' => false
													) );	
			echo '								</div>
										</div>
									</div>
								</div>';
								
								
echo '<script type="text/javascript">
		tinyMCEPreInit = {
			baseURL: "'.get_site_url().'/wp-includes/js/tinymce",
			suffix: ".min",
						mceInit: {\'on_res_potfolio_content_'.$number.'\':{theme:"modern",skin:"lightgray",language:"ru",formats:{alignleft: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"left"}},{selector: "img,table,dl.wp-caption", classes: "alignleft"}],aligncenter: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"center"}},{selector: "img,table,dl.wp-caption", classes: "aligncenter"}],alignright: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"right"}},{selector: "img,table,dl.wp-caption", classes: "alignright"}],strikethrough: {inline: "del"}},relative_urls:false,remove_script_host:false,convert_urls:false,browser_spellcheck:true,fix_list_elements:true,entities:"38,amp,60,lt,62,gt",entity_encoding:"raw",keep_styles:false,cache_suffix:"wp-mce-4603-20170530",resize:"vertical",menubar:false,branding:false,preview_styles:"font-family font-size font-weight font-style text-decoration text-transform",end_container_on_empty_block:true,wpeditimage_html5_captions:true,wp_lang_attr:"ru-RU",wp_shortcut_labels:{"Heading 1":"access1","Heading 2":"access2","Heading 3":"access3","Heading 4":"access4","Heading 5":"access5","Heading 6":"access6","Paragraph":"access7","Blockquote":"accessQ","Underline":"metaU","Strikethrough":"accessD","Bold":"metaB","Italic":"metaI","Code":"accessX","Align center":"accessC","Align right":"accessR","Align left":"accessL","Justify":"accessJ","Cut":"metaX","Copy":"metaC","Paste":"metaV","Select all":"metaA","Undo":"metaZ","Redo":"metaY","Bullet list":"accessU","Numbered list":"accessO","Insert\/edit image":"accessM","Toolbar Toggle":"accessZ","Insert Read More tag":"accessT","Insert Page Break tag":"accessP","Distraction-free writing mode":"accessW","Keyboard Shortcuts":"accessH"},content_css:"https://vr-j.ru/wp-includes/css/dashicons.min.css?ver=4.8,https://vr-j.ru/wp-includes/js/tinymce/skins/wordpress/wp-content.css?ver=4.8",plugins:"charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpautoresize,wpeditimage,wpemoji,wpgallery,wplink,wpdialogs,wptextpattern,wpview",selector:"#on_res_potfolio_content_'.$number.'",wpautop:true,indent:false,toolbar1:"formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,wp_more,spellchecker,fullscreen,wp_adv",toolbar2:"strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",toolbar3:"",toolbar4:"",tabfocus_elements:":prev,:next",body_class:"on_res_potfolio_content_'.$number.' post-type-page post-status-publish page-template-tamplate-lk locale-ru-ru"}},
			qtInit: {\'on_res_potfolio_content_'.$number.'\':{id:"on_res_potfolio_content_'.$number.'",buttons:"strong,em,link,block,del,ins,img,ul,ol,li,code,more,close"}},
			ref: {plugins:"charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpautoresize,wpeditimage,wpemoji,wpgallery,wplink,wpdialogs,wptextpattern,wpview",theme:"modern",language:"ru"},
			load_ext: function(url,lang){var sl=tinymce.ScriptLoader;sl.markDone(url+\'/langs/\'+lang+\'.js\');sl.markDone(url+\'/langs/\'+lang+\'_dlg.js\');}
		};
		</script>';								
?>