<?php
    session_start()
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Title</title>
  </head>
  <body>
      <p>Имя: <? echo $_SESSION['name'];?></p>
      <p>Фамилия: <? echo $_SESSION['lastname'];?></p>
      <p>Email: <? echo $_SESSION['email'];?></p>
      <p>id: <? echo $_SESSION['id'];?></p>
  </body>
</html>