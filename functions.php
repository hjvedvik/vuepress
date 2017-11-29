<?php

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/index.php';

add_action( 'after_setup_theme', function () {
  register_nav_menu( 'primary', __( 'Primary Menu', 'vuepress' ) );
} );

add_action( 'shutdown', function () {
  if ( is_admin() ) return;

  if ( isset( $_GET[ 'json' ] ) ) {
    $data = apply_filters( 'vuepress/data', vuepress_data() );
    return wp_send_json_success( $data, null );
  }

  get_template_part( 'templates/html' );
} );

add_filter( 'vuepress/data', function ( $data ) {
  $data['title'] = wp_title( '-', false, 'right' ) . get_bloginfo( 'name' );
  $data['blogName'] = get_bloginfo( 'name' );
  $data['bodyClass'] = join( ' ', get_body_class() );
  $data['baseURL'] = vuepress_url( get_home_url() );
  $data['currentURL'] = vuepress_url( vuepress_current_url() );
  $data['searchURL'] = vuepress_url( get_search_link( '/' ) );
  $data['searchQuery'] = get_search_query();
  $data['styles'] = vuepress_styles();
  $data['scripts'] = vuepress_scripts();

  foreach ( get_registered_nav_menus() as $location => $description ) {
    $data['navigation'][ $location ] = array_map( function ( $item ) {
      return array(
        'id' => $item->ID,
        'url' => $item->url,
        'title' => $item->title,
        'target' => $item->target,
        'description' => $item->description,
        'active' => strpos( vuepress_current_url(), $item->url ) !== false,
        'classNames' => join( ' ', $item->classes ),
      );
    }, wp_get_nav_menu_items( $location ) );
  }

  return $data;
} );
