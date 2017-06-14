
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

Vue.component('videos', require('./components/learn/details.vue') );
Vue.component('videos-overview', require('./components/learn/index.vue'));
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

    $('.nav-toggle').on({
      // Toggle nav menu for mobile devices
      click: function () {
        $('.nav-menu').toggleClass('is-active');
      }
    });



    $('.toggle-options').on('click', function () {
      $('.header-nav').removeClass('is-active')
      $('.toggle-header-nav').removeClass('is-active')

      $('.options-dropdown').toggleClass('is-active')
      $(this).toggleClass('is-active')
    })

    $('.toggle-header-nav').on('click', function () {
      $('.options-dropdown').removeClass('is-active')
      $('.toggle-options').removeClass('is-active')

      $('.header-nav').toggleClass('is-active')
      $(this).toggleClass('is-active')
    })

    $('.hero, .main-content').on('click', function () {
      $('.options-dropdown').removeClass('is-active')
      $('.toggle-options').removeClass('is-active')
      $('.header-nav').removeClass('is-active')
      $('.toggle-header-nav').removeClass('is-active')
    })

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

    $(".enable-admin-controls").on('click', function(e){
       e.stopPropagation();
       $(this).next().slideToggle();
    });

    $(".btn-admin-control-remove").on('click', function(e){
       e.stopPropagation();
       var id = $(this).attr('data-id');
       $.ajax('/post/' + id, {
            type: 'post',
            data : {
                _method: 'DELETE',
                _token: window.Laravel.csrfToken
            }
       }).done(function(data){
           document.location.href="/";
       });

    });

});
