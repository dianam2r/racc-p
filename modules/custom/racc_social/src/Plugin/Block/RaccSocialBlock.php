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

}
