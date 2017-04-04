
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


// boot up tinymce
$('document').ready(function(){

    tinymce.init({
        selector: ".tinymce",
        themes: "modern",
    });


    // event handlers
    $(".btn-add-comment").on('click', function(e){

        e.preventDefault();
        $(this).parent().parent().find('.form-comment-hidden').toggle('fast');

    });

});

