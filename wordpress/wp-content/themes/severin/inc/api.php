<?php

function severin_customize_register(mixed $wp_customize) {
    $wp_customize->add_section('severin_settings', [
        'title' => 'Severin',
        'priority' => 30
    ]);

    $settings = [
        'severin_site_url' => ['label' => 'URL du site', 'default' => home_url('/')],
        'severin_site_url_online' => ['label' => 'URL du site en ligne', 'default' => home_url('/')],
        'severin_color_title' => ['label' => 'Couleur des titres', 'default' => '#ff0057', 'type' => 'option'],
        'severin_color_text' => ['label' => 'Couleur du texte', 'default' => '#666666', 'type' => 'option'],
        'severin_color_dark' => ['label' => 'Couleur sombre', 'default' => '#000000', 'type' => 'option'],
        'severin_color_light' => ['label' => 'Couleur claire', 'default' => '#f7f7f7', 'type' => 'option'],
        'severin_color_background' => ['label' => 'Couleur de fond', 'default' => '#f7f7f7', 'type' => 'option'],
        'severin_radius_md' => ['label' => 'Rayon moyen', 'default' => '12px'],
        'severin_radius_lg' => ['label' => 'Grand rayon', 'default' => '18px'],
        'severin_shadow_md' => ['label' => 'Ombre moyenne', 'default' => '0 10px 30px rgba(0,0,0,0.04)'],
        'severin_transition_base' => ['label' => 'Transition', 'default' => '0.3s']
    ];

    foreach ($settings as $key => $setting) {
        $type = $setting['type'] ?? 'text';

        $wp_customize->add_setting($key, [
            'default' => $setting['default'],
            'transport' => 'refresh',
            'sanitize_callback' => $type === 'option' ? 'sanitize_hex_color' : 'sanitize_text_field',
            'capability'  => 'edit_theme_options'
        ]);

        $wp_customize->add_control($key, [
            'label' => $setting['label'],
            'section' => 'severin_settings',
            'type' => $type
        ]);
    }

    $wp_customize->add_setting('severin_share_image', [
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    ]);

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'severin_share_image', [
        'label' => 'Image de partage',
        'section' => 'severin_settings',
        'mime_type' => 'image'
    ]));
};
add_action('customize_register', 'severin_customize_register');

add_action('rest_api_init', function () {
    register_rest_route('severin/v1', '/severin', [
        'methods' => 'GET',
        'callback' => 'severin_api',
        'permission_callback' => '__return_true'
    ]);
});

function severin_api(WP_REST_Request $request) {
    $langDefault = explode('_', get_locale())[0];

    $config = [
        "siteVersion" => date('Ymd'),
        "siteUrl" => get_theme_mod('severin_site_url', site_url()),
        "siteUrlOnline" => get_theme_mod('severin_site_url_online', site_url()),
        "defaultPage" => $langDefault . '/' . get_post_field('post_name', get_option('page_on_front')),
        'theme' => [
            "color_title" => get_theme_mod('severin_color_title', '#ff0057'),
            "color_text" => get_theme_mod('severin_color_text', '#666666'),
            "color_dark" => get_theme_mod('severin_color_dark', '#000000'),
            "color_light" => get_theme_mod('severin_color_light', '#ffffff'),
            "color_background" => get_theme_mod('severin_color_background', '#f7f7f7'),
            "radius-md" => get_theme_mod('severin_radius_md', '12px'),
            "radius-lg" => get_theme_mod('severin_radius_lg', '18px'),
            "shadow-md" => get_theme_mod('severin_shadow_md', '0px 30px rgba(0,0,0,0.04)'),
            "transition-base" => get_theme_mod('severin_transition_base', '.3s')
        ],
    ];
    
    $contenusFixe = get_posts([
        'post_type' => ['fixedcontent'],
        'post_status' => 'publish',
        'numberposts' => -1
    ]);
    
    $fixedContent = array();
    foreach ($contenusFixe as $contenuFixe) {
        $cpts = get_field('commponents', $contenuFixe->ID);
        foreach ($cpts as $cpt) {
            $fixedContent = array($contenuFixe->post_name => get_fields($cpt->ID));
        }
    }

    // !! (wp-lang) - https://developer.wordpress.org/reference/functions/get_locale/
    $locale = [
        "languages" => [$langDefault, "nl"],
        "langDefault" => $langDefault,
        "langCode" => [
            "fr" => str_replace( '_', '-', get_locale() ),
            "nl" => "nl-NL"
        ]
    ];
    
    $meta = [
        "siteName" => get_bloginfo('name'),
        "description" => get_bloginfo('description'),
        "author" => ucfirst(get_userdata(1)->user_login),
        "siteImageShare" => wp_get_attachment_image_url ( get_theme_mod('severin_share_image', ''), 'full' ) ?: '',
        "charset" => get_bloginfo('charset')
    ];

    $pages = get_posts([
        'post_type' => ['page'],
        'post_status' => 'publish',
        'numberposts' => -1
    ]);

    $routes = [];

    foreach ($pages as $post) {
        $lang = get_post_meta($post->ID, '_severin_lang', true) ?: $langDefault; // !!
        $slug = $post->post_name;

        $composants = get_field('commponents', $post->ID);

        $components = array();
        foreach ($composants as $component) {
            $components[] = array(
                'component' => get_the_terms($component->ID, 'severin_cateroy_components')[0]->name,
                'data' => get_fields($component->ID)
            );
        }

        if (!is_array($components)) $components = [];

        $routes[$lang . '/' . trim($slug, '/')] = [
            'seo' => [
                'title' => get_the_title($post),
                'description' => get_the_excerpt($post),
                'priority' => floatval('0.' . $post->menu_order) ?: 0.5,
                'canonical' => $lang . '/' . trim($slug, '/'),
                'siteImageShare' => get_the_post_thumbnail_url($post->ID, 'full') ?: wp_get_attachment_image_url ( get_theme_mod('severin_share_image', ''), 'full' ) ?: ''
            ],
            'components' => $components
        ];
    }

    $routes['robots.txt'] = [
        'hideFolder' => site_url() . '/login'
    ];

    $routes['sitemap.xml'] = [
        'formatDate' => 'Y-m-d'
    ];

    return rest_ensure_response([
        'config' => $config,
        'fixedContent' => $fixedContent,
        'locale' => $locale,
        'meta' => $meta,
        'routes' => $routes
    ]);
}