<!DOCTYPE html>
<html ng-app='test'>
<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald&family=Yanone+Kaffeesatz&display=swap');
    </style>
    <title>Chat</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald&family=Yanone+Kaffeesatz&display=swap');
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
</body>
<div id="fon">
    <div class="chat_fon">
        <div class="section">

        </div>
    </div>
    <div class="mess_fon"><textarea placeholder="Сообщение" name="content" class="content" cols="30" rows="10"></textarea> <br>
        <button class="mess_send"><img class="send_svg" src="ico/send.svg" alt=""></button>
    </div>
    <!-- <input placeholder="Имя" type="text" name="up_cont" class="up_cont" id="elem"> <br> -->
    <div class="base_fon">
        <input id="title" placeholder="Логин" type="text" name="log" class="log"> <br> <br>
        <input id="title" placeholder="Гендер" type="text" name="pas" class="pas"> <br> <br>
        <input id="title" placeholder="Фото(url)" type="text" name="profimg" class="profimg"> <br> <br>
        <button id="viev" class="reg">Войти</button>
    </div>
    <div class="serch_fon">
        <input id="title" placeholder="Логин участника" type="text" name="serchAcc" class="serchAcc"> <br> <br>
        <button id="viev" class="serchAccount">Поиск</button><br> <br>
    </div>
    <div class="prof_fon">
        <div id="info">info <br> > маштаб фото 1:1 <br> > пример url фото https:/бла-бла/.jpg ну или jpeg, png т.п</div>
    </div>
</div>
</body>

<script src="script.js"></script>

</html>