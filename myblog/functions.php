function theme_styles() {
wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

function register_menus() {
register_nav_menus(
array(
'primary' => __( 'Primary Menu', 'myblog' ),
)
);
}
add_action( 'init', 'register_menus' );