<?php
session_start(); // Запускаем сессию и получаем суперглобальный массив $_SESSION
// "/deleteArticle/2" -> $path = ["", "deleteArticle", "2"] -> if($path[1] == "deleteArticle"){выполняем инструкции удаления статьи}
// "/reg" -> $path = ["", "reg"] -> if($path[1] == "reg"){открывем страницу регистрации}
// "/login" -> $path = ["", "login"] -> if($path[1] == "login"){открываем страницу авторизации}
$requestURI = $_SERVER['REQUEST_URI']; // Получаем URI по которому запрошена страница
$method = $_SERVER['REQUEST_METHOD']; // Получаем метод запроса GET POST
$path = explode('/', $requestURI);
require_once('php/db.php');
require_once('php/classes/UserController.php');
require_once('php/classes/ArticleController.php');
require_once('php/classes/Route.php');
require_once('php/classes/simple_html_dom.php');

/*
 * Маршрутизация
 * Класс Route имеет два метода get() и post()
 * */
Route::get('/', function (){return ArticleController::getArticles();}, "Добро пожаловать");
Route::get('/reg', function (){return file_get_contents("reg.php");}, "Регистрация");
Route::get('/login', function (){return file_get_contents('login.php');}, "Авторизация");
Route::get('/article/{id}', function (){return file_get_contents('article.html');});
Route::get("/getUsers", function (){UserController::getUsers();});
Route::get('/users', function (){return file_get_contents('users.html');});
Route::post('/reg', function (){UserController::reg($_POST['name'], $_POST['lastname'], $_POST['email'], $_POST['pass']);});
Route::post('/login', function (){UserController::login($_POST['email'], $_POST['pass']);});
Route::post('/article/{id}', function ($id){return ArticleController::getArticle($id);});
Route::get('/getUserData', function (){UserController::getUserData();});
Route::get('/getComment/{id}', function ($id){return ArticleController::getCommentsByArticleId($id);});

if($_SESSION['id']){
    Route::get('/profile', function (){return file_get_contents('profile.php');});
    Route::get('/addArticle', function (){return file_get_contents('addArticle.php');});
    Route::get('/deleteArticle', function (){ArticleController::deleteArticle(null);});
    Route::get('/updateArticle', function (){return file_get_contents('updateArticle.html');});
    Route::get('/exit', function (){UserController::logout();});
    Route::post('/addArticle', function (){ArticleController::addArticle($_POST['title'], $_POST['content'], $_POST['author']);});
    Route::post('/updateArticle', function (){ArticleController::updateArticle($_POST['id'], $_POST['title'], $_POST['content'], $_POST['author']);});
    Route::post('/uploadAvatar', function (){UserController::uploadAvatar();});
    Route::post('/addComment', function (){echo ArticleController::saveComment();});
}else{
    header('Location: /login');
}