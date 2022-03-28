/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

// start the Stimulus applicatio
import './bootstrap';

//On ajoute jquery et le Javascript de Bootstrap
const $ = require('jquery');
require('bootstrap');

import './js/script.js';
import './form.js';