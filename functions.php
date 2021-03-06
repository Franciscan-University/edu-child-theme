<?php
/*remove oasis VC update button */
add_action('admin_head', 'hide_vc_publish_button');
 
function hide_vc_publish_button() { 
 echo '<style>
 
    div#vc_navbar #vc_button-update {
            display: none;
    }
 
    div#vc_navbar #wpb-save-post {
      display: none;
    }  
 </style>
';
}
/** Add meta boxes to custom post types - codepoetry
 * http://www.thecodepoetry.com/add-the7-meta-boxes-to-custom-post-types/
*/
function add_dt_metaboxes_custom( $pages ) {
      $pages[] = 'department';
      $pages[] = 'mec-events';
      $pages[] = 'dt_team';
      $pages[] = 'events';
	$pages[] = 'major'; // add each post type in new line
	return $pages;
}

add_filter( 'presscore_pages_with_basic_meta_boxes', 'add_dt_metaboxes_custom' );

/** Add tags to portfolio posts
 * https://gist.github.com/bigdigital/5aa522ee7c5f17c6d57c112888bbf602
*/
add_action( 'init', 'dt_register_taxonomy_for_object_type' );
function dt_register_taxonomy_for_object_type() {
	register_taxonomy_for_object_type( 'post_tag', 'dt_portfolio' );
};
//The7 add custom post types to microsite metaboxes https://gist.github.com/bigdigital/52ef920ba8a4d7f4f21ecc1d1b608d1f
function dt_add_CPT_to_microsite_metabox() {

	global $DT_META_BOXES;

	if ( $DT_META_BOXES ) {
        foreach($DT_META_BOXES  as $id => $metabox) {
	        if ( isset( $metabox['id'] ) && ( $metabox['id'] == 'dt_page_box-microsite' ) ||  ( $metabox['id'] == 'dt_page_box-microsite_logo' ) ) {
		        $DT_META_BOXES[$id]['pages'][] = 'my_custom_postytype';
		        break;
	        }
        }
	}
}

add_action( 'admin_init', 'dt_add_CPT_to_microsite_metabox', 30 );
//since The7 5.0.2 global log URL change
function my_custom_logo_url($url)
{
    return "franciscan.edu";
}

add_filter('presscore_display_the_logo-url', 'my_custom_logo_url' ,  10, 1 );

//bigdigital multisite global URL logo change
function my_presscore_display_the_logo_url($url) {
	$url = 'https://www.franciscan.edu';
		if ( presscore_is_microsite() && ( $m_url = get_post_meta( $post->ID, '_dt_microsite_logo_link', true ) ) ) {
		$url = $m_url;
	}
	return $url;
}
//* Defer jQuery Parsing using the HTML5 defer property
/*
if (!(is_admin() )) {
      function defer_parsing_of_js ( $url ) {
          if ( FALSE === strpos( $url, '.js' ) ) return $url;
          if ( strpos( $url, 'jquery.js' ) ) return $url;
          // return "$url' defer ";
          return "$url' defer onload='";
      }
      add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
  } */
//*remove gutenberg block editor
//*add_filter('use_block_editor_for_post', '__return_false', 10);

//echo "567567";
 class Push_Menu_Walker extends Walker_Nav_Menu {
        /**
         * Start the element output.
         *
         * @param  string $output Passed by reference. Used to append additional content.
         * @param  object $item   Menu item data object.
         * @param  int $depth     Depth of menu item. May be used for padding.
         * @param  array $args    Additional strings.
         * @return void
         */
        function start_el( &$output, $item, $depth = 5, $args = array(), $id = 0 ) {
			
			//$urlval = $_SERVER['REQUEST_URI'];
			$urlval = $args->walker_arg;
			$wholeurl = $item->url;
			$clsurl = "";

			if($urlval=="/") 
			{
				
				//$urlc = home_url();	$urln = home_url()."/";
				
				$urlini = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://");
				$urlc = $urlini.$_SERVER['HTTP_HOST'];
				$urln = $urlini.$_SERVER['HTTP_HOST']."/"; 
				
				//if (strpos($wholeurl, $urlc) !== false) 
				if($urlc==$wholeurl || $urln==$wholeurl)
				{
					$clsurl = "mm-listitem_selected";
				}
				else
				{
					$clsurl = "";
				}
				
			} 
			else 
			{
				if (strpos($wholeurl, $urlval) !== false) 
				{
					$clsurl = "mm-listitem_selected";
				}
				else
				{
					$clsurl = "";
				}		
			}

            $output .= "<li class='menu_".$item->ID." ".$clsurl." '>";

            $attributes  = '';
            $title = $item->title;
            $desc = $item->description;
            $classes = $item->classes;
                    //["classes"] => array(8) {
                    //    [0]=> string(0) "" <-- THIS IS THE CUSTOM CLASS
                    //    [1]=> string(9) "menu-item" 
                     //   [2]=> string(24) "menu-item-type-post_type" 
                    //    [3]=> string(21) "menu-item-object-page" 
                     //   [4]=> string(17) "current-menu-item" 
                     //   [5]=> string(9) "page_item"
                     //   [6]=> string(12) "page-item-50"
                     //   [7]=> string(17) "current_page_item"
                   // }
            $font_awesome_class = ' class="fa fa-'. $classes[0] . '"';

            ! empty( $item->url )
                and $attributes .= ' href="'   . esc_attr( $item->url ) .'"';

            $title = apply_filters( 'the_title', $item->title, $item->ID );

            if (!empty ( $classes[0] )) : // If we have a custom class, add the H2 + icon
                    $item_output = $args->before
                        . "<a $attributes>"
                        .       $args->link_before
                        .       $title
                        . '</a> '
                        . '<h2>'
                        .       '<i ' . $font_awesome_class . '></i>'
                        .       $title
                        . '</h2>'
                        . $args->link_after
                        // . $description <-- Not needed for now...
                        . $args->after;
            else :
			
			if($item->url=="#" || $item->url=="")
			{
				$item_output = $args->before
                        . "<span $attributes>"
                        . $args->link_before
                        . $title
                        . '</span> '
                        . $args->link_after
                        . $args->after;
			}
			else
			{
				 $item_output = $args->before
                        . "<a $attributes>"
                        . $args->link_before
                        . $title
                        . '</a> '
                        . $args->link_after
                        . $args->after;
			}
                 
            endif;

            // Since $output is called by reference we don't need to return anything.
            $output .= apply_filters(
                'walker_nav_menu_start_el',
                $item_output,
                $item,
                $depth,
                $args
            );
        }
    }

function remove_link_contact_menu($item_output, $item) {

    if ($item->post_name == 'contact')
        return '<span>' . $item->title . '</span>';

    return $item_output;
}
//add_filter('walker_nav_menu_start_el', 'remove_link_contact_menu', 20, 2);
add_filter('megamenu_walker_nav_menu_start_el', 'remove_link_contact_menu', 20, 2);
	
function custom_mmmenu_func() {	
	//echo $urlc = home_url()."+++";
 ?>
<link type="text/css" rel="stylesheet" href="<?php echo home_url(); ?>/wp-content/themes/dt-the7-child/newmenu/mmenu1.css" />
<nav id="menu123">
  <?php
//mm-listitem_selected
//switch_to_blog( 1 );
//wp_nav_menu( array( 'menu' => 'Home', 'container'=>'', 'walker' => new Push_Menu_Walker()) );
//restore_current_blog();
?>
</nav>
<style>
#menu {
	background: #fff;
}
.sm-logo {
	padding: 30px 25px 25px;
	text-align: center;
}
.mm-listview li {
	line-height:unset;
}
.mm-btn_next {
	border-left:unset !important;
}
.menu-item a {
	border-left:unset !important;
	;
	border-right:unset !important;
}
#menu-home li {
	margin:unset;
	padding:unset;
}
.mm-listitem a {
	/*font-size: 22px;*/
text-align: left;
	font-family: 'Roboto';
	color:#6e7072 !important;
	font: bold 18px/24px "Roboto", sans-serif !important;
	font-weight: 400;
	color:rgb(97, 97, 97) !important;
	padding-left:30px;
	text-align: left;
	-webkit-transition: all .5s ease;
	-moz-transition: all .5s ease;
	transition: all .5s ease;
}
.mm-listitem::after {
	border:none !important;
}
#menu-home .mm-listitem {
	border-bottom: solid 1px;
	border-color: rgba( 0,0,0, 0.1 );
	border-bottom-width: 2px;
}
.mm-panel_opened .mm-listitem {
	border-bottom: solid 1px;
	border-color: rgba( 0,0,0, 0.1 );
	border-bottom-width: 2px;
}
#menu-home .menu_13036 {
	border-bottom: solid 1px !important;
	border-color: rgba( 0,0,0, 0.1 ) !important;
	border-bottom-width: 2px !important;
}
.mm-listitem_selected {
	background:#CCC !important;
}
/*border-color: rgba( 0,0,0, 0.1 ) !important;
    border-bottom-width: 2px !important;	*/

.mm-listitem a:hover {
	font-size: 25px;
	color:rgb(97, 97, 97) !important;
	background:#CCC;
}
.mm-navbar_sticky {
	display:none;
}
.backbtn a {
	font-family: "Roboto", sans-serif !important;
	color: #6e7072 !important;
	font-size: 15px;
	font-weight: bold;
}
.homebtn a {
	font-family: "Roboto", sans-serif !important;
	color: #6e7072 !important;
	font-size: 15px;
	font-weight: bold;
}
.copytext {
	font-family: "Roboto", sans-serif !important;
	color: #6e7072 !important;
	font-size: 15px;
}
.mm-navbars_bottom .mm-navbar {
	min-height: 25px !important;
	height: 20px !important;
}

.mm-navbars_bottom .mm-navbar:nth-child(2)
{
	margin-bottom:20px !important;
}

/*.mm-menu_offcanvas{ max-width:350px !important; }*/

.menu_13384 {
	padding:60px 0 0 0 !important;
}


.menu_13384, .menu_16077, .menu_13380, .menu_16076, .menu_13383, .menu_13381 {
	border:none !important;
}

.menu_13384 a, .menu_13382 a,.menu_16077 a, .menu_13380 a, .menu_16076 a, .menu_13383 a, .menu_13381 a {
	 padding:4px !important;
	 padding-left:42px !important;
}

.menu_13382 {
	border:none !important;
}

.logoborder {
	border-bottom:solid #998643 !important;
	clear:both;
}
.sm-search-field {
	font-size: 20px;
	text-align: left;
	color: rgba(133,133,133,0.71);
	padding-left: 50px;
	padding-right: 50px;
}
.closbuton {
	float:left;
}
.closemenu {
	cursor:pointer;
	padding-left: 15px;
}

.mm-listitem__text{ white-space:unset !important }
.dt-close-mobile-menu-icon{ display:none !important; }
</style>
<script src="<?php echo home_url(); ?>/wp-content/themes/dt-the7-child/newmenu/mmenu.polyfills.js"></script>
<script src="<?php echo home_url(); ?>/wp-content/themes/dt-the7-child/newmenu/mmenu.js"></script>
<script>			
			
			//<i class="icomoon-the7-font-the7-cross-01"></i>
			
			document.addEventListener(
        "DOMContentLoaded", () => {
            const menu = new Mmenu( "#menu123", {
                       "extensions": [
                          "pagedim-black",
						  "position-front",
                          "position-right", "theme-white"
                       ],
					   "navbars": [{
			height 	: 2,
			content : [ 
				'<div class="closemenu"><i class="icomoon-the7-font-the7-cross-01"></i></div>'
			]
		},{
			height 	: 2,
			content : [ 
				'<div class="sm-logo"><a href="https://www.franciscan.edu" target="_blank"> <img class="sm-animated" alt="logo" src="https://franciscan.edu/wp-content/uploads/2019/10/FUS_digital-use_hor_C-e1570472931678.png" style="max-width: 80%;height: auto;"></a></div>'
			]
		}, { height:2, content :['<div class="sm-search sm-animated"><form method="get" class="sm-search-form" action="<?php echo home_url() ?>" style="width:100%;"><input type="search" class="sm-search-field" placeholder="Search …" value="" style="width:100%;" name="s"></form></div>'] },{ height:2, content :['<div class="mainban"> <div style="float: left;text-align: left;width: 70%;padding-left: 25px;" class="backbtn"><a href="#"><span style="float: left;padding-top: 2px;padding-right: 5px;"><i class="icomoon-the7-font-the7-arrow-06"></i></span><span style="float: left;">Up One Level</span></a></div> <div style="float: right;text-align: right;width: 30%;padding-right: 25px;" class="homebtn"><a href="#menu-home"><div style="float: left; padding-right: 6px;"><i class="icomoon-the7-font-the7-home-04"></i></div> <div style="float: left;">Go Home</div></a></div> </div>'] }, {
                     "position": "bottom",
                     "content": [
                        "<div class='soc-ico show-on-desktop in-top-bar-right in-menu-second-switch custom-bg disabled-border border-off hover-accent-bg hover-disabled-border  hover-border-off first'><a title='Facebook' href='https://www.facebook.com/FranciscanUniversity' target='_blank' class='facebook' rel='noopener'><span class='soc-font-icon'></span><span class='screen-reader-text'>Facebook</span></a><a title='Instagram' href='https://www.instagram.com/franciscanuniversity/' target='_blank' class='instagram' rel='noopener'><span class='soc-font-icon'></span><span class='screen-reader-text'>Instagram</span></a><a title='Twitter' href='https://twitter.com/FranciscanU' target='_blank' class='twitter' rel='noopener'><span class='soc-font-icon'></span><span class='screen-reader-text'>Twitter</span></a><a title='YouTube' href='https://www.youtube.com/user/FranciscanUSteubie' target='_blank' class='you-tube' rel='noopener'><span class='soc-font-icon'></span><span class='screen-reader-text'>YouTube</span></a></div>"
                     ]
                  }, {
                     "position": "bottom",
                     "content": [
                        "<div class='copytext'>© 2020 Franciscan University of Steubenville</div>"
                     ]
                  } ]
					   
            } );
            const api = menu.API;			
				
				jQuery(document).ready(function(e) {
					
					jQuery('.menu-toggle').click(function(e) {
						e.preventDefault(); e.stopImmediatePropagation();
					e.stopPropagation();
					api.open();                    
						
					});
					jQuery('.dt-mobile-menu-icon').click(function(e) {
						e.preventDefault(); e.stopImmediatePropagation();
					e.stopPropagation();
					api.open();                    
						
					});
					
					jQuery('.closemenu').click(function(e) {
						api.close();
					});
					
					jQuery('.mainban').hide(); 
				jQuery('.mm-btn_next, .backbtn, .homebtn').click(function(e) {
                    
					setTimeout(function(){ 				
					
						link1 = jQuery('.mm-panel_opened .mm-btn_prev').attr('href');
						if(jQuery('.mm-panel_opened').find('.mm-btn_prev').length !== 0)
						{
							jQuery('.mainban').show();
							//jQuery('.backbtn').html("<a href='"+link1+"'>Up One Level</a>");
							jQuery('.backbtn').html("<a href='"+link1+"'><span style='float: left;padding-top: 2px;padding-right: 5px;'><i class='icomoon-the7-font-the7-arrow-06'></i></span><span style='float: left;'>Up One Level</span></a>");
						}
						else
						{	
							jQuery('.mainban').hide();						
						}
					 }, 500);
					
					
                });
				
				jQuery('.sm-logo').parent().addClass('logoborder');
				jQuery('.closemenu').parent().addClass('closbuton');
				
				
				setTimeout(function(){ 				
					
						link1 = jQuery('.mm-panel_opened .mm-btn_prev').attr('href');
						if(jQuery('.mm-panel_opened').find('.mm-btn_prev').length !== 0)
						{
							jQuery('.mainban').show();
							//jQuery('.backbtn').html("<a href='"+link1+"'>Up One Level</a>");
							jQuery('.backbtn').html("<a href='"+link1+"'><span style='float: left;padding-top: 2px;padding-right: 5px;'><i class='icomoon-the7-font-the7-arrow-06'></i></span><span style='float: left;'>Up One Level</span></a>");
						}
						else
						{	
							jQuery('.mainban').hide();						
						}
					 }, 1000);
				
					
			});				
        }
    );
	
			jQuery(document).ready(function(e) {
				
				jQuery.ajax({
			type: "POST",
			data: 'action=ajax_call_file_actions&type=getmenu&purl=<?php echo $_SERVER['REQUEST_URI']; ?>',
			url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
			success: function(result) {
				//alert(result);
				jQuery('#menu123').html(result);
				
				const menu = new Mmenu( "#menu123", {
                       "extensions": [
                          "pagedim-black",
						  "position-front",
                          "position-right", "theme-white"
                       ],
					   "navbars": [{
			height 	: 2,
			content : [ 
				'<div class="closemenu"><i class="icomoon-the7-font-the7-cross-01"></i></div>'
			]
		},{
			height 	: 2,
			content : [ 
				'<div class="sm-logo"><a href="https://www.franciscan.edu" target="_blank"> <img class="sm-animated" alt="logo" src="https://franciscan.edu/wp-content/uploads/2019/10/FUS_digital-use_hor_C-e1570472931678.png" style="max-width: 80%;height: auto;"></a></div>'
			]
		}, { height:2, content :['<div class="sm-search sm-animated"><form method="get" class="sm-search-form" action="<?php echo home_url() ?>" style="width:100%;"><input type="search" class="sm-search-field" placeholder="Search …" value="" style="width:100%;" name="s"></form></div>'] },{ height:2, content :['<div class="mainban"> <div style="float: left;text-align: left;width: 70%;padding-left: 25px;" class="backbtn"><a href="#"><span style="float: left;padding-top: 2px;padding-right: 5px;"><i class="icomoon-the7-font-the7-arrow-06"></i></span><span style="float: left;">Up One Level</span></a></div> <div style="float: right;text-align: right;width: 30%;padding-right: 25px;" class="homebtn"><a href="#menu-home"><div style="float: left; padding-right: 6px;"><i class="icomoon-the7-font-the7-home-04"></i></div> <div style="float: left;">Go Home</div></a></div> </div>'] }, {
                     "position": "bottom",
                     "content": [
                        "<div class='soc-ico show-on-desktop in-top-bar-right in-menu-second-switch custom-bg disabled-border border-off hover-accent-bg hover-disabled-border  hover-border-off first'><a title='Facebook' href='https://www.facebook.com/FranciscanUniversity' target='_blank' class='facebook' rel='noopener'><span class='soc-font-icon'></span><span class='screen-reader-text'>Facebook</span></a><a title='Instagram' href='https://www.instagram.com/franciscanuniversity/' target='_blank' class='instagram' rel='noopener'><span class='soc-font-icon'></span><span class='screen-reader-text'>Instagram</span></a><a title='Twitter' href='https://twitter.com/FranciscanU' target='_blank' class='twitter' rel='noopener'><span class='soc-font-icon'></span><span class='screen-reader-text'>Twitter</span></a><a title='YouTube' href='https://www.youtube.com/user/FranciscanUSteubie' target='_blank' class='you-tube' rel='noopener'><span class='soc-font-icon'></span><span class='screen-reader-text'>YouTube</span></a></div>"
                     ]
                  }, {
                     "position": "bottom",
                     "content": [
                        "<div class='copytext'>© 2020 Franciscan University of Steubenville</div>"
                     ]
                  } ]
					   
            } );
            const api = menu.API;			
				
				jQuery(document).ready(function(e) {
					
					jQuery('.menu-toggle').click(function(e) {
						e.preventDefault(); e.stopImmediatePropagation();
					e.stopPropagation();
					api.open();                    
						
					});
					jQuery('.dt-mobile-menu-icon').click(function(e) {
						e.preventDefault(); e.stopImmediatePropagation();
					e.stopPropagation();
					api.open();                    
						
					});
					
					jQuery('.closemenu').click(function(e) {
						api.close();
					});
					
					jQuery('.mainban').hide(); 
				jQuery('.mm-btn_next, .backbtn, .homebtn').click(function(e) {
                    
					setTimeout(function(){ 				
					
						link1 = jQuery('.mm-panel_opened .mm-btn_prev').attr('href');
						if(jQuery('.mm-panel_opened').find('.mm-btn_prev').length !== 0)
						{
							jQuery('.mainban').show();
							//jQuery('.backbtn').html("<a href='"+link1+"'>Up One Level</a>");
							jQuery('.backbtn').html("<a href='"+link1+"'><span style='float: left;padding-top: 2px;padding-right: 5px;'><i class='icomoon-the7-font-the7-arrow-06'></i></span><span style='float: left;'>Up One Level</span></a>");
						}
						else
						{	
							jQuery('.mainban').hide();						
						}
					 }, 500);
					
					
                });
				
				jQuery('.sm-logo').parent().addClass('logoborder');
				jQuery('.closemenu').parent().addClass('closbuton');
				
				
				setTimeout(function(){ 				
					
						link1 = jQuery('.mm-panel_opened .mm-btn_prev').attr('href');
						if(jQuery('.mm-panel_opened').find('.mm-btn_prev').length !== 0)
						{
							jQuery('.mainban').show();
							//jQuery('.backbtn').html("<a href='"+link1+"'>Up One Level</a>");
							jQuery('.backbtn').html("<a href='"+link1+"'><span style='float: left;padding-top: 2px;padding-right: 5px;'><i class='icomoon-the7-font-the7-arrow-06'></i></span><span style='float: left;'>Up One Level</span></a>");
						}
						else
						{	
							jQuery('.mainban').hide();						
						}
					 }, 1000);
				
					
			});
				
			}
		});
				
			});
			
</script>
    <script>
      function myFunction() {
        var input, filter, ul, li, a, i, txtValue, nores, background;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByClassName("maj");
        background = document.getElementById("backgroundImage");
        for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByTagName("span")[0];
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "inline-block";
            background.style.opacity = "0.5";
          } else {
            li[i].style.display = "none";
          }
        }
        //     hide list of majors after searching
        if (input.value === "") {
          ul.style.display = "none";
          background.style.opacity = "1";
        } else {
          ul.style.display = "";
        }
      }
    </script>
<?php
}
add_action( 'wp_footer', 'custom_mmmenu_func' );
add_action('wp_ajax_ajax_call_file_actions', 'ajax_call_file_actions');
add_action('wp_ajax_nopriv_ajax_call_file_actions', 'ajax_call_file_actions');
function ajax_call_file_actions()
{
	switch_to_blog( 1 );
	wp_nav_menu( array( 'menu' => 'Home', 'container'=>'', 'walker' => new Push_Menu_Walker(), 'walker_arg' => $_POST['purl']) );
	restore_current_blog();
exit;
}
add_action( 'wp_footer', 'custom_floatingbar' );
function custom_floatingbar(){
	include("footerbar.php");
}

add_action('admin_menu', 'navbar_backend_custom_page');
function navbar_backend_custom_page() {
   add_menu_page("Navbar Settings", "Navbar Settings", 'manage_options', "navbar_settings", "navbar_settings"); 
 }

function navbar_settings()
{
	include("footerbarback.php");
}
add_filter( 'presscore_post_type_dt_testimonials_args', 'my_testimonials_slug' );
function my_testimonials_slug( $args ) {
    $args['rewrite'] = array('slug' => 'voices');
    return $args;
}
