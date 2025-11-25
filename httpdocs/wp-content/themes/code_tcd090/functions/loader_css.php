<?php
     $options = get_design_plus_option();
     if($options['show_load_screen'] != 'type1'){ 
?>
#site_wrap { display:none; }
#site_loader_overlay { background:<?php echo esc_attr($options['load_bgcolor']); ?>; opacity:1; position:fixed; top:0px; left:0px; width:100%; height:100%; width:100%; height:100vh; z-index:99999; }
#site_loader_overlay.slide_up {
  top:-100vh; opacity:0;
  -webkit-transition: transition: top 0.7s cubic-bezier(0.83, 0, 0.17, 1) 0.4s, opacity 0s cubic-bezier(0.83, 0, 0.17, 1) 1.5s;
  transition: top 0.7s cubic-bezier(0.83, 0, 0.17, 1) 0.4s, opacity 0s cubic-bezier(0.83, 0, 0.17, 1) 1.5s;
}
#site_loader_overlay.slide_down {
  top:100vh; opacity:0;
  -webkit-transition: transition: top 0.7s cubic-bezier(0.83, 0, 0.17, 1) 0.4s, opacity 0s cubic-bezier(0.83, 0, 0.17, 1) 1.5s;
  transition: top 0.7s cubic-bezier(0.83, 0, 0.17, 1) 0.4s, opacity 0s cubic-bezier(0.83, 0, 0.17, 1) 1.5s;
}
#site_loader_overlay.slide_left {
  left:-100%; opactiy:0;
  -webkit-transition: transition: left 0.7s cubic-bezier(0.83, 0, 0.17, 1) 0.4s, opacity 0s cubic-bezier(0.83, 0, 0.17, 1) 1.5s;
  transition: left 0.7s cubic-bezier(0.83, 0, 0.17, 1) 0.4s, opacity 0s cubic-bezier(0.83, 0, 0.17, 1) 1.5s;
}
#site_loader_overlay.slide_right {
  left:100%; opactiy:0;
  -webkit-transition: transition: left 0.7s cubic-bezier(0.83, 0, 0.17, 1) 0.4s, opacity 0s cubic-bezier(0.83, 0, 0.17, 1) 1.5s;
  transition: left 0.7s cubic-bezier(0.83, 0, 0.17, 1) 0.4s, opacity 0s cubic-bezier(0.83, 0, 0.17, 1) 1.5s;
}
<?php
     // display logo or catchphrase ---------------------------------------------------------------------
     if($options['load_icon'] == 'type4' || $options['load_icon'] == 'type5'){
?>
#site_loader_logo { position:relative; width:100%; height:100%; }
#site_loader_logo_inner {
  position:absolute; text-align:center; width:100%;
  top:50%; -ms-transform: translateY(-50%); -webkit-transform: translateY(-50%); transform: translateY(-50%);
}
#site_loader_overlay.active #site_loader_logo_inner {
  opacity:0;
  -webkit-transition: all 1.0s cubic-bezier(0.22, 1, 0.36, 1) 0s; transition: all 1.0s cubic-bezier(0.22, 1, 0.36, 1) 0s;
}
#site_loader_logo img.mobile { display:none; }
#site_loader_logo .catch { line-height:1.6; padding:0 50px; width:100%; -webkit-box-sizing:border-box; box-sizing:border-box; }
#site_loader_logo_inner .message { text-align:left; margin:30px auto 0; display:table; }
#site_loader_logo.no_logo .message { margin-top:0 !important; }
#site_loader_logo_inner .message.type2 { text-align:center; }
#site_loader_logo_inner .message.type3 { text-align:right; }
#site_loader_logo_inner .message_inner { display:inline; line-height:1.5; margin:0; }
@media screen and (max-width:750px) {
  #site_loader_logo.has_mobile_logo img.pc { display:none; }
  #site_loader_logo.has_mobile_logo img.mobile { display:inline; }
  #site_loader_logo .message { margin:23px auto 0; }
  #site_loader_logo .catch { padding:0 20px; }
}

/* ----- animation ----- */
#site_loader_logo .logo_image { opacity:0; }
#site_loader_logo.use_normal_animation .catch { opacity:0; }
#site_loader_logo.use_text_animation .catch span { opacity:0; position:relative; }
#site_loader_logo .message { opacity:0; }
#site_loader_logo.active .logo_image {
  -webkit-animation: opacityAnimation 1.4s ease forwards 0.5s;
  animation: opacityAnimation 1.4s ease forwards 0.5s;
}
#site_loader_logo img.use_logo_animation {
	position:relative;
  -webkit-animation: slideUpDown 1.5s ease-in-out infinite 0s;
  animation: slideUpDown 1.5s ease-in-out infinite 0s;
}
#site_loader_logo.use_normal_animation.active .catch {
  -webkit-animation: opacityAnimation 1.4s ease forwards 0.5s;
  animation: opacityAnimation 1.4s ease forwards 0.5s;
}
#site_loader_logo.use_text_animation .catch span.animate {
  -webkit-animation: text_animation 0.5s ease forwards 0s;
  animation: text_animation 0.5s ease forwards 0s;
}
#site_loader_logo.use_normal_animation.active .message {
  -webkit-animation: opacityAnimation 1.4s ease forwards 1.5s;
  animation: opacityAnimation 1.4s ease forwards 1.5s;
}
#site_loader_logo.use_text_animation.active .message {
  -webkit-animation: opacityAnimation 1.4s ease forwards 2s;
  animation: opacityAnimation 1.4s ease forwards 2s;
}
#site_loader_logo_inner .text { display:inline; }
#site_loader_logo_inner .dot_animation_wrap { display:inline; margin:0 0 0 4px; position:absolute; }
#site_loader_logo_inner .dot_animation { display:inline; }
#site_loader_logo_inner i {
  width:2px; height:2px; margin:0 4px 0 0; border-radius:100%;
  display:inline-block; background:#000;
  -webkit-animation: loading-dots-middle-dots 0.5s linear infinite; -ms-animation: loading-dots-middle-dots 0.5s linear infinite; animation: loading-dots-middle-dots 0.5s linear infinite;
}
#site_loader_logo_inner i:first-child {
  opacity: 0;
  -webkit-animation: loading-dots-first-dot 0.5s infinite; -ms-animation: loading-dots-first-dot 0.5s linear infinite; animation: loading-dots-first-dot 0.5s linear infinite;
  -webkit-transform: translate(-4px); -ms-transform: translate(-4px); transform: translate(-4px);
}
#site_loader_logo_inner i:last-child {
  -webkit-animation: loading-dots-last-dot 0.5s linear infinite; -ms-animation: loading-dots-last-dot 0.5s linear infinite; animation: loading-dots-last-dot 0.5s linear infinite;
}
@-webkit-keyframes loading-dots-fadein{
  100% { opacity:1; }
}
@keyframes loading-dots-fadein{
  100% { opacity:1; }
}
@-webkit-keyframes loading-dots-first-dot {
  100% { -webkit-transform:translate(6px); -ms-transform:translate(6px); transform:translate(6px); opacity:1; }
}
@keyframes loading-dots-first-dot {
  100% {-webkit-transform:translate(6px);-ms-transform:translate(6px); transform:translate(6px); opacity:1; }
}
@-webkit-keyframes loading-dots-middle-dots { 
  100% { -webkit-transform:translate(6px); -ms-transform:translate(6px); transform:translate(6px) }
}
@keyframes loading-dots-middle-dots {
  100% { -webkit-transform:translate(6px); -ms-transform:translate(6px); transform:translate(6px) }
}
@-webkit-keyframes loading-dots-last-dot {
  100% { -webkit-transform:translate(6px); -ms-transform:translate(6px); transform:translate(6px); opacity:0; }
}
@keyframes loading-dots-last-dot {
  100% { -webkit-transform:translate(6px); -ms-transform:translate(6px); transform:translate(6px); opacity:0; }
}
<?php
     // circle animation ------------------------------------------------------------------------------------
     } elseif($options['load_icon'] == 'type1'){
?>
#site_loader_animation, #site_loader_animation:before, #site_loader_animation:after {
  border-radius: 50%;
}
#site_loader_animation {
  color: <?php echo $options['load_color1']; ?>;
  position:absolute; margin:-30px 0 0 -30px;
  left:50%; top:50%; -ms-transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);
  width:60px; height:60px; box-shadow: inset 0 0 0 5px;
  -webkit-transform: translateZ(0); -ms-transform: translateZ(0); transform: translateZ(0);
}
#site_loader_animation:before, #site_loader_animation:after {
  position: absolute;
  content: '';
}
#site_loader_animation:before {
  background: <?php echo $options['load_bgcolor']; ?>;
  width:32px; height:62px; border-radius:62px 0 0 62px;
  top:-1px; left:-1px;
  -webkit-transform-origin: 31px 31px; transform-origin: 31px 31px;
  -webkit-animation: load2 1.6s infinite ease 0s; animation: load2 1.6s infinite ease 0s;
}
#site_loader_animation:after {
  background: <?php echo $options['load_bgcolor']; ?>;
  width:32px; height:62px; border-radius:0 62px 62px 0;
  top:-1px; left:50%;
  -webkit-transform-origin: 0% 50%; transform-origin: 0% 50%;
  -webkit-animation: load2 1.6s infinite ease 0.3s; animation: load2 1.6s infinite ease 0.3s;
}
@-webkit-keyframes load2 {
  0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
}
@keyframes load2 {
  0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
}
@media screen and (max-width:750px) {
  #site_loader_animation { margin:-20px 0 0 -20px; width:40px; height:40px; box-shadow: inset 0 0 0 4px; }
  #site_loader_animation:before {
    width:22px; height:42px; border-radius:42px 0 0 42px;
    -webkit-transform-origin: 21px 21px; transform-origin: 21px 21px;
  }
  #site_loader_animation:after { width:22px; height:42px; border-radius:0 42px 42px 0; }
}

}

<?php
     // square animation ------------------------------------------------------------------------------------
     } elseif($options['load_icon'] == 'type2'){
?>
.sk-cube-grid {
  width:60px; height:60px;
  position:absolute; left:50%; top:50%; -ms-transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);
}
@media screen and (max-width:750px) {
  .sk-cube-grid { width:40px; height:40px; }
}
.sk-cube-grid .sk-cube {
  background-color: <?php echo $options['load_color1']; ?>;
  width:33%; height:33%; float:left;
  -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out; animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out; 
}
.sk-cube-grid .sk-cube1 { -webkit-animation-delay: 0.2s; animation-delay: 0.2s; }
.sk-cube-grid .sk-cube2 { -webkit-animation-delay: 0.3s; animation-delay: 0.3s; }
.sk-cube-grid .sk-cube3 { -webkit-animation-delay: 0.4s; animation-delay: 0.4s; }
.sk-cube-grid .sk-cube4 { -webkit-animation-delay: 0.1s; animation-delay: 0.1s; }
.sk-cube-grid .sk-cube5 { -webkit-animation-delay: 0.2s; animation-delay: 0.2s; }
.sk-cube-grid .sk-cube6 { -webkit-animation-delay: 0.3s; animation-delay: 0.3s; }
.sk-cube-grid .sk-cube7 { -webkit-animation-delay: 0s; animation-delay: 0s; }
.sk-cube-grid .sk-cube8 { -webkit-animation-delay: 0.1s; animation-delay: 0.1s; }
.sk-cube-grid .sk-cube9 { -webkit-animation-delay: 0.2s; animation-delay: 0.2s; }
@-webkit-keyframes sk-cubeGridScaleDelay {
  0%, 70%, 100% { -webkit-transform: scale3D(1, 1, 1); transform: scale3D(1, 1, 1); }
  35% { -webkit-transform: scale3D(0, 0, 1); transform: scale3D(0, 0, 1); }
}
@keyframes sk-cubeGridScaleDelay {
  0%, 70%, 100% { -webkit-transform: scale3D(1, 1, 1); transform: scale3D(1, 1, 1); }
  35% { -webkit-transform: scale3D(0, 0, 1); transform: scale3D(0, 0, 1); }
}
<?php
     // dot animation ------------------------------------------------------------------------------------
     } elseif($options['load_icon'] == 'type3'){
?>
.sk-circle {
  width:60px; height:60px;
  position:absolute; left:50%; top:50%; -ms-transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);
}
@media screen and (max-width:750px) {
  .sk-circle { width:40px; height:40px; }
}
.sk-circle .sk-child {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
}
.sk-circle .sk-child:before {
  content: '';
  display: block;
  margin: 0 auto;
  width: 15%;
  height: 15%;
  background-color: <?php echo $options['load_color1']; ?>;
  border-radius: 100%;
  -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
          animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
}
.sk-circle .sk-circle2 {
  -webkit-transform: rotate(30deg);
      -ms-transform: rotate(30deg);
          transform: rotate(30deg); }
.sk-circle .sk-circle3 {
  -webkit-transform: rotate(60deg);
      -ms-transform: rotate(60deg);
          transform: rotate(60deg); }
.sk-circle .sk-circle4 {
  -webkit-transform: rotate(90deg);
      -ms-transform: rotate(90deg);
          transform: rotate(90deg); }
.sk-circle .sk-circle5 {
  -webkit-transform: rotate(120deg);
      -ms-transform: rotate(120deg);
          transform: rotate(120deg); }
.sk-circle .sk-circle6 {
  -webkit-transform: rotate(150deg);
      -ms-transform: rotate(150deg);
          transform: rotate(150deg); }
.sk-circle .sk-circle7 {
  -webkit-transform: rotate(180deg);
      -ms-transform: rotate(180deg);
          transform: rotate(180deg); }
.sk-circle .sk-circle8 {
  -webkit-transform: rotate(210deg);
      -ms-transform: rotate(210deg);
          transform: rotate(210deg); }
.sk-circle .sk-circle9 {
  -webkit-transform: rotate(240deg);
      -ms-transform: rotate(240deg);
          transform: rotate(240deg); }
.sk-circle .sk-circle10 {
  -webkit-transform: rotate(270deg);
      -ms-transform: rotate(270deg);
          transform: rotate(270deg); }
.sk-circle .sk-circle11 {
  -webkit-transform: rotate(300deg);
      -ms-transform: rotate(300deg);
          transform: rotate(300deg); }
.sk-circle .sk-circle12 {
  -webkit-transform: rotate(330deg);
      -ms-transform: rotate(330deg);
          transform: rotate(330deg); }
.sk-circle .sk-circle2:before {
  -webkit-animation-delay: -1.1s;
          animation-delay: -1.1s; }
.sk-circle .sk-circle3:before {
  -webkit-animation-delay: -1s;
          animation-delay: -1s; }
.sk-circle .sk-circle4:before {
  -webkit-animation-delay: -0.9s;
          animation-delay: -0.9s; }
.sk-circle .sk-circle5:before {
  -webkit-animation-delay: -0.8s;
          animation-delay: -0.8s; }
.sk-circle .sk-circle6:before {
  -webkit-animation-delay: -0.7s;
          animation-delay: -0.7s; }
.sk-circle .sk-circle7:before {
  -webkit-animation-delay: -0.6s;
          animation-delay: -0.6s; }
.sk-circle .sk-circle8:before {
  -webkit-animation-delay: -0.5s;
          animation-delay: -0.5s; }
.sk-circle .sk-circle9:before {
  -webkit-animation-delay: -0.4s;
          animation-delay: -0.4s; }
.sk-circle .sk-circle10:before {
  -webkit-animation-delay: -0.3s;
          animation-delay: -0.3s; }
.sk-circle .sk-circle11:before {
  -webkit-animation-delay: -0.2s;
          animation-delay: -0.2s; }
.sk-circle .sk-circle12:before {
  -webkit-animation-delay: -0.1s;
          animation-delay: -0.1s; }

@-webkit-keyframes sk-circleBounceDelay {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0);
  } 40% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}

@keyframes sk-circleBounceDelay {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0);
  } 40% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}
<?php } ?>

#site_loader_overlay.active #site_loader_animation {
  opacity:0;
  -webkit-transition: all 1.0s cubic-bezier(0.22, 1, 0.36, 1) 0s; transition: all 1.0s cubic-bezier(0.22, 1, 0.36, 1) 0s;
}

<?php } // END show_load_screen ?>
