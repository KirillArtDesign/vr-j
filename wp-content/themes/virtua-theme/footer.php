<?php
/**
 * The template for displaying the footer.
**/

?>

			</div>
		</div>
	</div> 
	<!--/main-->
	<!--footer-->
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-6 col-xs-12">
					<div id="footer-1" class="footerwidget">
						<a class="logo" href="<? echo get_site_url();?>/">
							<object class="logo_desctop" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/logo_header1.svg" style="max-width: 100%;height: 80px;"></object>
							<object class="logo_mobile" type="image/svg+xml" data="<? echo get_template_directory_uri(); ?>/images/logo_header1.svg" style="max-width: 100%;height: 95px;"></object>
						</a>
						<div class="buttons buttons_footer">
							<a href="#subscription" class="modal footer__link btn btn_graytext btn_block">Подписаться</a>
							<? 
								if ( is_user_logged_in() ) { ?>
									<a href="<? echo get_permalink(360); ?>" class="footer__link btn btn_text">Кабинет</a>
									<a href="<? echo get_site_url();?>/wp-login.php?action=logout&redirect_to=<? echo get_site_url();?>" class="footer__link btn btn_blue">Выход</a>
							<? 	} else { ?>
									<a href="<? echo get_site_url();?>/wp-login.php?action=register" class="footer__link btn btn_text">Регистрация</a>
									<a href="<? echo get_site_url();?>/wp-login.php" class="modal footer__link btn btn_blue">Вход</a>
							<?	}
							?>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-md-offset-1 col-sm-6 col-xs-12">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php dynamic_sidebar( 'footer-4' ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="copyright">
		<div class="container"> 
			© <? echo date('2017-'), date('Y'); ?>. vr-j.ru. Материалы сайта могут содержать контент, не предназначенный для лиц младше 16 лет. *Meta - запрещенная в России организация.<br><a class="modal" href="#feedback">Написать нам</a>
		</div>
	</div>
	<!--/footer-->
</div>
<!--/wrapper-->
	<div id="subscription" class="popup" style="display:none;">
		<div class="subscription">
				<? echo do_shortcode('[contact-form-7 id="200" title="Подписаться"]'); ?>
		</div>
	</div>
	<div id="feedback" class="popup" style="display:none;">
		<div class="feedback">
				<? echo do_shortcode('[contact-form-7 id="260" title="Написать нам"]'); ?>
		</div>
	</div>
	<div id="message-thank" class="popup message">
		<div class="message__title">
			Вакансия добавлена!
		</div>
		<div class="message__text">
			Для редактирования и удаления пройдите в личный кабинет
		</div>
		<a href="<? echo get_permalink(3807); ?>" class="btn btn_blue btn_full">Личный кабинет</a>
	</div>
	<div id="login" class="popup" style="display:none;">
		<div class="login">
			<span class="login-title">Войти на сайт</span>
			<?php echo get_ulogin_panel(); ?>
			<?php wp_login_form(); ?>
		</div>
	</div>

<?php wp_footer(); ?>
<script type="text/javascript">
    jQuery(document).ready(function( $ ) {

    	<?php if( get_current_user_id() == 0) : ?>
			jQuery('#commentform').on('submit', function(){
				window.location.href = '/wp-login.php?redirect_to='+window.location.href;
				return false;  
			}); 
		<?php endif; ?>


		jQuery('.show_source_link').on('click', function(){
			$(this).toggleClass('active');
			jQuery('.source_link').slideToggle('slow');
		});


		if (typeof window.devicePixelRatio != 'undefined') {
		   if (window.devicePixelRatio > 1) {
			  jQuery('.top_but_retina1').attr('src','/wp-content/themes/virtua-theme/images/button1_min@2x.png');
			  jQuery('.top_but_retina2').attr('src','/wp-content/themes/virtua-theme/images/button2_min@2x.png');
			  jQuery('.top_but_retina3').attr('src','/wp-content/themes/virtua-theme/images/button3_min@2x.png');
			  jQuery('.top_but_retina4').attr('src','/wp-content/themes/virtua-theme/images/button4_min@2x.png');
		   }
		} 	
		setInterval(function(){
			scaleMenu();  
		}, 500);
			
	});

	function scaleMenu() {
		var screenCssPixelRatio = (window.outerWidth - 8) / window.innerWidth;
		if (screenCssPixelRatio >= .46 && screenCssPixelRatio <= .54) {
		  zoomLevel = "-4";
		} else if (screenCssPixelRatio <= .64) {
		  zoomLevel = "-3";
		} else if (screenCssPixelRatio <= .76) {
		  zoomLevel = "-2";
		} else if (screenCssPixelRatio <= .92) {
		  zoomLevel = "-1";
		} else if (screenCssPixelRatio <= 1.10) {
		  zoomLevel = "0";
		} else if (screenCssPixelRatio <= 1.32) {
		  zoomLevel = "1";
		} else if (screenCssPixelRatio <= 1.58) {
		  zoomLevel = "2";
		} else if (screenCssPixelRatio <= 1.90) {
		  zoomLevel = "3";
		} else if (screenCssPixelRatio <= 2.28) {
		  zoomLevel = "4";
		} else if (screenCssPixelRatio <= 2.70) {
		  zoomLevel = "5";
		} else {
		  zoomLevel = "unknown";
		}
		if(zoomLevel < 0) { 
			jQuery('.nav__menu > li .sub-menu').css({'border-left': '1px solid #9ec2d1'});
		} else {
			jQuery('.nav__menu > li .sub-menu').css({'border-left': '1px solid #9ec2d1'});
		}
		if (window.matchMedia("(max-width: 767px)").matches) { 
			jQuery('.nav__menu > li .sub-menu').css({'border-left': '0'});
		}
	}

</script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</body>
</html>