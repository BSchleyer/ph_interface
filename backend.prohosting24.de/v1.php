<?php

        $group->post('/reset', \VServerController::class . ":reset")->add(new RatelimitMiddleware($group->getContainer(),"vserverReset",60,5));
    });
})->add(new ServiceAuthMiddleware($container, 1));

$app->add(new RatelimitMiddleware($container,"global",60,60));
$app->add(new ApiLogMiddleware($container));

$app->run();