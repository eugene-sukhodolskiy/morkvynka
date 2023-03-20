<?php
	defined( 'ABSPATH' ) || exit;

	global $product;

	// Ensure visibility.
	if ( empty( $product ) || ! $product->is_visible() ) {
		return;
	}
?>

<div class="card mb-3 product">
	<a href="<?php the_permalink(); ?>" class="card-link">
		<img 
			src="<?= get_the_post_thumbnail_url() ?>" 
			class="card-img-top product-thumb" 
			alt="<?= get_the_title() ?>"
		>
	</a>
	<div class="card-body">
		<h5 class="card-title">
			<a href="<?php the_permalink(); ?>" class="no-style title-link">
				<?= get_the_title() ?>
			</a>
		</h5>
		<p class="card-text">
			<?= get_the_excerpt() ?>
		</p>
		<div class="product-card-footer">
			<div class="price">
				<span class="cost"><?= $product -> get_price() ?></span>
				<span class="currency"><?= get_woocommerce_currency_symbol() ?></span>
			</div>
			<a 
				href="<?php echo esc_url( get_permalink( $product -> get_id() ) ); ?>" 
				class="btn btn-outline-primary add-to-cart <? if(in_cart($product -> get_id())): ?>already<? endif ?>" 
				data-product_id="<?php echo esc_attr( $product -> get_id() ); ?>"
			>
				<div class="not-already-state">
					<span class="mdi mdi-cart-plus"></span>
					В корзину
				</div>
				<div class="already-state">
					<span class="mdi mdi-check"></span>
					Добавлено
				</div>
			</a>
		</div>
	</div>
</div>
