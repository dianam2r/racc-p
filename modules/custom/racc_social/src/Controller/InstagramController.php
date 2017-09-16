<?php

namespace Drupal\racc_social\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class InstagramController extends ControllerBase {

  public function getPicture(){
    // API config to obtain and display media
    $userId = '6042238992';
    $accessToken = '6042238992.1677ed0.2df990b5e94e4ae091a5eea9fa6ffffc';
    $url = "https://api.instagram.com/v1/users/$userId/media/recent/?access_token=$accessToken";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    $data = $this->getData($result);
    return new JsonResponse($data);
  }

  public function getData($result) {
    $result = json_decode($result, true);
    $array = array();
    $i = 0;
    while ($i <= 2) {
      $array[$i]['original'] = $result['data'][$i]['images']['standard_resolution']['url'];
      $array[$i]['caption'] = $result['data'][$i]['caption']['text'];
      $array[$i]['thumbnail'] = $result['data'][$i]['images']['thumbnail']['url'];
      $i = $i + 1;
    }
    return $array;
  }

}
