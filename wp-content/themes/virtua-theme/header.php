<?php	// Редирект на HTTPS
        //TODO переложить на плечи вебсервера
/**
 * The header for our theme.
**/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta content="width=device-width,initial-scale=1" name=viewport> 
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<meta name="likebtn-website-verification" content="34e67e0eae45cd3a" />
<?php wp_head(); ?>
<script async="async" src="https://w.uptolike.com/widgets/v1/zp.js?pid=1881147" type="text/javascript"></script>
<link rel="apple-touch-icon" sizes="180x180" href="https://vr-j.ru/wp-content/uploads/2019/10/apple-touch-icon.png">
<link rel="icon" href="https://vr-j.ru/wp-content/uploads/2019/10/apple-touch-icon.png" sizes="32x32" type="image/png">  
<meta property="og:image" content="https://vr-j.ru/wp-content/uploads/2019/10/apple-touch-icon.png" /> 
<meta property="og:image:secure_url" content="https://vr-j.ru/wp-content/uploads/2019/10/apple-touch-icon.png" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="256" />
<meta property="og:image:height" content="256" /> 
</head>
<body <?php body_class(); ?>>
<div class="overlay"></div>
<!--wrapper-->
<div class="wrapper">
	<!--header-->
	<div class="header">
		<!--top-->
		<div class="top">
			<div class="container">
				<div class="row">
					<div class="col-md-2 col-sm-6 col-xs-12">
						<a class="logo" href="<? echo get_site_url();?>/">
							<object class="logo_desctop" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/logo_header1.svg" style="max-width: 100%;height: 80px; margin-bottom: -13px;"></object>
							<object class="logo_mobile" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/logo_header1.svg" style="max-width: 100%;height: 95px;"></object>
						</a>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12 search-container">
						<div class="search">
							<form action="<? echo get_site_url();?>/" class="search__form">
								<input type="search" class="search__word" name="s" placeholder="Поиск">
								<input type="submit" class="search__button">
							</form>
						</div>
					</div>
					<div class="col-md-2 col-md-offset-1 col-sm-6 col-xs-12">
						<div class="social">
							<a href="https://vk.com/club145374250" class="social__link social__link_vkontakte">
								<object class="social__icon" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/vk.svg" style="max-width: 22px;height: 13px;"></object>
								<object class="social__icon social__icon_hover" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/vk_bg.svg" style="max-width: 22px;height: 13px;"></object>
							</a>
							<a href="https://www.facebook.com/InVRweTrust/" class="social__link social__link_facebook">
								<object class="social__icon" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/fb.svg" style="max-width: 10px;height: 19px;"></object>
								<object class="social__icon social__icon_hover" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/fb_bg.svg" style="max-width: 10px; height: 19px;"></object>
							</a>
							<a href="https://twitter.com/VR_Journa1" class="social__link social__link_twitter">
								<object class="social__icon" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/tw.svg" style="max-width: 22px;height: 17px;"></object>
								<object class="social__icon social__icon_hover" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/tw_bg.svg" style="max-width: 22px; height: 17px;"></object>
							</a>
							<a href="https://tgclick.com/VR_Journal" class="social__link social__link_telegram">
								<object class="social__icon" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/tl.svg" style="max-width: 20px;height: 20px;"></object>
								<object class="social__icon social__icon_hover" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/tl_bg.svg" style="max-width: 20px; height: 20px;"></object>
							</a>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="buttons">
							<a href="#subscription" class="modal buttons__link btn btn_text">Подписаться</a> 
							<? 
								if ( is_user_logged_in() ) { ?>
									<a href="<? echo get_permalink(3807); ?>" class="buttons__link btn btn_text">Кабинет</a>
									<a href="<? echo get_site_url();?>/wp-login.php?action=logout&redirect_to=<? echo get_site_url();?>" class="buttons__link btn btn_blue">Выход</a>
							<? 	} else { ?>
									<a href="<? echo get_site_url();?>/wp-login.php?action=register" class="buttons__link btn btn_text">Регистрация</a>
									<a href="<? echo get_site_url();?>/wp-login.php" class="modal buttons__link btn btn_blue">Вход</a>
							<?	}
							?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/top-->
		<!--topnav-->
		<div class="nav">
			<div class="container">
				<a href="#" class="nav__btn"><span>МЕНЮ</span></a>
				<?php wp_nav_menu( array(
																	'theme_location'  => 'main-menu-top',
																	'container'       => false,  
																	'menu_class'      => 'nav__menu', 
																) );
				?>
			</div>
			<div id="border"></div>
		</div>
		<!--/topnav-->
	</div>
	<!--/header-->
	<!--main-->
	<div class="main">
		<div class="container">
			<!--breadcrumbs-->
			<?php 

				if( is_singular('video') ){ 
					$term = get_the_terms(get_the_id(), 'video_cat');
					$term_link = get_term_link($term[0]->term_id, 'video_cat');
					$term_name = $term[0]->name;
					?>
					<div class="breadcrumbs" itemscope="" itemtype="https://schema.org/BreadcrumbList">
						<span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a href="https://vr-j.ru/" itemprop="item" class="home"><span itemprop="name">Главная</span></a><meta itemprop="position" content="1"></span> 
						<span class="sep">›</span> <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a href="https://vr-j.ru/video/" itemprop="item"><span itemprop="name">Видео</span></a><meta itemprop="position" content="2"></span> 
						<span class="sep">›</span> <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a href="<?php echo $term_link ?>" itemprop="item"><span itemprop="name"><?php echo $term_name ?></span></a><meta itemprop="position" content="3"></span> 
						<span class="sep">›</span> <span class="current"><?php the_title() ?><meta itemprop="position" content="4"></span>
					</div>
				<?php
				} elseif( is_tax( 'video_cat' ) ){ 
					$term_name = get_queried_object()->name;  
					?>
					<div class="breadcrumbs" itemscope="" itemtype="https://schema.org/BreadcrumbList">
						<span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a href="https://vr-j.ru/" itemprop="item" class="home"><span itemprop="name">Главная</span></a><meta itemprop="position" content="1"></span> 
						<span class="sep">›</span> <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a href="https://vr-j.ru/video/" itemprop="item"><span itemprop="name">Видео</span></a><meta itemprop="position" content="2"></span>
						<span class="sep">›</span> <span class="current"><?php echo $term_name; ?><meta itemprop="position" content="3"></span>
					</div>

				<?php

				} elseif(is_tax( 'location' ) ) {
					$term_name = get_queried_object()->name;  
					?>
					<div class="breadcrumbs" itemscope="" itemtype="https://schema.org/BreadcrumbList">
						<span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a href="https://vr-j.ru/" itemprop="item" class="home"><span itemprop="name">Главная</span></a><meta itemprop="position" content="1"></span> 
						<span class="sep">›</span> <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a href="<?php echo get_term_link(get_queried_object(), 'location'); ?>" itemprop="item"><span itemprop="name">Лучшие VR Клубы в <?php the_field('breadcrumbs_name', get_queried_object()); ?> <?php echo date('Y'); ?></span></a><meta itemprop="position" content="2"></span>
						<span class="sep">›</span> <span class="current"><?php echo $term_name; ?><meta itemprop="position" content="3"></span>
					</div>

					<?php

				} elseif( is_singular('vrclubs') ) {
					?>
					<div class="breadcrumbs" itemscope="" itemtype="https://schema.org/BreadcrumbList">
						<span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a href="https://vr-j.ru/" itemprop="item" class="home"><span itemprop="name">Главная</span></a><meta itemprop="position" content="1"></span> 
						<span class="sep">›</span> <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a href="https://vr-j.ru/vrclubs/" itemprop="item"><span itemprop="name">VR-клубы</span></a><meta itemprop="position" content="2"></span> 
						<span class="sep">›</span> <span class="current"><?php the_title() ?><meta itemprop="position" content="4"></span>
					</div>
					<?php
				} else {
					if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();
				}
			

			?>

			

			<div class="row">

