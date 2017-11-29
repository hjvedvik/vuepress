<?php

function vuepress_current_url () {
  return home_url( $_SERVER['REQUEST_URI'] );
}

function vuepress_url ( $url ) {
  return str_replace( get_home_url(), '', $url ) ?: '/';
}

function vuepress_styles () {
  ob_start();
  wp_print_styles();
  $markup = ob_get_clean();
  $regex = '/<(style|link)([^>]+)?>(?:(.*?)<\/style>)?/s';
  preg_match_all( $regex, $markup, $matches, PREG_SET_ORDER );
  $results = array();

  foreach ( $matches as $match ) {
    $results[] = array(
      'tag' => $match[1],
      'props' => shortcode_parse_atts( trim( $match[2], '/' ) ),
      'content' => $match[3],
    );
  }

  return $results;
}

function vuepress_scripts () {
  ob_start();
  wp_print_scripts();
  $markup = ob_get_clean();
  $regex = '/<script([^>]+)?>(?:(.*?)<\/script>)?/s';
  preg_match_all( $regex, $markup, $matches, PREG_SET_ORDER );
  $results = array();

  foreach ( $matches as $match ) {
    $results[] = array(
      'props' => shortcode_parse_atts( trim( $match[1], '/' ) ),
      'content' => $match[2],
    );
  }

  return $results;
}
