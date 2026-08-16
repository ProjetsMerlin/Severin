<?php

/* fix output buffering issues on shutdown */
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
   while ( @ob_end_flush() );
} );

/* disable the block editor */
add_filter('use_block_editor_for_post', '__return_false', 10);

/* add theme support for post thumbnails */
add_theme_support( 'post-thumbnails' );

/* add support for excerpts on pages */
add_post_type_support('page', 'excerpt');

/* add required/norequired plugins */
function severin_register_required_plugins() {
    $plugins = array(
        array(
            'name'      => 'Advanced Custom Fields',
            'slug'      => 'advanced-custom-fields',
            'required'  => true,
        ),
        array(
            'name'      => 'Really Simple SSL',
            'slug'      => 'really-simple-ssl',
            'required'  => false,
        ),
        array(
            'name'      => 'WPS Cleaner',
            'slug'      => 'wps-cleaner',
            'required'  => false,
        ),
        array(
            'name'      => 'BBQ Firewall',
            'slug'      => 'block-bad-queries',
            'required'  => false,
        ),
    );

    $config = array(
        'id'           => 'severin',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'severin_register_required_plugins' );