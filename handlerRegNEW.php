<?php
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $mysqli = new mysqli("localhost", "root", "", "vmotors");
    $result = $mysqli->query("SELECT * FROM `users` WHERE email = '$email'");
    if($result->num_rows){
        exit("Такой пользователь уже существует");
    }else{
        $mysqli->query("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) VALUES ('$name','$lastname','$email ','$pass')");
        exit("Пользователь $name успешно зарегистрирован");
    }

