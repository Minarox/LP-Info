<?php

// Tableau des routes possibles
$A_validRoute = array(
    "",
    "hello",
    "students",
    "students/:int",
    "formations",
    "formation/:int",
    "groups",
    "groups/:int",
    "list_groups",
    "error"
);

// Formatage de l'URL et ajout du tableau des routes possibles
Route::setUrl($_GET['url']);
Route::setValidRoutes($A_validRoute);

// Routes possibles
Route::goTo($A_validRoute[0], function(){ HelloController::welcome(); });
Route::goTo($A_validRoute[1], function(){ HelloController::helloWorld(); });
Route::goTo($A_validRoute[2], function(){ ClassroomController::students(); });
Route::goTo($A_validRoute[3], function(){ ClassroomController::student($_GET['int']); });
Route::goTo($A_validRoute[4], function(){ ClassroomController::formations(); });
Route::goTo($A_validRoute[5], function(){ ClassroomController::formation($_GET['int']); });
Route::goTo($A_validRoute[6], function(){ ClassroomController::groups(); });
Route::goTo($A_validRoute[7], function(){ ClassroomController::createGroups($_GET['int']); });
Route::goTo($A_validRoute[8], function(){ ClassroomController::createGroups($_POST['number']); });
Route::goTo($A_validRoute[9], function(){ ErrorController::error400(); });