<?php

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
  // USERS
  $app->group('/api/v1/persons', function (Group $group) {
    $group->post('', \App\Aplication\Action\Person\CreateAction::class);
    $group->get('/{data}', \App\Aplication\Action\Person\ReadAction::class);
    $group->delete('/{id:[0-9]+}', \App\Aplication\Action\Person\DeleteAction::class);
    $group->put('', \App\Aplication\Action\Person\UpdateAction::class);
  });
  // PETS
  $app->group('/api/v1/pets', function (Group $group) {
    $group->post('', \App\Aplication\Action\Pet\CreateAction::class);
    $group->get('/{data}', \App\Aplication\Action\Pet\ReadAction::class);
    $group->delete('/{id:[0-9]+}', \App\Aplication\Action\Pet\DeleteAction::class);
    $group->put('', \App\Aplication\Action\Pet\UpdateAction::class);
  });
  // USER_PETS
  $app->group('/api/v1/person_pets', function (Group $group) {
    $group->post('', \App\Aplication\Action\PersonPet\CreateAction::class);
    $group->get('/{data}', \App\Aplication\Action\PersonPet\ReadAction::class);
    $group->delete('/{id:[0-9]+}', \App\Aplication\Action\PersonPet\DeleteAction::class);
    $group->put('', \App\Aplication\Action\PersonPet\UpdateAction::class);
  });
};
