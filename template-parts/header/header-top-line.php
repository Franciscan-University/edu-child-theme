<?php
/**
 * Top line header.
 *
 * @since   5.7.0
 * @package The7/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php
presscore_get_template_part( 'theme', 'header/mixed-navigation', presscore_get_mixed_header_navigation() );
$config                 = presscore_config();
$top_line_right_classes = '';
$top_line_left_classes  = '';
if ( ! presscore_get_header_elements_list( 'side_top_line' ) ) {
	$top_line_left_classes = 'empty-widgets';
}
if ( ! presscore_get_header_elements_list( 'top_line_right' ) ) {
	$top_line_right_classes = 'empty-widgets';
}
?>

<div <?php presscore_mixed_header_class( 'masthead mixed-header' ); ?> <?php presscore_header_inline_style(); ?> role="banner">

	<?php presscore_get_template_part( 'theme', 'header/top-bar' ); ?>

	<header class="header-bar">

		<?php
		presscore_get_template_part( 'theme', 'header/mixed-branding' );

		if ( 'center' === $config->get( 'header.mixed.view.top_line.logo.position' ) || 'left' === $config->get( 'header.mixed.view.top_line.logo.position' ) ) {
			echo '<div class="top-line-left ' . $top_line_left_classes . '" >';
			presscore_render_header_elements( 'side_top_line', 'left-widgets' );
			echo '</div><div class="top-line-right ' . $top_line_right_classes . '">';
			presscore_render_header_elements( 'top_line_right', 'right-widgets' );
			presscore_header_menu_icon();
			echo '</div>';
		} else if ( 'left_btn-right_logo' === $config->get( 'header.mixed.view.top_line.logo.position' ) || 'left_btn-center_logo' === $config->get( 'header.mixed.view.top_line.logo.position' ) ) {
			echo '<div class="top-line-left ' . $top_line_left_classes . '">';
			presscore_header_menu_icon();
			presscore_render_header_elements( 'side_top_line', 'left-widgets' );
			echo '</div><div class="top-line-right ' . $top_line_right_classes . '">';
			presscore_render_header_elements( 'top_line_right', 'right-widgets' );
			echo '</div>';
		}
		?>

	</header>

</div>
<!-- Google Tag Manager -->
<script>
  (function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
    var f = d.getElementsByTagName(s)[0],
      j = d.createElement(s),
      dl = l != "dataLayer" ? "&l=" + l : "";
    j.async = true;
    j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
    f.parentNode.insertBefore(j, f);
  })(window, document, "script", "dataLayer", "GTM-M4R7MDF");
</script>
<!-- End Google Tag Manager -->
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script>
  (function(i, s, o, g, r, a, m) {
    i["GoogleAnalyticsObject"] = r;
    (i[r] =
      i[r] ||
      function() {
        (i[r].q = i[r].q || []).push(arguments);
      }),
      (i[r].l = 1 * new Date());
    (a = s.createElement(o)), (m = s.getElementsByTagName(o)[0]);
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m);
  })(
    window,
    document,
    "script",
    "https://www.google-analytics.com/analytics.js",
    "ga"
  );
  ga("create", "UA-5819863-1", "auto");
  ga("send", "pageview");
  ga("send", "event", "Videos", "play", "Lent Campaign");
</script>
<!-- GA Click tracking -->
<script type="text/javascript">
  (function(window) {
    "use strict";
    //jQuery Filter Ref: http://api.jquery.com/filter/
    jQuery(function($) {
      //Track Downloads
      var exts = "doc*|xls*|ppt*|pdf|zip|rar|exe|mp3";
      var regExt = new RegExp(".*\\.(" + exts + ")(\\?.*)?$");
      $("a")
        .filter(function() {
          //include only internal links
          if (this.hostname && this.hostname === window.location.hostname) {
            return this.href.match(regExt);
          }
        })
        .prop("download", "") //force download of these files
        .click(function() {
          logClickEvent("Downloads", this.href);
        });
      //Track Mailto links
      $('a[href^="mailto"]').click(function() {
        //href should not include 'mailto'
        logClickEvent("Email", this.href.replace("mailto:", "").toLowerCase());
      });
      //Track Outbound Links
      $('a[href^="http"]')
        .filter(function() {
          return this.hostname && this.hostname !== window.location.hostname;
        })
        .prop("target", "_blank") // make sure these links open in new tab
        .click(function(e) {
          logClickEvent("Outbound", this.href);
        });
    });
    /**
     * Detect Analytics type and send event
     * @ref https://support.google.com/analytics/answer/1033068
     * @param category string
     * @param label string
     */
    function logClickEvent(category, label) {
      if (window.ga && ga.create) {
        //Universal event tracking
        //https://developers.google.com/analytics/devguides/collection/analyticsjs/events
        ga("send", "event", category, "click", label, {
          nonInteraction: true
        });
      } else if (window._gaq && _gaq._getAsyncTracker) {
        //classic event tracking
        //https://developers.google.com/analytics/devguides/collection/gajs/eventTrackerGuide
        _gaq.push(["_trackEvent", category, "click", label, 1, true]);
      } else {
        console.info("Google analytics not found in this page");
      }
    }
  })(window);
</script>
<script>
  !(function(f, b, e, v, n, t, s) {
    if (f.fbq) return;
    n = f.fbq = function() {
      n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments);
    };
    if (!f._fbq) f._fbq = n;
    n.push = n;
    n.loaded = !0;
    n.version = "2.0";
    n.queue = [];
    t = b.createElement(e);
    t.async = !0;
    t.src = v;
    s = b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t, s);
  })(
    window,
    document,
    "script",
    "https://connect.facebook.net/en_US/fbevents.js"
  );
  fbq("init", "927094344012164");
  fbq("track", "PageView");
  fbq("track", "ViewContent");
  fbq("track", "Lead");
</script>
<noscript>
  <img
    height="1"
    width="1"
    src="https://www.facebook.com/tr?id=927094344012164&ev=PageView
&noscript=1"
  />
</noscript>
