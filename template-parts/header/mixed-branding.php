<?php
/**
 * Mixed header branding.
 *
 * @since   3.0.0
 * @package The7/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="branding">

	<?php
	$logo = '';

	$logo .= presscore_get_the_mixed_logo();
	$logo .= presscore_get_the_mobile_logo();

	presscore_display_the_logo( $logo );
	?>

</div>
