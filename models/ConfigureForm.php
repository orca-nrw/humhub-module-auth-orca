<?php

namespace humhubContrib\auth\orca\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use humhubContrib\auth\orca\Module;

/**
 * The module configuration model
 */
class ConfigureForm extends Model
{
    /**
     * @var boolean Enable this authclient
     */
    public $enabled;

    /**
     * @var string the client id provided by OAuth2
     */
    public $clientId;

    /**
     * @var string the client secret provided by OAuth2
     */
    public $clientSecret;

    /**
     * @var string readonly
     */
    public $redirectUri;

    public $authUrl;
    public $tokenUrl;
    public $apiBaseUrl;
    public $realm;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apiBaseUrl', 'authUrl', 'tokenUrl', 'clientId', 'clientSecret'], 'required'],
            [['enabled'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'enabled' => Yii::t('AuthOrcaModule.base', 'Enabled'),
            'apiBaseUrl' => Yii::t('AuthOrcaModule.base', 'Api Base Url'),
            'realm' => Yii::t('AuthOrcaModule.base', 'Realm Name'),
            'clientId' => Yii::t('AuthOrcaModule.base', 'Client ID'),
            'clientSecret' => Yii::t('AuthOrcaModule.base', 'Client secret'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
        ];
    }

    /**
     * Loads the current module settings
     */
    public function loadSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('auth-orca');

        $settings = $module->settings;

        $this->enabled = (boolean)$settings->get('enabled');
        $this->clientId = $settings->get('clientId');
        $this->clientSecret = $settings->get('clientSecret');
        $this->apiBaseUrl = $settings->get('apiBaseUrl');
        $this->authUrl = $settings->get('authUrl');
        $this->tokenUrl = $settings->get('tokenUrl');

        $this->redirectUri = Url::to(['/user/auth/external', 'authclient' => 'orca'], true);
    }

    /**
     * Saves module settings
     */
    public function saveSettings()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('auth-orca');

        $module->settings->set('enabled', (boolean)$this->enabled);
        $module->settings->set('clientId', $this->clientId);
        $module->settings->set('clientSecret', $this->clientSecret);
        $module->settings->set('apiBaseUrl', $this->apiBaseUrl);
        $module->settings->set('authUrl', $this->authUrl);
        $module->settings->set('tokenUrl', $this->tokenUrl);

        return true;
    }

    /**
     * Returns a loaded instance of this configuration model
     */
    public static function getInstance()
    {
        $config = new static;
        $config->loadSettings();

        return $config;
    }

}
