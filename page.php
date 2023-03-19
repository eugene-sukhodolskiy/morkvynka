<?
	$post_type = get_post_type();
	$queried_object = get_queried_object();

	if ($queried_object instanceof WP_Term) {
    $taxonomy = $queried_object -> taxonomy;
    
    if($taxonomy == "product_cat") {
    	// PRODUCT CATEGORY
    	
			$category_id = get_queried_object_id();
    	$query_args = array(
		    'post_type'      => 'product',
		  	'tax_query' => array(
	        array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $category_id,
	        ),
		    ),
		    'posts_per_page' => get_option('posts_per_page'),
		    'orderby'        => 'date',
		    'order'          => 'DESC'
			);
    	require_once "page-products.php";		
    }
	} else {
		require_once "single.php";
	}
?>