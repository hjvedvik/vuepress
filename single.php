<?php vuepress_use( 'components/Single.js' ) ?>
<?php vuepress_prop( 'post', vuepress_post() ); ?>
<?php vuepress_prop( 'posts', array_map( function ( $post ) {
  return array(
    'id' => $post->ID,
    'title' => $post->post_title,
    'date' => get_the_date( null, $post ),
    'permalink' => get_the_permalink( $post ),
  );
}, get_posts() ) ) ?>
