<?php
$navbarsettings = get_option("navbarsettings");
?>
<style>
    #floating-bar,#floating-bar *{position:relative;margin:0;padding:0;box-sizing:border-box}
	#floating-bar{position:fixed;z-index:999999;width:100%;min-width:100%;min-height:35px;bottom:0;left:0;right:0;background:#fff;box-shadow:0 0 5px rgba(0,0,0,.2);opacity:0;transition:opacity 0.3s,visibility 0.2s;visibility:hidden}
	#floating-bar.active{opacity:1;transition:opacity 0.2s,visibility 0.3s;visibility:visible}
	
	#floating-bar .floating-bar-inner{display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap}
	#floating-bar .floating-bar-btn-wrapper{-webkit-box-flex:1;-ms-flex:1 0;flex:1 0}
	#floating-bar .floating-bar-btn-wrapper:hover{background:rgba(0,0,0,.1);box-shadow:inset 0 0 4px rgba(0,0,0,.1)}#floating-bar .floating-bar-link{display:block;width:100%;height:100%;padding:10px;color:#777;text-align:center;transition:all .3s ease; text-decoration:none; pa}
	/*#floating-bar .floating-bar-icon{padding: 5px; background: white; border-radius: 50px;}*/
	#floating-bar .floating-bar-title{ display: block; font-size: 16px;font-weight: 700; }
	#floating-bar .floating-bar-icon i{ color:#998643;font-weight:bold; font-size:23px; }
	
	@media only screen and (min-width:1025px){
		#floating-bar.hide_on_standard,#floating-bar.hide_on_desktop{display:none}}
	@media only screen and (min-width:768px) and (max-width:1024px){#floating-bar.hide_on_tablet{display:none}}
	@media only screen and (max-width:767px){#floating-bar.hide_on_mobile{display:none}
	#floating-bar .floating-bar-title{ font-size: 14px;font-weight: 700; }
	#floating-bar .floating-bar-link{ padding:8px !important; }
	}
	/*hide_on_footer*/
  </style>
<div id="floating-bar" class="active hide_on_footer columns-4 nav_bottom" style="background-color:#21412a; border-top:5px solid #998643;">
  <div class="floating-bar-inner">
    
    <div id="floating-bar-btn-1" class="floating-bar-btn-wrapper navbar1"><a href="<?php echo $navbarsettings['menulink1'] ?>" target="_blank" title="Apply" data-navlink="1" class="floating-bar-link">
    
    <span class="floating-bar-icon"><i class="fa <?php echo $navbarsettings['menuicon1'] ?>" aria-hidden="true"></i></span>
    <span class="floating-bar-title" style="color: #ffffff"><?php echo $navbarsettings['menuTitle1'] ?></span></a></div>
      
    <div id="floating-bar-btn-2" class="floating-bar-btn-wrapper "><a href="<?php echo $navbarsettings['menulink2'] ?>" target="_blank" title="Inquire" data-navlink="2" class="floating-bar-link">
    
    <span class="floating-bar-icon"><i class="fa <?php echo $navbarsettings['menuicon2'] ?>" aria-hidden="true"></i></span>
    <span class="floating-bar-title" style="color: #ffffff"><?php echo $navbarsettings['menuTitle2'] ?></span></a></div>
      
    <div id="floating-bar-btn-3" class="floating-bar-btn-wrapper "><a href="<?php echo $navbarsettings['menulink3'] ?>" target="_blank" title="Visit" data-navlink="3" class="floating-bar-link">
    <span class="floating-bar-icon"><i style="" class="fa <?php echo $navbarsettings['menuicon3'] ?>" aria-hidden="true"></i></span>
    <span class="floating-bar-title" style="color: #ffffff"><?php echo $navbarsettings['menuTitle3'] ?></span></a></div>
      
    <div id="floating-bar-btn-4" class="floating-bar-btn-wrapper "><a href="<?php echo $navbarsettings['menulink4'] ?>" target="_blank" title="AccessFUS" data-navlink="4" class="floating-bar-link">
    <span class="floating-bar-icon"><i class="fa <?php echo $navbarsettings['menuicon4'] ?>" aria-hidden="true"></i></span>
    <span class="floating-bar-title" style="color: #ffffff"><?php echo $navbarsettings['menuTitle4'] ?></span></a></div>
      
    <div id="floating-bar-btn-4" class="floating-bar-btn-wrapper "><a href="<?php echo $navbarsettings['menulink5'] ?>" target="_blank" title="AccessFUS" data-navlink="4" class="floating-bar-link">
    
    <span class="floating-bar-icon"><i class="fa  <?php echo $navbarsettings['menuicon5'] ?>" aria-hidden="true"></i></span>
    <span class="floating-bar-title" style="color: #ffffff"><?php echo $navbarsettings['menuTitle5'] ?></span></a></div>
    
  </div>
</div>
<script type="text/javascript">
jQuery(function($) {
	 $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
           $('.hide_on_footer').hide();
        }else{
			$('.hide_on_footer').show();
        }
    });	
});
</script>