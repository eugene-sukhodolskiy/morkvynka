	<footer class="footer bg-light">
		<div class="container">
			<div class="row">
				<div class="col-6 col-md-6">
					<p>
						<a href="tel:<?= get_option('mytheme_phone_number') ?>" class="no-style"><?= get_option('mytheme_phone_number') ?></a>
					</p>
				</div>
				<div class="col-6 col-md-6 text-end">
					<p>&copy; <?= date("Y") ?> <?= bloginfo("name") ?></p>
				</div>
			</div>
		</div>
	</footer>

	<? wp_footer(); ?>
</body>
</html>