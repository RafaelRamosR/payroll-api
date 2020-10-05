<?php

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
  $app->get('/', \App\Action\HomeAction::class)->setName('home');
  $app->group('/api/v1', function (Group $group) {
    $group->post('/persons', \App\Action\CreateAction::class);
    $group->get('/persons/{data}', \App\Action\ReadAction::class);
    $group->delete('/persons/{id:[0-9]+}', \App\Action\DeleteAction::class);
    $group->put('/persons', \App\Action\UpdateAction::class);
  });
};
