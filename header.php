<?php
/**
 * Header template.
 *
 * @since   1.0.0
 *
 * @package The7\Templates
 */

defined( 'ABSPATH' ) || exit;

get_template_part( 'header-single' );
get_template_part( 'header-main' );

// Little trick!
// wp_head()
//echo "jkhjkh hjkh k";
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/banner.css">
<!--<div class="header"><a class="mmenutriger" href="#menu123"><span>open menu</span></a></div>
<div id="my-open-button">dsds</div>-->