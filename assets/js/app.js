/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */


// eslint-disable-next-line import/no-extraneous-dependencies
require('@fortawesome/fontawesome-free/css/all.min.css');
// eslint-disable-next-line import/no-extraneous-dependencies
require('@fortawesome/fontawesome-free/js/all.js');

// eslint-disable-next-line import/no-extraneous-dependencies
require('@fortawesome/fontawesome-free/css/all.min.css');
// eslint-disable-next-line import/no-extraneous-dependencies
require('@fortawesome/fontawesome-free/js/all.js');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// eslint-disable-next-line import/no-extraneous-dependencies

// eslint-disable-next-line import/no-extraneous-dependencies
const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
// eslint-disable-next-line import/no-extraneous-dependencies
require('bootstrap');

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/app.scss');
// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(() => {
    $('[data-toggle="popover"]').popover();
});
