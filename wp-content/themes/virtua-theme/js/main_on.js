
// Дополнение
jQuery(document).ready(function( $ ) {
					$('#add-opyt-but').click(function(){
						$('.add-opyt').append("<div class='experience'><div class='experience__row add-work-time-on'> <div class='experience__cell experience__cell_min'> <textarea name='on_time_work[]' class='on_time_work' placeholder='Время работы'></textarea> </div> <div class='experience__cell'> <textarea name='on_place_work[]' class='on_place_work' placeholder='Место работы'></textarea> </div> </div> </div>");
					});
/*					
					$('#btn_resume_send').click(function(){
						var time_works = '{';
						$(".add-work-time-on").map(function(){ 
							time_works+='"'+$(this).children('div').children('.on_time_work').val()+'":"'+$(this).children('div').children('.on_place_work').val()+'",';
						});
						time_works+='}';
						$('#on_opiyt').val(time_works);
					});
*/
/*
				$('#on_send_form').submit(function() { 
					var erro="";
					$('.required').each(function(){ 
						if ( $(this).val()=='' ) { $(this).focus(); erro="yes"; return false; }
					});
					if (erro=='') {
						//	$('#on_send_form').submit();	// Если ошибок нет - ОТПРАВЛЯЕМ						
					}
				});
				
				
				
				
*/		

			// добавленое Lao
			 
			 
			  // Образование
			  var obr = $('#count_obrazov_block').val();
			  cont1 = '<div class="row"><div class="col-sm-12 col-xs-12"><div class="lk__title lk__title_sep"><hr style="height: 2px; width: 100%; background: #9dc2d0;"></div></div>'+$('.obrazovanie').html();
			  $('.addobrazov').on('click',function(){
			   obr++;
			   cont2 = cont1.replace('Основное образование','Образование');
			   cont2 = cont2.replace(/infor\[\'obrazovanie\'\]\[0\]/g,"infor['obrazovanie']["+obr+"]");
			   cont2 = cont2.replace(/INN/g,obr+'rr');
			   $('#addobrazv').append('<div class="obrazovanie">'+cont2+'</div>');
			  });
			  
			 
			  // курсы
			  var kurs = $('#count_kursi_block').val();
			  kur1 = $('.kursi').html();
			  $('.addkursbut').on('click',function(){
			   kurs++;
			   kur2 = kur1.replace(/infor\[\'kursi\'\]\[0\]/g,"infor['kursi']["+kurs+"]");
			   $('#addkursi').append('<div class="kursi">'+kur2+'</div>');
			  });
			 
			 
			  // языки
			  var lang = $('#count_lang_block').val();
			  langs1 = $('.langs').html();
			  $('.addlang').on('click',function(){
			   lang++;
			   langs2 = langs1.replace(/infor\[\'lang\'\]\[0\]/g,"infor['lang']["+lang+"]");
			   $('#addlangs').append('<div class="langs">'+langs2+'</div>');
			  });

			  
			  // Портфолио
			  var portfol = $('#count_portfolio_block').val();
			  $('.addportfolio').on('click',function(){
			   portfol++;
			   $('#addportfolio-block').append('<div class="portfolio-block'+portfol+'"></div>');			   
			   $('.portfolio-block'+portfol).load('/visual-editor-tech/?ids='+portfol, function () {
				 $('.switch-tmce').trigger('click');
				});
				
			  });
			  			  
			  $(document).on("change", ".obrazov_select",function(){
				  prr = $(this).attr('datt');
				  if ( $(this).val() == 'Высшее' ) {
					$('.dopcls_'+prr).css('display','block');
				  } else {
					$('.dopcls_'+prr).css('display','none'); 
				  }
			  });
			  
			  // $('.obrazov_select').on('change',function(){
				  // prr = $(this).attr('datt');
				  // if ( $(this).val() == 'Высшее' ) {
					// $('.dopcls_'+prr).css('display','block');
				  // } else {
					// $('.dopcls_'+prr).css('display','none'); 
				  // }
			  // });
			  
			  
			// добавленое Lao		
			 
			 $('.opit-on').on('click',function(){
			   $('.list-opit').css({'display':'block'});
			  });
			  $('.opit-off').on('click',function(){
			   $('.list-opit').css({'display':'none'});
			  });

				var mss = new Array();
				
				dtc = $('.on-strana-tool').attr('data-country');
				if (dtc == 0) { urr = '/sel_country.php'; }
					else { urr = '/sel_country.php?contr='+dtc; }
				$('.on-strana-tool').attr('disabled', true);					
				$.ajax({
					type: 'get',
					url: urr,
					cache: false,
					success: function(otvet) {
						$('.on-strana-tool').html(otvet);
						$('.on-strana-tool').attr('disabled', false);
					}
				});

				
				$('.on-strana-tool').on('change',function(){
					cnt = $(this).val();	
					$.ajax({
						type: 'get',
						url: '/sel_city.php?needcount='+cnt,
						cache: false,
						success: function(otvet) {
							mss = otvet.split('|');
						}
					});
				});



				// функция поиска по буквам
				$('.on-city-tool').keyup(function(){
					cit = $(this).val();
					mas = new Array(); j = 0;
					if (cit.length > 2) {
						for(var i = 0; i < mss.length; i++){
							if(mss[i].indexOf(cit) + 1) {
								mas[j] = mss[i];
								j++;
							}		
						}		
					}
					selc = '';
					if (mas.length > 0) {
						mas.forEach(function(item, i, mas) {
							selc += '<option value="'+item+'">'+item+'</option>';
						});
						$('.fongors').html(selc);
						$('.city_tooltype_text').css('display','block');
					} else {
						$('.city_tooltype_text').css('display','none');
					}
				});
				
				$('.fongors').on('change',function(){
					$('.on-city-tool').val($(this).val());
					$('.city_tooltype_text').css('display','none');
				});
				
				
				$('#on-button-submit').click(function() { 
					var erro="";
					$('.required').each(function(){ 
						if ( $(this).val()=='' ) { $(this).focus(); erro="yes"; return false; }
					});
					if (erro=='') { $("#on-form-submit").submit(); }
				});
			 
	
	// $('.social__link_vkontakte:before').css('content','https://vr-j.ru/wp-content/themes/virtua-theme/images/vk.svg');
	
	// $('.social__link_facebook:before').css('content','https://vr-j.ru/wp-content/themes/virtua-theme/images/fb.svg');
	
	// $('.social__link_twitter:before').css('content','https://vr-j.ru/wp-content/themes/virtua-theme/images/tw.svg');
	
	// $('.social__link_telegram:before').css('content','https://vr-j.ru/wp-content/themes/virtua-theme/images/tl.svg');
	
	
				$('#loadLastNewsBut').click(function() { 
					// alert('начинаем');
					$('#loadLastNewsBut').css({'opacity': '0'}).hide(); 
					$('.load-more-img').show();
					// $('.loadmore').css({'cursor': 'progress'}); 
					$('body').addClass('load-post-ajax'); 
					$.ajax({
							type: 'POST',
							url: '/wp-admin/admin-ajax.php',
							data: {
								action : 'on_do_load_last_news_in_home',
								on_page: $('#loadLastNewsBut').attr('rel')
							},
							beforeSend:function(){
							//	alert($('#loadLastNewsBut').attr('rel'));
							},
							success: function (response) {
								$('.grid__box_last').removeClass('grid__box_last');
								$( ".grid__box_telegram" ).before(response);
							//	$('.loadgrid').append(response);
								var xxx = parseInt($('#loadLastNewsBut').attr('rel'), 10)+1;
								$('#loadLastNewsBut').attr('rel',''+xxx);
								$('body').removeClass('load-post-ajax'); 
								$('#loadLastNewsBut').css({'opacity': '1'}).show(); 
								// $('.loadmore').css({'cursor': 'default'});
								$('.load-more-img').hide();
							}
					});
				});
			//	$('#loadLastNewsBut').click();
	
});