<nav class="navbar navbar-expand-lg navbar-light bg-light top-navbar">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= home_url(); ?>">
			<img class="logo-img" src="/wp-content/themes/morkvynka/images/logo-element-md.png" alt="Logo Morkvynka">
			<? bloginfo('name'); ?>
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<?
			ob_start();
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
			
			$nav = ob_get_clean();

			$nav = str_replace(">mdi-insta<", '><span class="mdi mdi-instagram"></span><span class="t"> Instagram</span><', $nav);
			$nav = str_replace(">mdi-email<", '><span class="mdi mdi-email-outline"></span><span class="t"> Пошта</span><', $nav);
			echo $nav;
		?>
	</div>
</nav>

<a href="/cart/" class="go-cart-btn">
	<span class="mdi mdi-cart-variant"></span>
	<span class="counter">0</span>
</a>
