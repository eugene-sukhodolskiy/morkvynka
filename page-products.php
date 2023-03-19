<? require("layout/head.php") ?>

<?
	if(!isset($query_args)) {
		$query_args = array(
	    'post_type'      => 'product',
	    'posts_per_page' => get_option('posts_per_page'),
	    'orderby'        => 'date',
	    'order'          => 'DESC'
		); 
	}
?>

<div class="container page-container">
	<h2 class="page-title"><? the_title() ?></h2>
	<? require("layout/product-list.php") ?>
</div>
	
<? require("layout/footer.php") ?>