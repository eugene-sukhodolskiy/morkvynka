<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= home_url(); ?>"><? bloginfo('name'); ?></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<?
			wp_nav_menu(array(
				'menu' => 'primary',
				'theme_location' => 'primary',
				'depth' => 2,
				'container' => 'div',
				'container_class' => 'collapse navbar-collapse',
				'container_id' => 'navbarNav',
				'menu_class' => 'navbar-nav ms-auto',
				'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
				'walker' => new WP_Bootstrap_Navwalker(),
			));
		?>
	</div>
</nav>
