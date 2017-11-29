<?php vuepress_use( 'components/Archive.js' ) ?>
<?php vuepress_set( 'archiveTitle', get_the_archive_title() ) ?>

<?php while ( have_posts() ) : the_post() ?>
  <?php vuepress_prop( 'posts', vuepress_post(), true ) ?>
<?php endwhile ?>
