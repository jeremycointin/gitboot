<? // template name: digest ?>

<?

$url = "http://test.studio2108dev8.com/?bird_feeder=feed_me";

if (strpos($url, 'bird_feeder')) { // returns false if '?' isn't there

$responce = file_get_contents('http://test.studio2108dev8.com/?bird_feeder=feed_me&post_type=post&posts_per_page=1&offset=1&cat=');

$return_array = json_decode($responce,true);

var_dump($return_array);

}




?>