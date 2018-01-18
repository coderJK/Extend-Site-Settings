<?php

namespace Drupal\extend_site_setting\Controller;

use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ExtendSiteController Class Doc Comment.
 *
 * @category Class
 * @package SiteConfiguration
 * @author Jitesh Khatwani
 * @license http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link https://www.linkedin.com/in/jitesh-khatwani-6148a11b?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base%3BJDOjwW1%2BQEmanDbDVg%2FtOA%3D%3D
 */
class ExtendSiteController {

  /**
   * To display the node details in JSON response.
   *
   * @param string $site_api_key
   *   - Added field in site settings.
   * @param \Drupal\node\NodeInterface $node
   *   - Retrieving node information.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   - Used for JSON response.
   */
  public function content($site_api_key, NodeInterface $node) {
    // Fetching the added Site API Key from configuration.
    $site_api_key_value = \Drupal::config('siteapikey.configuration')->get('siteapikey');

    // JSON respnse for node using Site API Key.
    if ($node->getType() == 'page' && $site_api_key_value != 'No API Key yet' && $site_api_key_value == $site_api_key) {
      // JSON response of node.
      return new JsonResponse($node->toArray(), 200, ['Content-Type' => 'application/json']);
    }
    else {
      // Access Denied.
      return new JsonResponse(["error" => "access denied"], 401, ['Content-Type' => 'application/json']);
    }
  }

}
