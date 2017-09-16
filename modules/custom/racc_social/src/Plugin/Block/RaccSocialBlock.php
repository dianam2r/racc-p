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
    $build['racc_social_block']['#markup'] = $this->getData();
    /*$build['racc_social_block']['#theme'] = 'racc_social';
    $build['racc_social_block']['#results'] = $this->getData();*/
    return $build;
  }

  public function getData(){
    $client = \Drupal::httpClient();
    try {
      //Getting response from Instagram;
      $instagramRequest = $client->get('http://dev-racc-p.pantheonsite.io/racc-p/racc_social_instagram');
      $instagramResponse = $instagramRequest->getBody();
      $instagramResponse = json_decode($instagramResponse,true);
      //Getting response from Facebook;
      $facebookRequest = $client->get('http://dev-racc-p.pantheonsite.io/racc-p/racc_social_facebook');
      $facebookResponse = $facebookRequest->getBody();
      $facebookResponse = json_decode($facebookResponse,true);
      //Getting response from Twitter;
      $twitterRequest = $client->get('http://dev-racc-p.pantheonsite.io/racc-p/racc_social_twitter');
      $twitterResponse = $twitterRequest->getBody();
      $twitterResponse = json_decode($twitterResponse,true);
    } catch (RequestException $e) {
      $result = $e->getMessage();
    }
    //$resultResponse = array('instagram'=>$instagramResponse,'facebook'=>$facebookResponse,'twitter'=>$twitterResponse);


    $result = '<div class="get-connected">'
              .'<div class="get-connected-content">'
              .'<div class="first-col">'
                  .'<div class="connected">'
                  .'<h1>Get Connected</h1>'
                  .'<div class="social">'
                  .'<div class="social-row1">'
                  .'<div class="social-media-facebook"><a href="https://www.facebook.com/ReadingAreaCommunityCollege"></a></div>'
                  .'<div class="social-media-twitter"><a href="https://twitter.com/raccp_p"></a></div>'
                  .'<div class="social-media-youtube"><a href="https://www.youtube.com/user/RACCvideopage"></a></div>'
                  .'</div>'
                  .'<div class="social-row2">'
                  .'<div class="social-media-linkedin"><a href="https://www.linkedin.com/company/reading-area-community-college"></a></div>'
                  .'<div class="social-media-snapchat"><a href="https://www.snapchat.com/add/racc_edu"></a></div>'
                  .'<div class="social-media-instagram"><a href="https://www.instagram.com/RACC_edu/"></a></div>'
                  .'</div>'
                  .'</div>'
                  .'</div>'
                  .'<div class="stairs">'
                  .'<div class="social-img-background"><img alt="instagramPicture" src="'.$instagramResponse[0]['original'].'" /></div>'
                  .'<div class="social-instagram">'
                  .'<p><span class="logo-social-instagram">@raccp_p</span></p>'
                  .'</div>'
                  .'</div>'
              .'</div>'

              .'<div class="second-col">'
                  .'<div class="back-to-school">'
                  .'<div class="social-img-background"><img alt="Facebook Post" src="'.$facebookResponse[0]['full_picture'].'" /></div>'
                  .'<div class="social-facebook">'
                  .'<p><span class="media-message">'.$facebookResponse[0]['message'].'<br></span><span class="logo-social-instagram">@raccp_p</span></p>'
                  .'</div>'
                  .'</div>'
                  .'<div class="stairs">'
                  .'<div class="social-img-background"><img alt="instagramPicture" src="'.$instagramResponse[1]['original'].'" /></div>'
                  .'<div class="social-instagram">'
                  .'<p><span class="logo-social-instagram">@raccp_p</span></p>'
                  .'</div>'
                  .'</div>'
              .'</div>'
              .'<div class="third-col">'
                  .'<div class="racc-entrance">'
                  .'<div class="social-img-background"><img alt="Instagram Picture" src="'.$instagramResponse[2]['original'].'" /></div>'
                  .'<div class="social-instagram">'
                  .'<p><span class="logo-social-instagram">@raccp_p</span></p>'
                  .'</div>'
                  .'</div>'
                  .'<div class="advice">'
                  .'<div class="message">'
                  .'<p>'.addslashes($twitterResponse[0]['text']).'<span></span></p>'
                  .'</div>'
                  .'<div class="social-twitter">'
                  .'<p><span><strong>@raccp_p</strong></span></p>'
                  .'</div>'
                  .'</div>'
              .'</div>'
              .'<div class="fourth-col">'
                  .'<div class="advice">'
                  .'<div class="message">'
                  .'<p>'.addslashes($twitterResponse[1]['text']).'<span></span></p>'
                  .'</div>'
                  .'<div class="social-twitter">'
                  .'<p><span class="logo-social-twitter"><strong>@RACC_edu</strong></span></p>'
                  .'</div>'
                  .'</div>'
                  .'<div class="racc-product">'
                  .'<div class="social-img-background"><img alt="Facebook Picture" src="'.$facebookResponse[1]['full_picture'].'" /></div>'
                  .'<div class="social-facebook">'
                  .'<p><span class="media-message">'.$facebookResponse[0]['message'].'<br></span><span class="logo-social-instagram">@raccp_p</span></p>'
                  .'</div>'
                  .'</div>'
              .'</div>'

              .'</div>'
              .'</div>';


    return $result;
    //return $resultResponse;
  }

}
