<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>">
  <title></title>
</head>
<body>
  <div id="app"></div>
  <script>
    const __INITIAL_STATE__ = <?php echo json_encode( apply_filters( 'vuepress/data', vuepress_data() ), JSON_PRETTY_PRINT ) ?>;
  </script>
  <script src="https://unpkg.com/vue@2.5.9/dist/vue.js"></script>
  <script src="https://unpkg.com/vue-router@3.0.1/dist/vue-router.js"></script>
  <script type="module" src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/main.js"></script>
</body>
</html>
