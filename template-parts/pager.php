<?php
$paginate_links_args = array(
	'current' => max( 1, get_query_var( 'paged' ) ),
	'next_text' => '&#xe910;',
	'prev_text' => '&#xe90f;',
	'total' => $wp_query->max_num_pages,
	'type' => 'array',
	'prev_next' => false,
);

$paginate_links = paginate_links( $paginate_links_args );

if ( $paginate_links ) :
	echo "\t\t\t";
	echo '<ul class="pagination">';

	foreach ( $paginate_links as $paginate_link ) :
		echo '<li class="pagination_item">' . $paginate_link . '</li>';
	endforeach;

	echo '</ul>' . "\n";
endif;

unset( $paginate_links, $paginate_links_args );
