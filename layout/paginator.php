<?php
global $query_result;

$big = 999999999; // Уникальное число для замены.
$pages = paginate_links( array(
	'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format'  => '?paged=%#%',
	'current' => max( 1, get_query_var( 'paged' ) ),
	'total'   => $query_result -> max_num_pages,
	'prev_text' => '<span class="mdi mdi-chevron-left"></span>',
	'next_text' => '<span class="mdi mdi-chevron-right"></span>', 
) );
?>

<div class="paginator">
	<div class="row">
		<div class="col-12">
			<nav aria-label="Page navigation">
				<ul class="pagination">
					<?php echo str_replace(
						['<a class="', "</a>", '<span aria-current="page" class="page-numbers current">', '</span>'], 
						['<li class="page-item"><a class="page-link ', "</a></li>", '<li class="page-item active"><span aria-active="page" class="page-link current">', '</span></li>'], 
						$pages
					); ?>
				</ul>
			</nav>
		</div>
	</div>
</div>