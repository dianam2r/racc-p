<?php

namespace Drupal\racc_social\Logic;

/**
 * This class makes the logic to obtain info from the user instagram account.
 */
class InstagramLogic {

  protected $userId = '6042238992';
  protected $accessToken = '6042238992.1677ed0.2df990b5e94e4ae091a5eea9fa6ffffc';

  /**
   * This function retrieves de data from instagram.
   */
  public function getData() {
    // API config to obtain and display media.
    $userId = $this->userId;
    $accessToken = $this->accessToken;
    $url = "https://api.instagram.com/v1/users/$userId/media/recent/?access_token=$accessToken";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    $response = $this->arrangeData($result);
    return $response;
  }

  /**
   * This function extracts only what is needed in a simple array.
   */
  public function arrangeData($result) {
    $result = json_decode($result, TRUE);
    $response = [];
    $i = 0;
    while ($i <= 2) {
      $response[$i]['original'] = $result['data'][$i]['images']['standard_resolution']['url'];
      $response[$i]['caption'] = $result['data'][$i]['caption']['text'];
      $response[$i]['thumbnail'] = $result['data'][$i]['images']['thumbnail']['url'];
      $i = $i + 1;
    }
    return $response;
  }

}
