import axios from "axios";
import jquery from "jquery";
import popper from "popper.js";
import "bootstrap";
import {formatDistance, parseISO} from 'date-fns';

// require('tabler-ui/dist/assets/js/vendors/chart.bundle.min.js');
// require('tabler-ui/dist/assets/js/vendors/circle-progress.min.js');
// require('tabler-ui/dist/assets/js/vendors/jquery-jvectormap-2.0.3.min.js');
// require('tabler-ui/dist/assets/js/vendors/jquery-jvectormap-de-merc.js');
// require('tabler-ui/dist/assets/js/vendors/jquery-jvectormap-world-mill.js');
// require('tabler-ui/dist/assets/js/vendors/jquery.sparkline.min.js');
// require('tabler-ui/dist/assets/js/vendors/jquery.tablesorter.min.js');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.Popper = popper;
window.$ = window.jQuery = jquery;

window.formatDistance = formatDistance;
window.parseISO = parseISO;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
