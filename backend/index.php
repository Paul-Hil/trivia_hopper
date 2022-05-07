<?php

// inclusion des dépendances via Composer
// autoload.php permet de charger d'un coup toutes les dépendances installées avec composer
// mais aussi d'activer le chargement automatique des classes (convention PSR-4)
require_once '../backend/vendor/autoload.php';

header('Access-Control-Allow-Origin: http://localhost:3000');

/* ------------
--- ROUTAGE ---
-------------*/

// création de l'objet router
$router = new AltoRouter();

// le répertoire (après le nom de domaine) dans lequel on travaille est celui-ci
// Mais on pourrait travailler sans sous-répertoire
// Si il y a un sous-répertoire
if (array_key_exists('BASE_URI', $_SERVER)) {
    // Alors on définit le basePath d'AltoRouter
    $router->setBasePath($_SERVER['BASE_URI']);
    // ainsi, nos routes correspondront à l'URL, après la suite de sous-répertoire
}
// sinon
else {
    // On donne une valeur par défaut à $_SERVER['BASE_URI'] car c'est utilisé dans le CoreController
    $_SERVER['BASE_URI'] = '/';
}

$router->map(
    'GET',
    '/game',
    'MainController::game',
    'main-game'
);

$router->map(
    'GET',
    '/questionsList',
    'MainController::getAllQuestions',
    'main-questionsList'
);

$router->map(
    'GET',
    '/numberOfQuestions',
    'MainController::numberMaxOfQuestions',
    'main-numberOfQuestions'
);

$router->map(
    'POST',
    '/loginAdmin',
    'MainController::loginAdmin',
    'main-loginAdmin'
);

$router->map(
    'POST',
    '/newQuestion',
    'MainController::newQuestion',
    'main-newQuestion'
);

$router->map(
    'POST',
    '/deleteQuestion',
    'MainController::deleteQuestion',
    'main-deleteQuestion'
);

$router->map(
    'POST',
    '/editQuestion',
    'MainController::editQuestion',
    'main-editQuestion'
);

$match = $router->match();

// Ensuite, pour dispatcher le code dans la bonne méthode, du bon Controller
// On délègue à une librairie externe : https://packagist.org/packages/benoclock/alto-dispatcher
// 1er argument : la variable $match retournée par AltoRouter
// 2e argument : le "target" (controller & méthode) pour afficher la page 404
$dispatcher = new Dispatcher($match, 'App\Controllers\ErrorController::err404');
$dispatcher->setControllersNamespace('App\Controllers');

// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();