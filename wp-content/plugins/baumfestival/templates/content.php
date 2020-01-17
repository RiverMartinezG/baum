<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	include_once plugin_dir_path( __FILE__ ) . 'entry-header.php';

	?>

	<div class="post-inner">

		<div class="entry-content">

			<?php the_content( __( 'Continue reading', 'twentytwenty' ) ); ?>

			<?php
			$post_type = get_post_type();

			if ( 'festival' === $post_type ) :
				?>
				<p><?php the_field( 'descripcion'); ?></p>
				<p>
					<?php
					$logo = get_field('logo');
					if( !empty( $logo ) ): ?>
						<img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
					<?php endif; ?>
				</p>
				<p>
					<?php
					$image = get_field('imagen_de_fondo' );
					if( !empty( $image ) ): ?>
						<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					<?php endif; ?>
				</p>
				<p>
					<?php
					$location = get_field('location');
					if( $location ) {

						$address = '';
						foreach( array('street_number', 'street_name', 'city', 'state', 'post_code', 'country') as $i => $k ) {
							if( isset( $location[ $k ] ) ) {
								$address .= sprintf( '<span class="segment-%s">%s</span>, ', $k, $location[ $k ] );
							}
						}

						$address = trim( $address, ', ' );

						echo $address;
					}
					?>
				</p>
				<p>
					<span>Fecha de Inicio: <strong><?php the_field( 'fecha_inicio' );?></strong></span>,
					<span>Fecha de Fin: <strong><?php the_field( 'fecha_fin' );?></strong></span>
				</p>

				<?php
				$args = [
					'post_type'  => 'event',
					'meta_query' => [
						[
							'key'     => 'festival',
							'value'   => get_the_ID(),
							'compare' => '='
						]
					]
				];

				$events = new WP_Query( $args ); ?>

				<?php if ( $events->have_posts() ) : ?>
					<h2>Eventos</h2>
					<ul>
						<?php while ( $events->have_posts() ) : $events->the_post(); ?>
							<li>
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</li>
						<?php
						endwhile;
						wp_reset_postdata();
						?>
					</ul>
				<?php else: ?>
					<h2>No hay eventos disponibles</h2>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( 'event' === get_post_type() ): ?>
				<p><?php the_field( 'descripcion'); ?></p>
				<p>Fecha: <?php the_field( 'fecha' );?></p>
				<p>Hora de Inicio: <?php the_field( 'hora_de_inicio' );?></p>
				<p>Hode de Fin: <?php the_field( 'hora_fin' );?></p>
				<p>Artista: <strong></strong></p>
				<?php
				$artist = get_field('artista');

				if( $artist ):
					$post = $artist;
					setup_postdata( $post );
					?>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php endif; ?>
			<?php endif; ?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		edit_post_link();
		?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}
	?>

</article><!-- .post -->
