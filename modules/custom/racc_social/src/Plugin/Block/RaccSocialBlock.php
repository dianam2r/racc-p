<?php

namespace Drupal\racc_social\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'RaccSocialBlock' block.
 *
 * @Block(
 *  id = "racc_social_block",
 *  admin_label = @Translation("Racc social block"),
 * )
 */
class RaccSocialBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'racc_social';
    $build['#id'] = 'get-connected';
    return $build;
  }

  /**
   * This function retrieves de data from de social containers.
   */
  public function getData() {
    $client = \Drupal::httpClient();
    try {
      $request = $client->get('http://dev-racc-p.pantheonsite.io/racc_social_posts');
      $response = $request->getBody();
      $response = json_decode($response, TRUE);
    }
    catch (RequestException $e) {
      $response = $e->getMessage();
    }
    return $response;
  }

}
