<?php 
function university_files(){
wp_enqueue_style('university_main_style',get_theme_file_uri('/build/style-index.css'));
wp_enqueue_style('university_extra_style',get_theme_file_uri('/build/index.css'));
wp_enqueue_style('university_font_aws_style','https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
wp_enqueue_style('university_font_style','https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');

wp_enqueue_script('university_main_js',get_theme_file_uri('/build/index.js'),array('jquery'),1.0,true);

}
add_action('wp_enqueue_scripts','university_files');



function university_features()
{
    register_nav_menu('headeMenuLocation','Header Menu Location'); // Add header menu
    register_nav_menu('footerMenuLocation1','Footer Menu Location 1'); // Add Footer menu 1
    register_nav_menu('footerMenuLocation2','Footer Menu Location 2'); // Add Footer menu 2

    add_theme_support('title-tag');
}
add_action('after_setup_theme','university_features');

