===Post Moon ===
Contributors: Kirill Shur (SureCode Marketing)
Donate link: https://surecode.me/
Tags: AJAX,debugging,postmoon,woocommerce
Requires at least: 5.1
Tested up to: 5.9
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Debugging your WordPress AJAX actions easily!

== Description ==
This plugin lets you debugging your AJAX actions to your WordPress site.

== Installation ==
1. Download the plugin.
2. Activate the plugin in the WordPress Admin Panel.
3. Usage of the plugin:
 Shortcode: "[moon selector="my_products" category="laptops" method="post" action="postmoon" post_type="product" ppp="5" order="DESC"]
 or in php place do_shortcode('[moon selector="my_products" category="laptops" method="post" action="postmoon" post_type="product" ppp="5" order="DESC"]')".

 The "selector" is ID of the your DOM element.

 function.php very basic example of the code:

"function postmoon_action_method(){
  if(isset($_POST["post_type"])){
  $args = array(
  'posts_per_page' => sanitize_text_field($_POST["ppp"]),
  'post_type' => sanitize_text_field($_POST["post_type"]),
  'product_cat' => sanitize_text_field($_POST["category"]),
  'order' => sanitize_text_field($_POST["order"])
 );
 $query = new WP_Query( $args );
      if ( $query->have_posts() ) {
      echo '<ul>';
      while ( $query->have_posts() ) : $query->the_post();
      global $product;
      $product_output = '<li>';
      $product_output .= '<span>'.$product->get_title().'</span>';
      $image_links[0] = get_post_thumbnail_id( $product->id );
      $gallery = wp_get_attachment_image_src($image_links[0], 'full' );
      $product_output .=  "<img src='".$gallery[0]."'/>";
      $product_output .=  '<span>'.$product->get_price_html().'</span>';
      $product_output .=  '</li>';
      echo $product_output;
      endwhile;
      echo '</ul>';
      wp_reset_postdata();
      }
  }
die();
}".
 "add_action("wp_ajax_postmoon","postmoon_action_method");".

 "add_action("wp_ajax_nopriv_postmoon","postmoon_action_method");".

The results you will see in the your browser only if you are administrator.



== Changelog ==
= 1.0 =
* First version of the plugin.

== Frequently Asked Questions ==
There are currently no FAQs at this time.

== Screenshots ==
1. The view of the results after AJAX request.
