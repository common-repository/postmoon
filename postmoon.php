<?php

/*

Plugin Name: PostMoon

Plugin URI: https://surecode.me

Description: Plugin for testing your actions in WordPress by AJAX  requests.

Version: 1.0.0

Author: Kirill Shur(SureCode Marketing)

License: GPLv2

*/


add_shortcode('moon','postmoon_method');


function postmoon_method($atts){



   $moon_parameters = [
     "selector" => null,
     "method" => null,
     "ppp" => null,
     "action" => null,
     "post_type" => null,
     "page_number" => null,
     "category" => null,
     "taxonomy" => null,
     "order" => null
    ];
   $attrset = shortcode_atts($moon_parameters,$atts);

   $user = wp_get_current_user();

   if(isset($user->allcaps['administrator']))
   {

   ob_start();
?>
 <style type="text/css" rel="stylesheet">

 .moon_style ul {
     display: flex;
     justify-content: center;
     list-style: none;
     flex-wrap: wrap;
     padding: 0;
 }
 div.moon_style {
    padding: 1em 1em;
    font-size: min(17px,5vw);
}
 .moon_style ul li {
     display: flex;
     height: 27rem;
     overflow: hidden;
     flex-direction: column;
     align-items: center;
 }
 .moon_style ul li img {
    display: inline-block;
    height:300px;
    width:300px;
    max-width:100%;
    object-fit: contain;
}
.moon_style ul li {
    display: flex;
    height: 27rem;
    overflow: hidden;
    flex-direction: column;
    align-items: center;
    margin: : 0 2em;
}

 </style>
 <script type="text/javascript">
 jQuery(document).ready(function($){
   $postmoon = $.noConflict();
   $postmoon.ajax({
       type: '<?php echo esc_html($attrset['method']);?>',
       dataType: 'html',
       url: '<?php echo admin_url('admin-ajax.php');?>',
       data: {
         action:'<?php echo esc_html($attrset['action']);?>',
         ppp : '<?php echo esc_html($attrset['ppp']);?>',
         post_type : '<?php echo esc_html($attrset['post_type']);?>',
         page_number :'<?php echo esc_html($attrset['page_number']);?>',
         category : '<?php echo esc_html($attrset['category']);?>',
         taxonomy : '<?php echo esc_html($attrset['taxonomy']);?>',
         order : '<?php echo esc_html($attrset['order']);?>'
       },
       success: function(data){
          $postmoon('#'+'<?php echo esc_html($attrset['selector']);?>').empty();
          $postmoon('#'+'<?php echo esc_html($attrset['selector']);?>').append(data);
          $postmoon('#'+'<?php echo esc_html($attrset['selector']);?>').addClass('moon_style');
       },
       error : function(jqXHR, textStatus, errorThrown) {
           console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
       }
   });
 });

 </script>

<?php
 $allow_html = array(
 "script" => array(
   "type" => "text/javascript"
 ),
 "div" => array(
   "id" => array(),
   "class" => array()
 ),
 "ul" => array(
   "id" => array(),
   "class" => array()
 ),
 "li" => array(
   "id" => array(),
   "class" => array()
 ),
 "span" => array(
   "id" => array(),
   "class" => array()
 ),
 "style" => array(),
 "img" => array(
  "alt" =>array()
 ),

);
 $postmoon_set = ob_get_clean();
  echo wp_kses($postmoon_set,$allow_html);
 }
}
