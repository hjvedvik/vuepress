<?php

function &vuepress_data () {
  static $data;

  if ( empty( $data ) ) {
    $data = array();
  }

  return $data;
}

function vuepress_use ( $component_path ) {
  $data =& vuepress_data();
  $file_path = locate_template( $component_path );
  $file_url = str_replace( getcwd(), get_site_url(), $file_path );
  $data['componentURL'] = $file_url;
}

function vuepress_set ( $key, $value ) {
  $data =& vuepress_data();
  $data[ $key ] = $value;
}

function vuepress_prop ( $key, $value, $is_list = false ) {
  $data =& vuepress_data();
  $props =& $data['componentProps'];

  if ( $is_list ) $props[ $key ][] = $value;
  else $props[ $key ] = $value;
}

function vuepress_post ( WP_Post $post = null ) {
  if ( empty( $post ) ) {
    $post = get_post();
  }

  return array(
    'id' => $post->ID,
    'title' => $post->post_title,
    'date' => get_the_date( null, $post ),
    'content' => apply_filters( 'the_content', $post->post_content ),
    'excerpt' => get_the_excerpt( $post ),
    'permalink' => get_the_permalink( $post ),
    'thumbnail' => get_the_post_thumbnail_url( $post ),
    'taxonomies' => vuepress_post_taxonomies( $post ),
    'author' => array(
      'name' => get_the_author_meta( 'display_name', $post->post_author ),
      'url' => get_author_posts_url( $post->post_author ),
    ),
  );
}

function vuepress_post_taxonomies ( WP_Post $post = null ) {
  if ( empty( $post ) ) {
    $post = get_post();
  }

  $taxonomies = get_post_taxonomies( $post );
  $results = array();

  foreach ( $taxonomies as $taxonomy ) {
    $results[ $taxonomy ] = array_map( function ( $term ) {
      return array(
        'id' => $term->term_id,
        'name' => $term->name,
        'count' => $term->count,
        'description' => $term->description,
        'parent' => $term->parent,
        'permalink' => get_term_link( $term ),
      );
    }, wp_get_post_terms( $post->ID, $taxonomy ) );
  }


  return $results;
}
