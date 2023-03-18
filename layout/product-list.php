<?
	$query_args["paged"] = max( 1, get_query_var( 'paged' ) );
	$products = new WP_Query( $query_args );
	$query_result = $products;
?>
<? if ( $products->have_posts() ) : ?>
  <div class="products">
    <? while ( $products->have_posts() ) : $products->the_post(); ?>
      <? wc_get_template_part( 'content', 'product' ); ?>
    <? endwhile; ?>
  </div>
  <? wp_reset_postdata(); ?>
<? endif; ?>

<? require("paginator.php") ?>