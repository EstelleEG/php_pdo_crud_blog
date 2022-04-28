<?php

use App\Controller\{ArticleController, CategoryController, SigninController, SignoutController, SignupController};

$router->map('GET', '/', function() {
    $articleController = new ArticleController();
    $articleController->index(); //index() is for getAll (to display all articles)
});
$router->map('GET|POST', '/article/new', function() {
    $articleController = new ArticleController();
    $articleController->new();
});
$router->map('GET|POST', '/article/show/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->show($id);
});
$router->map('GET|POST', '/article/edit/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->edit($id);
});
$router->map('GET', '/article/delete/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->delete($id);
});
$router->map('GET|POST', '/signup', function () {
    $signupController = new SignupController();
    $signupController->index();
});
$router->map('GET|POST', '/signin', function () {
    $signinController = new SigninController();
    $signinController->index();
});
$router->map('GET|POST', '/signout', function () {
    $signoutController = new SignoutController();
    $signoutController->index();
});



$router->map('GET', '/category', function() {
    $categoryController = new CategoryController();
    $categoryController->index(); //index() is for getAll (to display all categories)
});
$router->map('GET|POST', '/category/show/[i:id]', function(int $id) {
    $categoryController = new CategoryController();
    $categoryController->show($id);
});
$router->map('GET|POST', '/category/new', function() {
    $categoryController = new CategoryController();
    $categoryController->new();
});
$router->map('GET|POST', '/category/edit/[i:id]', function(int $id) {
    $categoryController = new CategoryController();
    $categoryController->edit($id);
});
$router->map('GET', '/category/delete/[i:id]', function(int $id) {
    $categoryController = new CategoryController();
    $categoryController->delete($id);
});
