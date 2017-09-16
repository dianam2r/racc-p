<?php
// appID = 181421835737852
// appSecret = d4f9c5e23c17275221f600bf8d2ef0bb
namespace Drupal\racc_social\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Facebook\Facebook;
use \Facebook\Exceptions\FacebookResponseException;
use \Facebook\FacebookRedirectLoginHelper;
use \Facebook\Exceptions\FacebookSDKException;
use \Facebook\Authentication\AccessToken;
use \Facebook\Authentication\AccessTokenMetadata;

class FacebookController extends ControllerBase {

  public function getPost(){

    if($_SESSION['fb_access_token']){
      $token = $_SESSION['fb_access_token'];
    }else{
      $token = 'EAACFZBvWfncgBAJKQmGACcDFceqyZBUZCWmgN1X0YeBZADBZCpDu9gMjpSVjaiLZBVW8ghEBtr53nRYEE3tjheNWcwcK4xRTDJJo2aADv3oadVnpCVA5M08ttAeLXTGdd1VfcNoBZBE1GpfanGqDqFVVFSwMmZAgpMAZD';
    }

    $fb = new Facebook([
      'app_id' => '147312909196744',
      'app_secret' => '94a3e074f5d997d46b1288a1e662c590',
      'default_graph_version' => 'v2.10',
      'default_access_token' => $token, // optional
    ]);

    try {
    		$posts_request = $fb->get('me/posts?fields=message,full_picture&limit=2');
    } catch(FacebookResponseException $e) {
    		// When Graph returns an error
    		$print = 'Graph returned an error: ' . $e->getMessage();
    		return new Response($print);
    } catch(FacebookSDKException $e) {
    		// When validation fails or other local issues
    		$print = 'Facebook SDK returned an error: ' . $e->getMessage();
    		return new Response($print);
    	}
    $total_posts = array();
    $posts_response = $posts_request->getGraphEdge();
    $posts_response = $posts_request->getGraphEdge()->asArray();
    $print = $posts_response;

    return new JsonResponse($posts_response);

  }

  public function logIn(){
    $fb = new Facebook([
      'app_id' => '147312909196744',
      'app_secret' => '94a3e074f5d997d46b1288a1e662c590',
      'default_graph_version' => 'v2.10',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['user_posts']; // Optional permissions
    $loginUrl = $helper->getLoginUrl('http://dev-racc-p.pantheonsite.io/racc_social_facebook/callback', $permissions);

    return new Response( '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>');
  }

  public function callback() {
    $fb = new Facebook([
      'app_id' => '147312909196744',
      'app_secret' => '94a3e074f5d997d46b1288a1e662c590',
      'default_graph_version' => 'v2.10',
    ]);
    $helper = $fb->getRedirectLoginHelper();

    try {
      $accessToken = $helper->getAccessToken();
    } catch(FacebookResponseException $e) {
      // When Graph returns an error
      $print = 'Graph returned an error: ' . $e->getMessage();
      return new Response($printText);
    } catch(FacebookSDKException $e) {
      // When validation fails or other local issues
      $print = 'Facebook SDK returned an error: ' . $e->getMessage();
      return new Response($printText);
    }

    if (! isset($accessToken)) {
      if ($helper->getError()) {
        //header('HTTP/1.0 401 Unauthorized');
        $print = "Error: " . $helper->getError() . "<br>";
        $print .= "Error Code: " . $helper->getErrorCode() . "<br>";
        $print .= "Error Reason: " . $helper->getErrorReason() . "<br>";
        $print .= "Error Description: " . $helper->getErrorDescription() . "<br>";
        return new Response($printText);
      } else {
        //header('HTTP/1.0 400 Bad Request');
        $print = 'Bad request';
        return new Response($printText);
      }
    }

    // Logged in
    $print = '<h3>Access Token</h3>';
    //var_dump($accessToken->getValue());
    $print .= $accessToken->getValue();

    // The OAuth 2.0 client handler helps us manage access tokens
    $oAuth2Client = $fb->getOAuth2Client();

    // Get the access token metadata from /debug_token
    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
    $print .= '<h3>Metadata</h3>';

    // Validation (these will throw FacebookSDKException's when they fail)
    $tokenMetadata->validateAppId('147312909196744'); // Replace {app-id} with your app id
    // If you know the user ID this access token belongs to, you can validate it here
    $tokenMetadata->validateExpiration();

    if (! $accessToken->isLongLived()) {
      // Exchanges a short-lived access token for a long-lived one
      try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
      } catch (FacebookSDKException $e) {
        $print = "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p><br><br>";
        return new Response($printText);
      }

      $print .= '<h3>Long-lived</h3>';
      $print .= $accessToken->getValue();
    }

    $_SESSION['fb_access_token'] = (string) $accessToken;

    // User is logged in with a long-lived access token.
    // You can redirect them to a members-only page.
    return new Response($print.'<br><br>'.$_SESSION['fb_access_token']);
  }

}
