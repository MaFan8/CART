<?php
/**
 * Author: Jim Thornton
 * Return Google CSE search results
 *
 */

add_action( 'genesis_after_header', 'genesis_do_search_title' );
function genesis_do_search_title() {

	$title = sprintf( '<header class="entry-header"><h1 class="archive-title">%s %s</h1></header>', apply_filters( 'genesis_search_title_text', __( 'Search Results for:', 'genesis' ) ), get_search_query() );

	echo apply_filters( 'genesis_search_title_output', $title ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

// remove post image (from theme settings).
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//	remove entry content.
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content_markup_open' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content_markup_close' );

// remove entry footer.
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

// remove post content nav.
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );
remove_action( 'genesis_loop', 'genesis_do_loop' );
// add_action( 'genesis_entry_header', 'genesis_do_post_content', 11 );
add_action( 'genesis_loop','if_get_google_custom_search_results', 1 );




function if_get_google_custom_search_results() {

	$q_phrase = sprintf( '%s%s', apply_filters( 'genesis_search_title_text', __( '', 'genesis' ) ), get_search_query() );
	$q = apply_filters( 'genesis_search_title_output', $q_phrase );

	//check our search keyword value (working) > // echo $q;

	// build our request
	$key = 'AIzaSyAWjLOPLbcxEA7txCD83hOx2Xp9_GmS6Wg ';
	$cx_search_id = '2b47b5c86db0b99d5 ';
	$base_url = 'https://www.googleapis.com/customsearch/v1?key=';
	$request_url = $base_url . $key . '&cx=' . $cx_search_id . '&q=' . $q;

	// check our request uri (working) > // echo $request_url;

 	$response = wp_remote_get( $request_url, array ('method' => 'GET', 'timeout'=> 100, 'sslverify' => false ));

	$results = array();

	if( is_array($response)) {

		// capture response object from gcs
		$body = wp_remote_retrieve_body( $response );
		$results_response_object = json_decode($body, true); // convert json to php object
		$results = $results_response_object['items'];

	//	get a count of results (working) >

		$num_results = count($results);
	//	get a dump of our json decoded array structure >echo '<pre>'; var_dump($results); echo '</pre>';

		echo '<div class="gcs wp-block-group tight-wrap"><div class="wp-block-group__inner-container"><ul>';

		$response_code = wp_remote_retrieve_response_code( $response );

		if ( $response_code == 403 ) {
			echo '<pre>'; var_dump( $results_response_object['error'] ); echo '</pre>';
			echo 'Whoops. Unfortunately, Google APIs returned a 403 error blocking your request. You may have reached a search restrictions limit. Please try again later. If the problem persists, let us know.';
		}

		$i = 0;

		foreach ( $results as $result ){

			echo '<li><h3><a href="' . trim( $result['link'] ) . '">' . ($i + 1) . '. ' . trim( $result['title'] ) . '</a></h3><p>' . trim( $result['htmlSnippet']) . '</p></li>';
			$i++;
		}

		echo '</ul></div></div>';
		echo '<style>.gcs.wp-block-group ul li:nth-of-type(odd) {
			background-color: #efefef;
		}
		.gcs.wp-block-group ul li {
			display: block;
			padding: 30px 20px 30px 40px;
		}
		.gcs.wp-block-group ul li p {
			margin-bottom: 0;
		}
		.gcs.wp-block-group ul li h3 {
			margin-bottom: 5px;
		}
		.gcs.wp-block-group ul li a:hover {
			text-decoration: underline;
		}</style>';

	} else {

		echo 'Sorry, the Google Custom Search JSON API is down. Please try again in a few moments.';
	}

	echo '<div style="max-width: 350px; text-align: center; margin: 10px auto 60px;"><p style="max-width: 350px; text-align: center; margin: 10px auto 20px;">Didn\'t find what you were looking for? Try broadening your query here:</p><form class="search-form" method="get" action="/" role="search"><label class="search-form-label screen-reader-text" for="searchform-2">Search site</label><input class="search-form-input" type="search" name="s" id="searchform-2" value=""><input class="search-form-submit" type="submit" value="Search"><meta content="/?s={s}"></form></div>';

}


genesis();
?>
