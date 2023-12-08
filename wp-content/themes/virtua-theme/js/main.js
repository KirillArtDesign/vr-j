jQuery(document).ready(function( $ ) {

    $('.vrc__slides').slick();

    $('.event-carousel').slick({
        infinite: false,
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
if($(window).width() > 992 && $('#sticky').length ) {
    var StickyElement = function(node){
  var doc = $(document), 
      fixed = false,
      anchor = node.find('.sticky-anchor'),
      content = node.find('#sidebar-2');
  
  var onScroll = function(e){
    var docTop = doc.scrollTop(),
        anchorTop = anchor.offset().top; 
    if(docTop > anchorTop){
      if(!fixed){
        anchor.height(content.outerHeight());
        content.addClass('fixed');        
        fixed = true;
      }
    }  else   { 
      if(fixed){
        anchor.height(0);
        content.removeClass('fixed'); 
        fixed = false;
      }
    }
  };
  
  $(window).on('scroll', onScroll);
};

    var demo = new StickyElement($('#sticky')); 
  }
 

  $('.show-order-list-c').on('click', function(e){
    e.stopPropagation();

      $('.order-list-c').slideToggle('slow'); 
 
    
  }); 

    $(document).mouseup(function (e) {
      var container = $(".order-list-c, .order_video");

      if (container.has(e.target).length === 0 ){
     
          $(".order-list-c").slideUp('slow');

      } 
  }); 


  $('.order-list-c li').on('click', function(){
    var value = $(this).data('value');
    $('#order .value').val(value);
    $('#order').submit();
    return false; 
  });
  $('#true_loadmore:not(.load_games)').click(function(){
      $(this).find('.more__link').text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
      var data = {
        'action': 'loadmore',
        'query': true_posts,
        'page' : current_page
      };
      $.ajax({
        url:ajaxurl, // обработчик
        data:data, // данные
        type:'POST', // тип запроса
        success:function(data){ 
          if( data ) { 
            $('#true_loadmore .more__link').text('Загрузить ещё');
            $('.list-video').append(data); // вставляем новые посты
            current_page++; // увеличиваем номер страницы на единицу
            if (current_page == max_pages) $("#true_loadmore").remove(); // если последняя страница, удаляем кнопку
          } else {
            $('#true_loadmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
          }
        }
      });
      return false;
    });

  $('#true_loadmore.load_games').click(function(){
      $(this).find('.more__link').text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
      var data = {
        'action': 'loadmore_game',
        'query': true_posts,
        'page' : current_page
      };
      $.ajax({
        url:ajaxurl, // обработчик
        data:data, // данные
        type:'POST', // тип запроса
        success:function(data){ 
          if( data ) { 
            $('#true_loadmore .more__link').text('Загрузить ещё');
            $('.related_withfilter').append(data); // вставляем новые посты
            current_page++; // увеличиваем номер страницы на единицу
            if (current_page == max_pages) $("#true_loadmore").remove(); // если последняя страница, удаляем кнопку
          } else {
            $('#true_loadmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
          }
        }
      });
      return false;
    });

  $('body').on('click', '.add-to-favorite', function(){
    var id = $(this).data('id');
    var this_ = $(this);
    var data = {
			action: 'add_favorite_comment',
			id: id
		};
		jQuery.post( myajax.ajax_url, data, function(response) {
			if(response) {
        this_.toggleClass('active');
      }
		});
    return false;
  });


   $('body').on('click', '.remove_notification', function(){
    var id = $(this).data('id');
    var this_ = $(this);
    var data = {
      action: 'remove_notification',
      id: id
    };
    jQuery.post( myajax.ajax_url, data, function(response) {
      console.log(response);
      if(response) {
        this_.parents('.profile_comment_self').remove();
      }
    });
    return false;
  });


  $('.ui_navigation__item').on('click', function(){
    $('.ui_navigation__item').removeClass('active');
    $(this).addClass('active');
    var action = $(this).data('action');
    var this_ = $(this);
    var data = {
			action: action,
    };
    if(action == 'get_favorite_comment' ) {
		jQuery.post( myajax.ajax_url, data, function(response) {
			if(response) {
        $('.comments_list').hide();
        $('.notifications_list').hide();
        $('.comments_list_video').hide();
        $('.content-ajax').html(response);
      }
    });
  }
  if(action == 'comment' ) {
    $('.comments_list').show();
    $('.notifications_list').hide();
    $('.comments_list_video').hide();
    $('.content-ajax').html('');
  }
  if(action == 'notifications' ) {
    $('.comments_list').hide();
    $('.comments_list_video').hide();
    $('.notifications_list').show();
    $('.content-ajax').html('');
  }

  if(action == 'comment_video' ) {
    $('.comments_list').hide();
    $('.notifications_list').hide();
    $('.content-ajax').html('');

    $('.comments_list_video').show();
  }
    
    return false;
  });

  $('.comment-reply .comment-reply-link').on('click', function(){
    $('.show-form-bott').show();
    var id = $(this).parents('li').data('id');
    $('#comment_parent').val( id );
    $('#commentform').appendTo( $(this).parents('article') );

    return false;
  });

  $('.show-form-bott').on('click', function(){
    $('.show-form-bott').hide();
    $('#comment_parent').val( 0 );
    $('#commentform').appendTo( '#respond' );

    return false;
  });

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
    slidesToShow: 5,
    slidesToScroll: 1,
    vertical: true,
    draggable: true,
    verticalSwiping: true,
    autoplay: true,
    autoplaySpeed: 2000,
    cssEase: 'linear',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          draggable: false,
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
      $(this).parents('.tabs').find('.tab.active').css('display','none').removeClass('active');
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

   

    if($(document).width() < 768) {
      
    } else {
      $('ul.nav__menu li').click(function () {
        $('ul.nav__menu li').removeClass('current-menu-item'); 
        $(this).addClass('current-menu-item');
      });
      $('ul.nav__menu li').hover(function () {
        left = Math.round($(this).offset().left);
        width = $(this).outerWidth();
        $('#border').stop(false, true).animate({left: left, width: width},{duration:500, easing: style}); 
      }) 
      $('ul.nav__menu').mouseleave(function () {
        default_left = Math.round($('ul.nav__menu li.current-menu-item').offset().left);
        default_width = $('ul.nav__menu li.current-menu-item').outerWidth();
        $('#border').stop(false, true).animate({left: default_left, width: default_width},{duration:1500, easing: style});  
      });
    }



  // $("ul.nav__menu li").hover(
  //     function () {
  //       if (!$('ul.nav__menu').hasClass('openmenu')) {
  //         $(this).children('ul').stop(false, true).slideDown(500); 
  //       }
  //     },
  //     function () {
  //       if (!$('ul.nav__menu').hasClass('openmenu')) {
  //         $(this).children('ul').stop(false, false).slideUp(500);
  //       } 
  //     }
  //   );
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
  $('.fancybox').fancybox({
    padding: 0
  });
  $('.nav__btn').click(function(event) {
    event.preventDefault(); 
    $(this).next('ul').slideToggle('fast').toggleClass('openmenu');
    // $('.nav__btn').next('ul').find('> li').find('ul').hide(); 
  });

  $(document).on('click', '.openmenu .menu-item-has-children', function(event) { 
      console.log('+');
     event.preventDefault();  
     event.stopPropagation();  
     
      if( $(this).children('ul').length  ) {
          $(this).children('ul').slideToggle('slow');   
        
      } else {
        console.log('-');
        window.location = $(this).find('a').attr('href');
      }
  });


  // $(document).on('click', '.menu-item-has-children > a', function(event) { 
  //    event.preventDefault(); 
  //    event.stopPropagation();   
  
  //    cons
   
  // });

  $(document).on('click', '.nav__menu li:not(.menu-item-has-children)', function(event) { 
     event.preventDefault(); 
     event.stopPropagation();   
  
      window.location = $(this).find('a').attr('href');
   
  });

  $(document).on('click', '.list-video__item .likebtn-wrapper', function(e) {
    event.preventDefault(); 
    event.stopPropagation();  
  });
  
  $('.hide-toggle').click(function(event) {
    event.preventDefault();

    $(this).toggleClass('toggled');
    $(this).parents('.device__block').find('.hide').slideToggle('fast');
    if ($(this).text() == 'Читать далее') {
      $(this).text('Свернуть');
    } else {
      $(this).text('Читать далее');
    }
  });
if ($(window).width() >= '992'){
  $('.header .search').click(function(){
    $('.search-container').css({'position' : 'static', 'height' : '40px'});
    $('.header .search').addClass('opened');
    $('.overlay').fadeIn(500);
  })
  $('.overlay').click(function(){
    $('.search-container').css('position', 'relative');
    $('.header .search').removeClass('opened');
    $('.overlay').fadeOut(500);
  }) 
}

  $(".vrfilter__loc").on("change", () => {
    let name = $(".vrfilter__loc").find(":selected").text();
    let slug = $(".vrfilter__loc").find(":selected").data('url');
    let id = $(".vrfilter__loc").find(":selected").data('id');

    window.location.replace("/location/"+slug+"/");
  });

  $(".vrfilter__loc2").on("change", () => {
    let name = $(".vrfilter__loc2").find(":selected").text();
    let slug = $(".vrfilter__loc2").find(":selected").data('url');
    let id = $(".vrfilter__loc2").find(":selected").data('id');
    
    window.location.replace("/location/"+slug+"/");
  }); 
  
  $(".vrfilter__submit").on("click", () => {
    let vrid = $(".vrfilter__loc3").find(":selected").attr("value");
    let mvrid = [];
    $('.cselect__list input:checkbox:checked').each(function(index) {
      mvrid.push($(this).siblings('span').text());
    });


    $('.vritem').each(function( index ) {
      let mshow = false;
      let tshow = false;
      if(vrid != 0) {

          
          let tags = String($(this).data('tags'));
          
          if(tags) {
            tags = tags.split(',');
            if(!tags.includes(vrid)) {
              tshow = false;
            } else {
              tshow = true;
            }
          } else {
            tshow = false;
          }

      } else {
        tshow = true;
      }



      if(mvrid.length > 0) {
        
        let metros = String($(this).data('metros'));
        metros = metros.split(',');
        if(metros) {

          if(findCommonElements3(metros, mvrid)) {
            mshow = true;
          } else {
            mshow = false;
          }
        } else {
          mshow = false;
        }
      } else {
        mshow = true;
      }

      console.log(mshow, tshow);
      if(mshow && tshow) {
        $(this).show();
        console.log(1);
      } else {
        console.log(2);
        $(this).hide();
      }
    });



  }); 


  $(".cselect__info").on('click', function() {
    $(".cselect__dropdown").toggleClass('active');
    $(".js-cselect").toggleClass('active');
  });


  $(".cselect__filter").on('input', function() {
    let filterSubstring = $(this).val().toLowerCase();

    $(".cselect__list li").each(function(index) {
      let metroName = $(this).find('span').text().toLowerCase();
      if(metroName.includes(filterSubstring)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  $(".cselect__list input[type='checkbox']").on('change', function() {
    let checkboxCount = $('.cselect__list input:checkbox:checked').length;
    if(checkboxCount == 0) {
      $(".cselect__info").text('Станция метро');
    } else {
      $(".cselect__info").text(checkboxCount + ' ' + declOfNum(checkboxCount, ['станция', 'станции', 'станций']));
    }
  });

  $(".cselect__clear").on('click', function() {
    $('.cselect__list input:checkbox').prop( "checked", false );
    $(".cselect__info").text('Станция метро');
  });

  $(document).on('click', function(e) {
    if ($(e.target).closest(".js-cselect").length === 0) {
      $(".cselect__dropdown").removeClass('active'); 
    }
  });


  function declOfNum(number, words) {  
    return words[(number % 100 > 4 && number % 100 < 20) ? 2 : [2, 0, 1, 1, 1, 2][(number % 10 < 5) ? Math.abs(number) % 10 : 5]];
  }

  function findCommonElements3(arr1, arr2) {

    return arr1.some(item =>  arr2.includes(item))
  }
});

///

//
//