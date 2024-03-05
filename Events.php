<?php

namespace humhubContrib\auth\orca;

use humhub\components\Event;
use humhub\modules\user\authclient\Collection;
use humhubContrib\auth\orca\authclient\OrcaAuth;
use humhubContrib\auth\orca\models\ConfigureForm;

class Events
{
    /**
     * @param Event $event
     */
    public static function onAuthClientCollectionInit($event)
    {
        /** @var Collection $authClientCollection */
        $authClientCollection = $event->sender;

        if (!empty(ConfigureForm::getInstance()->enabled)) {
            $authClientCollection->setClient('orca', [
                'class' => OrcaAuth::class,
                'clientId' => ConfigureForm::getInstance()->clientId,
                'clientSecret' => ConfigureForm::getInstance()->clientSecret,
                'authUrl' => ConfigureForm::getInstance()->authUrl,
                'tokenUrl' => ConfigureForm::getInstance()->tokenUrl,
                'apiBaseUrl' => ConfigureForm::getInstance()->apiBaseUrl,
                'httpClient' => [
                    'transport' => 'yii\httpclient\CurlTransport'
                ],
                'scope' => 'openid profile email'
            ]);
        }
    }

}
