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



});