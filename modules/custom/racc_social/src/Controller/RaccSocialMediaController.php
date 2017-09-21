<?php

namespace Drupal\racc_social\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\racc_social\Logic\FacebookLogic;
use Drupal\racc_social\Logic\InstagramLogic;
use Drupal\racc_social\Logic\TwitterLogic;

/**
 * This class retrieves all services from the socia media containers.
 */
class RaccSocialMediaController extends ControllerBase {

  private $facebookCall;
  private $instagramCall;
  private $twitterCall;

  /**
   * This function constructs the object of the class so it can be instantiated.
   */
  public function __construct(FacebookLogic $facebookCall, InstagramLogic $instagramCall, TwitterLogic $twitterCall) {
    $this->facebookCall = $facebookCall;
    $this->instagramCall = $instagramCall;
    $this->twitterCall = $twitterCall;
  }

  /**
   * This function get the posts from the socia media services.
   */
  public function getMediaPosts() {
    $response = [];
    $facebookData = $this->facebookCall->getData();
    $instagramData = $this->instagramCall->getData();
    $twitterData = $this->twitterCall->getData();
    $response['facebookResponse'] = $facebookData;
    $response['instagramResponse'] = $instagramData;
    $response['twitterResponse'] = $twitterData;
    $build = [
      '#theme' => 'racc_container',
      '#results' => $response,
      '#title' => 'Get Connected',
    ];
    $html = \Drupal::service('renderer')->renderRoot($build);
    $output = new Response();
    $output->setContent($html);
    return $output;
  }

  /**
   * This function makes the call to the containers of the services.
   */
  public static function create(ContainerInterface $container) {
    $facebookCall = $container->get('racc_social.facebook.call');
    $instagramCall = $container->get('racc_social.instagram.call');
    $twitterCall = $container->get('racc_social.twitter.call');
    return new static($facebookCall, $instagramCall, $twitterCall);
  }

}
