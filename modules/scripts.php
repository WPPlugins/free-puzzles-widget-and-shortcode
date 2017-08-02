<?php 

add_action('wp_print_scripts', 'pw_add_script_fn');
function pw_add_script_fn(){

   if(is_admin()){
	wp_enqueue_script('pw_admin_js', plugins_url('/js/admin.js', __FILE__ ), array('jquery'), '1.0' ) ;
	wp_enqueue_style('pw_admin_css', plugins_url('/css/admin.css', __FILE__ ) ) ;	
  }else{
	wp_enqueue_script('pw_front_js', plugins_url('/js/front.js', __FILE__ ), array('jquery'), '1.0' ) ;
	wp_enqueue_style('pw_front_css', plugins_url('/css/front.css', __FILE__ ) ) ;
	
  }
}
?>