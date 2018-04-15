/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

// Datatables
require('datatables.net');
require('datatables.net-bs4');
require('datatables.net-responsive');
require('datatables.net-responsive-bs4');
require('datatables.net-buttons');
require('datatables.net-buttons-bs4');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });

$(document).ready(function () {
    // active menu item
    $("#sidebar .nav a").each(function () {
        if (this.href == window.location.href) {
            $(this).parent().addClass("active");
            // set parent active if sub item is active
            if ($(this).parent().parent().hasClass('submenu')) {
                $(this).parent().parent().parent().addClass('active');
            }
        }
    });

    // Hide submenu
    $("#sidebar .submenu").css({
        "height": 0,
        "opacity": 0
    });
    // show submenu for active menu item
    $("#sidebar .active .submenu").css({
        "height": "auto",
        "opacity": 1
    });

    // show submenu on hover
    $("#sidebar .nav-item").not('.active').hover(function () {
        var submenu = $(this).find(".submenu");
        var amount = submenu.children('li').length * 55;
        submenu.stop().animate({
            "height": amount+"px",
            "opacity": 1
        }, 300);
    }, function () {
        $(this).find(".submenu").stop().animate({
            "height": 0,
            "opacity": 0
        });
    }, 300);


});