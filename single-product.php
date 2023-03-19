<? require("layout/head.php") ?>

<? $product = @get_product(); ?>
<div class="container page-container">
	<div class="row">
		<div class="col-7">
			<!-- Carousel -->
			<? $gallery = @get_product() -> get_gallery_image_ids(); ?>

			<div 
				id="carouselExampleIndicators" 
				class="carousel slide carousel-fade product-carousel" 
				data-bs-ride="false"
			>
			  <div class="carousel-indicators">
			  	<? if ( $gallery ): ?>
				  	<? foreach ( $gallery as $i => $id ): $img_url = wp_get_attachment_image_url( $id, 'full' ); ?>
					    <button 
					    	type="button" 
					    	data-bs-target="#carouselExampleIndicators" 
					    	data-bs-slide-to="<?= $i ?>" 
					    	class="control-btn <? if(!$i): ?>active<? endif ?>" 
					    	aria-current="true"
					    >
					    	<img src="<?= $img_url ?>" alt="<?= get_the_title() ?>">
					    </button>
					  <? endforeach ?>
				  <? endif ?>
			  </div>
			  <div class="carousel-inner">
			  	<? if ( $gallery ): ?>
				  	<? foreach ( $gallery as $i => $id ): $img_url = wp_get_attachment_image_url( $id, 'full' ); ?>
					    <div class="carousel-item <? if(!$i): ?>active<? endif ?>">
					      <img src="<?= $img_url ?>" class="d-block w-100" alt="<?= get_the_title() ?>">
					    </div>
				  	<? endforeach ?>
				  <? endif ?>
			  </div>
			</div>

		</div>
		<div class="col-5">
			<!-- Product description -->

			<div class="product-description">
				<h2 class="product-title"><? the_title() ?></h2>
				
				<? $product_cats = wp_get_post_terms( $product->get_id(), 'product_cat' ); ?>
				<? if($product_cats): ?>
					<div class="product-cats">
						<? foreach( $product_cats as $i => $cat ): ?>
							<span class="mdi mdi-label-outline"></span>
							<a href="/product-category/<?= $cat -> slug ?>/" class="cat no-style"><?= $cat -> name ?></a> &nbsp;
						<? endforeach	?>
					</div>
				<? endif ?>

				<div class="product-price-group">
					<div class="price">
						<span class="cost"><?= $product -> get_price() ?></span>
						<span class="currency"><?= get_woocommerce_currency_symbol() ?></span>
					</div>
					<a href="#" class="btn btn-primary">
						<span class="mdi mdi-cart-plus"></span>
						В корзину
					</a>
				</div>
				<div class="product-about">
					<?= $product -> get_description() ?>					
				</div>
			</div>
		</div>
	</div>
	<div class="row">

	</div>
</div>
	
<? require("layout/footer.php") ?>
