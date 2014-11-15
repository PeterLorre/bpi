<?php
function get_shares($url) {
  $curl = curl_init();
  # URL to call
  curl_setopt($curl, CURLOPT_URL, "http://www.linkedin.com/countserv/count/share?url=".$url."&format=json");
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
  # Get the response
  $response = curl_exec($curl);
  # Close connection
  curl_close($curl);

  $json = json_decode($response, true);
  return intval( $json['count'] );
}
function get_tweets($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, 'http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
  $response = curl_exec($curl);
  curl_close($curl);

  $json = json_decode($response, true);
  return intval( $json['count'] );
}

function get_likes($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, 'http://graph.facebook.com/?ids=' . $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
  $response = curl_exec($curl);
  curl_close($curl);

  $json = json_decode($response, true);
  if (empty($json)) {
    return 0;
  } else {
    return intval( $json[$url]['shares'] );
  }
}

function get_plusones($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  $curl_results = curl_exec ($curl);
  curl_close ($curl);

  $json = json_decode($curl_results, true);
  return intval( $json[0]['result']['metadata']['globalCounts']['count'] );
}
function total($url){
    return get_tweets($url) + get_shares($url) + get_likes($url) + get_plusones($url); }
?>
