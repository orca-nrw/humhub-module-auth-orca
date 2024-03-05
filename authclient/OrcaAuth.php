<?php

namespace humhubContrib\auth\orca\authclient;

use yii\authclient\OAuth2;

/**
 * ORCA-Keykloak allows authentication via OAuth.
 */
class OrcaAuth extends OAuth2
{

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-key',
            'buttonBackgroundColor' => '#e0492f',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function defaultNormalizeUserAttributeMap()
    {
        return [
            'id' => 'sub',
            'username' => 'preferred_username',
            'firstname' => function ($attributes) {
                if (!isset($attributes['given_name'])) {
                    return '';
                }
               
                return $attributes['given_name'];
            },
            'lastname' => function ($attributes) {
                if (!isset($attributes['family_name'])) {
                    return '';
                }

                return $attributes['family_name'];
            },
            'title' => 'tagline',
            'email' => function ($attributes) {
                return $attributes['email'];

            },
        ];
    }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {  
        $userinfo = $this->api("userinfo");


            if(array_key_exists("realm_access", $userinfo) && !empty($userinfo))// check userinfo is not empty and userinfo has realm access
            {
                

                if (!in_array("community", $userinfo['realm_access']['roles']))
                {
                    header('HTTP/1.1 403 Forbidden');
                    echo '<html xmlns="http://www.w3.org/1999/xhtml"><head><title>403 Forbidden</title></head><h2>Sorry, access to this page is forbidden.</h2></body></html>';
                    die();
                }
                else
                {
                    return $this->api("userinfo");
                }

              

            }
            else
            {

                die("Something went wrong");
            }
        

        
        
    }

    

    protected function defaultName()
    {
        return 'orcalogin';
    }

    protected function defaultTitle()
    {
        return 'Zur Anmeldung';
    }


    public function applyAccessTokenToRequest($request, $accessToken)
    {
        $request->getHeaders()->add('Authorization', 'Bearer ' . $accessToken->getToken());
    }

}
