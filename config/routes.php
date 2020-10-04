<?php

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

  $app->get('/', \App\Action\HomeAction::class)->setName('home');
  $app->post('/users', \App\Action\UserCreateAction::class);

  $app->group('/api/v1', function (Group $group) {
    $query = [
      'table' => 'users',
      'columns' => 'username, first_name, last_name, email',
      'columns2' => 'username = ?, first_name = ?, last_name = ?, email = ?'
    ];
    $group->get('/billing', function ($request, $response, $args) {
      // Route for /billing
    });
    $group->post('/person', \App\Action\CreateAction::class);
    $group->get('/person', \App\Action\HomeAction::class);
    $group->delete('/person', \App\Action\HomeAction::class);
    $group->put('/person', \App\Action\HomeAction::class);
  });
};
