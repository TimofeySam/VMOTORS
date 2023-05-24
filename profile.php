<!-- Конец меню -->
<div class="container">
    <p>Имя: <span id="name"></span></p>
    <p>Фамиля: <span id="lastname"></span></p>
    <p>Email: <span id="email"></span></p>
    <p>ID: <span id="id"></span></p>
    <form action="/uploadAvatar" enctype="multipart/form-data" method="post">
        <input type="file" name="userfile">
        <input type="submit">
    </form>
</div>
<script>
    let name = document.getElementById('name');
    let lastname = document.getElementById('lastname');
    let email = document.getElementById('email');
    let id = document.getElementById('id');
    fetch('/getUserData')
        .then(function (response){return response.json()})
        .then(function (result){
            console.log(result);
            name.innerText = result.name;
            lastname.innerText = result.lastname;
            email.innerText = result.email;
            id.innerText = result.id;
        });
</script>