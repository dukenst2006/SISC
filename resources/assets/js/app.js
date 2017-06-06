
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// require('propellerkit');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

$(document).ready(function() {
    $('#list').click(function(event){
        event.preventDefault();
        $('#products').find('.item').removeClass('grid-group-item');
        $('#products').removeClass('row');
        $('#products').find('.item').addClass('list-group-item');
    });

    $('#grid').click(function(event){
        event.preventDefault();
        $('#products').find('.item').removeClass('list-group-item');
        $('#products').addClass('row');
        $('#products').find('.item').addClass('grid-group-item');
    });
});
