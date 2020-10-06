<?php

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
  $app->get('/', \App\Action\HomeAction::class)->setName('home');
  $app->group('/api/v1', function (Group $group) {
    $group->post('/persons', \App\Domain\Person\Person::class . ':createData');
    $group->get('/persons/{data}', \App\Domain\Person\Person::class . ':readData');
    $group->delete('/persons/{id:[0-9]+}', \App\Domain\Person\Person::class . ':deleteData');
    $group->put('/persons', \App\Domain\Person\Person::class . ':updateData');
  });
};
