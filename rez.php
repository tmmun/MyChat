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
<button class="up"></button>
<div id="fon">
    <div class="chat_fon">
        <div class="section">

        </div>
    </div>
    <div class="mess_fon"><textarea placeholder="Сообщение" name="content" class="content" cols="30" rows="10"></textarea> <br>
        <button class="mess_send"></button>
    </div>
    <!-- <input placeholder="Имя" type="text" name="up_cont" class="up_cont" id="elem"> <br> -->
    <div class="prof_fon"><input placeholder="Имя" type="text" name="title" class="title"> <br>
    </div>
</div>
</body>

<script>
    var messCountDel = 0;

    function TitleBlock() {
        let name = document.querySelector('.title'); // Получаем input
        let regex = /[\d\D\s\S\w\W]/g; // регулярка только цифры

        name.oninput = function() {
            this.value = this.value.replace(regex, '');
        }
    }

    $(document).ready(function() { // загружаем данные в бд
        $('button.mess_send').on('click', function() {
            messCountDel++
            console.log(messCountDel)
            //var contentVal = $('textarea.content').val();

            if (document.querySelector('.title').value === '') {
                $('textarea.content').val('Введите имя!');
            } else

            {
                $(".title").hide();
                var re = / /gi; //заменяем все пробелы
                var str = $('textarea.content').val();
                var str2 = $('input.title').val();
                var contentVal = str.replace(re, '_');
                var titleVal = str2.replace(re, '_');

                $.ajax({
                        method: "POST",
                        url: "some.php",
                        data: {
                            title: titleVal,
                            content: contentVal
                        }
                    })
                    .done(function() {
                        //alert("Data Saved: " + msg);
                    });

                $('textarea.content').val('');
            }
        });
    });

    $(document).ready(function() { // загружаем данные в бд
        $('button.del').on('click', function() {
            //var contentVal = $('textarea.content').val();

            $.ajax({
                    method: "POST",
                    url: "del.php",
                    data: {}
                })
                .done(function() {
                    //alert("Data Saved: " + msg);
                });

            $('textarea.content').val('');
        });
    });

    $(document).ready(function() { // загружаем данные в бд
        $('button.up').on('click', function() {
            var content = $('textarea.content').val();
            var title = $('input.title').val();



            $.ajax({
                    method: "POST",
                    url: "update.php",
                    data: {
                        content: content,
                        title: title
                    }
                })
                .done(function() {
                    //alert("Data Saved: " + msg);
                });

            $('textarea.content').val('');
            vievDate();

        });
    });

    var itemCo = 5;
    var itemEl = 0;

    var itemDel;
    var itemSel;

    var ElemCo = 3;

    function vievDate() { //вывод последнего сообщения из бд
        $.ajax({
            type: 'POST',
            url: 'show.php',
            data: {},
            success: function(data) {
                var lastCo = 0;
                //console.log($sss);
                var a = data.split(' ');
                //console.log(a);
                var lastCo = a.length - 2;
                //console.log(lastCo);
                //console.log(contentSave);
                //console.log(JSON.parse(a[lastCo]).content);

                for (let i = 0; i < a.length; i += 1) {
                    if(JSON.parse(a[i]).title == 'ЛЕха'){
                        console.log(i)
                        break
                    }
                    
                }


                if (contentSave != JSON.parse(a[lastCo]).content) { // сравниваем   
                    titleSave = JSON.parse(a[lastCo]).title;
                    contentSave = JSON.parse(a[lastCo]).content;
                    ElemCo++;
                    const boxes = document.getElementsByClassName('section'); // создает элемент section_item
                    const child = document.createElement('div');
                    itemCo++;
                    itemCo = String(itemCo);
                    itemEl = 'item' + itemCo;
                    child.className = 'section_item ' + itemEl;
                    //child.innerHTML = titleSave + '</td>';
                    itemSel = 'section_item ' + itemEl;
                    child.style = "background-color: #373d49;scroll-snap-align: start;"
                    boxes[0].appendChild(child);

                    try {
                        if (contentSave.search('https://') == -1) {

                            CreateTextMess()

                        } else {

                            try {
                                console.log("Фото")
                                const section_item = document.getElementsByClassName('section_item ' + itemEl); // создает элемент imgBase

                                const nameMess = document.createElement('div');
                                nameMess.innerHTML = titleSave + '</td>';

                                section_item[0].appendChild(nameMess);

                                const textMess = document.createElement('img');
                                textMess.className = 'img_chat';
                                textMess.src = contentSave;

                                section_item[0].appendChild(textMess);

                            } catch (err) {

                                CreateTextMess()
                            }

                        }
                    } catch (err) {
                        console.log('ошибка')
                    }
                }

            }
        })
    }

    function CreateTextMess() {
        console.log("неФото")
        const section_item = document.getElementsByClassName('section_item ' + itemEl); // создает элемент imgBase

        const nameMess = document.createElement('div');
        nameMess.innerHTML = titleSave + '</td>';

        section_item[0].appendChild(nameMess);

        const textMess = document.createElement('div');
        textMess.className = 'text';
        textMess.innerHTML = contentSave + '</td>';

        section_item[0].appendChild(textMess);
    }

    function WriteLog() {
        if (messCountDel == 30) { //чистыим базу после определенного кол-во сообьщений
            MessDel()

            var tit = 'Хост'
            var con = 'Чистка!'

            $.ajax({
                    method: "POST",
                    url: "some.php",
                    data: {
                        title: tit,
                        content: con
                    }
                })
                .done(function() {
                    //alert("Data Saved: " + msg);
                });
            messCountDel = 0
        }
        vievDate();
    }

    function MessDel() {
        $.ajax({
                method: "POST",
                url: "del.php",
                data: {}
            })
            .done(function() {
                //alert("Data Saved: " + msg);
            });
    }

    //var TimerId = window.setInterval(WriteLog, 2000);  //Сообщения каждые 3 сек
    //var TimerId = window.setInterval(ProfEnable, 5000);  //Сообщения каждые 3 сек


    var contentSave = "";
    var titleSave = "";

    $('button.viev').on('click', function() {
        vievDate();
    });
</script>

</html>