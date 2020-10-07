<?php

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
  $app->get('/', \App\Action\HomeAction::class)->setName('home');
  $app->group('/api/v1/persons', function (Group $group) {
    $path = \App\Aplication\Action\Person\Person::class;
    $group->post('', \App\Aplication\Action\Person\CreateAction::class);
    $group->get('/{data}', $path . ':readData');
    $group->delete('/{id:[0-9]+}', $path . ':deleteData');
    $group->put('', \App\Aplication\Action\Person\UpdateAction::class);
  });
};
