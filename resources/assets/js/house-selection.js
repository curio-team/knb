/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '8f5d535785d154b591eb',
    cluster: 'eu',
    encrypted: true
});

window.Echo.channel('houseSelection')
    .listen('housesSelected', function(e){
        console.log('why is this not receiving');
        console.log(e);
    });