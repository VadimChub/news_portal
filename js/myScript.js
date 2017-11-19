$(document).ready(function() {

    $.extend({
        getUrlVars: function(){
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        },
        getUrlVar: function(name){
            return $.getUrlVars()[name];
        }
    });

    //Получить объект с URL параметрами
    var allVars = $.getUrlVars();

   //Получит параметр URL по его имени
    var byName = $.getUrlVar('start');

    function readyIt() {
        if (byName == 0){
            $('.back-button').prop('disabled', true);
            $('.first-button').hide();
        } else {
            $('.back-button').prop('disabled', false);
            $('.first-button').show();
        }
    }

    readyIt();

    function lastButton() {
        var current = $('.current-button').html();
        var last = $('.last-button').html();
        if(current == last){
            $('.next-button').prop('disabled', true);
            $('.last-button').hide();
        }
        else {
            $('.next-button').prop('disabled', false);
            $('.last-button').show();
        }
    }

    lastButton();

    function readingNow () {
        var id = $('.readed').attr('newId');
        var min = 0;
        var max = 5;
        var rand = min - 0.5 + Math.random() * (max - min + 1)
        rand = Math.round(rand);
        $('.reading-now').html(rand);

        $.post("helpers/set_views.php", { views: rand, id: id })
            .done(function(data) {
                $('.readed').html(data);
            });


    }




    //setInterval(readingNow, 3000);




    $('.comment-button').on('click', function () {
        var user = user_id;
        var article = $.getUrlVar('id');
        var comtext = $('.comment-text').val();

        if(comtext != '') {
            $.post("savers/save_comment.php", {text: comtext, user: user, article: article})
                .done(function (data) {
                    $('.comment-text').val('');
                    $('.empty').after(data);
                });
        }
    });



    $('.comment-p').hover(function () {
        $(this).addClass('hover-text');
    }, function () {
        $(this).removeClass('hover-text');
    });

    $('.comment-plus').on('click',function () {
        var autor = user_id;
        var comid = $('.hover-text small').attr('comid');
        var sign = "+";
        $.post("savers/points_saver.php", {comentId: comid, user: autor, sign: sign})
            .done(function (data) {
                $('.hover-text label>span').html(data);
            });
    });

    $('.comment-minus').on('click',function () {
        var autor = user_id;
        var comid = $('.hover-text small').attr('comid');
        var sign = "-";
        $.post("savers/points_saver.php", {comentId: comid, user: autor, sign: sign})
            .done(function (data) {
                //тут мы получаем количество поинтов
                $('.hover-text label>span').html(data);
            });
    });

    //searching
    $('.search-input').keyup(function () {
        var searchval = $('.search-input').val();
        $.post("helpers/searching.php", {search: searchval})
            .done(function (data) {
                $('.option-tempor').remove();
                $('.option-empty').after(data);
            });
    });

    $('.nav-change-standart').on('click', function () {
        $.post("../helpers/settings.php", {mode: 0});
    });

    $('.nav-change-dark').on('click', function () {
        $.post("../helpers/settings.php", {mode: 1});
    });

    $('.nav-change-primary').on('click', function () {
        $.post("../helpers/settings.php", {mode: 2});
    });

    $('.nav-change-light').on('click', function () {
        $.post("../helpers/settings.php", {mode: 3});
    });


});