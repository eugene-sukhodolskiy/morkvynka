<? require("layout/head.php") ?>

<? $post_content = get_the_content() ?>
<div class="container page-container">
	<div class="home-block slide"></div>

	<? 
		$categories = get_terms( array(
	    'taxonomy' => 'product_cat',
	    'hide_empty' => true,
		));
	?>
	<? foreach ( $categories as $category ): ?>
		<?
			$args = array(
		    'post_type' => 'product',
		    'posts_per_page' => 4,
		    'tax_query' => array(
	        array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $category -> slug,
	        ),
	    	),
		    'orderby' => 'date',
		    'order' => 'DESC',
			);

			$products = new WP_Query( $args );
		?>
		<? if ( $products -> have_posts() ): ?>
			<div class="home-block category-line">
				<h3 class="cat-name">
			    <a 
			    	href="<?= get_term_link( $category ) ?>"
			    	class="no-style"
			    >
			    	<?= $category -> name ?> 
			    	<span class="mdi mdi-chevron-right"></span>
			    </a>
			  </h3>

			  <div class="products">
				  <? while ( $products -> have_posts() ): ?>
		        <? $products -> the_post(); ?>
		        <? wc_get_template_part( 'content', 'product' ); ?>
			    <? endwhile ?>
			  </div>
			</div>
		<? endif ?>
		<? wp_reset_postdata(); ?>
	<? endforeach ?>

	<div class="home-block text-block">
		<?= $post_content ?>
	</div>
</div>
	
<? require("layout/footer.php") ?>
