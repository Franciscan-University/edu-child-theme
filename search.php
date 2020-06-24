<?php
/**
 * Search results page.
 *
 * @since   1.0.0
 *
 * @package The7\Templates
 */
defined( 'ABSPATH' ) || exit;

$config = presscore_config();
$config->set( 'template', 'search' );
$config->set( 'layout', 'masonry' );
$config->set( 'template.layout.type', 'masonry' );

global $wpdb;
get_header();
$searchWord = $_GET['s'];
//$blog_list = get_site_transient( 'multisite_blog_list' );

//echo "SELECT blog_id from $wpdb->blogs WHERE public = '0' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0';";echo "<br><br>";

//$blogrows =  $wpdb->get_results( "SELECT blog_id from wp_6637def821_blogs WHERE public = '0' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0'" );

//restore_current_blog();

$nquery = '';
$mainhtml = '';
/*
foreach($blogrows as $blogrow)
{
	
	if($blogrow->blog_id==1)
	{
		continue;
	}
	
	if($blogrow->blog_id==1)
	{
		//$nquery = " select ID, post_title, post_content, @blogid:=".$blogrow->blog_id." from wp_6637def821_posts where post_status = 'publish' and post_type = 'post' and (post_title like '%".$searchWord."%' OR post_content like '%".$searchWord."%') ";
		$nquery = " select ID, post_title, post_content from wp_6637def821_posts where post_status = 'publish' and post_type = 'post' and (post_title like '%".$searchWord."%' OR post_content like '%".$searchWord."%') limit 1 ";
	}
	else
	{
		//$nquery = " select ID, post_title, post_content, @blogid:=".$blogrow->blog_id." from wp_6637def821_".$blogrow->blog_id."_posts where post_status = 'publish' and post_type = 'post' and (post_title like '%".$searchWord."%' OR post_content like '%".$searchWord."%') ";
		$nquery = " select ID, post_title, post_content from wp_6637def821_".$blogrow->blog_id."_posts where post_status = 'publish' and post_type = 'post' and (post_title like '%".$searchWord."%' OR post_content like '%".$searchWord."%') limit 1 ";
	}
	
	//$fquery = rtrim($nquery, "UNION ");
	$searchedPostList = $wpdb->get_results($nquery, ARRAY_A);
	
	$blog_id = (int) $blogrow->blog_id;
	
	if(!empty($searchedPostList)) {
	
	foreach($searchedPostList as $spost)
			{
					//$pid = (int) $spost['ID'];
					
					//switch_to_blog( $blog_id );
					//$mainhtml .= '<div>'.get_the_post_thumbnail( $spost['ID'], 'thumbnail' ).'<a href="'.$postURI = get_blog_permalink( 5, 123 );get_permalink($spost['ID']).'">'.get_the_title($spost['ID']).'</a></div>';
					//$mainhtml .= '<div><a href="'.get_permalink( $pid ).'">'.($spost['post_title']).'</a></div>';
					//$mainhtml .= '<div><br></div>';
					//$mainhtml .= $spost['ID']."---".$spost['post_title']."---".$blog_id;
					//$mainhtml .= "<br>";
					//restore_current_blog();
			}
	
	}
} */
//echo get_blog_permalink( 8, 583 );get_blog_permalink( $rrr, $eee );

/*
$nquery = '';
foreach($blogrows as $blogrow)
{
	if($blogrow->blog_id==1)
	{
		$nquery = " select ID, post_title, post_content, @blogid:=".$blogrow->blog_id." from wp_6637def821_posts where post_status = 'publish' and post_type = 'post' and (post_title like '%".$searchWord."%' OR post_content like '%".$searchWord."%') UNION ";
	}
	else
	{
		$nquery .= " select ID, post_title, post_content, @blogid:=".$blogrow->blog_id." from wp_6637def821_".$blogrow->blog_id."_posts where post_status = 'publish' and post_type = 'post' and (post_title like '%".$searchWord."%' OR post_content like '%".$searchWord."%') UNION ";
	}
	
	$fquery = rtrim($nquery, "UNION ");
	$searchedPostList = $wpdb->get_results($fquery, ARRAY_A);
}*/

//echo $nquery;
//echo "<br><br><br>";
//print_r($blogrows);
//exit;

//echo "<pre>";print_r($rrr);

/*
$posts_4 = $wpdb->get_results(" 
		select ID, post_title, @blogid:=4 from wp_6637def821_4_posts where post_status = 'publish' and post_type = 'post' 		
		UNION 		
		select ID, post_title, @blogid:=5 from wp_6637def821_5_posts where post_status = 'publish' and post_type = 'post' ", ARRAY_A);
		
echo "<pre>";print_r($posts_4);*/
//echo $posts_4[0]['@blogid:=4'];
//echo $postURI = get_blog_permalink( 5, 123 );
//print_r($arrytest);
/*
$html = '<ul>';
}*/
?>
<!-- Content -->

<div id="content" class="content" role="main">
	<form action="" method="get">
		<div>
			<input style="width:100%;" type="text" class="field searchform-s" value="<?php echo $_GET['s'] ?>" name="s" placeholder="Type and hit enter …">
		</div>
	</form>
	<?php
		//if ( have_posts() ) { the7_search_loop();} else { get_template_part( 'no-results', 'search' );}
	?>
	<div class="articles-list blog-shortcode mode-list classic-layout-list content-bg-on dt-icon-bg-off loading-effect-fade-in">
		<?php 
//$blogs = $wpdb->get_results( "SELECT blog_id,path FROM {$wpdb->blogs} WHERE blog_id != {$wpdb->blogid} AND site_id = '{$wpdb->siteid}' AND spam = '0' AND deleted = '0' AND archived = '0' order by blog_id", ARRAY_A ); 

$blogs = $wpdb->get_results( "SELECT blog_id,path FROM {$wpdb->blogs} WHERE site_id = '{$wpdb->siteid}' AND spam = '0' AND deleted = '0' AND archived = '0' order by blog_id", ARRAY_A ); 

//echo "<pre>"; print_r($blogs);
//search_excerpt
//search_excluded
function get_mpost_excerpt($blogid, $post_id)
{
	global $wpdb;
	
	if($blog[ 'blog_id' ]==1)
	{
		$pexcerpt = $wpdb->get_row( " select meta_value from wp_6637def821_postmeta where post_id = ".$post_id." and meta_key = 'search_excerpt ' ", ARRAY_A ); 
	}
	else
	{
		$pexcerpt = $wpdb->get_row( " select meta_value from wp_6637def821_".$blogid."_postmeta where post_id = ".$post_id." and meta_key = 'search_excerpt ' ", ARRAY_A ); 
	}
	
	return $pexcerpt;
}

if ( 0 < count( $blogs ) ) :
    foreach( $blogs as $blog ) : 
        switch_to_blog( $blog[ 'blog_id' ] );
		
		if($blog[ 'blog_id' ]==1)
		{
				$nquery = " SELECT p.ID, p.post_title, p.post_content FROM wp_6637def821_posts p LEFT JOIN wp_6637def821_postmeta pm ON (p.ID = pm.post_id AND pm.meta_key = 'additional-keywords') where p.post_status = 'publish' and (post_type = 'post' or post_type = 'page' or post_type = 'dt_portfolio' or post_type = 'dt_team' ) and (p.post_title like '%".$searchWord."%' OR p.post_content like '%".$searchWord."%' OR pm.meta_value like '%".$searchWord."%') ";
						
		}
		else
		{			
				$nquery = " SELECT p.ID, p.post_title, p.post_content FROM wp_6637def821_".$blog[ 'blog_id' ]."_posts p LEFT JOIN wp_6637def821_".$blog[ 'blog_id' ]."_postmeta pm ON (p.ID = pm.post_id AND pm.meta_key = 'additional-keywords') where p.post_status = 'publish' and (post_type = 'post' or post_type = 'page' or post_type = 'dt_portfolio' or post_type = 'dt_team' ) and (p.post_title like '%".$searchWord."%' OR p.post_content like '%".$searchWord."%' OR pm.meta_value like '%".$searchWord."%') ";
			
		}		
		
		//echo $nquery;echo "<br><br><br>";
				
		$searchedPostList = $wpdb->get_results($nquery, ARRAY_A);
		$blog_id = $blog[ 'blog_id' ];
		$mainhtml = '';
		if(!empty($searchedPostList)) {
	
			foreach($searchedPostList as $spost)
			{
				$pid = (int) $spost['ID'];
				$sexcert  = get_post_meta($spost['ID'], 'search_excerpt', true);
				$sexclude = get_post_meta($spost['ID'], 'search_excluded', true);
				
				if($sexclude==1)
				{
					continue;
				}
				
				$search_rating		=	get_post_meta($spost['ID'], 'search_rating', true);
				$search_keywords	=	get_post_meta($spost['ID'], 'search_keywords', true);
				$post_link			=	get_permalink($spost['ID']);
				$post_thumb			=	get_the_post_thumbnail( $spost['ID'], 'thumbnail' );
				
				$p_content = $spost['post_content'];
				$pattern = "/\[[\/]?vc_[^\]]*\]/";
				$pattern1 = "/\[[\/]?ult_[^\]]*\]/";
				$pattern2 = "/\[[\/]?dt_[^\]]*\]/";
				
				if(!empty($sexcert))
				{
					$final_content = $sexcert;
				}
				else
				{
					$p_contentClean = preg_replace(array($pattern,$pattern1, $pattern2), '', $p_content);			
					$pcontent = strip_tags($p_contentClean);
					$final_content = substr($pcontent,0,200)."...";
				}
				
				if(empty($search_rating))
				{
					$search_rating = 0;
				}
				
				$brsearch_keywords = explode(",", $search_keywords);
				$keyws = $_GET['s'];
				if(!in_array($keyws, $brsearch_keywords))
				{
					$search_rating = 0;
				}
				
				$allpostids[] = array(
						'pid'=>$pid, 
						'post_title' => $spost['post_title'],
						'post_content' => $final_content,
						'post_link' => $post_link, 
						'sort' => $search_rating,						
						'post_img' => $post_thumb
				);
				
			}
	}
	        restore_current_blog();
			endforeach; endif;  
			
			$sort = array();
			foreach($allpostids as $k=>$v) {
				$sort['sort'][$k] = $v['sort'];
			}
			
			array_multisort($sort['sort'], SORT_DESC, $allpostids);
		
		foreach($allpostids as $allpostids)
		{
	?>
		<article class="post article-un-clas project-odd visible type-post status-publish format-standard has-post-thumbnail hentry category-technology tag-article tag-blog tag-design tag-news tag-premium tag-theme tag-themeforest tag-web tag-wordpress category-3 description-off">
			<?php
				$imgexists = 0;
				if($allpostids['post_img']) 
				{
				$imgexists = 1;	
			?>
			<div class="imgbox">
				<div class="post-thumbnail"> <a href="<?php echo $allpostids['post_link']; ?>" class="post-thumbnail-rollover" target="_blank"> <?php echo $allpostids['post_img']; ?> </a> </div>
			</div>
			<?php } ?>
			<div class="post-entry-content" style="padding-top: 20px;padding-right: 30px; <?php if($imgexists==0){ echo "padding-left: 30px"; } ?> ">
				<h3 class="entry-title"> <a href="<?php echo $allpostids['post_link']; ?>" title="<?php echo $allpostids['post_title']; ?>" target="_blank" rel="bookmark" style="font-weight: bold;"><?php echo $allpostids['post_title']; ?></a></h3>
				<div class="entry-excerpt">
					<p>
						<?php			
			echo $allpostids['post_content'];
			//echo $sexclude;
			//$p_contentClean = preg_replace(array($pattern,$pattern1, $pattern2), '', $p_content);			
			//$pcontent = strip_tags($p_contentClean);
			//echo substr($pcontent,0,200)."...";
			?>
					</p>
				</div>
				<a href="<?php echo $allpostids['post_link']; ?>" class="post-details details-type-link" target="_blank" rel="nofollow">Read More<i class="dt-icon-the7-arrow-03" aria-hidden="true"></i></a></div>
		</article>
	<?php		
		}
			
			//echo "<pre>";print_r($allpostids);			
			?>
		<div class="paginator" id="pagin" role="navigation"></div>
		<div style="text-align: center; display:none;" class="loaddiv"> <img class=" preload-me" src="https://franciscan.edu/wp-content/themes/dt-the7-child/loading.gif" sizes="" width="50" height="50"> </div>
	</div>
</div>
<!-- #content -->

<?php do_action( 'presscore_after_content' ); ?>
<?php get_footer(); ?>
<style>
 /* remove it after search */
#main{ background:white; }
.imgbox{ padding-top:10px;width: 24%;padding-left: 10px;padding-right: 24px; }
article{ margin:30px 0px;padding-bottom: 16px; }

#pagin li { list-style:none; }

#pagin .next{ display:none; }
#pagin .prev{ display:none; }
</style>
<script type="text/javascript">
//Pagination
jQuery(document).ready(function($) {
//alert(4);

pageSize = 20;
incremSlide = 20;
startPage = 0;
numberPage = 0;

var pageCount =  $(".article-un-clas").length / pageSize;
var totalSlidepPage = Math.floor(pageCount / incremSlide);
    
for(var i = 0 ; i<pageCount;i++){
    $("#pagin").append('<li><a href="#">'+(i+1)+'</a></li> ');
    if(i>pageSize){
       $("#pagin li").eq(i).hide();
    }
}


var prev = $("<li/>").addClass("prev").html("Prev").click(function(){
   startPage-=5;
   incremSlide-=5;
   numberPage--;
   slide();
});

prev.hide();

var next = $("<li/>").addClass("next").html("Next").click(function(){
   startPage+=5;
   incremSlide+=5;
   numberPage++;
   slide();
});

$("#pagin").prepend(prev).append(next);

$("#pagin li").first().find("a").addClass("act");

slide = function(sens){
   $("#pagin li").hide();
   
   for(t=startPage;t<incremSlide;t++){
     $("#pagin li").eq(t+1).show();
   }
   if(startPage == 0){
     next.show();
     prev.hide();
   }else if(numberPage == totalSlidepPage ){
     next.hide();
     prev.show();
   }else{
     next.show();
     prev.show();
   }
   
    
}

showPage = function(page) {
	
	 setTimeout(function(){ 
	
	  $(".article-un-clas").hide();
	  $(".article-un-clas").each(function(n) {
	      if (n >= pageSize * (page - 1) && n < pageSize * page)
	          $(this).show();
	  });        
	  
	  $('.loaddiv').hide();
	  $("html, body").animate({ scrollTop: 0 }, "slow");
	  	 }, 2000);
}
    
showPage(1);
$("#pagin li a").eq(0).addClass("act");

$("#pagin li a").click(function() {
	 $('.loaddiv').show();
	 
	 $("#pagin li a").removeClass("act");
	 $(this).addClass("act");	 
	 showPage(parseInt($(this).text()));
	 
	
	 
});
//alert(4);
});
</script>