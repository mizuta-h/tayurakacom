jQuery(document).ready(function($){

  var $window = $(window);

  $("a").bind("focus",function(){if(this.blur)this.blur();});
  $("a.target_blank").attr("target","_blank");

  //return top button
  var return_top_button = $('#return_top');
  $('a',return_top_button).click(function() {
    var myHref= $(this).attr("href");
    var myPos = $(myHref).offset().top;
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    return false;
  });
  return_top_button.removeClass('active');
  $window.scroll(function () {
    if ($(this).scrollTop() > 100) {
      return_top_button.addClass('active');
    } else {
      return_top_button.removeClass('active');
    }
  });


  //fixed footer content
  var fixedFooter = $('#fixed_footer_content');
  fixedFooter.removeClass('active');
  $window.scroll(function () {
    if ($(this).scrollTop() > 330) {
      fixedFooter.addClass('active');
    } else {
      fixedFooter.removeClass('active');
    }
  });
  $('#fixed_footer_content .close').click(function() {
    $("#fixed_footer_content").hide();
    return false;
  });


  // comment button
  $("#comment_tab li").click(function() {
    $("#comment_tab li").removeClass('active');
    $(this).addClass("active");
    $(".tab_contents").hide();
    var selected_tab = $(this).find("a").attr("href");
    $(selected_tab).fadeIn();
    return false;
  });


  //custom drop menu widget
  $(".tcdw_custom_drop_menu li:has(ul)").addClass('parent_menu');
  $(".tcdw_custom_drop_menu li").hover(function(){
     $(">ul:not(:animated)",this).slideDown("fast");
     $(this).addClass("active");
  }, function(){
     $(">ul",this).slideUp("fast");
     $(this).removeClass("active");
  });


  // design select box widget
  $(".design_select_box select").on("click" , function() {
    $(this).closest('.design_select_box').toggleClass("open");
  });
  $(document).mouseup(function (e){
    var container = $(".design_select_box");
    if (container.has(e.target).length === 0) {
      container.removeClass("open");
    }
  });


  //archive list widget
  if ($('.p-dropdown').length) {
    $('.p-dropdown__title').click(function() {
      $(this).toggleClass('is-active');
      $('+ .p-dropdown__list:not(:animated)', this).slideToggle();
    });
  }


  //category widget
  $(".tcd_category_list li:has(ul)").addClass('parent_menu');
  $(".tcd_category_list li.parent_menu > a").parent().prepend("<span class='child_menu_button'></span>");
  $(".tcd_category_list li .child_menu_button").on('click',function() {
     if($(this).parent().hasClass("open")) {
       $(this).parent().removeClass("active");
       $(this).parent().removeClass("open");
       $(this).parent().find('>ul:not(:animated)').slideUp("fast");
       return false;
     } else {
       $(this).parent().addClass("active");
       $(this).parent().addClass("open");
       $(this).parent().find('>ul:not(:animated)').slideDown("fast");
       return false;
     };
  });


  //search widget
  $('.widget_search #searchsubmit').wrap('<div class="submit_button"></div>');
  $('.google_search #searchsubmit').wrap('<div class="submit_button"></div>');
// テキストウィジェットとHTMLウィジェットにエディターのクラスを追加する
$('.widget_text .textwidget').addClass('post_content');

  // quick tag - underline ------------------------------------------
  if ($('.q_underline').length) {
    var gradient_prefix = null;

    $('.q_underline').each(function(){
      var bbc = $(this).css('borderBottomColor');
      if (jQuery.inArray(bbc, ['transparent', 'rgba(0, 0, 0, 0)']) == -1) {
        if (gradient_prefix === null) {
          gradient_prefix = '';
          var ua = navigator.userAgent.toLowerCase();
          if (/webkit/.test(ua)) {
            gradient_prefix = '-webkit-';
          } else if (/firefox/.test(ua)) {
            gradient_prefix = '-moz-';
          } else {
            gradient_prefix = '';
          }
        }
        $(this).css('borderBottomColor', 'transparent');
        if (gradient_prefix) {
          $(this).css('backgroundImage', gradient_prefix+'linear-gradient(left, transparent 50%, '+bbc+ ' 50%)');
        } else {
          $(this).css('backgroundImage', 'linear-gradient(to right, transparent 50%, '+bbc+ ' 50%)');
        }
      }
    });

    $window.on('scroll.q_underline', function(){
      $('.q_underline:not(.is-active)').each(function(){
        var top = $(this).offset().top;
        if ($window.scrollTop() > top - window.innerHeight) {
          $(this).addClass('is-active');
        }
      });
      if (!$('.q_underline:not(.is-active)').length) {
        $window.off('scroll.q_underline');
      }
    });
  }


// responsive ------------------------------------------------------------------------
var mql = window.matchMedia('screen and (min-width: 1201px)');
function checkBreakPoint(mql) {

 if(mql.matches){ //PC

   $("html").removeClass("mobile");
   $("html").addClass("pc");

   // bread crumb
   if ($('#container #bread_crumb').length) {
     $("#container #bread_crumb").clone().insertAfter("#header_logo");
     $("#container #bread_crumb").remove();
   }

   // mega menu
   if ($('#mega_menu_mobile_header_top #side_sns').length) {
     $("#mega_menu_mobile_header_top #side_sns").clone().appendTo("#side_menu");
     $("#mega_menu_mobile_header_top #side_sns").remove();
   }
   if ($('#mega_menu_mobile_header_top #site_desc').length) {
     $("#mega_menu_mobile_header_top #site_desc").clone().prependTo("#side_menu");
     $("#mega_menu_mobile_header_top #site_desc").remove();
   }

   // header search
   $("#header_search").hover(function(){
      $(this).addClass("active");
      $('#header_search_input').focus();
   }, function(){
      $(this).removeClass("active");
   });

 } else { //smart phone

   $("html").removeClass("pc");
   $("html").addClass("mobile");

   // header search
   $("#header_search").off('mouseenter mouseleave');
   $("#mobile_header_search_button").on('click',function() {
     $('body').toggleClass('active_header_search');
      $('#container').on('click', function(e){
        if($('body').hasClass('active_header_search')){
          $('body').removeClass('active_header_search');
          return false;
        };
      });
   });

   // bread crumb
   if ($('#bread_crumb').length) {
     $("#bread_crumb").clone().prependTo("#container");
     $("#header #bread_crumb").remove();
   }

   // mega menu
   if ($('#mega_menu_mobile_header').length && $('#side_sns').length) {
     $("#side_sns").clone().insertBefore(".mobile_close_button");
     $("#side_menu #side_sns").remove();
   }
   if ($('#mega_menu_mobile_header').length && $('#site_desc').length) {
     $("#site_desc").clone().prependTo("#mega_menu_mobile_header_top");
     $("#side_menu #site_desc").remove();
   }

   // perfect scroll
   if ($('#drawer_menu').length) {
     if(! $(body).hasClass('mobile_device') ) {
       new SimpleBar($('#drawer_menu')[0]);
     };
   };

   // drawer menu
   $("#mobile_menu .child_menu_button").remove();
   $('#mobile_menu li > ul').parent().prepend("<span class='child_menu_button'><span class='icon'></span></span>");
   $("#mobile_menu .child_menu_button").on('click',function() {
     if($(this).parent().hasClass("open")) {
       $(this).parent().removeClass("open");
       $(this).parent().find('>ul:not(:animated)').slideUp("fast");
       return false;
     } else {
       $(this).parent().addClass("open");
       $(this).parent().find('>ul:not(:animated)').slideDown("fast");
       return false;
     };
   });

   // drawer menu button
   var menu_button = $('#global_menu_button');
   menu_button.off();
   menu_button.removeAttr('style');
   menu_button.toggleClass("active",false);

  // open drawer menu
   menu_button.on('click', function(e) {

      e.preventDefault();
      e.stopPropagation();
      $('html').toggleClass('open_menu');

      $('#container').one('click', function(e){
        if($('html').hasClass('open_menu')){
          $('html').removeClass('open_menu');
          return false;
        };
      });

   });

  // animation scroll link
  $('#mobile_menu a[href^="#"]').click(function() {
    var myHref= $(this).attr("href");
    if($("html").hasClass("mobile") && $("body").hasClass("use_mobile_header_fix")) {
      var myPos = $(myHref).offset().top - 60;
    } else if($("html").hasClass("mobile")) {
      var myPos = $(myHref).offset().top;
    } else if($("html").hasClass("pc") && $("body").hasClass("use_header_fix")) {
      if($("html").hasClass("pc") && $("body").hasClass("menu_type2 hide_header_logo hide_global_menu")) {
        var myPos = $(myHref).offset().top;
      } else {
        var myPos = $(myHref).offset().top - 80;
      }
    } else {
      var myPos = $(myHref).offset().top;
    }
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    if($('html').hasClass('open_menu')){
      $('html').removeClass('open_menu');
      return false;
    };
    return false;
  });

 };
};
mql.addListener(checkBreakPoint);
checkBreakPoint(mql);


});