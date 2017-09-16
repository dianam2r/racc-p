<?php

namespace Drupal\racc_social\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use \TwitterAPIExchange;

class TwitterController extends ControllerBase{

  public function getTweet(){

    $settings = array(
      'oauth_access_token' => "907621593089757184-dqrgLAwXmBsNoyD6MGufbXQl2JIi2Bc",
      'oauth_access_token_secret' => "4NWmp3LktxWc9mZn6OO1PGwuco7EacjsqKNKYMttnlvBv",
      'consumer_key' => "4gPgqb6Z2HmH3l7se8IzllCs9",
      'consumer_secret' => "r725Tj2LvlvXnNO32YjJdUTgwNjIbMxinNlJl9fqpwwrnX4RhC"
    );

    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $getfield = '?screen_name=raccp_p&count=2';
    $requestMethod = 'GET';

    $twitter = new TwitterAPIExchange($settings);
    $response = $twitter->setGetfield($getfield)
        ->buildOauth($url, $requestMethod)
        ->performRequest();

    $data = $this->getData($response); //This returns an array 

    return new JsonResponse($data);

  }

  public function getData($response){
    $response = json_decode($response, true);
    $json = array();
    $json[0]['text'] = $response[0]['text'];
    $aux = $response[0]['entities']['user_mentions'];
    $i=0;
    foreach ($aux as $key => $value) {
        $json[0]['entities']['user_mentions'][$i]['screen_name'] = $value['screen_name'];
        $i = $i+1;
    }
    $aux = $response[0]['entities']['media'];
    $i = 0;
    foreach ($aux as $key => $value) {
        $json[0]['entities']['media'][$i]['url'] = $value['url'];
        $i = $i+1;
    }
    $aux = $response[0]['entities']['hashtags'];
    $i = 0;
    foreach ($aux as $key => $value) {
        $json[0]['entities']['hashtags'][$i]['text'] = $value['text'];
        $i = $i+1;
    }
    $json[0]['user']['screen_name'] = $response[0]['user']['screen_name'];
    $json[1]['text'] = $response[1]['text'];
    $aux = $response[1]['entities']['user_mentions'];
    $i=0;
    foreach ($aux as $key => $value) {
        $json[1]['entities']['user_mentions'][$i]['screen_name'] = $value['screen_name'];
        $i = $i+1;
    }
    $aux = $response[1]['entities']['media'];
    $i = 0;
    foreach ($aux as $key => $value) {
        $json[1]['entities']['media'][$i]['url'] = $value['url'];
        $i = $i+1;
    }
    $aux = $response[1]['entities']['hashtags'];
    $i = 0;
    foreach ($aux as $key => $value) {
        $json[1]['entities']['hashtags'][$i]['text'] = $value['text'];
        $i = $i+1;
    }
    $json[1]['user']['screen_name'] = $response[1]['user']['screen_name'];
    return $json;
  }

}
