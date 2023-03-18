<? require("layout/head.php") ?>

<?
	if(!isset($query_args)) {
		$query_args = array(
	    'post_type'      => 'product',
	    'posts_per_page' => 1,
	    'orderby'        => 'date',
	    'order'          => 'DESC'
		); 
	}
?>

<div class="container">
	<h2 class="page-title"><? the_title() ?></h2>
	<? require("layout/product-list.php") ?>
	<? require("layout/paginator.php") ?>
</div>
	
<? require("layout/footer.php") ?>