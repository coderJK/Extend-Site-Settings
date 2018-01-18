<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * This is the controller, which will help in representing the JSON response for node
 *
 * This module also provides a URL that responds with a JSON representation of a given 
 * node with the content type "page" only if the previously submitted API Key and a 
 * node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".
 * Example URL: http://localhost/page_json/FOOBAR12345/17
 *
 * PHP version 5.6
 * LICENSE: Added this for practical exam
 *
 * @category   SiteConfiguration
 * @package    SiteConfiguration
 * @author     "Jitesh Khatwani <jiteshkhatwani@gmail.com>"
 * @copyright  2018-2019 Personal
 * @license    https://github.com/coderJK/Extend-Site-Settings Personal use
 * @version    Github
 * @link       https://github.com/coderJK/Extend-Site-Settings
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.0
 * @deprecated File deprecated in Release 1.1
 */

namespace Drupal\extend_site_setting\Controller;

use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ExtendSiteController Class Doc Comment
 *
 * @category Class
 * @package  SiteConfiguration
 * @author   Jitesh Khatwani 
 * @license  https://github.com/coderJK/Extend-Site-Settings Personal use
 * @link     https://github.com/coderJK/Extend-Site-Settings
 *
 */
class ExtendSiteController
{
    /**
     * @param $site_api_key - Added field in site settings
     * @param NodeInterface $node - Retrieving node information 
     * @return JsonResponse
     */
    public function content($site_api_key, NodeInterface $node)
    {
        // Fetching the added Site API Key from configuration
        $site_api_key_value = \Drupal::config('siteapikey.configuration')->get('siteapikey');

        //JSON respnse for node using Site API Key URL: http://localhost/page_json/FOOBAR12345/17
        if($node->getType() == 'page' && $site_api_key_value != 'No API Key yet' && $site_api_key_value == $site_api_key) {
            // JSON response of node
            return new JsonResponse($node->toArray(), 200, ['Content-Type'=> 'application/json']);
        } else {
            // Access Denied
            return new JsonResponse(array("error" => "access denied"), 401, ['Content-Type'=> 'application/json']);
        }
    }
}
