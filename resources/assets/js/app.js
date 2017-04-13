
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
        plugins: ["autolink", "code", "codesample"],
        toolbar: 'code | codesample'
    });

    // event handlers
    $(".btn-add-comment").on('click', function(e){
        e.preventDefault();
        $(this).parent().parent().find('.form-comment-hidden').toggle('fast');
    });


    $(".delete").on('click', function(){
       $(this).parent().slideToggle();
    });

    $(".filter-questions").on('click', function() {
        $('.filter-panel').slideToggle('fast');
    });


});

