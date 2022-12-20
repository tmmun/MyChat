var myName = '';
var myGender = '';
var myImg = '';
var messCount = 0;
var garbageMessages = 0;
$(".content").hide();
$(".mess_send").hide();
$(".serch_fon").hide();
//$("#element").show(); 

var loginVal;
var paswordtVal;

$(document).ready(function () { // ограничения для input(log, pas)
    $('[name=log]').bind("change keyup input click", function () {
        if (this.value.match(/[^a-z]/g)) {
            this.value = this.value.replace(/[^a-z]/g, '');
        }
    });
    $('[name=pas]').bind("change keyup input click", function () {
        if (this.value.match(/[^a-z]/g)) {
            this.value = this.value.replace(/[^a-z]/g, '');
        }
    });
});

function NumberOfMessages() { //кол-во сообщений
    $.ajax({
        type: 'POST',
        url: 'show.php',
        data: {},
        success: function (data) {
            var a = data.split(' ');
            messCount = a.length - 1;
        }
    })
}

NumberOfMessages()

$(document).ready(function () { // регистрация с проверкой логина
    $('button.reg').on('click', function () {
        
        profimgVal = $('input.profimg').val()
        let result = profimgVal.match(/(https?:\/\/.*\.(?:png|jpg))/i);
        if (result != null) {// если url ведет на картинку

            myImg = profimgVal
            loginVal = $('input.log').val();
            myName = loginVal
            paswordtVal = $('input.pas').val();
            myGender = paswordtVal

            $.ajax({
                method: "POST",
                url: "some.php",
                data: {
                    log: loginVal,
                    pas: paswordtVal,
                    profimg: profimgVal
                }
            })
                .done(function () {
                    //alert("Data Saved: " + msg);
                });

            VievEl(myName)

            const imgIco = document.querySelector('#myimg')
            imgIco.setAttribute('src', profimgVal)

        } else {// если url не ведет на картинку

            profimgVal = "ico/avatar.svg"//картинка затычка
            myImg = profimgVal
            loginVal = $('input.log').val();
            myName = loginVal
            paswordtVal = $('input.pas').val();
            myGender = paswordtVal

            $.ajax({
                method: "POST",
                url: "some.php",
                data: {
                    log: loginVal,
                    pas: paswordtVal,
                    profimg: profimgVal
                }
            })
                .done(function () {
                    //alert("Data Saved: " + msg);
                });

            VievEl(myName)

            const imgIco = document.querySelector('#myimg')
            imgIco.setAttribute('src', profimgVal)
        }

    });
});

$(document).ready(function () { // пишем сообщение
    $('button.mess_send').on('click', function () {
        GarbageMessages()
        garbageMessages++
        var contentVal = $('textarea.content').val();
        var titleVal = myName;

        var re = / /gi; //заменяем все пробелы
        var str = $('textarea.content').val();
        var contentVal = str.replace(re, '_');

        $.ajax({
            method: "POST",
            url: "wrimess.php",
            data: {
                title: titleVal,
                content: contentVal
            }
        })
            .done(function () {
                //alert("Data Saved: " + msg);
            });

        $('textarea.content').val('')
    });
});


var itemCo = 5;
var itemEl = 0;

var itemDel;
var itemSel;

var ElemCo = 3;

var titleSave = ''
var contentSave = ''

function messShow() { //вывод сообщений
    $.ajax({
        type: 'POST',
        url: 'show.php',
        data: {},
        success: function (data) {
            var lastIndex = 0;
            var a = data.split(' ');
            var lastIndex = a.length - 2;
            var ifalength = a.length - 1;
            if (messCount < ifalength) {
                titleSave = JSON.parse(a[lastIndex]).title;
                contentSave = JSON.parse(a[lastIndex]).content;
                ElemCo++;
                const boxes = document.getElementsByClassName('section'); // создает элемент section_item
                const child = document.createElement('div');
                itemCo++;
                itemCo = String(itemCo);
                itemEl = 'item' + itemCo;
                child.className = 'section_item ' + itemEl;
                itemSel = 'section_item ' + itemEl;
                child.style = "background-color: #373d49;scroll-snap-align: start;"
                boxes[0].appendChild(child);
                let result = contentSave.match(/(https?:\/\/.*\.(?:png|jpg))/i);

                try {
                    if (result == null) {

                        CreateTextMess()

                    } else {

                        try {
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
                }
                messCount++
            }
        }
    })
}

var TimerId = window.setInterval(messShow, 2000);  //вывод Сообщения каждые 3 сек


$(document).ready(function () { // поиск
    $('button.serchAccount').on('click', function () {

        var logVal = $('input.serchAcc').val();

        $.ajax({
            type: 'POST',
            url: 'serch.php',
            data: {},
            success: function (data) {
                var a = data.split(' ');
                for (let i = 0; i < a.length - 1; i += 1) {

                    var log = JSON.parse(a[i]).log;

                    if (log == logVal) {
                        const imgIco = document.querySelector('#myimg')
                        var elems = document.getElementsByClassName('prof_text');
                        elems[0].innerHTML = 'Login: ' + JSON.parse(a[i]).log + '\n' + 'Gender: ' + JSON.parse(a[i]).pas;
                        imgIco.setAttribute('src', JSON.parse(a[i]).profimg)
                    }
                }

            }
        })
    });
});

function CreateTextMess() {
    const section_item = document.getElementsByClassName('section_item ' + itemEl); // создает элемент imgBase

    const nameMess = document.createElement('div');
    nameMess.innerHTML = titleSave + '</td>';

    section_item[0].appendChild(nameMess);

    const textMess = document.createElement('div');
    var contentCatch = contentSave
    var re = /_/gi; //заменяем все _
    var str = contentCatch;
    var contentDone = str.replace(re, ' ');
    textMess.className = 'text';
    textMess.innerHTML = contentDone + '</td>';

    section_item[0].appendChild(textMess);
}

function VievEl(nam) { //показываем и скрываем ненужные элементы и формируем профиль
    $(".content").show();
    $(".mess_send").show();
    $(".serch_fon").show();
    $(".log").hide();
    $(".pas").hide();
    $(".profimg").hide();
    $(".singin").hide();
    $(".reg").hide();

    const boxes = document.getElementsByClassName('base_fon'); // создает элемент section_item
    const child = document.createElement('img');
    child.className = 'myimg';
    child.id = 'myimg';
    child.setAttribute('src', myImg)
    boxes[0].appendChild(child);
    const boxes2 = document.getElementsByClassName('base_fon');
    const child2 = document.createElement('div');
    child2.innerHTML = 'Login: ' + nam + '\n' + 'Gender: ' + myGender
    child2.className = 'prof_text'
    child2.id = 'prof_text'
    boxes2[0].appendChild(child2);
}

function GarbageMessages() {
    if (messCount > 100) {
        $.ajax({
            method: "POST",
            url: "del.php",
            data: {}
        })
            .done(function () {
                //alert("Data Saved: " + msg);
            });
        garbageMessages = 0
    }

}





