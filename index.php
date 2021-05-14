<?php
	// include config and twitter api wrappe
	require_once( 'config.php' );
	require_once( 'TwitterAPIExchange.php' );

	// settings for twitter api connection
	$settings = array(
		'oauth_access_token' => TWITTER_ACCESS_TOKEN,
		'oauth_access_token_secret' => TWITTER_ACCESS_TOKEN_SECRET,
		'consumer_key' => TWITTER_CONSUMER_KEY,
		'consumer_secret' => TWITTER_CONSUMER_SECRET
	);

	// twitter api endpoint
	$url = 'https://api.twitter.com/1.1/statuses/update.json';

  $media_url = 'https://upload.twitter.com/1.1/media/upload.json';

  $file = file_get_contents('test.jpg');

  $image = base64_encode($file);
  $requestmethod = "POST";
    $apiData = array(
    "media_data" => $image,
    );


	// twitter api endpoint request type
	$requestMethod = 'POST';

	// create new twitter for api communication
	$twitter = new TwitterAPIExchange( $settings );

	// make our api call to twiiter
	$twitter->buildOauth( $media_url, $requestMethod );
	$twitter->setPostfields( $apiData );
	$response = $twitter->performRequest( true, array( CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0 ) );

   $res = json_decode( $response);
   $media_ids = $res->media_id_string;

	// display response from twitter
    // echo '<pre>';
    print_r( $media_ids );

    $datapost = array(
      'media_ids' =>  $media_ids,
      'status' => "this is machine test");

      $twitter->buildOauth( $url, $requestMethod );
      $twitter->setPostfields( $datapost );
      $response1 = $twitter->performRequest( true, array( CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0 ) );

      echo "<pre>";
      print_r(json_decode( $response1 , true));

?>
