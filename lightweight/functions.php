<?

error_reporting(E_ERROR | E_PARSE);

$description = "default";

register_nav_menu( 'primary', $description ); 

add_theme_support( 'post-thumbnails' );

include TEMPLATEPATH.'/functions/styles_n_scripts.php';
include TEMPLATEPATH.'/functions/general_functions.php';
include TEMPLATEPATH.'/functions/shortcodes.php';
include TEMPLATEPATH.'/functions/theme_page_theme_display.php';
include TEMPLATEPATH.'/functions/custom_admin_columns.php';
include TEMPLATEPATH.'/functions/post_page_meta_boxes.php';
include TEMPLATEPATH.'/functions/post_page_options_handler.php';
include TEMPLATEPATH.'/functions/theme_post_page_options_display.php';
include TEMPLATEPATH.'/functions/theme_header_display.php';
include TEMPLATEPATH.'/functions/theme_footer_display.php';
include TEMPLATEPATH.'/functions/site_content_options_handler.php';
include TEMPLATEPATH.'/functions/theme_sidebar_editor_display.php';
include TEMPLATEPATH.'/functions/theme_side_bars_display.php';
include TEMPLATEPATH.'/functions/theme_defaults_display.php';
include TEMPLATEPATH.'/functions/defaults_handler.php';
include TEMPLATEPATH.'/functions/sidebar_editor_handler.php';
include TEMPLATEPATH.'/functions/widgets.php';
include TEMPLATEPATH.'/functions/activate_theme.php';
include TEMPLATEPATH.'/functions/custom_content.php';

function theme_options() {
   add_menu_page('Theme 2108', 'Theme 2108', 'manage_options', 'theme-options','theme_page_theme_display');
   add_submenu_page( 'theme-options', 'Header', 'Header', 'manage_options', 'header', 'header_display' );
   add_submenu_page( 'theme-options', 'Footer', 'Footer', 'manage_options', 'footer', 'footer_display' );
   add_submenu_page( 'theme-options', 'Post Page Options', 'Post Page Options', 'manage_options', 'post_page_options', 'post_page_options_display' );
   //add_submenu_page( 'theme-options', 'Google Fonts', 'Google Fonts', 'manage_options', 'google_fonts', 'google_fonts_display' ); 
   add_submenu_page( 'theme-options', 'Side Bar Names', 'Side Bar Names', 'manage_options', 'side_bars', 'side_bars_display' ); 
   add_submenu_page( 'theme-options', 'Side Bar Editor', 'Side Bar Editor', 'manage_options', 'side_bar_editor', 'side_bar_editor_display' ); 
   add_submenu_page( 'theme-options', 'Defaults', 'Defaults', 'manage_options', 'defaults', 'defaults_display' );
}

add_action('admin_menu', 'theme_options');