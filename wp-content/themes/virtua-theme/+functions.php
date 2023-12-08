<?php
/**
 * ULIT-BLOG functions and definitions
 *
 * @package VIRTUA-THEME
 */
	add_theme_support( 'title-tag' ); // Подключаем заголовки
	add_theme_support( 'post-thumbnails' ); // Подключаем миниатюры
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );	
	add_theme_support( 'customize-selective-refresh-widgets' );
//	add_theme_support( 'post-formats', array('aside') );
	
	add_image_size( 'afisha-event-thumb', 160, 200, true ); 
	add_image_size( 'afisha-event', 250, 300, true ); 
	add_image_size( 'widget-post-thumb', 80, 60, true ); 
	add_image_size( 'hot-post-thumb', 570, 304, true ); 
	add_image_size( 'exlusive-post-thumb', 96, 90, true ); 
	add_image_size( 'last-post-thumb', 255, 160, true ); 
	add_image_size( 'post-list-thumb', 400, 250, true ); 
	add_image_size( 'post-list-thumb-200', 200, 200, true ); 
	
if ( !current_user_can('administrator') ) {
	add_filter('show_admin_bar', '__return_false'); // отключить
} else {
	add_filter('show_admin_bar', '__return_true'); // отключить
}	
	

// Отключаем от админки всех пользователей кроме администраторов
// function true_wp_admin_block() {
if(empty($_POST)) {
	if (is_admin()) {
		if ( !current_user_can('administrator') ) { // если не администратор
			wp_redirect( get_permalink(3807) );
			 exit();
		}	
	}
}



	
/*
// Поключаем скрипты во фронт энд
	function true_include_on_kroempol_configurator_dep() {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'on_kroempol_configurator_kp',  plugins_url('', __FILE__) . '/js/kroempol-configurator-kp.js', array('jquery') );
			wp_enqueue_script( 'on_kroempol_configurator_kp_json',  plugins_url('', __FILE__) . '/js/jquery.json.min.js', array('jquery') );
	}
	add_action('wp_enqueue_scripts', 'true_include_on_kroempol_configurator_dep' );
	add_action('wp_ajax_on_do_tamplate', 'on_do_tamplate_function'); // wp_ajax_{значение параметра action}
	add_action('wp_ajax_on_do_work_list_print', 'on_do_work_list_print_function');
*/
	// Поключаем CSS
	function on_custom_styles() {
		wp_enqueue_style( 'on-theme-style-bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
		wp_enqueue_style( 'on-theme-style-fonts', get_template_directory_uri() . '/css/fonts.css' );
		wp_enqueue_style( 'on-theme-style-slick', get_template_directory_uri() . '/css/slick.css' );
		wp_enqueue_style( 'on-theme-style-fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css' );
		wp_enqueue_style( 'on-theme-style', get_template_directory_uri() . '/css/style.css' );
		wp_add_inline_style( 'on-custom-style', $custom_inline_style );
	}
	add_action( 'wp_enqueue_scripts', 'on_custom_styles' );
	
	// Подключаем скрипты
	add_action( 'wp_enqueue_scripts', 'true_include_myscript' );
	function true_include_myscript() {
		wp_enqueue_script( 'on-theme-js-jquery', get_stylesheet_directory_uri() . '/js/jquery.min.js', array('jquery'), null  );
		wp_enqueue_script( 'on-theme-js-stick', get_stylesheet_directory_uri() . '/js/slick.min.js', array('jquery'), null  );
		wp_enqueue_script( 'on-theme-js-easing', get_stylesheet_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), null  );
		wp_enqueue_script( 'on-theme-js-fancybox', get_stylesheet_directory_uri() . '/js/jquery.fancybox.js', array('jquery'), null  );
		wp_enqueue_script( 'on-theme-js-fancybox-media', get_stylesheet_directory_uri() . '/js/jquery.fancybox-media.js', array('jquery'), null  );
		wp_enqueue_script( 'on-theme-js-main', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), null  );
		wp_enqueue_script( 'on-theme-js-main-on', get_stylesheet_directory_uri() . '/js/main_on.js', array('jquery'), null  );
		wp_enqueue_script( 'on-theme-js-maskedinput', get_stylesheet_directory_uri() . '/js/jquery.maskedinput.js', array('jquery'), null  );
	}
	
	add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
	function myajax_data(){
		wp_localize_script('on-theme-js-main-on', 'myajax', 
			array(
                'ajax_url'   => admin_url('admin-ajax.php'),
                'nonce'      => wp_create_nonce('media-form')
			)
		);  
	}
	
	// Подключаем меню в теме
	function theme_register_nav_menu() {
		register_nav_menu( 'main-menu-top', 'Main menu' );
	}
	add_action( 'after_setup_theme', 'theme_register_nav_menu' );
	
	
	// Подключаем виджеты
	register_sidebar( array(
		'name' => 'Header Block',
		'id' => 'header-block',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	) );
	register_sidebar( array(
		'name' => 'Side Bar',
		'id' => 'sidebar-1',
		'before_widget' => '<div id="sidebar-2" class="widget block">',
		'after_widget' => '</div>',
		'before_title' => '<div class="block__title"><span>',
		'after_title' => '</span></div>'
	) );
	register_sidebar( array(
		'name' => 'Footer 1',
		'id' => 'footer-1',
		'before_widget' => '<div id="footer-1" class="footerwidget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="footerwidget__title">',
		'after_title' => '</div>'
	) );
	register_sidebar( array(
		'name' => 'Footer 2',
		'id' => 'footer-2',
		'before_widget' => '<div id="footer-2" class="footerwidget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="footerwidget__title">',
		'after_title' => '</div>'
	) );
	register_sidebar( array(
		'name' => 'Footer 3',
		'id' => 'footer-3',
		'before_widget' => '<div id="footer-3" class="footerwidget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="footerwidget__title">',
		'after_title' => '</div>'
	) );
	register_sidebar( array(
		'name' => 'Footer 4',
		'id' => 'footer-4',
		'before_widget' => '<div id="footer-4" class="footerwidget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="footerwidget__title">',
		'after_title' => '</div>'
	) );
	register_sidebar( array(
		'name' => 'Баннер на главной',
		'id' => 'banner-in-home',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div class="block__title"><span>',
		'after_title' => '</span></div>'
	) );
	

	
	
	
// Перехват сообщений 
do_action( 'wpcf7_before_send_mail', $contact_form ); 
function wpcf7_do_save_mail_to_base ($contact_form) {
	
	if( $contact_form->id == 200 ) {
		$submission = WPCF7_Submission::get_instance();
		$submited['posted_data'] = $submission->get_posted_data();
		$on_email = $submited['posted_data']['email-subsribe'];
				global $post; 
				$news_list_args = array( 'post_type' => 'on_emails', 'publish' => true, 'title' => $on_email );
				$news_list = get_posts( $news_list_args );
				$x_email=0;
				foreach( $news_list as $post ){ setup_postdata($post);
					$x_email++;
				}
		if ($x_email==0) {
			$new_email = array(
				'post_type'    => 'on_emails',
				'post_title'    => $on_email,
				'post_status'   => 'publish' // опубликованный пост
			);
			// добавляем пост и получаем его ID 
			$new_email_id = wp_insert_post( $new_email );
		}					
	}
	
}
add_action("wpcf7_before_send_mail", "wpcf7_do_save_mail_to_base", 10, 1 );


	
	
	
	
// Подключаем события
add_action( 'init', 'true_register_post_type_init' ); // Использовать функцию только внутри хука init
function true_register_post_type_init() {
	// События
	$labels = array(
		'name' => 'События',
		'singular_name' => 'Событие', // админ панель Добавить->Функцию
		'add_new' => 'Добавить событие',
		'add_new_item' => 'Добавить новое событие', // заголовок тега <title>
		'edit_item' => 'Редактировать событие',
		'new_item' => 'Новое событие',
		'all_items' => 'Все события',
		'view_item' => 'Просмотр события на сайте',
		'search_items' => 'Искать событие',
		'not_found' =>  'Событие не найдена.',
		'not_found_in_trash' => 'В корзине нет оперций.',
		'menu_name' => 'События' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'hierarchical' => false, // Включаем эрархию у записей
		'slug' => 'on-event',	// Ярлых устанавливем
		'feeds' => false,	// Убираем из РСС
		'has_archive' => false,
		'exclude_from_search' => false, // Исключаем из поиска		
		'menu_icon' => 'dashicons-clock', // иконка в меню
		'menu_position' => 21, // порядок в меню
		'supports' => array( 'title', 'editor', 'thumbnail','excerpt', 'comments','revisions','page-attributes' )
	);
	register_post_type('events', $args);
	
	// Игры
	$labels = array(
		'name' => 'Игры',
		'singular_name' => 'Игра', // админ панель Добавить->Функцию
		'add_new' => 'Добавить игру',
		'add_new_item' => 'Добавить новую игру', // заголовок тега <title>
		'edit_item' => 'Редактировать игру',
		'new_item' => 'Новая игра',
		'all_items' => 'Все игры',
		'view_item' => 'Просмотр игры на сайте',
		'search_items' => 'Искать игру',
		'not_found' =>  'Игры не найдены.',
		'not_found_in_trash' => 'В корзине нет игр.',
		'menu_name' => 'Игры' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'hierarchical' => false, // Включаем эрархию у записей
		'slug' => 'on-game',	// Ярлых устанавливем
		'feeds' => false,	// Убираем из РСС
		'has_archive' => false,
		'exclude_from_search' => false, // Исключаем из поиска		
		'menu_icon' => 'dashicons-smiley', // иконка в меню
		'menu_position' => 21, // порядок в меню
		'supports' => array( 'title', 'editor', 'thumbnail','excerpt', 'comments' )
	);
	register_post_type('games', $args);
	
	// Игры
	$labels = array(
		'name' => 'Подписчики',
		'singular_name' => 'Подписчик', // админ панель Добавить->Функцию
		'add_new' => 'Добавить подписчика',
		'add_new_item' => 'Добавить нового подписчика', // заголовок тега <title>
		'edit_item' => 'Редактировать подписчика',
		'new_item' => 'Новый подписчик',
		'all_items' => 'Все подписчики',
		'view_item' => 'Просмотр подписчика на сайте',
		'search_items' => 'Искать подписчика',
		'not_found' =>  'Подписчики не найдены.',
		'not_found_in_trash' => 'В корзине нет подписчиков.',
		'menu_name' => 'Подписчики' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => false,
		'show_ui' => true, // показывать интерфейс в админке
		'hierarchical' => false, // Включаем эрархию у записей
		'slug' => 'on-email',	// Ярлых устанавливем
		'feeds' => false,	// Убираем из РСС
		'has_archive' => true,
		'exclude_from_search' => false, // Исключаем из поиска		
		'menu_icon' => 'dashicons-email', // иконка в меню
		'menu_position' => 25, // порядок в меню
		'supports' => array( 'title' )
	);
	register_post_type('on_emails', $args);
	
	// Резюме
	$labels = array(
		'name' => 'Резюме',
		'singular_name' => 'Резюме', // админ панель Добавить->Функцию
		'add_new' => 'Добавить резюме',
		'add_new_item' => 'Добавить новое резюме', // заголовок тега <title>
		'edit_item' => 'Редактировать резюме',
		'new_item' => 'Новое резюме',
		'all_items' => 'Все резюме',
		'view_item' => 'Просмотр резюме на сайте',
		'search_items' => 'Искать резюме',
		'not_found' =>  'Резюме не найдены.',
		'not_found_in_trash' => 'В корзине нет резюме.',
		'menu_name' => 'Резюме' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'hierarchical' => false, // Включаем эрархию у записей
		'slug' => 'resume',	// Ярлых устанавливем
		'feeds' => false,	// Убираем из РСС
		'has_archive' => false,
		'exclude_from_search' => false, // Исключаем из поиска		
		'menu_icon' => 'dashicons-portfolio', // иконка в меню
		'menu_position' => 25, // порядок в меню
		'supports' => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type('resume', $args);
	
	
	// Вакансии
	$labels = array(
		'name' => 'Вакансии',
		'singular_name' => 'Вакансии', // админ панель Добавить->Функцию
		'add_new' => 'Добавить Вакансии',
		'add_new_item' => 'Добавить новую вакансию', // заголовок тега <title>
		'edit_item' => 'Редактировать вакансию',
		'new_item' => 'Новая Вакансия',
		'all_items' => 'Все вакансии',
		'view_item' => 'Просмотр вакансии на сайте',
		'search_items' => 'Искать вакансии',
		'not_found' =>  'Вакансии не найдены.',
		'not_found_in_trash' => 'В корзине нет вакансий.',
		'menu_name' => 'Вакансии' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'hierarchical' => false, // Включаем эрархию у записей
		'slug' => 'on-vacancy',	// Ярлых устанавливем
		'feeds' => false,	// Убираем из РСС
		'has_archive' => false,
		'exclude_from_search' => false, // Исключаем из поиска		
		'menu_icon' => 'dashicons-portfolio', // иконка в меню
		'menu_position' => 25, // порядок в меню
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' )
	);
	register_post_type('vacancies', $args);
	
	
	// Компании
	$labels = array(
		'name' => 'Компании',
		'singular_name' => 'Компания', // админ панель Добавить->Функцию
		'add_new' => 'Добавить компанию',
		'add_new_item' => 'Добавить новую компанию', // заголовок тега <title>
		'edit_item' => 'Редактировать компанию',
		'new_item' => 'Новая компания',
		'all_items' => 'Все компании',
		'view_item' => 'Просмотр компании на сайте',
		'search_items' => 'Искать компанию',
		'not_found' =>  'Компании не найдены.',
		'not_found_in_trash' => 'В корзине нет компаний.',
		'menu_name' => 'Компании' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'hierarchical' => false, // Включаем эрархию у записей
		'slug' => 'on-company',	// Ярлых устанавливем
		'feeds' => false,	// Убираем из РСС
		'has_archive' => false,
		'exclude_from_search' => false, // Исключаем из поиска		
		'menu_icon' => 'dashicons-portfolio', // иконка в меню
		'menu_position' => 25, // порядок в меню
		'supports' => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type('company', $args);	
	
	
	// Портфолио
	$labels = array(
		'name' => 'Портфолио',
		'singular_name' => 'Портфолио', // админ панель Добавить->Функцию
		'add_new' => 'Добавить портфолио',
		'add_new_item' => 'Добавить новое портфолио', // заголовок тега <title>
		'edit_item' => 'Редактировать портфолио',
		'new_item' => 'Новое ортфолио',
		'all_items' => 'Все портфолио',
		'view_item' => 'Просмотр портфолио на сайте',
		'search_items' => 'Искать портфолио',
		'not_found' =>  'Портфолио не найдены.',
		'not_found_in_trash' => 'В корзине нет портфолио.',
		'menu_name' => 'Портфолио' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'hierarchical' => false, // Включаем эрархию у записей
		'slug' => 'on-portfolio',	// Ярлых устанавливем
		'feeds' => false,	// Убираем из РСС
		'has_archive' => false,
		'exclude_from_search' => false, // Исключаем из поиска		
		'menu_icon' => 'dashicons-portfolio', // иконка в меню
		'menu_position' => 25, // порядок в меню
		'supports' => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type('portfolio', $args);
	
}





// ТАКСОНОМИИ 
add_action('init', 'create_taxonomy_on_tax_events');
function create_taxonomy_on_tax_events(){
		
	// КАТЕГОРИИ Событий
	// заголовки
	$labels = array(
		'name'              => 'Категории событий',
		'singular_name'     => 'Категория события',
		'search_items'      => 'Поиск по категориям события',
		'all_items'         => 'Все категории событий',
		'parent_item'       => 'Родительская категория',
		'parent_item_colon' => 'Родительская категория:',
		'edit_item'         => 'Редактировать категорию',
		'update_item'       => 'Обновить категорию',
		'add_new_item'      => 'Добавить новую категорию',
		'new_item_name'     => 'Новое имя категории',
		'menu_name'         => 'Категории событий',
		'not_found' 		=> 'Категорий для событий не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => true,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('cat-events', array('events'), $args );
	
// КАТЕГОРИИ Игр
	// заголовки
	$labels = array(
		'name'              => 'Категории игр',
		'singular_name'     => 'Категория игр',
		'search_items'      => 'Поиск по категориям игр',
		'all_items'         => 'Все категории игр',
		'parent_item'       => 'Родительская категория',
		'parent_item_colon' => 'Родительская категория:',
		'edit_item'         => 'Редактировать категорию',
		'update_item'       => 'Обновить категорию',
		'add_new_item'      => 'Добавить новую категорию',
		'new_item_name'     => 'Новое имя категории',
		'menu_name'         => 'Категории игр',
		'not_found' 		=> 'Категорий для игр нет.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => true,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('cat-games', array('games'), $args );
	
	// Жанры Игр
	// заголовки
	$labels = array(
		'name'              => 'Жанр игр',
		'singular_name'     => 'Жанр игр',
		'search_items'      => 'Поиск по жанр игр',
		'all_items'         => 'Все жанр игр',
		'parent_item'       => 'Родительский жанр',
		'parent_item_colon' => 'Родительский жанр:',
		'edit_item'         => 'Редактировать жанр',
		'update_item'       => 'Обновить жанр',
		'add_new_item'      => 'Добавить новый жанр',
		'new_item_name'     => 'Новое имя жанр',
		'menu_name'         => 'Жанры игр',
		'not_found' 		=> 'Жанров для игр нет.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('games-genre', array('games'), $args );
	
	// Разработчик Игр
	// заголовки
	$labels = array(
		'name'              => 'Разработчик игры',
		'singular_name'     => 'Разработчик игры',
		'search_items'      => 'Поиск по разработчикам игр',
		'all_items'         => 'Все разработчики игр',
		'parent_item'       => 'Родительский разработчик',
		'parent_item_colon' => 'Родительский разработчик:',
		'edit_item'         => 'Редактировать разработчика',
		'update_item'       => 'Обновить разработчика',
		'add_new_item'      => 'Добавить нового разработчика',
		'new_item_name'     => 'Новый разработчик',
		'menu_name'         => 'Разработчики игр',
		'not_found' 		=> 'Разработчиков для игр нет.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('games-razrab', array('games'), $args );
	
	
	// Издатель Игр
	// заголовки
	$labels = array(
		'name'              => 'Издатели игр',
		'singular_name'     => 'Издатель игры',
		'search_items'      => 'Поиск по издателям игр',
		'all_items'         => 'Все издатели игр',
		'parent_item'       => 'Родительский издатель',
		'parent_item_colon' => 'Родительский издатель:',
		'edit_item'         => 'Редактировать издателя',
		'update_item'       => 'Обновить издателя',
		'add_new_item'      => 'Добавить нового издателя игр',
		'new_item_name'     => 'Новый издатель игр',
		'menu_name'         => 'Издатели игр',
		'not_found' 		=> 'Издателей для игр нет.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('games-izdatel', array('games'), $args );

	
		// Платформы Игр
	// заголовки
	$labels = array(
		'name'              => 'Платформы',
		'singular_name'     => 'Платформа',
		'search_items'      => 'Поиск по платформам',
		'all_items'         => 'Все платформы для игр',
		'parent_item'       => 'Родительская платформа',
		'parent_item_colon' => 'Родительская платформа:',
		'edit_item'         => 'Редактировать платформу',
		'update_item'       => 'Обновить платформу',
		'add_new_item'      => 'Добавить новую платформу',
		'new_item_name'     => 'Новая платформа для игр',
		'menu_name'         => 'Платформы',
		'not_found' 		=> 'Платформы для игр не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('games-platform', array('games'), $args );
	
	// Устройства Игр
	// заголовки
	$labels = array(
		'name'              => 'Устройства',
		'singular_name'     => 'Устройства',
		'search_items'      => 'Поиск по устройствам',
		'all_items'         => 'Все устройства для игр',
		'parent_item'       => 'Родительские устройства',
		'parent_item_colon' => 'Родительские устройства:',
		'edit_item'         => 'Редактировать устройство',
		'update_item'       => 'Обновить устройство',
		'add_new_item'      => 'Добавить новое устройство',
		'new_item_name'     => 'Новое устройство для игр',
		'menu_name'         => 'Устройства',
		'not_found' 		=> 'Устройства для игр не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('games-ustroistva', array('games'), $args );
	
	// Год Игр
	// заголовки
	$labels = array(
		'name'              => 'Год',
		'singular_name'     => 'Год',
		'search_items'      => 'Поиск по годам',
		'all_items'         => 'Все годы для игр',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать год',
		'update_item'       => 'Обновить год',
		'add_new_item'      => 'Добавить новый год',
		'new_item_name'     => 'Новый год для игр',
		'menu_name'         => 'Год',
		'not_found' 		=> 'Годы для игр не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('games-year', array('games'), $args );
	
	// Сервисы
	// заголовки
	$labels = array(
		'name'              => 'Сервисы',
		'singular_name'     => 'Сервис',
		'search_items'      => 'Поиск по сервисам',
		'all_items'         => 'Все сервисы',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать сервис',
		'update_item'       => 'Обновить сервис',
		'add_new_item'      => 'Добавить новый сервис',
		'new_item_name'     => 'Новый сервис',
		'menu_name'         => 'Сервисы',
		'not_found' 		=> 'Сервисы не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('game-service', array('games'), $args );	
	
	
	// Резюмэ
	// Занятость
	$labels = array(
		'name'              => 'Занятость',
		'singular_name'     => 'Занятость',
		'search_items'      => 'Поиск по занятости',
		'all_items'         => 'Все занятости',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать сервис',
		'update_item'       => 'Обновить занятость',
		'add_new_item'      => 'Добавить новую занятость',
		'new_item_name'     => 'Новая занятость',
		'menu_name'         => 'Занятость',
		'not_found' 		=> 'Занятость не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('zanyatost', array('resume','vacancies'), $args );
	
	// Вакансии
	// Опыт работы
	$labels = array(
		'name'              => 'Опыт работы',
		'singular_name'     => 'Опыт работы',
		'search_items'      => 'Поиск по опыту',
		'all_items'         => 'Все опыты работы',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать опыт работы',
		'update_item'       => 'Обновить опыт работы',
		'add_new_item'      => 'Добавить опыт работы',
		'new_item_name'     => 'Новый опыт работы',
		'menu_name'         => 'Опыт работы',
		'not_found' 		=> 'Опыт работы не найден.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('experience', array('vacancies'), $args );
	
	
	// Ваканссии
	// Образование
	$labels = array(
		'name'              => 'Требуемое образование',
		'singular_name'     => 'Требуемое образование',
		'search_items'      => 'Поиск по образованию',
		'all_items'         => 'Все образования',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать образование',
		'update_item'       => 'Обновить образование',
		'add_new_item'      => 'Добавить образование',
		'new_item_name'     => 'Новое образование',
		'menu_name'         => 'Требуемое образование',
		'not_found' 		=> 'Требуемое образование не найдено.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('obrazovaie', array('vacancies'), $args );
	
	
	// Ваканссии
	// Тип работы
	$labels = array(
		'name'              => 'Тип работы',
		'singular_name'     => 'Тип работы',
		'search_items'      => 'Поиск типу работы',
		'all_items'         => 'Все типы работы',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать тип работы',
		'update_item'       => 'Обновить тип работы',
		'add_new_item'      => 'Добавить тип работы',
		'new_item_name'     => 'Новый тип работы',
		'menu_name'         => 'Тип работы',
		'not_found' 		=> 'Тип работы не найдено.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('typework', array('vacancies','resume'), $args );
	
	
	// Резюмэ
	// гражданство
	$labels = array(
		'name'              => 'Гражданство',
		'singular_name'     => 'Гражданство',
		'search_items'      => 'Поиск по гражданству',
		'all_items'         => 'Все гражданства',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать гражданство',
		'update_item'       => 'Обновить гражданство',
		'add_new_item'      => 'Добавить новое гражданство',
		'new_item_name'     => 'Новое гражданство',
		'menu_name'         => 'Гражданство',
		'not_found' 		=> 'Ничего не найдено.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('grajdanstvo', array('resume'), $args );
	
	
	// Резюмэ
	// график работы
	$labels = array(
		'name'              => 'Языки',
		'singular_name'     => 'Языки',
		'search_items'      => 'Поиск по языкам',
		'all_items'         => 'Все языки',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать язык',
		'update_item'       => 'Обновить язык',
		'add_new_item'      => 'Добавить новый язык',
		'new_item_name'     => 'Новый язык',
		'menu_name'         => 'Владение языками',
		'not_found' 		=> 'Языки работы не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('langwich', array('resume'), $args );
	
	// Резюмэ
	// график работы
	$labels = array(
		'name'              => 'Степени владения',
		'singular_name'     => 'Степень владения',
		'search_items'      => 'Поиск по степеням',
		'all_items'         => 'Все степени',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать степень владения',
		'update_item'       => 'Обновить степень',
		'add_new_item'      => 'Добавить новую степень',
		'new_item_name'     => 'Новая степень владения',
		'menu_name'         => 'Степень владения языками',
		'not_found' 		=> 'Степени работы не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => false,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('langwich-stepen', array('resume'), $args );
	
		
	// Резюмэ
	// график работы
	$labels = array(
		'name'              => 'Ключевые навыки',
		'singular_name'     => 'Ключевые навыки',
		'search_items'      => 'Поиск по Ключевым навыки',
		'all_items'         => 'Все Ключевые навыки',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать Ключевые навыки',
		'update_item'       => 'Обновить Ключевые навыки',
		'add_new_item'      => 'Добавить новый Ключевые навыки',
		'new_item_name'     => 'Новый Ключевые навыки',
		'menu_name'         => 'Ключевые навыки',
		'not_found' 		=> 'Ключевые навыки не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('key-naviki', array('resume','resume'), $args );
/*	
	// Портфолио
	// Навыки
	$labels = array(
		'name'              => 'Ключевые навыки',
		'singular_name'     => 'Ключевые навыки',
		'search_items'      => 'Поиск по Ключевым навыки',
		'all_items'         => 'Все Ключевые навыки',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать Ключевые навыки',
		'update_item'       => 'Обновить Ключевые навыки',
		'add_new_item'      => 'Добавить новый Ключевые навыки',
		'new_item_name'     => 'Новый Ключевые навыки',
		'menu_name'         => 'Ключевые навыки',
		'not_found' 		=> 'Ключевые навыки не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('key-naviki-portfolio', array('portfolio'), $args );
*/	
	
	// Резюмэ
	// Города
	$labels = array(
		'name'              => 'Города',
		'singular_name'     => 'Город',
		'search_items'      => 'Поиск по городам',
		'all_items'         => 'Все города',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать город',
		'update_item'       => 'Обновить город',
		'add_new_item'      => 'Добавить новый город',
		'new_item_name'     => 'Новый город',
		'menu_name'         => 'Страны и Города',
		'not_found' 		=> 'Города навыки не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => true,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('city', array('resume','vacancies','company'), $args );
	
	// Вакансии
	// Опыт работы
	$labels = array(
		'name'              => 'Проф. области',
		'singular_name'     => 'Проф. область',
		'search_items'      => 'Поиск по проф. области',
		'all_items'         => 'Все проф. области',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать проф. область',
		'update_item'       => 'Обновить проф. область',
		'add_new_item'      => 'Добавить проф. область',
		'new_item_name'     => 'Новая проф. область',
		'menu_name'         => 'Проф. области',
		'not_found' 		=> 'Проф. области не найден.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => false,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('prof-obl-vacan', array('vacancies'), $args );
	
/*	
	// Резюмэ
	// страны
	$labels = array(
		'name'              => 'Страны',
		'singular_name'     => 'Страна',
		'search_items'      => 'Поиск по странам',
		'all_items'         => 'Все страны',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать страну',
		'update_item'       => 'Обновить страну',
		'add_new_item'      => 'Добавить новую страну',
		'new_item_name'     => 'Новая страна',
		'menu_name'         => 'Страны',
		'not_found' 		=> 'Страны не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('lands', array('resume'), $args );
*/	
	// Резюмэ
	// Профессиональная область
	$labels = array(
		'name'              => 'Профессиональная область',
		'singular_name'     => 'Профессиональная область',
		'search_items'      => 'Поиск по профессиональным областям',
		'all_items'         => 'Все профессиональные области',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать профессиональную область',
		'update_item'       => 'Обновить профессиональную область',
		'add_new_item'      => 'Добавить новую профессиональную область',
		'new_item_name'     => 'Новая профессиональная область',
		'menu_name'         => 'Профессиональные области',
		'not_found' 		=> 'Профессиональние области не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => false,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('prof-obl', array('resume'), $args );
	
	// Резюмэ
	// Учебное заведение
	$labels = array(
		'name'              => 'Учебное заведение',
		'singular_name'     => 'Учебное заведение',
		'search_items'      => 'Поиск по учебным заведениям',
		'all_items'         => 'Все учебние заведения',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать учебное заведение',
		'update_item'       => 'Обновить учебное заведение',
		'add_new_item'      => 'Добавить учебное заведение',
		'new_item_name'     => 'Новое учебное заведение',
		'menu_name'         => 'Учебные заведения',
		'not_found' 		=> 'Зведения не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => false,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => true,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('ucheb-zaved', array('resume'), $args );
	
	// Резюмэ
	// образования
	$labels = array(
		'name'              => 'Образования',
		'singular_name'     => 'Образование',
		'search_items'      => 'Поиск по образованиям',
		'all_items'         => 'Все образования',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать образование',
		'update_item'       => 'Обновить образование',
		'add_new_item'      => 'Добавить новое образование',
		'new_item_name'     => 'Новое образование',
		'menu_name'         => 'Образования',
		'not_found' 		=> 'Образования не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => false,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('resume-obrazovaie', array('resume'), $args );
	
	// Резюмэ
	// образования
	$labels = array(
		'name'              => 'Степень образования',
		'singular_name'     => 'Степень образования',
		'search_items'      => 'Поиск по степеням',
		'all_items'         => 'Все степени',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать степень',
		'update_item'       => 'Обновить степень',
		'add_new_item'      => 'Добавить новую степень',
		'new_item_name'     => 'Новая степень',
		'menu_name'         => 'Степень образования',
		'not_found' 		=> 'Степени не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => false,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('resume-obrazovaie-stepen', array('resume'), $args );
	
	
	// КОмпании
	// Должности
	$labels = array(
		'name'              => 'Должности',
		'singular_name'     => 'Должность',
		'search_items'      => 'Поиск по должностям',
		'all_items'         => 'Все должности',
		'parent_item'       => 'Родительские ',
		'parent_item_colon' => 'Родительские :',
		'edit_item'         => 'Редактировать должность',
		'update_item'       => 'Обновить должность',
		'add_new_item'      => 'Добавить новую должность',
		'new_item_name'     => 'Новая должность',
		'menu_name'         => 'Должности',
		'not_found' 		=> 'Должности не найдены.',
	); 
	// параметры
	$args = array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => $labels,
		'public'                => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => true, // равен аргументу show_ui
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);
	register_taxonomy('rank', array('company'), $args );
	
}







##################
// Дополнительные поля в записях СОБЫТИЙ
##################

// Добавляем дополнительное поле
function status_events_box() {  
    add_meta_box(  
        'status_events_box', // Идентификатор(id)
        'Дополнительные параметры', // Заголовок области с мета-полями(title)
        'show_events_metabox', // Вызов(callback)
        'events', // Где будет отображаться наше поле, в нашем случае в Записях
        'normal', 
        'high');
}  
add_action('add_meta_boxes', 'status_events_box'); // Запускаем функцию

// Создаем новые поля
$meta_fields_evants = array(  
	array(  
        'label' => 'Дата начала события',  
        'desc'  => '',  
        'id'    => 'on_event_data_start', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),	
	array(  
        'label' => 'Время начала события',  
        'desc'  => '',  
        'id'    => 'on_event_time_start', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),	
	array(  
        'label' => '',  
        'desc'  => '',  
        'id'    => 'on_event_data_start_int', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Кол-во участников',  
        'desc'  => '',  
        'id'    => 'on_event_members', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Вход',  
        'desc'  => '',  
        'id'    => 'on_event_enter', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    )
);


// Вызов метаполей  
function show_events_metabox() {  
global $meta_fields_evants; // Обозначим наш массив с полями глобальным
global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
echo '<input type="hidden" name="on_events_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />'; 
	
    // Начинаем выводить таблицу с полями через цикл
//    echo '<style>.switch-html, .misc-pub-post-status, .misc-pub-visibility, .edit-timestamp, #submitdiv .button-link, #submitdiv h2, #wp-content-editor-tools { display: none!important; }</style> ';  
	  echo '<table class="form-table">';
	
    foreach ($meta_fields_evants as $field) {  
        // Получаем значение если оно есть для этого поля 
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // Начинаем выводить таблицу
        echo '<tr>';  
								
                switch($field['type']) {  
                    // Выводить поля будем здесь, как это сделать читайте ниже!
					
					
					case 'textarea':  
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label><br><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="30" rows="6">'.$meta.'</textarea> 
							<br /><span class="description">'.$field['desc'].'</span></th>';  
					break;
					case 'checkbox':  
						echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
							<label for="'.$field['id'].'">'.$field['desc'].'</label></td>';  
					break;
					// Всплывающий список  
					case 'select':  
						echo '<th><option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
						echo '</select></th>';  
					break;
					case 'text': 
						$collt="30";
						if ($field['id'] == "on_event_data_start") { $collt="17"; $datapiker_print="class='datepicker'"; } else { $datapiker_print=""; }
						if ($field['id'] == "on_event_members") { $type_on="number"; $collt="15"; } 
							elseif ($field['id'] == "on_event_data_start_int") { $type_on="hidden"; } 
							else { $type_on="text"; }
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label> <input type="'.$type_on.'" '.$datapiker_print.' name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="'.$collt.'" /></th>';
					break;
                }
        echo '</tr>';  
    }  
    echo '</table>'; 
}



// Пишем функцию для сохранения СОбытий
function on_events_save_meta_fields($post_id) {
    global $meta_fields_evants;  // Массив с нашими полями
 
    // проверяем наш проверочный код 
    if (!wp_verify_nonce($_POST['on_events_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // Проверяем авто-сохранение 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // Проверяем права доступа  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
	
	//Записываем дату
	if ($_POST['on_event_data_start']!="") { $date_num = explode(".", $_POST['on_event_data_start']); $_POST['on_event_data_start_int'] = $date_num[2].$date_num[1].$date_num[0]; }
 
    // Если все отлично, прогоняем массив через foreach
    foreach ($meta_fields_evants as $field) {  
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }  
    } // end foreach  
}  
add_action('save_post', 'on_events_save_meta_fields'); // Запускаем функцию сохранения


















##################
// Дополнительные поля в записях ИГР
##################

// Добавляем дополнительное поле
function status_games_box() {  
    add_meta_box(  
        'status_games_box', // Идентификатор(id)
        'Дополнительные параметры', // Заголовок области с мета-полями(title)
        'show_games_metabox', // Вызов(callback)
        'games', // Где будет отображаться наше поле, в нашем случае в Записях
        'normal', 
        'high');
}  
add_action('add_meta_boxes', 'status_games_box'); // Запускаем функцию

// Создаем новые поля
$meta_fields_games = array(  
	array(  
        'label' => 'Системные требования',  
        'desc'  => '',  
        'id'    => 'on_game_sis',  // даем идентификатор.
        'type'  => 'textarea'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Наличие русской локализации',  
        'desc'  => '',  
        'id'    => 'on_game_rus_locate',  // даем идентификатор.
        'type'  => 'textarea'  // Указываем тип поля.
    ),
	array(  
        'label' => 'URL на видео',  
        'desc'  => '',  
        'id'    => 'on_game_video', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),	
	array(  
        'label' => 'Верхний текст',  
        'desc'  => '',  
        'id'    => 'on_game_top_text',  // даем идентификатор.
        'type'  => 'textarea'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Рейтинг (Метакритик)',  
        'desc'  => '',  
        'id'    => 'on_game_rating', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'URL страницы с рейтингом игры для парсера (Метакритик)',  
        'desc'  => 'Пример: http://www.metacritic.com/game/switch/the-legend-of-zelda-breath-of-the-wild',  
        'id'    => 'on_game_url_rating', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ), 
	array(  
        'label' => 'Оценка пользователей Steam',  
        'desc'  => '',  
        'id'    => 'on_game_otsenka_stream', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'URL страницы с рейтингом игры для парсера (Steam)',  
        'desc'  => '',  
        'id'    => 'on_game_otsenka_stream_url', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Оценка пользователей PlayStation',  
        'desc'  => '',  
        'id'    => 'on_game_otsenka_ps', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
/*	array(  
        'label' => 'Оценка пользователей PlayStation - URL для парсера',  
        'desc'  => '',  
        'id'    => 'on_game_otsenka_ps_url', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ), */
	array(  
        'label' => 'Дата релиза',  
        'desc'  => '',  
        'id'    => 'on_game_data_realise', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => '',  
        'desc'  => '',  
        'id'    => 'on_game_data_realise_int', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Участвует в акции',  
        'desc'  => 'Игра участвует в акции',  
        'id'    => 'on_game_akciya',  // даем идентификатор.
        'type'  => 'checkbox'  // Указываем тип поля.
    )
);


// Вызов метаполей  
function show_games_metabox() {  
global $meta_fields_games; // Обозначим наш массив с полями глобальным
global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
echo '<input type="hidden" name="on_games_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />'; 
	
    // Начинаем выводить таблицу с полями через цикл
//    echo '<style>.switch-html, .misc-pub-post-status, .misc-pub-visibility, .edit-timestamp, #submitdiv .button-link, #submitdiv h2, #wp-content-editor-tools { display: none!important; }</style> <table class="form-table">';  
	  echo '<table class="form-table">';
	  
    foreach ($meta_fields_games as $field) {  
        // Получаем значение если оно есть для этого поля 
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // Начинаем выводить таблицу
        echo '<tr>';  
								
                switch($field['type']) {  
                    // Выводить поля будем здесь, как это сделать читайте ниже!
					
					
					case 'textarea':  
						if($field['id'] == "on_game_sis") {
							echo '<b>'.$field['label'].'</b>';
							wp_editor( $meta, 'on_game_sis', array('textarea_name' => 'on_game_sis', 'textarea_rows' => 5, 'drag_drop_upload' => false, 'media_buttons' => false, 'teeny' => 1 ) ); 
						} else {
							echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label><br><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="30" rows="6">'.$meta.'</textarea> 
							<br /><span class="description">'.$field['desc'].'</span></th>';  
						}
							
					break;
					case 'checkbox':  
						echo '<td><input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
							<label for="'.$field['id'].'">'.$field['desc'].'</label></td>';  
					break;
					// Всплывающий список  
					case 'select':  
						echo '<th><option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
						echo '</select></th>';  
					break;
					case 'text': 
						$collt="30";
						if ($field['id'] == "on_game_data_realise") { $collt="17"; $datapiker_print="class='datepicker'"; } else { $datapiker_print=""; }
						if ($field['id'] == "on_game_members") { $type_on="number"; $collt="15"; } 
						elseif ($field['id'] == "on_game_data_realise_int") { $type_on="hidden"; } else { $type_on="text"; }
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label> <input type="'.$type_on.'" '.$datapiker_print.' name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="'.$collt.'" /></th>';
					break;
                }
        echo '</tr>';  
    }  
    echo '</table>'; 
}



// Пишем функцию для сохранения ИГР
function on_games_save_meta_fields($post_id) {
    global $meta_fields_games;  // Массив с нашими полями
 
    // проверяем наш проверочный код 
    if (!wp_verify_nonce($_POST['on_games_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // Проверяем авто-сохранение 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // Проверяем права доступа  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    } 
	
	//Записываем дату
	if ($_POST['on_game_data_realise']!="") { $date_num = explode(".", $_POST['on_game_data_realise']); $_POST['on_game_data_realise_int'] = $date_num[2].$date_num[1].$date_num[0]; } 
	
	// Парсим рейтинги
	if ($_POST['on_game_url_rating']!='' and $_POST['on_game_otsenka_stream_url']!='') {
		$rating = pars_rating($_POST['on_game_url_rating'],$_POST['on_game_otsenka_stream_url']);
		$_POST['on_game_rating']=$rating[0];
		$_POST['on_game_otsenka_stream']=$rating[1];
	}
	


    
	// Если все отлично, прогоняем массив через foreach
    foreach ($meta_fields_games as $field) {  
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }  
    } // end foreach  
}  
add_action('save_post', 'on_games_save_meta_fields', 10); // Запускаем функцию сохранения


/*
// Парсер для игр оценок
function func_on_parse_info_games($post_ID)  {
	if ( is_admin() ) { 
		$url_rating = get_post_meta($post_ID, 'on_game_url_rating', true);
		if ($url_rating=="") {} else {
			print "Страница для парсинга задана!<br><br>";
			$wigdet_informer = file_get_contents('http://www.metacritic.com/game/switch/the-legend-of-zelda-breath-of-the-wild/');
			preg_match_all('|<span itemprop="ratingValue">(.*?)</span>|s', $wigdet_informer, $inform_name, PREG_PATTERN_ORDER);
//			if ($inform_name[1][0]!="") { update_post_meta($post_ID, 'on_game_rating', $inform_name[1][0]); } 						
		}	
						
				print "ID: ".$post_ID." <br> URL: ".$url_rating."<br> RATING: ".get_post_meta($post_ID,'on_game_rating',true)."<br><BR><BR>";
				print_r($inform_name);
				print_r($wigdet_informer);
				wp_die();
	}
}
add_action('save_post', 'func_on_parse_info_games', 20, 1);

*/









##################
// Дополнительные поля в НОВОСТЯХ - ЭКЛЮЗИВ И ГОРЯЧООО!
##################

// Добавляем дополнительное поле
function status_exlusive_posts_box() {  
    add_meta_box(  
        'status_exlusive_posts_box', // Идентификатор(id)
        'Дополнительные параметры', // Заголовок области с мета-полями(title)
        'show_exlusive_posts_metabox', // Вызов(callback)
        'post', // Где будет отображаться наше поле, в нашем случае в Записях
        'side', 
        'high');
}  
add_action('add_meta_boxes', 'status_exlusive_posts_box'); // Запускаем функцию

// Создаем новые поля
$meta_fields_exlusive_posts = array(  
   
    array(  
        'label' => 'Горячая новость',  
        'desc'  => 'Горячая новость',  
        'id'    => 'on_hot_news',  // даем идентификатор.
        'type'  => 'checkbox'  // Указываем тип поля.
    ),   
	array(  
        'label' => 'Экслюзив',  
        'desc'  => 'Экслюзив',  
        'id'    => 'on_exlusive_news',  // даем идентификатор.
        'type'  => 'checkbox'  // Указываем тип поля.
    )
);


// Вызов метаполей  
function show_exlusive_posts_metabox() {  
global $meta_fields_exlusive_posts; // Обозначим наш массив с полями глобальным
global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
echo '<input type="hidden" name="on_exlusive_posts_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />'; 
	
    // Начинаем выводить таблицу с полями через цикл
//    echo '<style>.switch-html, .misc-pub-post-status, .misc-pub-visibility, .edit-timestamp, #submitdiv .button-link, #submitdiv h2, #wp-content-editor-tools { display: none!important; }</style> <table class="form-table">';  
	  echo '<table class="form-table">';
	  
    foreach ($meta_fields_exlusive_posts as $field) {  
        // Получаем значение если оно есть для этого поля 
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // Начинаем выводить таблицу
        echo '<tr>';  
								
                switch($field['type']) {  
                    // Выводить поля будем здесь, как это сделать читайте ниже!
					
					
					case 'textarea':  
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label><br><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="30" rows="6">'.$meta.'</textarea> 
							<br /><span class="description">'.$field['desc'].'</span></th>';  
					break;
					case 'checkbox':  
						echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
							<label for="'.$field['id'].'">'.$field['desc'].'</label><br></td>';  
					break;
					// Всплывающий список  
					case 'select':  
						echo '<th><option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
						echo '</select></th>';  
					break;
					case 'text': 
						$collt="30";
						if ($field['id'] == "on_exlusive_post_data_realise") { $collt="17"; $datapiker_print="class='datepicker'"; } else { $datapiker_print=""; }
						if ($field['id'] == "on_exlusive_post_members") { $type_on="number"; $collt="15"; } else { $type_on="text"; }
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label> <input type="'.$type_on.'" '.$datapiker_print.' name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="'.$collt.'" /></th>';
					break;
                }
        echo '</tr>';  
    }  
    echo '</table>'; 
}



// Пишем функцию для сохранения СОбытий
function on_exlusive_posts_save_meta_fields($post_id) {
    global $meta_fields_exlusive_posts;  // Массив с нашими полями
 
    // проверяем наш проверочный код 
    if (!wp_verify_nonce($_POST['on_exlusive_posts_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // Проверяем авто-сохранение 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // Проверяем права доступа  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
 
    // Если все отлично, прогоняем массив через foreach
    foreach ($meta_fields_exlusive_posts as $field) {  
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }  
    } // end foreach  
}  
add_action('save_post', 'on_exlusive_posts_save_meta_fields'); // Запускаем функцию сохранения













##################
// Дополнительные поля в записях РЕЗЮМЕ
##################

// Добавляем дополнительное поле
function status_resume_box() {  
    add_meta_box(  
        'status_resume_box', // Идентификатор(id)
        'Дополнительные параметры', // Заголовок области с мета-полями(title)
        'show_resume_metabox', // Вызов(callback)
        'resume', // Где будет отображаться наше поле, в нашем случае в Записях
        'normal', 
        'high');
}  
add_action('add_meta_boxes', 'status_resume_box'); // Запускаем функцию

// Создаем новые поля
$meta_fields_resume = array(  
    array(  
        'label' => 'Имя',  
        'desc'  => '',  
        'id'    => 'on_resume_imya', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Отчество',  
        'desc'  => '',  
        'id'    => 'on_resume_otchestvo', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Фамилия',
        'desc'  => '',  
        'id'    => 'on_resume_familia', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Дата рождения',  
        'desc'  => '',  
        'id'    => 'on_resume_dataday', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ), /*
	array(  
        'label' => 'месяц рождения',  
        'desc'  => '',  
        'id'    => 'on_resume_month', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Год рождения',
        'desc'  => '',  
        'id'    => 'on_resume_year', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ), */
	array(  
        'label' => 'Город проживания',
        'desc'  => '',  
        'id'    => 'on_resume_city', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Страна проживания',
        'desc'  => '',  
        'id'    => 'on_resume_land', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Гражданство',
        'desc'  => '',  
        'id'    => 'on_resume_grajdanstvo', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Стаж',
        'desc'  => '',  
        'id'    => 'on_resume_stage', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Опыт работы (да/нет)',
        'desc'  => '',  
        'id'    => 'on_resume_jelanie_opit_da_net', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Желаемая должность',
        'desc'  => '',  
        'id'    => 'on_resume_jelanie_rang', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Зарплата от',
        'desc'  => '',  
        'id'    => 'on_resume_jelanie_zp_ot', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Зарплата до',
        'desc'  => '',  
        'id'    => 'on_resume_jelanie_zp_do', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Валюта',
        'desc'  => '',  
        'id'    => 'on_resume_jelanie_zp_valuta', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Профессиональная область',
        'desc'  => '',  
        'id'    => 'on_resume_profobl', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Навыки',
        'desc'  => '',  
        'id'    => 'on_resume_naviki', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Занятость',
        'desc'  => '',  
        'id'    => 'on_resume_zanyatost', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Тип Работы',
        'desc'  => '',  
        'id'    => 'on_resume_typework', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Учебные заведения',
        'desc'  => '',  
        'id'    => 'on_resume_ucheb_zaveden', // даем идентификатор.
        'type'  => 'textarea'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Языки',
        'desc'  => '',  
        'id'    => 'on_resume_langs', // даем идентификатор.
        'type'  => 'textarea'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Инор',
        'desc'  => '',  
        'id'    => 'on_resume_infor', // даем идентификатор.
        'type'  => 'textarea'  // Указываем тип поля.
    )
);


// Вызов метаполей  
function show_resume_metabox() {  
global $meta_fields_resume; // Обозначим наш массив с полями глобальным
global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
echo '<input type="hidden" name="on_resume_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />'; 
	
    // Начинаем выводить таблицу с полями через цикл
//    echo '<style>.switch-html, .misc-pub-post-status, .misc-pub-visibility, .edit-timestamp, #submitdiv .button-link, #submitdiv h2, #wp-content-editor-tools { display: none!important; }</style> <table class="form-table">';  
	  echo '<table class="form-table">';
	  
    foreach ($meta_fields_resume as $field) {  
        // Получаем значение если оно есть для этого поля 
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // Начинаем выводить таблицу
        echo '<tr>';  
								
                switch($field['type']) {  
                    // Выводить поля будем здесь, как это сделать читайте ниже!
					
					
					case 'textarea':  
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label><br><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="30" rows="6">'.$meta.'</textarea> 
							<br /><span class="description">'.$field['desc'].'</span></th>';  
					break;
					case 'checkbox':  
						echo '<td><input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
							<label for="'.$field['id'].'">'.$field['desc'].'</label></td>';  
					break;
					// Всплывающий список  
					case 'select':  
						echo '<th><option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
						echo '</select></th>';  
					break;
					case 'text': 
						$collt="30";
						if ($field['id'] == "on_game_data_realise") { $collt="17"; $datapiker_print="class='datepicker'"; } else { $datapiker_print=""; }
						if ($field['id'] == "on_game_members") { $type_on="number"; $collt="15"; } 
						elseif ($field['id'] == "on_game_data_realise_int") { $type_on="hidden"; } else { $type_on="text"; }
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label> <input type="'.$type_on.'" '.$datapiker_print.' name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="'.$collt.'" /></th>';
					break;
                }
        echo '</tr>';  
    }  
    echo '</table>'; 
}



// Пишем функцию для сохранения СОбытий
function on_resume_save_meta_fields($post_id) {
    global $meta_fields_resume;  // Массив с нашими полями
 
    // проверяем наш проверочный код 
    if (!wp_verify_nonce($_POST['on_resume_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // Проверяем авто-сохранение 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // Проверяем права доступа  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }
    // Если все отлично, прогоняем массив через foreach
    foreach ($meta_fields_resume as $field) {  
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }  
    } // end foreach  
}  
add_action('save_post', 'on_resume_save_meta_fields', 10); // Запускаем функцию сохранения
















##################
// Дополнительные поля в записях Вакансии
##################

// Добавляем дополнительное поле
function status_vacancy_box() {  
    add_meta_box(  
        'status_vacancy_box', // Идентификатор(id)
        'Дополнительные параметры', // Заголовок области с мета-полями(title)
        'show_vacancy_metabox', // Вызов(callback)
        'vacancies', // Где будет отображаться наше поле, в нашем случае в Записях
        'normal', 
        'high');
}  
add_action('add_meta_boxes', 'status_vacancy_box'); // Запускаем функцию

// Создаем новые поля
$meta_fields_vacancy = array(  
	array(  
        'label' => 'Уровень ЗП от',  
        'desc'  => '',  
        'id'    => 'on_vacancy_zp_ot', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Уровень ЗП до',  
        'desc'  => '',  
        'id'    => 'on_vacancy_zp_do', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Валюта',  
        'desc'  => '',  
        'id'    => 'on_vacancy_valuta',  
        'type'  => 'select',  
        'options' => array (  // Параметры, всплывающие данные
            'one' => array (  
                'label' => 'руб',  // Название поля
                'value' => '1'  // Значение
            ),  
            'two' => array (  
                'label' => '$',  // Название поля
                'value' => '2'  // Значение
            ) 
        )  
    ),
	array(  
        'label' => 'ID Компании',  
        'desc'  => '',  
        'id'    => 'on_vacancy_id_company', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Проф.деятельность',  
        'desc'  => '',  
        'id'    => 'on_vacancy_prof_deyat', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Опыт',  
        'desc'  => '',  
        'id'    => 'on_vacancy_opit', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'ОБразование',  
        'desc'  => '',  
        'id'    => 'on_vacancy_obrazovalie', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Занятость',  
        'desc'  => '',  
        'id'    => 'on_vacancy_zanyatost', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Тип.Работы',  
        'desc'  => '',  
        'id'    => 'on_vacancy_typework', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Страна',  
        'desc'  => '',  
        'id'    => 'on_vacancy_city', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Город',  
        'desc'  => '',  
        'id'    => 'on_vacancy_city', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    )
);


// Вызов метаполей  
function show_vacancy_metabox() {  
global $meta_fields_vacancy; // Обозначим наш массив с полями глобальным
global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
echo '<input type="hidden" name="on_vacancy_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />'; 
	
    // Начинаем выводить таблицу с полями через цикл
//    echo '<style>.switch-html, .misc-pub-post-status, .misc-pub-visibility, .edit-timestamp, #submitdiv .button-link, #submitdiv h2, #wp-content-editor-tools { display: none!important; }</style> <table class="form-table">';  
	  echo '<table class="form-table">';
	  
    foreach ($meta_fields_vacancy as $field) {  
        // Получаем значение если оно есть для этого поля 
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // Начинаем выводить таблицу
        echo '<tr>';  
								
                switch($field['type']) {  
                    // Выводить поля будем здесь, как это сделать читайте ниже!
					
					
					case 'textarea':  
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label><br><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="30" rows="6">'.$meta.'</textarea> 
							<br /><span class="description">'.$field['desc'].'</span></th>';  
					break;
					case 'checkbox':  
						echo '<td><input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
							<label for="'.$field['id'].'">'.$field['desc'].'</label></td>';  
					break;
					// Всплывающий список  
					case 'select':  
						echo '<th><option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
						echo '</select></th>';  
					break;
					case 'text': 
						$collt="30";
						if ($field['id'] == "on_game_data_realise") { $collt="17"; $datapiker_print="class='datepicker'"; } else { $datapiker_print=""; }
						if ($field['id'] == "on_game_members") { $type_on="number"; $collt="15"; } 
						elseif ($field['id'] == "on_game_data_realise_int") { $type_on="hidden"; } else { $type_on="text"; }
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label> <input type="'.$type_on.'" '.$datapiker_print.' name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="'.$collt.'" /></th>';
					break;
                }
        echo '</tr>';  
    }  
    echo '</table>'; 
}



// Пишем функцию для сохранения СОбытий
function on_vacancy_save_meta_fields($post_id) {
    global $meta_fields_vacancy;  // Массив с нашими полями
 
    // проверяем наш проверочный код 
    if (!wp_verify_nonce($_POST['on_vacancy_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // Проверяем авто-сохранение 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // Проверяем права доступа  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }
    // Если все отлично, прогоняем массив через foreach
    foreach ($meta_fields_vacancy as $field) {  
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }  
    } // end foreach  
}  
add_action('save_post', 'on_vacancy_save_meta_fields', 10); // Запускаем функцию сохранения














##################
// Дополнительные поля в записях Компании
##################

// Добавляем дополнительное поле
function status_company_box() {  
    add_meta_box(  
        'status_company_box', // Идентификатор(id)
        'Дополнительные параметры', // Заголовок области с мета-полями(title)
        'show_company_metabox', // Вызов(callback)
        'company', // Где будет отображаться наше поле, в нашем случае в Записях
        'normal', 
        'high');
}  
add_action('add_meta_boxes', 'status_company_box'); // Запускаем функцию

// Создаем новые поля
$meta_fields_company = array(  
	array(  
        'label' => 'Имя',  
        'desc'  => '',  
        'id'    => 'on_company_imya', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Фамилия',  
        'desc'  => '',  
        'id'    => 'on_company_familia', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Отчество',  
        'desc'  => '',  
        'id'    => 'on_company_otchestvo', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Телефон',  
        'desc'  => '',  
        'id'    => 'on_company_phone', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Email',  
        'desc'  => '',  
        'id'    => 'on_company_email', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Web сайт',  
        'desc'  => '',  
        'id'    => 'on_company_website', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Кол-во сотрудников',  
        'desc'  => '',  
        'id'    => 'on_company_kolvo_sotrud', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Страна',  
        'desc'  => '',  
        'id'    => 'on_company_land', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Город',  
        'desc'  => '',  
        'id'    => 'on_company_city', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Проф.Область',  
        'desc'  => '',  
        'id'    => 'on_company_prof_obl', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Пароль',  
        'desc'  => '',  
        'id'    => 'on_company_password', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Должность',  
        'desc'  => '',  
        'id'    => 'on_company_rang_input', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    )
);


// Вызов метаполей  
function show_company_metabox() {  
global $meta_fields_company; // Обозначим наш массив с полями глобальным
global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
echo '<input type="hidden" name="on_company_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />'; 
	
    // Начинаем выводить таблицу с полями через цикл
//    echo '<style>.switch-html, .misc-pub-post-status, .misc-pub-visibility, .edit-timestamp, #submitdiv .button-link, #submitdiv h2, #wp-content-editor-tools { display: none!important; }</style> <table class="form-table">';  
	  echo '<table class="form-table">';
	  
    foreach ($meta_fields_company as $field) {  
        // Получаем значение если оно есть для этого поля 
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // Начинаем выводить таблицу
        echo '<tr>';  
								
                switch($field['type']) {  
                    // Выводить поля будем здесь, как это сделать читайте ниже!
					
					
					case 'textarea':  
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label><br><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="30" rows="6">'.$meta.'</textarea> 
							<br /><span class="description">'.$field['desc'].'</span></th>';  
					break;
					case 'checkbox':  
						echo '<td><input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
							<label for="'.$field['id'].'">'.$field['desc'].'</label></td>';  
					break;
					// Всплывающий список  
					case 'select':  
						echo '<th><option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
						echo '</select></th>';  
					break;
					case 'text': 
						$collt="30";
						if ($field['id'] == "on_game_data_realise") { $collt="17"; $datapiker_print="class='datepicker'"; } else { $datapiker_print=""; }
						if ($field['id'] == "on_game_members") { $type_on="number"; $collt="15"; } 
						elseif ($field['id'] == "on_game_data_realise_int") { $type_on="hidden"; } else { $type_on="text"; }
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label> <input type="'.$type_on.'" '.$datapiker_print.' name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="'.$collt.'" /></th>';
					break;
                }
        echo '</tr>';  
    }  
    echo '</table>'; 
}



// Пишем функцию для сохранения Компании
function on_company_save_meta_fields($post_id) {
    global $meta_fields_company;  // Массив с нашими полями
 
    // проверяем наш проверочный код 
    if (!wp_verify_nonce($_POST['on_company_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // Проверяем авто-сохранение 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // Проверяем права доступа  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }
    // Если все отлично, прогоняем массив через foreach
    foreach ($meta_fields_company as $field) {  
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }  
    } // end foreach  
}  
add_action('save_post', 'on_company_save_meta_fields', 10); // Запускаем функцию сохранения















##################
// Дополнительные поля в записях ПОРТФОЛИО
##################

// Добавляем дополнительное поле
function status_portfolio_box() {  
    add_meta_box(  
        'status_portfolio_box', // Идентификатор(id)
        'Дополнительные параметры', // Заголовок области с мета-полями(title)
        'show_portfolio_metabox', // Вызов(callback)
        'portfolio', // Где будет отображаться наше поле, в нашем случае в Записях
        'normal', 
        'high');
}  
add_action('add_meta_boxes', 'status_portfolio_box'); // Запускаем функцию

// Создаем новые поля
$meta_fields_portfolio = array(  
	array(  
        'label' => 'Год создания',  
        'desc'  => '',  
        'id'    => 'on_portfolio_data', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'Облако навыков',  
        'desc'  => '',  
        'id'    => 'on_portfolio_naviki', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
	array(  
        'label' => 'ID резюме',  
        'desc'  => '',  
        'id'    => 'on_portfolio_id_resume', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    )
);


// Вызов метаполей  
function show_portfolio_metabox() {  
global $meta_fields_portfolio; // Обозначим наш массив с полями глобальным
global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
echo '<input type="hidden" name="on_portfolio_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />'; 
	
    // Начинаем выводить таблицу с полями через цикл
//    echo '<style>.switch-html, .misc-pub-post-status, .misc-pub-visibility, .edit-timestamp, #submitdiv .button-link, #submitdiv h2, #wp-content-editor-tools { display: none!important; }</style> ';  
	  echo '<table class="form-table">';
	
    foreach ($meta_fields_portfolio as $field) {  
        // Получаем значение если оно есть для этого поля 
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // Начинаем выводить таблицу
        echo '<tr>';  
								
                switch($field['type']) {  
                    // Выводить поля будем здесь, как это сделать читайте ниже!
					
					
					case 'textarea':  
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label><br><textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="30" rows="6">'.$meta.'</textarea> 
							<br /><span class="description">'.$field['desc'].'</span></th>';  
					break;
					case 'checkbox':  
						echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
							<label for="'.$field['id'].'">'.$field['desc'].'</label></td>';  
					break;
					// Всплывающий список  
					case 'select':  
						echo '<th><option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
						echo '</select></th>';  
					break;
					case 'text': 
						$collt="30";
						if ($field['id'] == "on_portfolio_data_start") { $collt="17"; $datapiker_print="class='datepicker'"; } else { $datapiker_print=""; }
						if ($field['id'] == "on_portfolio_members") { $type_on="number"; $collt="15"; } 
							elseif ($field['id'] == "on_portfolio_data_start_int") { $type_on="hidden"; } 
							else { $type_on="text"; }
						echo '<th><label for="'.$field['id'].'">'.$field['label'].'</label> <input type="'.$type_on.'" '.$datapiker_print.' name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="'.$collt.'" /></th>';
					break;
                }
        echo '</tr>';  
    }  
    echo '</table>'; 
}



// Пишем функцию для сохранения СОбытий
function on_portfolio_save_meta_fields($post_id) {
    global $meta_fields_portfolio;  // Массив с нашими полями
 
    // проверяем наш проверочный код 
    if (!wp_verify_nonce($_POST['on_portfolio_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // Проверяем авто-сохранение 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // Проверяем права доступа  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
	
	//Записываем дату
	if ($_POST['on_portfolio_data_start']!="") { $date_num = explode(".", $_POST['on_portfolio_data_start']); $_POST['on_portfolio_data_start_int'] = $date_num[2].$date_num[1].$date_num[0]; }
 
    // Если все отлично, прогоняем массив через foreach
    foreach ($meta_fields_portfolio as $field) {  
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }  
    } // end foreach  
}  
add_action('save_post', 'on_portfolio_save_meta_fields'); // Запускаем функцию сохранения














// Вызываем функцию
datepicker_js();

/**
 * скрипт выбора даты datepicker
 * version: 1
 */
function datepicker_js(){
	// подключаем все необходимые скрипты: jQuery, jquery-ui, datepicker
	wp_enqueue_script('jquery-ui-datepicker');

	// подключаем нужные css стили
	wp_enqueue_style('jqueryui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css', false, null );

	// инициализируем datepicker
	if( is_admin() )
		add_action('admin_footer', 'init_datepicker', 99 ); // для админки
	else
		add_action('wp_footer', 'init_datepicker', 99 ); // для админки

	function init_datepicker(){
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			'use strict';
			// настройки по умолчанию. Их можно добавить в имеющийся js файл, 
			// если datepicker будет использоваться повсеместно на проекте и предполагается запускать его с разными настройками
			$.datepicker.setDefaults({
				closeText: 'Закрыть',
				prevText: '<Пред',
				nextText: 'След>',
				currentText: 'Сегодня',
				monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
				monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
				dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
				dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
				dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
				weekHeader: 'Нед',
				dateFormat: 'dd-mm-yy',
				firstDay: 1,
				showAnim: 'slideDown',
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: ''
			} );

			// Инициализация
//			$('input[name*="date"], .datepicker').datepicker({ dateFormat: 'dd.mm.yy' });
			$('.datepicker').datepicker({ dateFormat: 'dd.mm.yy' });
			$('.datepicker-filter').datepicker({ dateFormat: 'dd.mm.yy' });
			// можно подключить datepicker с доп. настройками так:
			/*
			$('input[name*="date"]').datepicker({ 
				dateFormat : 'yy-mm-dd',
				onSelect : function( dateText, inst ){
		// функцию для поля где указываются еще и секунды: 000-00-00 00:00:00 - оставляет секунды
		var secs = inst.lastVal.match(/^.*?\s([0-9]{2}:[0-9]{2}:[0-9]{2})$/);
		secs = secs ? secs[1] : '00:00:00'; // только чч:мм:сс, оставим часы минуты и секунды как есть, если нет то будет 00:00:00
		$(this).val( dateText +' '+ secs );
				}
			});
			*/          
		});
		</script>
		<?php
	}
}

/* Подсчет количества посещений страниц
---------------------------------------------------------- */
add_action('wp_head', 'kama_postviews');
function kama_postviews() {

/* ------------ Настройки -------------- */
$meta_key       = 'views';  // Ключ мета поля, куда будет записываться количество просмотров.
$who_count      = 0;            // Чьи посещения считать? 0 - Всех. 1 - Только гостей. 2 - Только зарегистрированных пользователей.
$exclude_bots   = 1;            // Исключить ботов, роботов, пауков и прочую нечесть :)? 0 - нет, пусть тоже считаются. 1 - да, исключить из подсчета.

global $user_ID, $post;
	if(is_singular()) {
		$id = (int)$post->ID;
		static $post_views = false;
		if($post_views) return true; // чтобы 1 раз за поток
		$post_views = (int)get_post_meta($id,$meta_key, true);
		$should_count = false;
		switch( (int)$who_count ) {
			case 0: $should_count = true;
				break;
			case 1:
				if( (int)$user_ID == 0 )
					$should_count = true;
				break;
			case 2:
				if( (int)$user_ID > 0 )
					$should_count = true;
				break;
		}
		if( (int)$exclude_bots==1 && $should_count ){
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			$notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - все равны Mozilla
			$bot = "Bot/|robot|Slurp/|yahoo"; //Яндекс иногда как Mozilla представляется
			if ( !preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent) )
				$should_count = false;
		}

		if($should_count)
			if( !update_post_meta($id, $meta_key, ($post_views+1)) ) add_post_meta($id, $meta_key, 1, true);
	}
	return true;
}










// Видео с ЮТУБА
function cwc_youtube($atts) {
	extract(shortcode_atts(array(
		"value" => '',
		"width" => '475',
		"height" => '350',
		"name"=> 'movie',
		"allowFullScreen" => 'true',
		"allowScriptAccess"=>'always',
	), $atts));
	return '<object style="height: '.$height.'px; width: '.$width.'px">
				<param name="'.$name.'" value="'.$value.'">
				<param name="allowFullScreen" value="'.$allowFullScreen.'">
				<param name="allowScriptAccess" value="'.$allowScriptAccess.'">
				<embed 
					src="'.$value.'" 
					type="application/x-shockwave-flash" 
					allowfullscreen="'.$allowFullScreen.'" 
					allowScriptAccess="'.$allowScriptAccess.'" 
					width="'.$width.'" 
					height="'.$height.'">
				</embed>
			</object>';
}
add_shortcode("youtube", "cwc_youtube");








	// Волкер для списка таксономий для фильтров
	class TaxFilWalker extends Walker_Category { 
		function start_el(&$output, $item, $depth=0, $args=array()) {
		//	print_r($item);			
			$output .= "\n<option value='".esc_attr($item->name)."'>".esc_attr($item->name)."</option>";
		}  

		function end_el(&$output, $item, $depth=0, $args=array()) {  
			$output .= "";  
		}  
	} 



	
/* Breadcrumb */
function the_breadcrumb() {
	/* echo 'You are here: '; */
	echo '<div class="breadcrumbs">';
	if (!is_front_page()) {
		echo '<a href="';
		echo get_option('home');
		echo '">Главная';
		echo '</a> <span class="sep">-</span> ';
		if (is_category() || is_single()) {
			/* echo '<span class="current">';  */
			the_category(' ');
			if (is_single()) {
				echo '<span class="current">';
				the_title();
				echo '</span>'; 
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}
	else {
		echo '<span class="current">Главная</li></span>';
	}
	echo '</div>';
}




/*

Кстати, выводить доп фотки для игр можно так:
<?php
$images = twp_get_post_images(get_the_ID());
foreach ($images as $im) {
$thumb_url = wp_get_attachment_image_src($im->id, 'thumbnail-size', true);
?>
<a href="<?php echo $thumb_url[0]; ?>" class="fancybox" rel="group">
<img src="<?php echo $thumb_url[0]; ?>">
</a>
<?php
}
?>

*/






####  ВИДЖЕТ ПОСЛЕДНИЕ ПОСТЫ
class trueTopPostsWidget extends WP_Widget {
 
	/*
	 * создание виджета
	 */
	function __construct() {
		parent::__construct(
			'true_top_widget', 
			'Последние посты - VIRTUA-THEME', // заголовок виджета
			array( 'description' => 'Позволяет вывести посты, последние.' ) // описание
		);
	}
 
	/*
	 * фронтэнд виджета
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] ); // к заголовку применяем фильтр (необязательно)
		$posts_per_page = $instance['posts_per_page'];
 
		echo $args['before_widget'];
 
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
 
		$q = new WP_Query("posts_per_page=$posts_per_page&orderby=date");
		if( $q->have_posts() ):
			?><ul class="recents"><?php
			while( $q->have_posts() ): $q->the_post();
				?>
					<li>
						<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
							<a href="<?php the_permalink() ?>" class="alignleft">
								<?php the_post_thumbnail('widget-post-thumb'); ?>
							</a>
						<?php endif; ?>
						<div class="recents__title">
							<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
						</div>
						<div class="date"><?php echo get_the_date(); ?></div>
					</li>
				<?php
			endwhile;
			?></ul>
							<div class="more">
								<a href="<? echo get_category_link( '42' ); ?>" class="more__link">Больше новостей</a>
							</div>
			<?php
		endif;
		wp_reset_postdata();
 
		echo $args['after_widget'];
	}
 
	/*
	 * бэкэнд виджета
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		if ( isset( $instance[ 'posts_per_page' ] ) ) {
			$posts_per_page = $instance[ 'posts_per_page' ];
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">Количество постов:</label> 
			<input id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" type="text" value="<?php echo ($posts_per_page) ? esc_attr( $posts_per_page ) : '5'; ?>" size="3" />
		</p>
		<?php 
	}
 
	/*
	 * сохранение настроек виджета
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['posts_per_page'] = ( is_numeric( $new_instance['posts_per_page'] ) ) ? $new_instance['posts_per_page'] : '5'; // по умолчанию выводятся 5 постов
		return $instance;
	}
}
 
/*
 * регистрация виджета
 */
function true_top_posts_widget_load() {
	register_widget( 'trueTopPostsWidget' );
}
add_action( 'widgets_init', 'true_top_posts_widget_load' );








####  ВИДЖЕТ ГОРЯЧИЕ ПОСТЫ
class trueHotPostsWidget extends WP_Widget {
 
	/*
	 * создание виджета
	 */
	function __construct() {
		parent::__construct(
			'true_hot_widget', 
			'Горячие новости - VIRTUA-THEME', // заголовок виджета
			array( 'description' => 'Позволяет вывести посты, последние.' ) // описание
		);
	}
 
	/*
	 * фронтэнд виджета
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] ); // к заголовку применяем фильтр (необязательно)
		$posts_per_page = $instance['posts_per_page'];
 
	if( !is_front_page() ) {
			echo $args['before_widget'];
	 
			if ( ! empty( $title ) )
				echo $args['before_title'] . $title . $args['after_title'];
	 
			$q = new WP_Query("posts_per_page=$posts_per_page&orderby=date&meta_key=on_hot_news&order=desc");
			if( $q->have_posts() ):
				?><div><?php
				while( $q->have_posts() ): $q->the_post();
					?>
						<div class="scroller__item">
										<a href="<?php the_permalink() ?>" class="scroller__image">
											<?php the_post_thumbnail('exlusive-post-thumb'); ?>
											<div class="scroller__splash">
												<span class="scroller__icon comment-ico"><? echo get_comments_number($q->post->ID); ?></span>
												<span class="scroller__icon view-ico"><? echo get_post_meta($q->post->ID,'views',true); ?></span>
											</div>
										</a>
										<div class="scroller__content">
											<div class="scroller__title">
												<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
											</div>
											<div class="scroller__date"><?php echo get_the_date(); ?></div>
										</div>
						</div>
					<?php
				endwhile;
				?></div>
								<div class="more">
									<a href="<? echo get_category_link( '42' ); ?>" class="more__link">Больше новостей</a>
								</div>
				<?php
			endif;
			wp_reset_postdata();
	 
			echo $args['after_widget'];
		}
	}
 
	/*
	 * бэкэнд виджета
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		if ( isset( $instance[ 'posts_per_page' ] ) ) {
			$posts_per_page = $instance[ 'posts_per_page' ];
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">Количество постов:</label> 
			<input id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" type="text" value="<?php echo ($posts_per_page) ? esc_attr( $posts_per_page ) : '5'; ?>" size="3" />
		</p>
		<?php 
	}
 
	/*
	 * сохранение настроек виджета
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['posts_per_page'] = ( is_numeric( $new_instance['posts_per_page'] ) ) ? $new_instance['posts_per_page'] : '5'; // по умолчанию выводятся 5 постов
		return $instance;
	}
}
 
/*
 * регистрация виджета
 */
function true_hot_posts_widget_load() {
	register_widget( 'trueHotPostsWidget' );
}
add_action( 'widgets_init', 'true_hot_posts_widget_load' );











####  ВИДЖЕТ БЛИЖАЙШЕЕ СОБЫТИЕ
class trueEvwentNowWidget extends WP_Widget {
 
	/*
	 * создание виджета
	 */
	function __construct() {
		parent::__construct(
			'true_event_now_widget', 
			'Ближайшее событие - VIRTUA-THEME', // заголовок виджета
			array( 'description' => 'Позволяет вывести посты, последние.' ) // описание
		);
	}
 
	/*
	 * фронтэнд виджета
	 */
	public function widget( $args, $instance ) {
 
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		
									$date_now = date("Ymd");
									$args_event = array(
									   'post_type' => 'events',
									   'publish' => true,
									   'posts_per_page' => 1,
									   'meta_key' => 'on_event_data_start_int',
									   'orderby' => 'meta_value_num',
									   'order' => 'ASC',
									   'meta_query' => array(
															   array(
																	'key' => 'on_event_data_start_int',
																	'value' => $date_now,
																	'compare' => '>=',
															   )
														   )
								    );
		
		$q = new WP_Query($args_event);
		if( $q->have_posts() ):
			while( $q->have_posts() ): $q->the_post();
			
				$title = apply_filters( 'widget_title', $instance['title'] ); // к заголовку применяем фильтр (необязательно)
				echo $args['before_widget'];
				
				?>
					<div class="event">
								<div class="event__title">
									<a href="<?php the_permalink() ?>"><?php the_title() ?> </a>
								</div>
								<a href="<?php the_permalink() ?>">
									<?php 
																	if( has_post_thumbnail($q->post->ID) ) { the_post_thumbnail('afisha-event-thumb'); }
																	else { echo '<img src="'.get_bloginfo("template_url").'/images/no-events.jpg" class="posts__thumbnail news__thumbnail" />'; }
									?>
								</a>
								<div class="event__desc">
									<? the_excerpt(); ?>
								</div>
								<div class="event__data">
									<strong>Начало:</strong> в <?php echo get_post_meta ($q->post->ID,'on_event_time_start',true); ?> <strong> Участников:</strong> <?php echo get_post_meta ($q->post->ID,'on_event_members',true); ?>
								</div>
					</div>
				<?php
			endwhile;
		endif;
		wp_reset_postdata();
 
		echo $args['after_widget'];
	}
 
	/*
	 * бэкэнд виджета
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		if ( isset( $instance[ 'posts_per_page' ] ) ) {
			$posts_per_page = $instance[ 'posts_per_page' ];
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
 
	/*
	 * сохранение настроек виджета
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['posts_per_page'] = ( is_numeric( $new_instance['posts_per_page'] ) ) ? $new_instance['posts_per_page'] : '5'; // по умолчанию выводятся 5 постов
		return $instance;
	}
}




// Коментарии от ДИСКУСА
function disqus_embed($disqus_shortname) {
    global $post;
    wp_enqueue_script('disqus_embed', 'https://'.$disqus_shortname.'.disqus.com/embed.js');
    echo '<div id="disqus_thread"></div>
    <script type="text/javascript">
        var disqus_shortname = "'.$disqus_shortname.'";
        var disqus_title = "'.$post->post_title.'";
        var disqus_url = "'.get_permalink($post->ID).'";
        var disqus_identifier = "'.$disqus_shortname.'-'.$post->ID.'";
    </script>';
}





// Настройка облако тегов
add_filter('widget_tag_cloud_args', 'vr_tag_cloud');
function vr_tag_cloud($args)  {
	$args = array(
	'smallest' => 10, 
	'largest' => 32, 
	'unit' => 'px',
	'number' => 25,
	'format' => 'flat', 
	'separator' => '', 
	'orderby' => 'count', 
	'order' => 'DESC',
	'exclude' => '', 
	'include' => '', 
	'link' => 'view',
	'taxonomy' => 'post_tag',
	'echo' => 0
	); 
	return $args;
}







// Для СЕО
class trueTaxonomyMetaBox {
	private $opt;
	private $prefix;

	function __construct( $option ) {
		$this->opt    = (object) $option;
		$this->prefix = $this->opt->id .'_'; // префикс настроек

		foreach( $this->opt->taxonomy as $taxonomy ){
			add_action( $taxonomy . '_edit_form_fields', array( &$this, 'fill'), 10, 2 ); // хук добавления полей
		}

		// установим таблицу в $wpdb, если её нет
		global $wpdb;
		if( ! isset( $wpdb->termmeta ) ) $wpdb->termmeta = $wpdb->prefix .'termmeta';

		add_action('edit_term', array( &$this, 'save'), 10, 1 ); // хук сохранения значений полей
	}

	function fill( $term, $taxonomy ){

		foreach( $this->opt->args as $param ){
			$def   = array('id'=>'', 'title'=>'', 'type'=>'', 'desc'=>'', 'std'=>'', 'args'=>array() );
			$param = (object) array_merge( $def, $param );

			$meta_key   = $this->prefix . $param->id;
			$meta_value = get_metadata('term', $term->term_id, $meta_key, true ) ?: $param->std;
			
			if ($meta_key == "txseo_seo_title") { echo '<tr class ="form-field"><th scope="row"><h2> =====  SEO  ===== </h2></th><td></td></tr>'; }

			echo '<tr class ="form-field">';
				echo '<th scope="row"><label for="'. $meta_key .'">'. $param->title .'</label></th>';
				echo '<td>';

				// select
		if( $param->type == 'wp_editor' ){
		  wp_editor( $meta_value, $meta_key, array(
			'wpautop' => 1,
			'media_buttons' => false,
			'textarea_name' => $meta_key, //нужно указывать!
			'textarea_rows' => 10,
			//'tabindex'      => null,
			//'editor_css'    => '',
			//'editor_class'  => '',
			'teeny'         => 0,
			'dfw'           => 0,
			'tinymce'       => 1,
			'quicktags'     => 1,
			//'drag_drop_upload' => false
		  ) );
		}
		// select
				elseif( $param->type == 'select' ){
					echo '<select name="'. $meta_key .'" id="'. $meta_key .'">
							<option value="">...</option>';

							foreach( $param->args as $val => $name ){
								echo '<option value="'. $val .'" '. selected( $meta_value, $val, 0 ) .'>'. $name .'</option>';
							}
					echo '</select>';
					if( $param->desc ) echo '<p class="description">' . $param->desc . '</p>';
				}
				// checkbox
				elseif( $param->type == 'checkbox' ){
					echo '
						<label>
							<input type="hidden" name="'. $meta_key .'" value="">
							<input name="'. $meta_key .'" type="'. $param->type .'" id="'. $meta_key .'" '. checked( $meta_value, 'on', 0) .'>
							'. $param->desc .'
						</label>
					';
				}
				// textarea
				elseif( $param->type == 'textarea' ){
					if ($meta_key == "txseo_seo_description") {
							echo '<textarea name="'. $meta_key .'" type="'. $param->type .'" id="'. $meta_key .'" value="'. $meta_value .'" class="large-text">'. esc_html( $meta_value ) .'</textarea>';                    
							if( $param->desc ) echo '<p class="description">' . $param->desc . '</p>';
					} else {
						wp_editor( $meta_value, $meta_key, array('textarea_name' => $meta_key, 'textarea_rows' => 10, 'drag_drop_upload' => true, 'media_buttons' => true, 'teeny' => 0, 'dfw'  > 0, 'tinymce' => 1, 'quicktags' => 1 ) ); 
					}
					
				}
				// text
				else{
					echo '<input name="'. $meta_key .'" type="'. $param->type .'" id="'. $meta_key .'" value="'. $meta_value .'" class="regular-text">';

					if( $param->desc ) echo '<p class="description">' . $param->desc . '</p>';
				}
				echo '</td>';
			echo '</tr>';         
		}

	}

	function save( $term_id ){
		foreach( $this->opt->args as $field ){
			$meta_key = $this->prefix . $field['id'];
			if( ! isset($_POST[ $meta_key ]) ) continue;

			if( $meta_value = trim($_POST[ $meta_key ]) ){
				update_metadata('term', $term_id, $meta_key, $meta_value, '');
			}
			else {
				delete_metadata('term', $term_id, $meta_key, '', false );
			}
		}
	}

}

add_action('init', 'register_additional_term_fields');
function register_additional_term_fields(){ 
	new trueTaxonomyMetaBox( array(
		'id'       => 'txseo', // id играет роль префикса названий полей
		'taxonomy' => array('post_tag','category', 'games-ustroistva', 'games-genre', 'games-razrab', 'games-izdatel', 'games-platform', 'games-year', 'game-service'), // названия таксономий, для которых нужно добавить ниже перечисленные поля
		'args'     => array(
			array(
				'id'    => 'seo_title', // атрибуты name и id без префикса, получится "txseo_seo_title"
				'title' => 'SEO Заголовок',
				'type'  => 'text',
				'desc'  => 'Укажите альтернативное название термина для SEO.',
				'std'   => '', // по умолчанию
			),
			array(
				'id'    => 'seo_description',
				'title' => 'SEO Описание',
				'type'  => 'textarea',
				'desc'  => 'meta тег description.',
				'std'   => '', // по умолчанию
			),
			array(
				'id'    => 'seo_keywords',
				'title' => 'SEO Keywords',
				'type'  => 'text',
				'desc'  => 'meta тег keywords.',
				'std'   => '', // по умолчанию
			),
			array(
				'id'    => 'seo_top_description',
				'title' => 'Верхнее Описание',
				'type'  => 'textarea',
				'desc'  => 'Верхнее Описание',
				'std'   => '', // по умолчанию
			),
			array(
				'id'    => 'seo_down_description',
				'title' => 'Нижнее Описание',
				'type'  => 'textarea',
				'desc'  => 'Верхнее Описание',
				'std'   => '', // по умолчанию
			)
		)
	) );
}

add_filter('aioseop_description', 'add_taxseo_head_meta_fields');
function add_taxseo_head_meta_fields($descr){
if (is_tag() or is_category() or is_tax()) {
	if( ! is_tax() && ! is_category() && ! is_tag() ) return; // выходим если не таксы
	$term = get_queried_object();
	$descr = get_metadata('term', $term->term_id, 'txseo_seo_description', 1 );
}
	return $descr;
} 

//apply_filters( 'wp_title', $title, $sep, $seplocation );
add_filter('aioseop_title', 'add_taxseo_wp_title', 5, 3);
function add_taxseo_wp_title( $title, $sep, $seplocation ){

	if( ! is_tax() && ! is_category() && ! is_tag() ) return $title; // выходим если не таксы
	$term = get_queried_object();
	$title = get_metadata('term', $term->term_id, 'txseo_seo_title', 1 );

	return esc_html( $title );
} 

add_filter('aioseop_keywords', 'add_taxseo_wp_keywords', 5, 3);
function add_taxseo_wp_keywords( $title, $sep, $seplocation ){
	if( ! is_tax() && ! is_category() && ! is_tag() ) return $title; // выходим если не таксы

	$term = get_queried_object();
	$keywords = get_metadata('term', $term->term_id, 'txseo_seo_keywords', 1 );

	return esc_html( $keywords );
} 
 










 
/*
 * регистрация виджета
 */
function true_event_now_widget_load() {
	register_widget( 'trueEvwentNowWidget' );
}
add_action( 'widgets_init', 'true_event_now_widget_load' );





// Поиск только по Записям
function searchExcludePages($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post, resume, vacancies');
	}
 
	return $query;
}
 
// add_filter('pre_get_posts','searchExcludePages');




/* МЕНЯЕМ КОЛ_ВО ПОСТОВ НА СТРАНИЦАХ ТАКСОНОМИИ платформы */
function custom_posts_per_page($query){
    
 //       $query->set('posts_per_page',3);

}  
add_action('pre_get_posts','custom_posts_per_page');





// Подключаем шорткоды
include_once('functions_short.php');
include_once('functions_calendar.php');
include_once('functions_other.php');

/* меняет кнопку на ПОказать полностью */
function new_excerpt_more($more) {
	return ' <a class="strong" href="'. get_permalink($post->ID) . '">' . '«Показать полностью»' . '</a> ';
}
add_filter('excerpt_more', 'new_excerpt_more');
/**
 * Обрезка текста (excerpt). Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
 *
 * @param (строка/массив) $args Параметры.
 *
 * @return HTML
 * ver 2.6.1
 */
function kama_excerpt( $args = '' ){
	global $post;

	$default = array(
		'maxchar'   => 350,   // количество символов.
		'text'      => '',    // какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
							  // Если есть тег <!--more-->, то maxchar игнорируется и берется все до <!--more--> вместе с HTML
		'autop'     => true,  // Заменить переносы строк на <p> и <br> или нет
		'save_tags' => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'
		'more_text' => '«Показать полностью»', // текст ссылки читать дальше
	);

	if( is_array($args) ) $_args = $args;
	else                  parse_str( $args, $_args );

	$rg = (object) array_merge( $default, $_args );
	if( ! $rg->text ) $rg->text = $post->post_excerpt ?: $post->post_content;
	$rg = apply_filters('kama_excerpt_args', $rg );

	$text = $rg->text;
	$text = preg_replace ('~\[/?.*?\](?!\()~', '', $text ); // убираем шоткоды, например:[singlepic id=3], markdown +
	$text = trim( $text );

	// <!--more-->
	if( strpos( $text, '<!--more-->') ){
		preg_match('/(.*)<!--more-->/s', $text, $mm );

		$text = trim($mm[1]);

		$text_append = ' <a href="'. get_permalink( $post->ID ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
	}
	// text, excerpt, content
	else {
		$text = trim( strip_tags($text, $rg->save_tags) );

		// Обрезаем
		if( mb_strlen($text) > $rg->maxchar ){
			$text = mb_substr( $text, 0, $rg->maxchar );
			$text = preg_replace('~(.*)\s[^\s]*$~s', '\\1 <a class="strong" href="'. get_permalink($post->ID) . '">' . '«Показать полностью»' . '</a>', $text ); // убираем последнее слово, оно 99% неполное
		}
	}

	// Сохраняем переносы строк. Упрощенный аналог wpautop()
/*	if( $rg->autop ){
		$text = preg_replace(
			array("~\r~", "~\n{2,}~", "~\n~",   '~</p><br ?/>~'),
			array('',     '</p><p>',  '<br />', '</p>'),
			$text
		);
	} */

	$text = apply_filters('kama_excerpt', $text, $rg );

	if( isset($text_append) ) $text .= $text_append;

	return ($rg->autop && $text) ? "<p>$text</p>" : $text;
}
/* changelog
 * 2.6 - удалил параметр 'save_format' и заменил его на два параметра 'autop' и 'save_tags'.
 *       Немного изменил логику кода.
 */



// меняем лого
function my_login_logo(){
echo '
<style type="text/css">
#login h1 a { background: url('. get_bloginfo('template_directory') .'/images/logo_header_autoriz.png) no-repeat 0 0 !important; height: 95px; width: 300px; }
body { background: #fff!important; }
</style>';
}
add_action('login_head', 'my_login_logo');

// Меняем URL
add_filter( 'login_headerurl', create_function('', 'return get_home_url();') );
// Меянем надпись
add_filter( 'login_headertitle', create_function('', '') );








// Скрываем чужие картинки от пользователей
add_filter('parse_query', 'true_hide_attachments_2' );
function true_hide_attachments_2( $wp_query ) {
	global $current_user;
	if ( !current_user_can('administrator') // администраторов всё так же не трогаем
	   && isset( $wp_query->query_vars['post_type'] ) // защищаемся от Notices :)
	   && $wp_query->query_vars['post_type']=="attachment" ) // тип поста - вложения
		$wp_query->set( 'author', $current_user->data->ID );
}

