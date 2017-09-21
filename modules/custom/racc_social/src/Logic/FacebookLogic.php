<?php

namespace Drupal\racc_social\Logic;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

/**
 * This class makes connection with Facebook and retrieves the last two posts.
 */
class FacebookLogic {

  protected $appId = '147312909196744';
  protected $appSecret = '94a3e074f5d997d46b1288a1e662c590';
  protected $graphVersion = 'v2.10';
  protected $accessToken = 'EAACFZBvWfncgBAJKQmGACcDFceqyZBUZCWmgN1X0YeBZADBZCpDu9gMjpSVjaiLZBVW8ghEBtr53nRYEE3tjheNWcwcK4xRTDJJo2aADv3oadVnpCVA5M08ttAeLXTGdd1VfcNoBZBE1GpfanGqDqFVVFSwMmZAgpMAZD';

  /**
   * This function retrieves data from Facebook.
   */
  public function getData() {

    $fb = new Facebook([
      'app_id' => $this->appId,
      'app_secret' => $this->appSecret,
      'default_graph_version' => $this->graphVersion,
      // Optional.
      'default_access_token' => $this->accessToken,
    ]);

    try {
      $posts_request = $fb->get('me/posts?fields=message,full_picture&limit=2');
    }
    catch (FacebookResponseException $e) {
      // When Graph returns an error.
      $response = 'Graph returned an error: ' . $e->getMessage();
    }
    catch (FacebookSDKException $e) {
      // When validation fails or other local issues.
      $response = 'Facebook SDK returned an error: ' . $e->getMessage();
    }
    // $posts_response = $posts_request->getGraphEdge();
    $posts_response = $posts_request->getGraphEdge()->asArray();
    $response = $posts_response;
    return $response;
  }

}
