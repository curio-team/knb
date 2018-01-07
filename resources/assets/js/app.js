
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

Vue.component('videos', require('./components/learn/details.vue') );
Vue.component('learning', require('./components/learn/index.vue'));
Vue.component('points', require('./components/points/index.vue'));
Vue.component('badges', require('./components/badges/index.vue'));
Vue.component('tools', require('./components/learn/tools.vue'));
Vue.component('resource-links', require('./components/learn/links.vue'));
Vue.component('news', require('./components/news/index.vue'));
Vue.component('statistics', require('./components/statistics.vue'));

const app = new Vue({
    el : '#app'
});

// boot up tinymce
$('document').ready(function(){

    tinymce.init({
        selector: ".tinymce",
        themes: "modern",
        plugins: ["autolink", "code", "codesample", "link"],
        toolbar: 'code | codesample | link',
    });

    // event handlers
    $(".btn-add-comment").on('click', function(e){
        e.preventDefault();
        $(this).parent().parent().find('.form-comment-hidden').toggle('fast');
        $(this).parent().parent().find('.form-flag-hidden').hide('fast');

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

    $(".option-flag-post").on('click', function(e){
        e.stopPropagation();
        e.preventDefault();

        var flag = $(this).parent().parent().parent().find('.flag-form');

        flag.parent().parent().parent().parent().find('.form-comment-hidden').hide('fast');
        flag.parent().parent().parent().parent().find('.form-flag-hidden').toggle('fast');

        flag.find('.button').html("Flag post");
        flag.find('.textarea').html("");
        flag.find('.textarea').attr('placeholder', "Add the reason for flagging...");

        var id = $(this).attr('data-id');
        flag.attr('action', "/post/" + id + "/flag");
    });

    $(".option-flag-comment").on('click', function(e){
        e.stopPropagation();
        e.preventDefault();

        var flag = $(this).parent().parent().parent().parent().parent().find('.flag-form');

        flag.parent().parent().parent().parent().find('.form-comment-hidden').hide('fast');
        flag.parent().parent().parent().parent().find('.form-flag-hidden').toggle('fast');
        
        flag.find('.textarea').html("");
        flag.find('.textarea').attr('placeholder', "Add the reason for flagging...");
        flag.find('.button').html("Flag comment");

        id = $(this).parent().attr('data-id');
        flag.attr('action', "/comment/" + id + "/flag");
    });

    $(".option-edit-comment").on('click', function(e){
        e.stopPropagation();
        e.preventDefault();

        var flag = $(this).parent().parent().parent().parent().parent().find('.flag-form');

        flag.parent().parent().parent().parent().find('.form-comment-hidden').hide('fast');
        flag.parent().parent().parent().parent().find('.form-flag-hidden').toggle('fast');

        flag.find('.button').html("Edit comment");
        var content = $(this).parent().parent().parent().find('.content').find('.content').html();
        console.log(content);
        flag.find('.textarea').html(content);
        flag.find('.textarea').attr('placeholder', "Editing comment");

        id = $(this).parent().attr('data-id');
        flag.attr('action', "/comment/" + id + "/edit");
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
                _token: window.Laravel.csrfToken,
                content: $(this).find('.textarea').val()
            }
       }).done(function(data){
           document.location.href="/";
       });

    });

    $(".btn-status-control-remove-comment").on('click', function(e){
        e.stopPropagation();
        var id = $(this).parent().parent().parent().attr('data-comment');
        $.ajax('/comment/' + id, {
            type: 'post',
            data : {
                _method: 'DELETE',
                _token: window.Laravel.csrfToken,
                content: $(this).parent().parent().parent().find('.textarea').val(),
                flag_id: $(this).parent().parent().parent().attr('data-id')
            }
        }).done(function(data){
            document.location.href="/post/" + id;
        });

    });

    $(".btn-admin-control-lock").on('click', function(e){
        e.stopPropagation();
        var id = $(this).attr('data-id');
        $.ajax('/post/' + id + '/lock', {
            type: 'POST',
            data : {
                _token: window.Laravel.csrfToken
            }
        }).done(function(data){
            document.location.href="/post/" + id;
        });

    });

    $(".btn-status-control-unflag").on('click', function(e){
        e.stopPropagation();
        var id = $(this).parent().parent().parent().attr('data-post');
        $.ajax('/post/' + id + '/unflag', {
            type: 'POST',
            data : {
                _token: window.Laravel.csrfToken,
                content: $(this).parent().parent().parent().find('.textarea').val(),
                flag_id: $(this).parent().parent().parent().attr('data-id')
            }
        }).done(function(data){
            document.location.href="/post/" + id;
        });

    });

    $(".btn-status-control-change").on('click', function(e){
        e.stopPropagation();
        var id = $(this).parent().parent().parent().attr('data-post');
        $.ajax('/post/' + id + '/change', {
            type: 'POST',
            data : {
                _token: window.Laravel.csrfToken,
                content: $(this).parent().parent().parent().find('.textarea').val(),
                flag_id: $(this).parent().parent().parent().attr('data-id')
            }
        }).done(function(data){
            document.location.href="/post/" + id;
        });

    });


    $(".btn-status-control-removal").on('click', function(e){
        e.stopPropagation();
        var id = $(this).parent().parent().parent().attr('data-post');
        $.ajax('/post/' + id + '/removal', {
            type: 'POST',
            data : {
                _token: window.Laravel.csrfToken,
                content: $(this).parent().parent().parent().find('.textarea').val(),
                flag_id: $(this).parent().parent().parent().attr('data-id')
            }
        }).done(function(data){
            document.location.href="/post/" + id;
        });

    });

    $(".btn-status-control-unflag-comment").on('click', function(e){
        e.stopPropagation();
        var id = $(this).parent().parent().parent().attr('data-comment');
        $.ajax('/post/' + id + '/unflag', {
            type: 'POST',
            data : {
                _token: window.Laravel.csrfToken,
                content: $(this).parent().parent().parent().find('.textarea').val(),
                flag_id: $(this).parent().parent().parent().attr('data-id')
            }
        }).done(function(data){
            document.location.href="/post/" + id;
        });

    });

    $(".btn-status-control-change-comment").on('click', function(e){
        e.stopPropagation();
        var id = $(this).parent().parent().parent().attr('data-comment');
        $.ajax('/post/' + id + '/change', {
            type: 'POST',
            data : {
                _token: window.Laravel.csrfToken,
                content: $(this).parent().parent().parent().find('.textarea').val(),
                flag_id: $(this).parent().parent().parent().attr('data-id')
            }
        }).done(function(data){
            document.location.href="/post/" + id;
        });

    });


    $(".btn-status-control-removal-comment").on('click', function(e){
        e.stopPropagation();
        var id = $(this).parent().parent().parent().attr('data-comment');
        $.ajax('/post/' + id + '/removal', {
            type: 'POST',
            data : {
                _token: window.Laravel.csrfToken,
                content: $(this).parent().parent().parent().find('.textarea').val(),
                flag_id: $(this).parent().parent().parent().attr('data-id')
            }
        }).done(function(data){
            document.location.href="/post/" + id;
        });

    });

    $(".btn-admin-control-unflag").on('click', function(e){
        e.stopPropagation();
        var id = $(this).attr('data-id');
        $.ajax('/post/' + id + '/unflag', {
            type: 'POST',
            data : {
                _token: window.Laravel.csrfToken,
                content: $(this).closest('.flag-form').find('.textarea').val()
            }
        }).done(function(data){
            document.location.href="/post/" + id;
        });

    });

    $(".btn-admin-control-change").on('click', function(e){
        e.stopPropagation();
        var id = $(this).attr('data-id');
        $.ajax('/post/' + id + '/change', {
            type: 'POST',
            data : {
                _token: window.Laravel.csrfToken,
                content: $(this).closest('.flag-form').find('.textarea').val()
            }
        }).done(function(data){
            document.location.href="/post/" + id;
        });

    });


    $(".btn-admin-control-removal").on('click', function(e){
        e.stopPropagation();
        var id = $(this).attr('data-id');
        $.ajax('/post/' + id + '/removal', {
            type: 'POST',
            data : {
                _token: window.Laravel.csrfToken,
                content: $(this).closest('.flag-form').find('.textarea').val()
            }
        }).done(function(data){
            document.location.href="/post/" + id;
        });

    });

    $(".btn-admin-control-status").on('click', function(e){
        e.stopPropagation();
        var id = $(this).attr('data-id');
        document.location.href="/post/" + id + "/status";

    });

    $("body").on('click', '.badge-toggler',  function(){

        $(this).toggleClass('fa-toggle-on fa-toggle-off');

    });




});
