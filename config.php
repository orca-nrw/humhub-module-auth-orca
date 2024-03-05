<?php

use humhub\modules\user\authclient\Collection;

return [
    'id' => 'auth-orca',
    'class' => 'humhubContrib\auth\orca\Module',
    'namespace' => 'humhubContrib\auth\orca',
    'events' => [
        [Collection::class, Collection::EVENT_AFTER_CLIENTS_SET, ['humhubContrib\auth\orca\Events', 'onAuthClientCollectionInit']]
    ],
];
