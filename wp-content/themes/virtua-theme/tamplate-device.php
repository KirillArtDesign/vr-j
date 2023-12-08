<?php
/*
Template Name: Устройства - Лендинг
*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta content="width=device-width,initial-scale=1" name=viewport>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body>
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
							<img class="logo_desctop" src="<? echo get_template_directory_uri(); ?>/images/logo_header.svg" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>">
							<img class="logo_mobile" src="<? echo get_template_directory_uri(); ?>/images/logo_header.svg" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>">
						</a>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
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
							<a href="https://www.facebook.com/VRJourna1" class="social__link social__link_facebook">
								<object class="social__icon" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/fb.svg" style="max-width: 10px;height: 19px;"></object>
								<object class="social__icon social__icon_hover" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/fb_bg.svg" style="max-width: 10px; height: 19px;"></object>
							</a>
							<a href="https://twitter.com/VRJourna1" class="social__link social__link_twitter">
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
									<a href="<? echo get_site_url();?>/lichnyj-kabinet/" class="buttons__link btn btn_text">Кабинет</a>
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

							<?php while ( have_posts() ) : the_post(); ?>

								<?php the_content(); ?>

							<?php endwhile; // End of the loop. ?>
			
		</div>
	</div>
	<!--/main-->
<?php get_footer(); ?>