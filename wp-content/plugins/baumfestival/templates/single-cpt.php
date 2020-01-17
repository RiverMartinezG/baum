<?php get_header(); ?>

<main id="site-content" role="main">

	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			include_once plugin_dir_path( __FILE__ ) . 'content.php';
		}
	}

	?>

</main><!-- #site-content -->

<?php get_footer(); ?>
