<?
	/**
	 * SHOW PRODUCTS BY ATTR
	 */
	$query_args = array(
   'post_type'      => 'product',
   'post_status'    => 'publish',
   'posts_per_page' => get_option('posts_per_page'),
   'tax_query'      => [[
      'taxonomy'        => 'pa_age',
      'field'           => 'name',
      'terms'           =>  "0+",
    ]]
	);
?>

<? require("page-products.php") ?>