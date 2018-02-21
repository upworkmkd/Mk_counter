<?php
/*
	* questions.php
	* 
	* Copyright 2018  @Jose Luis Carillo <xyz@gmail.com>
	* 
	* This program is free software; you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation; either version 2 of the License, or
	* (at your option) any later version.
	* 
	* This program is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.
	* 
	* You should have received a copy of the GNU General Public License
	* along with this program; if not, write to the Free Software
	* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
	* MA 02110-1301, USA.
	* 
	* 
	Plugin Name: Wordpress Counter
	Plugin URI: www.xyz.com
	Description: The wordpress plugin Adding days to a several countdown timers just clicking.
	Version: 1.0.1
	Author: Jose Luis Carillo
*/
define( 'MKCOUNTER_VERSION', '1.0.1' );
define('MKCOUNTER_PATH',__DIR__);
define('MKCOUNTER_URL',plugins_url(basename(__DIR__)));
require_once("inc/CounterClass.php");
add_action(
	'plugins_loaded',
	array(
		'CounterClass',
		'instance'
	)
);

/**

* @ add admin scripts and style

* @ param null

* @return html

**/
function enqueue_date_picker(){
    wp_enqueue_script(
        'field-date', 
        MKCOUNTER_URL . '/assets/js/field-date.js', 
        array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'),
        time(),
        true
    );  
	wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
	//wp_enqueue_script('jquery-ui-timepicker', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/i18n/jquery-ui-timepicker-addon-i18n.js');
	wp_enqueue_style( 'jquery-ui' ); 
    wp_enqueue_style( 'jquery-ui-datepicker' );
}

add_action('admin_enqueue_scripts', 'enqueue_date_picker');


add_action('init', 'frontendscripts');

function frontendscripts(){
	wp_enqueue_script( 'mk_counter', MKCOUNTER_URL.'/assets/js/jQuery.countdownTimer.min.js', array('jquery'), MKCOUNTER_VERSION, false );
	wp_enqueue_style( 'mk_counter_style', MKCOUNTER_URL.'/assets/css/jQuery.countdownTimer.css', array(), MKCOUNTER_VERSION, false );
	wp_enqueue_style( 'mk_style', MKCOUNTER_URL.'/assets/css/mk_counter.css', array(), MKCOUNTER_VERSION, false );
	wp_enqueue_style( 'mk_style_custom', MKCOUNTER_URL.'/assets/css/mk_daynamic_css.php', array(), MKCOUNTER_VERSION, false );
}
/*
 * 
 * name: Mk_CounterPosts
 * @param
 * @return
 * 
 */
function Mk_CounterPosts( $atts ) {
	$args = array(
		'post_type'=> 'project',
    );
	$posts=get_posts($args);
	$content=MkCounterView('counterposts',array('posts'=>$posts));
	return $content;
}
add_shortcode( 'Mk_CounterPosts', 'Mk_CounterPosts' );

function MkCounterView($viewname,$data){
	if(!empty($data) && is_array($data)){
		foreach($data as $key=>$value)
			$$key=$value;
	}
	ob_start();
	$viewpath=MKCOUNTER_PATH."/views/{$viewname}.php";
	require($viewpath) ;
	$html=ob_get_clean();	
	return $html;	
}

/* Filter the single_template with our custom function*/
add_filter('single_template', 'my_custom_template');

function my_custom_template($single) {

    global $wp_query, $post;

    /* Checks for single template by post type */
    if ( $post->post_type == 'project' ) {
        if ( file_exists( MKCOUNTER_PATH . '/single-project.php' ) ) {
            return MKCOUNTER_PATH . '/single-project.php';
        }
    }

    return $single;

}
?>
