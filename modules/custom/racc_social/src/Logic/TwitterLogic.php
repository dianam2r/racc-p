<?php

namespace Drupal\racc_social\Logic;

use TwitterAPIExchange;

/**
 * This class makes the logic to obtain info from the user twitter account.
 */
class TwitterLogic {

  protected $accessToken = '907621593089757184-dqrgLAwXmBsNoyD6MGufbXQl2JIi2Bc';
  protected $accessTokenSecret = '4NWmp3LktxWc9mZn6OO1PGwuco7EacjsqKNKYMttnlvBv';
  protected $consumerKey = '4gPgqb6Z2HmH3l7se8IzllCs9';
  protected $consumerSecret = 'r725Tj2LvlvXnNO32YjJdUTgwNjIbMxinNlJl9fqpwwrnX4RhC';

  /**
   * This function retrieves de data from twitter.
   */
  public function getData() {
    $settings = [
      'oauth_access_token' => $this->accessToken,
      'oauth_access_token_secret' => $this->accessTokenSecret,
      'consumer_key' => $this->consumerKey,
      'consumer_secret' => $this->consumerSecret,
    ];
    // This is to make the request to the API.
    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $getfield = '?screen_name=raccp_p&count=2';
    $requestMethod = 'GET';

    $twitter = new TwitterAPIExchange($settings);
    $response = $twitter->setGetfield($getfield)
      ->buildOauth($url, $requestMethod)
      ->performRequest();
    // This is to get the format we want to work with.
    $response = $this->arrangeData($response);
    return $response;
  }

  /**
   * This function extracts only what is needed in a simple array.
   */
  public function arrangeData($response) {
    $response = json_decode($response, TRUE);
    $json = [];
    $cleanStrings = ['@', '#', 'http'];
    $i = 0;
    while ($i < 2) {
      $cleanResult = str_replace($cleanStrings, $cleanStrings[0], $response[$i]['text']);
      $aux = explode($cleanStrings[0], $cleanResult);
      $json[$i]['text'] = trim($aux[0]);
      $i = $i + 1;
    };
    $aux = $response[0]['entities']['user_mentions'];
    $i = 0;
    foreach ($aux as $key => $value) {
      $json[0]['entities']['user_mentions'][$i]['screen_name'] = $value['screen_name'];
      $i = $i + 1;
    }
    $aux = $response[0]['entities']['media'];
    $i = 0;
    foreach ($aux as $key => $value) {
      $json[0]['entities']['media'][$i]['url'] = $value['url'];
      $i = $i + 1;
    }
    $aux = $response[0]['entities']['hashtags'];
    $i = 0;
    foreach ($aux as $key => $value) {
      $json[0]['entities']['hashtags'][$i]['text'] = $value['text'];
      $i = $i + 1;
    }
    $json[0]['user']['screen_name'] = $response[0]['user']['screen_name'];
    $aux = $response[1]['entities']['user_mentions'];
    $i = 0;
    foreach ($aux as $key => $value) {
      $json[1]['entities']['user_mentions'][$i]['screen_name'] = $value['screen_name'];
      $i = $i + 1;
    }
    $aux = $response[1]['entities']['media'];
    $i = 0;
    foreach ($aux as $key => $value) {
      $json[1]['entities']['media'][$i]['url'] = $value['url'];
      $i = $i + 1;
    }
    $aux = $response[1]['entities']['hashtags'];
    $i = 0;
    foreach ($aux as $key => $value) {
      $json[1]['entities']['hashtags'][$i]['text'] = $value['text'];
      $i = $i + 1;
    }
    $json[1]['user']['screen_name'] = $response[1]['user']['screen_name'];
    return $json;
  }

}
