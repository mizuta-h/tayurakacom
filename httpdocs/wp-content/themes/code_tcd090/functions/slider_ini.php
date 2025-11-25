<?php
     $options = get_design_plus_option();

     if(!is_mobile() && $options['show_index_slider']) {
       $index_slider = $options['index_slider'];
       $device = '';
     } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type2') ) {
       $index_slider = $options['mobile_index_slider'];
       $device = 'mobile_';
     } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type1') ) {
       $index_slider = $options['index_slider'];
       $device = '';
     }

     $slider_item_total = count($index_slider);
?>

  var slideWrapper = $('#header_slider'),
      iframes = slideWrapper.find('.youtube-player'),
      ytPlayers = {},
      timers = { slickNext: null };

  // YouTube IFrame Player API script load
  if ($('#header_slider .youtube-player').length) {
    if (!$('script[src="//www.youtube.com/iframe_api"]').length) {
      var tag = document.createElement('script');
      tag.src = 'https://www.youtube.com/iframe_api';
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }
  }

  // YouTube IFrame Player API Ready
  window.onYouTubeIframeAPIReady = function(){
    slideWrapper.find('.youtube-player').each(function(){
      var ytPlayerId = $(this).attr('id');
      if (!ytPlayerId) return;
      var player = new YT.Player(ytPlayerId, {
        events: {
          onReady: function(e) {
            $('#'+ytPlayerId).css('opacity', 0).css('pointerEvents', 'none');
            iframes = slideWrapper.find('.youtube-player');
            ytPlayers[ytPlayerId] = player;
            ytPlayers[ytPlayerId].mute();
            ytPlayers[ytPlayerId].lastStatus = -1;
            var item = $('#'+ytPlayerId).closest('.item');
            if (item.hasClass('slick-current')) {
              playPauseVideo(item, 'play');
            }
          },
          onStateChange: function(e) {
            if (e.data === 0) { // ended
              if (slideWrapper.find('.item').length == 1) {<?php // youtubeスライド1枚のみのループ処理 ?>
                var slide = slideWrapper.find('.slick-current');
                slide.css('transition', 'none').removeClass('animate');
                slide.find('.animate_item, .animate_item span').css('transition', 'none').removeClass('animate');
                setTimeout(function(){
                  slide.removeAttr('style');
                  slide.find('.animate_item, .animate_item span').removeAttr('style');
                  slide.addClass('animate');
                  playPauseVideo(slide, 'play');
                }, 20);
              } else {
                $('#'+ytPlayerId).stop().css('opacity', 0);
                if ($('#'+ytPlayerId).closest('.item').hasClass('slick-current')) {
                  if (timers.slickNext) {
                    clearTimeout(timers.slickNext);
                    timers.slickNext = null;
                  }
                  slideWrapper.slick('slickNext');
                }
              }
            } else if (e.data === 1) { // play
              $('#'+ytPlayerId).not(':animated').css('opacity', 1);
              if (slideWrapper.find('.item').length > 1) {
                var slide = $('#'+ytPlayerId).closest('.item');
                var slickIndex = slide.attr('data-slick-index') || 0;
                clearInterval(timers[slickIndex]);
                timers[slickIndex] = setInterval(function(){
                  var state = ytPlayers[ytPlayerId].getPlayerState();
                  if (state != 1 && state != 3) {
                    clearInterval(timers[slickIndex]);
                  } else if (ytPlayers[ytPlayerId].getDuration() - ytPlayers[ytPlayerId].getCurrentTime() < 1) {
                    clearInterval(timers[slickIndex]);
                    if (timers.slickNext) {
                      clearTimeout(timers.slickNext);
                      timers.slickNext = null;
                    }
                    slideWrapper.slick('slickNext');
                  }
                }, 200);
              }
            } else if (e.data === 3) { // buffering
              if (ytPlayers[ytPlayerId].lastStatus === -1) {
                $('#'+ytPlayerId).delay(100).animate({opacity: 1}, 400);
              }
            }
            ytPlayers[ytPlayerId].lastStatus = e.data;
          }
        }
      });
    });
  };

  // play or puase video
  function playPauseVideo(slide, control){
    if (!slide) {
      slide = slideWrapper.find('.slick-current');
    }
    // animate caption and logo
    function captionAnimation() {
      if( !$('body').hasClass('stop_index_slider_animation') ){

      if( slide.hasClass('first_item') ){
        $('#header_logo a').addClass('animate');
        $('#global_menu_button').addClass('animate');
        $('#header_search').addClass('animate');
        $('#header_logo a').on('animationend webkitAnimationEnd oAnimationEnd mozAnimationEnd', function(){
          $(".first_animate_item").each(function(i){
            $(this).delay(i *700).queue(function(next) {
              $(this).addClass('animate');
              next();
            });
          }).promise().done(function () {
            slide.removeClass('first_item');
          });
        });
      } else {
        slide.find(".animate_item").each(function(i){
          $(this).delay(i *700).queue(function(next) {
            $(this).addClass('animate');
            next();
          });
        });
      }

      }
    }
    // youtube item --------------------------
    if (slide.hasClass('youtube')) {
      var ytPlayerId = slide.find('.youtube-player').attr('id');
      if (ytPlayerId) {
        switch (control) {
          case 'play':
            if (ytPlayers[ytPlayerId]) {
              ytPlayers[ytPlayerId].seekTo(0, true);
              ytPlayers[ytPlayerId].playVideo();
            }
            setTimeout(function(){
              captionAnimation();
            }, 1000);
            if (timers.slickNext) {
              clearTimeout(timers.slickNext);
              timers.slickNext = null;
            }
            break;
          case 'pause':
            slide.find(".animate_item").removeClass('animate');
            slide.find(".progress_bar .bar").removeClass('active');
            if (ytPlayers[ytPlayerId]) {
              ytPlayers[ytPlayerId].pauseVideo();
            }
            break;
        }
      }
    // video item ------------------------
    } else if (slide.hasClass('video')) {
      var video = slide.find('video').get(0);
      if (video) {
        switch (control) {
          case 'play':
            video.currentTime = 0;
            video.play();
            setTimeout(function(){
              captionAnimation();
            }, 1000);
            var slickIndex = slide.attr('data-slick-index') || 0;
            clearInterval(timers[slickIndex]);
            timers[slickIndex] = setInterval(function(){
              if (video.paused) {
                // clearInterval(timers[slickIndex]);
              } else if (video.duration - video.currentTime < 2) {
                clearInterval(timers[slickIndex]);
                if (timers.slickNext) {
                  clearTimeout(timers.slickNext);
                  timers.slickNext = null;
                }
                slideWrapper.slick('slickNext');
                setTimeout(function(){
                  video.currentTime = 0;
                }, 2000);
              }
            }, 200);
            break;
          case 'pause':
            slide.find(".animate_item").removeClass('animate animate_mobile');
            slide.find(".progress_bar .bar").removeClass('active');
            video.pause();
            break;
        }
      }
    // normal image item --------------------
    } else if (slide.hasClass('image_item')) {
      switch (control) {
        case 'play':
          if (slide.find('.progress_bar').length) {
            var playSpeed = <?php echo esc_html($options[$device . 'index_slider_time'] / 1000); ?> - 1.7;
            setTimeout(function(){
              slide.find(".progress_bar .bar").css({'transition': 'left ' + playSpeed + 's ease-out'}).addClass('active');
            }, 1700);
          }
          slide.find(".animate_item").fadeIn("fast");
<?php if($options[$device.'index_slider_type'] == 'type1'){ ?>
          setTimeout(function(){
            captionAnimation();
          }, 200);
<?php } else { ?>
          setTimeout(function(){
            captionAnimation();
          }, 1000);
<?php }; ?>
          if (timers.slickNext) {
            clearTimeout(timers.slickNext);
            timers.slickNext = null;
          }
          timers.slickNext = setTimeout(function(){
            if(slideWrapper.find('.item').length != 1){
              slide.find(".animate_item").fadeOut(50, 'easeOutExpo' );
            }
            slideWrapper.slick('slickNext');
          }, <?php echo absint($options[$device . 'index_slider_time']); ?>);
          break;
        case 'pause':
          slide.find(".animate_item").removeClass('animate animate_mobile');
          slide.find(".progress_bar .bar").removeClass('active');
          break;
      }
    }
  }


  // resize youtube video
  function youtube_resize(){
    var object = $('.youtube_wrap');
    var slider_height = $('#header_slider').innerHeight();
    var slider_width = slider_height*(16/9);
    if($('html').hasClass('pc')){
      var win_width = $(window).width() - 80;
    } else {
      var win_width = $(window).width();
    }
    var win_height = win_width*(9/16);
    <?php if($options[$device.'index_slider_type'] == 'type2') { ?>
    if(win_width > slider_width) {
      object.addClass('type1');
      object.removeClass('type2');
      object.css({'width': '100%', 'height': win_height});
    } else {
      object.removeClass('type1');
      object.addClass('type2');
      object.css({'width':slider_width, 'height':slider_height });
    }
    <?php } else { ?>
    if (window.matchMedia('(min-width: 1050px)').matches) {
      object.removeClass('type1');
      object.addClass('type2');
      object.css({'width':slider_width, 'height':slider_height });
    } else {
      if(win_width > slider_width) {
        object.addClass('type1');
        object.removeClass('type2');
        object.css({'width': '100%', 'height': win_height});
      } else {
        object.removeClass('type1');
        object.addClass('type2');
        object.css({'width':slider_width, 'height':slider_height });
      }
    }
    <?php }; ?>
  }

  // resize MP4 video
  function video_resize(){
    if($('html').hasClass('pc')){
      var win_width = $(window).width() - 80;
    } else {
      var win_width = $(window).width();
    }
    <?php if($options[$device.'index_slider_type'] == 'type2') { ?>
    var item_width = win_width;
    var item_height = $(window).innerHeight();
    <?php } elseif($options[$device.'index_slider_type'] == 'type3') { ?>
    if (window.matchMedia('(min-width: 1050px)').matches) {
      var item_width = win_width / 2;
      var item_height = $(window).innerHeight();
    } else {
      var item_width = win_width;
      var item_height = $(window).innerHeight() / 2;
    }
    <?php } else { ?>
    var item_width = win_width;
    var item_height = $("#header_slider .slick-slide .video_wrap").height();
    <?php }; ?>
    $(".video_media").each(function(i){
      var video = $(this)[0];
      var video_width = video.videoWidth;
      var video_height = video.videoHeight;
      var scaleW = item_width / video_width;
      var scaleH = item_height / video_height;
      var fixScale = Math.max(scaleW, scaleH);
      var setW = video_width * fixScale;
      var setH = video_height * fixScale;
      var moveX = Math.floor((item_width - setW) / 2);
      var moveY = Math.floor((item_height - setH) / 2);
      $(this).css({
        'width': setW,
        'height': setH,
        'left' : moveX,
        'top' : moveY
      });
    });
  }

  // Adjust height for mobile device
  function adjust_height(){
    var winH = $(window).innerHeight();
    <?php if($options[$device.'index_slider_type'] == 'type3') { ?>
    if (window.matchMedia('(min-width: 1050px)').matches) {
      $('#header_slider_wrap').css('height', winH);
      $('#header_slider').css('height', winH);
      $('#header_slider .item').css('height', winH);
      $('#header_content_post_list').css('height', winH);
    } else {
      $('#header_slider_wrap').css('height', winH);
      $('#header_slider').css('height', winH / 2);
      $('#header_slider .item').css('height', winH / 2);
      $('#header_content_post_list').css('height', winH / 2);
    }
    <?php } else { ?>
    $('#header_slider_wrap').css('height', winH);
    $('#header_slider').css('height', winH);
    $('#header_slider .item').css('height', winH);
    <?php }; ?>
  }

  // DOM Ready
  $(function() {
    slideWrapper.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
      if (currentSlide == nextSlide) return;
      slick.$slides.eq(nextSlide).addClass('animate');
      setTimeout(function(){
        playPauseVideo(slick.$slides.eq(currentSlide), 'pause');
      }, slick.options.speed);
      playPauseVideo(slick.$slides.eq(nextSlide), 'play');
    });
    slideWrapper.on('afterChange', function(event, slick, currentSlide) {
      slick.$slides.not(':eq(' + currentSlide + ')').removeClass('animate');
    });
    slideWrapper.on('swipe', function(event, slick, direction){
      slideWrapper.slick('setPosition');
    });

    //start the slider
    slideWrapper.slick({
      slide: '.item',
      infinite: true,
      dots: false,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      swipe: true,
      pauseOnFocus: false,
      pauseOnHover: false,
      autoplay: false,
      fade: true,
      autoplaySpeed:<?php echo absint($options[$device . 'index_slider_time']); ?>,
      speed:1500,
      easing: 'easeOutExpo',
    });
    $('#header_slider_wrap .prev_item').on('click', function() {
      $('#header_slider').slick('slickPrev');
    });
    $('#header_slider_wrap .next_item').on('click', function() {
      $('#header_slider').slick('slickNext');
    });

    // initialize / first animate
    adjust_height();
    youtube_resize();
    video_resize();
    playPauseVideo($('#header_slider .item1'), 'play');
    $('#header_slider .item1').addClass('animate');
<?php if($options[$device.'index_slider_type'] == 'type3'){ ?>
    $('#header_content_post_list').addClass('active');
<?php }; ?>
  });

  // Resize event
  var currentWidth = $(window).innerWidth();
  $(window).on('resize', function(){
    adjust_height();
    if (currentWidth == $(this).innerWidth()) {
      return;
    } else {
      youtube_resize();
      video_resize();
    };
  });
