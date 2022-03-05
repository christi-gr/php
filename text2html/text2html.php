<?php
	function text_to_html( $plain_text ) {
	    $html = '<p>' . implode('</p>' . "\n" . '<p>', preg_split('/\R+/', $plain_text)) . '</p>';
	    $html = preg_replace('/\<p\>\*([^<\*]*)\<\/p\>/', '<li>${1}</li>', $html);
	    $html = preg_replace('/\<\/p\>\R+\<li\>/', "</p>\n<ul>\n<li>", $html);
	    $html = preg_replace('/\<\/li\>\R+\<p\>/', "</li>\n</ul>\n<p>", $html);

	    return $html;
	}


	$csv_path = './input.csv';
	$output_handle = fopen( './output.csv', 'w+');
	if ( ( $handle = fopen( $csv_path, 'r') ) !== false):
	    $data = fgetcsv( $handle, 1000, ',');
	    fputcsv($output_handle, $data, ',');
	    while( ( $data = fgetcsv( $handle, 1000, ',') ) != false ):
		$data[2] = text_to_html($data[2]);
		fputcsv($output_handle, $data, ',');
	    endwhile;
	endif;
	fclose($output_handle);
?>
