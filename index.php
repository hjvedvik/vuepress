<?php vuepress_use( 'components/Index.js' ) ?>

<?php while ( have_posts() ) : the_post() ?>
  <?php vuepress_prop( 'posts', vuepress_post(), true ) ?>
<?php endwhile ?>
