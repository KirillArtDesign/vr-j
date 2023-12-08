<?php
define( 'WP_USE_THEMES', false );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
if(isset($_GET['cron']) && $_GET['cron'] == 'aMp0fp') {
    set_time_limit(0);
	header('Content-Type: text/html; charset= utf-8');

	if_has_been_launched(); // Проверяем, не работает ли парсер в данный момент, чтобы не запустить его дважды
	before_the_start(); // Создаем индикатор работы парсера (по нему идет проверка в первой функции)
	new_parser_on_api(); // Запускаем парсер в работу
	before_the_end(); // Парсер завершил свою работу, удаляем индикатор
	delete_old_vacancies(); //Проверка и удаление старых вакансий, которым более 30 дней
}

function new_parser_on_api() {

	/* Зона настроек */

		$keywords = [
				'Virtual+Reality',
				'augmented+reality',
				'mixed+reality',
				'виртуальная+реальность',
				'дополненная+реальность',
				'смешанная+реальность',
				'360+degree+video'
		];

		/* Конец зоны настроек. НИЧЕГО НЕ МЕНЯЕМ НИЖЕ */

	include_once 'function_parser_vacans_setings.php'; // подключение конфига

	$url_vac = 'https://api.hh.ru/vacancies/?per_page=20&text=';
	$url_vac_id = 'https://api.hh.ru/vacancies/';
	$url_emp = 'https://api.hh.ru/employers/';

	$dops = '&area=113&area=5&area=16&specialization=1';

	$pars = new Parser;
	$count = 0;

				global $post;

        $userAgent = 'myApp';

        foreach($keywords as &$val) {
            $new_url = $url_vac . iconv('UTF-8', 'cp1251', $val) . $dops;
            $l_size = 240;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $new_url);
            curl_setopt( $ch, CURLOPT_USERAGENT, $userAgent );
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($ch);
            curl_close($ch);

           if(isset($response->errors)) {
               continue;
           }

           $response = json_decode($response);
           $response = $response->items;

					 if( empty($response) ) {
						 continue;
					 }

           foreach($response as $k=>$v) {

						 /* О Компании */

						 $employer['id'] = empty($v->employer->id) ? '' : $v->employer->id;
						 $employer['logo'] = empty($v->employer->logo_urls->$l_size) ? '' : $v->employer->logo_urls->$l_size;
						 $employer['name'] = empty($v->employer->name) ? '' : $v->employer->name;

						 $ch = curl_init();
						 curl_setopt($ch, CURLOPT_URL, $url_emp . $employer['id']);
						 curl_setopt( $ch, CURLOPT_USERAGENT, $userAgent );
						 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
						 $response_emp = curl_exec($ch);
						 curl_close($ch);

						 $response_emp = json_decode($response_emp);

						 $employer['description'] = empty($response_emp->description) ? '' : $response_emp->description;
						 $employer['url'] = empty($response_emp->site_url) ? '' : $response_emp->site_url;
						 $employer['address'] = empty($response_emp->area) ? '' : $response_emp->area->name;


						 /* / О Компании */

               /* О Вакансии */

               $vacancy['id'] =  $v->id;
							 $vacancy['emp_id'] =  $v->employer->id;

               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $url_vac_id . $vacancy['id']);
               curl_setopt( $ch, CURLOPT_USERAGENT, $userAgent );
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
               $response_vac = curl_exec($ch);
               curl_close($ch);

               $response_vac = json_decode($response_vac);

               $vacancy['description'] = empty($response_vac->description) ? '' : $response_vac->description;
               $vacancy['name'] = empty($response_vac->name) ? '' : $response_vac->name;
               $vacancy['employment'] = empty($response_vac->employment->name) ? '' : $response_vac->employment->name;
               $vacancy['url'] = empty($response_vac->alternate_url) ? '' : $response_vac->alternate_url;
               $vacancy['experience'] = empty($response_vac->experience->name) ? '' : $response_vac->experience->name;

							 if( $response_vac->salary == null ) {
                   $vacancy['salary_from'] = null;
                   $vacancy['salary_to'] = null;
                   $vacancy['currency'] = null;
               }
               else {
                   if( $response_vac->salary->from != null ) {
                       $vacancy['salary_from'] = $response_vac->salary->from;
                       if( $response_vac->salary->to != null ) {
                           $vacancy['salary_to'] = $response_vac->salary->to;
                       }
                       else {
                           $vacancy['salary_to'] = null;
                       }
                   }
                   else {
                       $vacancy['salary_from'] = null;
                       $vacancy['salary_to'] = null;
                   }
               }

               if( $response_vac->salary != null && $response_vac->salary->currency ) {
                   $vacancy['currency'] = $response_vac->salary->currency;
               }
               else {
                   $vacancy['currency'] = null;
               }

               if(! empty($response_vac->key_skills) ) {
                   $ks = $response_vac->key_skills;
                   $kss = '';
                   foreach($ks as &$ksl) {
                       $kss .= $ksl->name . ',';
                   }
                   $vacancy['prof_area'] = $kss;
                   unset($ks);
                   unset($kss);
               }
               else {
                   $vacancy['prof_area'] = '';
               }

               if(! empty($response_vac->address) ) {
                   $vacancy['address'] = $response_vac->address->city . ', ' . $response_vac->address->street . ' ' . $response_vac->address->building;
               }
               else {
                   $vacancy['address'] = '';
               }

               /* / О Вакансии */

							global $post;

							$args = array(
	 							'post_type'   => 'company',
	 							'title'    	  => $employer['name'],
	 							'post_status' => 'any',
							);

	 						$company_list = get_posts( $args );

							//если нет компании, то добавляем
							if ( count($company_list) == 0 ) {
								$new_company = array(
									'post_type'    =>  'company',
									'post_title'   =>  $employer['name'],
									'post_content' =>  $employer['description'],
									'post_status'  =>  'publish', // опубликованный пост
								);

								// добавляем пост и получаем его ID
								$new_company_id = wp_insert_post( $new_company );
								update_post_meta($new_company_id, 'on_company_website',  $employer['url']);
								update_post_meta($new_company_id, 'on_company_city',  $employer['address']);

								// во фронтэнде нужны эти файлы
								require_once ABSPATH . 'wp-admin/includes/image.php';
								require_once ABSPATH . 'wp-admin/includes/file.php';
								require_once ABSPATH . 'wp-admin/includes/media.php';

								// Загружаем картинку
								if ( $employer['logo'] != '' ) {

									$catl = '/imag';
									$img = $employer['logo'];
									$pic = explode('/',$img);
									$nam = $pic[count($pic)-1];
									$path = $catl.'/'.$nam;
									save_image($img,  __DIR__.$path);

									$url = get_template_directory_uri().$path;
									$desc = "Компания ".$employer['name'];
									$id_ava = media_sideload_image( $url, $new_company_id, $desc, 'id' );
									if ( is_wp_error( $id_ava ) ) {
										$status_file = "Ошибка загрузки медиафайла.";
									} else {
										set_post_thumbnail( $new_company_id, $id_ava );
										print "ID = $new_company_id === AVA = $id_ava <br><br>";
										unlink(__DIR__.$path); // Удаляем из временной
									}
								} else { $print_eror = "=== НЕТ ЛОГО ===="; }

							}
							else {
								foreach( $company_list as $post ){ setup_postdata($post);
									$new_company_id = $post->ID;
							}
								wp_reset_postdata();
							}

							// /если нет компании, то добавляем

							$args = array(
								'post_type'   => 'vacancies',
								'meta_key'    => 'on_vacancy_url_parser',
								// 'post_title'  =>  $vacancy['name'],
								'meta_value'  =>  $vacancy['url'],
								'post_status' => 'any'
							);

							$posts = get_posts( $args );

							echo $vacancy['name'] . ' ' .count($posts) . ' ONE FOUND <br>';


								// Если вакансии нет
								if (count($posts) == 0) {
											$new_resume = array(
												'post_type'     =>  'vacancies',
												'post_title'    =>  $vacancy['name'],
												'post_content'  =>  $vacancy['description'],
												'post_status'   =>  'publish' // на проверке
											);

											$d = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
											$vacancy['date'] = date('U', $d);

											if( find_in_parser_list($vacancy['id']) == 'yes' ) {
												continue;
											}

											// добавляем пост и получаем его ID
											$new_resume_id = wp_insert_post( $new_resume );

											update_post_meta($new_resume_id, 'on_vacancy_zp_ot', $vacancy['salary_from']);
											update_post_meta($new_resume_id, 'on_vacancy_zp_do', $vacancy['to']);
											update_post_meta($new_resume_id, 'on_vacancy_valuta', $vacancy['currency']);
											update_post_meta($new_resume_id, 'on_vacancy_id_company', $new_company_id);
											update_post_meta($new_resume_id, 'on_vacancy_url_parser', $vacancy['url']);
											update_post_meta($new_resume_id, 'on_vacancy_prof_deyat', $vacancy['prof_area']);
											update_post_meta($new_resume_id, 'on_vacancy_city', $vacancy['address']);
											update_post_meta($new_resume_id, 'on_vacancy_zanyatost', $vacancy['employment']);
											update_post_meta($new_resume_id, 'on_date_add', $vacancy['date']);

											//wp_set_post_terms( $new_resume_id, $uni['adress_work'][0], 'city' ); // Город для таксономии

											update_post_meta($new_resume_id, 'on_vacancy_opit', $uni['need']['olds']);

											global $wpdb;
											$wpdb->insert(
												'parser_list',
												array( 'vac_id' => $vacancy['id'] ),
												array( '%d' )
											);

           }

					 // / Если вакансии нет

        }
			}
			print("that's all");
}


function if_has_been_launched() {
	if( file_exists('cron_new.txt') ) {
		die('File is exist');
	}
}

function before_the_start() { //создаем файл перед началом работы
	if(! file_exists('cron_new.txt') ) {
			$fp = fopen("cron_new.txt", "w");
	}
	else {
		die();
	}
}

function before_the_end() { //удаляем файл перед завершением работы
	if( file_exists('cron_new.txt') ) {
		unlink('cron_new.txt');
	}
}

function delete_old_vacancies() {
	$old_time = date('U')-(60*60*24*30);
						global $post;
						$news_list_args = array(
											   'post_type' => 'vacancies',
											   'publish' => true,
											   'numberposts' => -1,
											   'meta_key' => 'on_date_add',
											   'orderby' => 'meta_value_num',
											   'order' => 'DESC',
											   'meta_query' => array(
																	   array(
																			'key' => 'on_date_add',
																			'compare' => '<',
																			'value' => $old_time
																	   )
																   )
											);
						$news_list = get_posts( $news_list_args );
						foreach( $news_list as $post ){ setup_postdata($post);
								wp_trash_post( $post->ID );
						}
						wp_reset_postdata();
}


function find_in_parser_list($num) {
	global $wpdb;

	$results = $wpdb->get_results("SELECT * FROM parser_list");

	if(! empty($results) ) {
		foreach($results as $one=>$two) {
			if( $num == $two->vac_id ) {
				return 'yes';
			}
		}
	}

	return 'no';
}


	function save_image($img,$path){
		 $curl = curl_init($img);
		 curl_setopt($curl, CURLOPT_HEADER, 0);
		 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		 curl_setopt($curl, CURLOPT_BINARYTRANSFER,1);
		 $content = curl_exec($curl);
		 curl_close($curl);
		 if (file_exists($path)) :
		  unlink($path);
		 endif;
		 $fp = fopen($path,'x');
		 fwrite($fp, $content);
		 fclose($fp);
	}
?>
