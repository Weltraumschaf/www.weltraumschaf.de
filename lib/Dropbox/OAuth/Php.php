<?php

/**
 * Dropbox OAuth
 * 
 * @package Dropbox 
 * @copyright Copyright (C) 2010 Rooftop Solutions. All rights reserved.
 * @author Evert Pot (http://www.rooftopsolutions.nl/) 
 * @license http://code.google.com/p/dropbox-php/wiki/License MIT
 */

require_once 'Dropbox/Exception/Forbidden.php';
require_once 'Dropbox/Exception/NotFound.php';
require_once 'Dropbox/Exception/OverQuota.php';
require_once 'Dropbox/Exception/RequestToken.php';
require_once 'Dropbox/Response.php';
require_once 'Dropbox/OAuth.php';
require_once 'Dropbox/OAuth/Token.php';
/**
 * This class is used to sign all requests to dropbox.
 *
 * This specific class uses the PHP OAuth extension
 */
class Dropbox_OAuth_Php extends Dropbox_OAuth {

    /**
     * OAuth object
     *
     * @var OAuth
     */
    protected $OAuth;

    /**
     * Constructor
     * 
     * @param string $consumerKey 
     * @param string $consumerSecret 
     */
    public function __construct($consumerKey, $consumerSecret, $enableDebug = false) {
        if (!class_exists('OAuth')) {
            throw new Dropbox_Exception('The OAuth class could not be found! 
                                        Did you install and enable the oauth extension?');
        }

        $this->OAuth = new OAuth($consumerKey,
                                 $consumerSecret,
                                 OAUTH_SIG_METHOD_HMACSHA1,
                                 OAUTH_AUTH_TYPE_URI);

        if ($enableDebug) {
            $this->OAuth->enableDebug();
        }
    }

    /**
     * Sets the request token and secret.
     *
     * The tokens can also be passed as an array into the first argument.
     * The array must have the elements token and token_secret.
     * 
     * @param string|array $token 
     * @param string $token_secret 
     * @return void
     */
    public function setToken(Dropbox_OAuth_Token $token) {
        parent::setToken($token);
        $this->OAuth->setToken($this->oauthToken->getToken(), $this->oauthToken->getSecret());
    }


    /**
     * Fetches a secured oauth url and returns the response body. 
     * 
     * @param string $uri 
     * @param mixed $arguments 
     * @param string $method 
     * @param array $httpHeaders 
     * @return string 
     */
    public function fetch($uri, array $arguments = array(), $method = 'GET', array $httpHeaders = array()) {
        try { 
            $this->OAuth->fetch($uri, $arguments, $method, $httpHeaders);
            $lastResponseInfo = $this->OAuth->getLastResponseInfo();

            return new Dropbox_Response(
                $lastResponseInfo['http_code'],
                $this->OAuth->getLastResponse()
            );
        } catch (OAuthException $e) {
            $lastResponseInfo = $this->OAuth->getLastResponseInfo();

            switch ($lastResponseInfo['http_code']) {
                  // Not modified
                case 304 :
                    return new Dropbox_Response(304);
                case 403 :
                    throw new Dropbox_Exception_Forbidden('Forbidden. This could mean a bad OAuth request, or a file or folder already existing at the target location.');
                case 404 : 
                    throw new Dropbox_Exception_NotFound('Resource at uri: ' . $uri . ' could not be found');
                case 507 : 
                    throw new Dropbox_Exception_OverQuota('This dropbox is full');
                default:
                    // rethrowing
                    throw $e;
            }
        }
    }

    /**
     * Requests the OAuth request token.
     *
     * @return void 
     */
    public function getRequestToken() {
        try {
            $token = $this->OAuth->getRequestToken(self::URI_REQUEST_TOKEN);
            $this->setToken(new Dropbox_OAuth_Token($token['oauth_token'], $token['oauth_token_secret']));
            return $this->getToken();
        } catch (OAuthException $e) {
            throw new Dropbox_Exception_RequestToken('We were unable to fetch request tokens. This likely means that your consumer key and/or secret are incorrect.', 0, $e);
        }
    }


    /**
     * Requests the OAuth access tokens.
     *
     * This method requires the 'unauthorized' request tokens
     * and, if successful will set the authorized request tokens.
     * 
     * @return void 
     */
    public function getAccessToken() {
        $uri = self::URI_ACCESS_TOKEN;
        $token = $this->OAuth->getAccessToken($uri);
        $this->setToken(Dropbox_OAuth_Token($token['oauth_token'], $token['oauth_token_secret']));
        
        return $this->getToken();

    }


}
