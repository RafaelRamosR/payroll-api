<?php

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
  $app->get('/', \App\Action\HomeAction::class)->setName('home');
  $app->group('/api/v1/persons', function (Group $group) {
    $group->post('', \App\Aplication\Action\Person\CreateAction::class);
    $group->get('/{data}', \App\Aplication\Action\Person\ReadAction::class);
    $group->delete('/{id:[0-9]+}', \App\Aplication\Action\Person\DeleteAction::class);
    $group->put('', \App\Aplication\Action\Person\UpdateAction::class);
  });
};
