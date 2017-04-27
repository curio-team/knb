
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

Vue.component('videos', require('./components/learn/index.vue') );

const app = new Vue({
    el : '#learning'
});


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

    $(".box-post").on('click', function(){
       document.location.href = $(this).attr('data-href');
    });

    $(".option-flag").on('click', function(e){
        e.stopPropagation();
        e.preventDefault();

        if ( confirm('Are you sure you want to mark this post as flagged? A moderator will be notified and address this. Misuse of this will not be tolerated.') )
        {
            $(this).next('.flag-form').submit();
        }
    });

    $("#search-tags input").on('change', function(){
       $(this).closest('form').submit();
    });


});

