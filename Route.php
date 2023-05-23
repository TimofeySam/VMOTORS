<?php
// Класс отвечающий за маршрутизацию
class Route{
    // Отвечает за те запросы которые были посланы методом POST
    // Метод post() принимает на вход два аргумента,
    // $path - URI для сопоставления
    // $callback - функция, которую нужно вызвать, если $path совпадёт
    /* Первый случай
        $path = '/article/{id}'
        $requestURI = '/article/3'
        $paths = ['', 'article', '3'];
        $uriChunks = ['', 'article', '{id}']
       Второй случай
        $path = '/reg' - URI для сопоставления (с которым сравниваем)
        $requestURI = '/reg' - URI который запросил пользователь
        $paths = ['', 'reg'];
    */
    public static function post($path, $callback){
        $requestURI = $_SERVER['REQUEST_URI']; // Получаем URI по которому запрошена страница
        $paths = explode('/', $requestURI); // URI по которому проверяем (по нему и был запрос)
        if(strpos($path, "{") and $_SERVER['REQUEST_METHOD'] == "POST"){
            $uriChunks = explode('/',$path);
            if($uriChunks[1] == $paths[1]){
                exit($callback($paths[2]));
            }
        }else if($path == $requestURI and $_SERVER['REQUEST_METHOD'] == "POST"){
            $callback();
            exit;
        }
    }
    // Отвечает за те запросы которые были посланы методом GET
    public static function get($path, $callback, $title=""){ // /article/{id}
        $requestURI = $_SERVER['REQUEST_URI']; // Получаем URI по которому запрошена страница
        $paths = explode('/', $requestURI); // URI по которому проверяем (по нему и был запрос)
        $content = "";
        if(strpos($path, "{") and $_SERVER['REQUEST_METHOD']== "GET"){
            $uriChunks = explode('/',$path);
            if($uriChunks[1] == $paths[1]){
                $content = $callback($paths[2]);
                require_once('template.php');
                exit;
            }
        }else if($path == '/'.$paths[1] and $_SERVER['REQUEST_METHOD']== "GET") {
            $content = $callback();
            require_once('template.php');
            exit;
        }
    }
}