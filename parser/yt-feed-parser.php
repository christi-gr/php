<?php
	//$channel_id = 'UCDkcjwvWxUqWUmkDEIQrkuQ';
	if ( $channel_id = $_GET['channel_id'] ) :
		$url = "https://www.youtube.com/feeds/videos.xml?channel_id=$channel_id";
		try {
			$xml = @simplexml_load_file($url);
			if ( !isset($xml->entry)) throw new Exception( 'Wrong xml' );

			foreach($xml->entry as $item) :
				$media = $item->children('media', true)->group;
?>


			<entry>
				<?= (string)$item->title ?>

				<?= (string)$item->published ?>

			</entry>

			<media:group>
				<media:thumbnail url="<?= $media->thumbnail->attributes()->url ?>" />
			</media:group>

			<media:community>
				<media:starRating count="<?= $media->community->starRating->attributes()->count ?>" />
				<media:statistics views="<?= $media->community->statistics->attributes()->views ?>" />
			</media:community>
<?php
			endforeach;
		} catch ( Exception $e ) {
			echo $e->getMessage();
		}
	endif;
