$(document).ready(function() {
  $('.slider').slick({
    infinite: true,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    adaptiveHeight: true
  });
  $('.scroller').slick({
    infinite: false,
    dots: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    vertical: true,
    draggable: true,
    verticalSwiping: true,
    autoplay: true,
    autoplaySpeed: 2000,
    cssEase: 'linear'
  });
  $('.event-carousel').slick({
    infinite: true,
    dots: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
       {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
        }
      },
      {
        breakpoint: 540,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
        }
      },
    ]
  });
  $('.game__carousel').slick({
    infinite: true,
    dots: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 540,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
        }
      },
      {
        breakpoint: 320,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
        }
      },
    ]
  });
  $('.rating').each(function(index, el) {
    $val = $(this).text();
    if ($val > 66) {
      $color = '#4b8e4e';
    } else if ($val > 33){
      $color = '#d5bf1b';
    } else{
      $color = '#ea687a';
    }
    $(this).css('background', $color);
  });
	$('.tabs__link').click(function(event) {
		event.preventDefault();
		if (!$(this).hasClass('active')) {
      $(this).parent('.tabs__links').children('.tabs__link.active').removeClass('active')
			$(this).addClass('active');
			block = $(this).attr('href');
			$(this).parents('.tabs').find('.tab.active').fadeOut('fast').removeClass('active');
			$(block).fadeIn('fast').addClass('active');
		}
	});
    var style = 'easeOutExpo';
    if (!$('ul.nav__menu li').is('.current-menu-item')) {
      $('ul.nav__menu li:first').addClass('current-menu-item');
    }
    var default_left = Math.round($('ul.nav__menu li.current-menu-item').offset().left);
    var default_top = '100%'; /* 30 - отступ от пункта меню */
    var default_width = $('ul.nav__menu li.current-menu-item').outerWidth();
    $('#border').css({left: default_left, top: default_top, width: default_width}); 
    $('ul.nav__menu li').hover(function () {
      left = Math.round($(this).offset().left);
      width = $(this).outerWidth();
      $('#border').stop(false, true).animate({left: left, width: width},{duration:500, easing: style}); 
    }).click(function () {
      $('ul.nav__menu').removeClass('current-menu-item'); 
      $(this).addClass('current-menu-item');
    });
    $('ul.nav__menu').mouseleave(function () {
      default_left = Math.round($('ul.nav__menu li.current-menu-item').offset().left);
      default_width = $('ul.nav__menu li.current-menu-item').outerWidth();
      $('#border').stop(false, true).animate({left: default_left, width: default_width},{duration:1500, easing: style});  
    });
  $("ul.nav__menu li").hover(
      function () {
        $('ul', this).stop(false, true).slideDown(500); 
      },
      function () {
        $('ul', this).stop(false, false).slideUp(500); 
      }
    );
  $('.device__menu li a').click(function(event) {
    event.preventDefault();
    if (!$(this).hasClass('active')) {
      $('.device__menu li a.active').removeClass('active');
      $(this).addClass('active');
    }
    var thisHash = this.hash;
    var targetOffset = $(thisHash).offset().top;
    $("html,body").stop().animate({
      scrollTop: targetOffset
    }, 1100 );
    location.hash = thisHash;
  });
  $('.modal').fancybox({
    padding: 0
  });
});


// Дополнение
$(document).ready(function() {
 
	$('.post-ratings img').hover(
	function(){
	  number_hover = $(this).attr('alt');
	  if(number_hover<5) { 
									for (var i = 1; i <= number_hover; i++)  { $('.post-ratings img[alt='+i+']').attr({"src":"/sample/sis-virtua/wp-content/themes/virtua-theme/js/rating_over_1_4.png"});   }
	  }
	  if(number_hover>4 & number_hover<8) { 
									for (var i = 1; i <= 4; i++)  { $('.post-ratings img[alt='+i+']').attr({"src":"/sample/sis-virtua/wp-content/themes/virtua-theme/js/rating_over_1_4.png"});	}
									for (var i = 5; i <= number_hover; i++)  { $('.post-ratings img[alt='+i+']').attr({"src":"/sample/sis-virtua/wp-content/themes/virtua-theme/js/rating_over_5_7.png"});   }
	  }
	  
	  if(number_hover>7) { 
									for (var i = 1; i <= 4; i++)  { $('.post-ratings img[alt='+i+']').attr({"src":"/sample/sis-virtua/wp-content/themes/virtua-theme/js/rating_over_1_4.png"});	}
									for (var i = 5; i <= 7; i++)  { $('.post-ratings img[alt='+i+']').attr({"src":"/sample/sis-virtua/wp-content/themes/virtua-theme/js/rating_over_5_7.png"});   }
									for (var i = 8; i <= number_hover; i++)  { $('.post-ratings img[alt='+i+']').attr({"src":"/sample/sis-virtua/wp-content/themes/virtua-theme/js/rating_over_8_10.png"});   }
	  }
	},
	function(){  
	});
});