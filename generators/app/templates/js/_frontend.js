/**
 * @file js/_frontend.js
 * @summary Front-end scripting for public pages.
 * @description PHP variables are provided in <%= nameSafe %>_config.
 * @requires DTRT WordPress Plugin Boilerplate Generator <%= generatorVersion %>
 */

/* globals jQuery, <%= nameSafe %>_config */
/* eslint-disable camelcase, no-unused-vars */

/**
 * @namespace <%= nameSafe %>Ui
 */
const <%= nameSafe %>Ui = {

    /**
     * Method: init
     *
     * Initialise front-end scripting.
     */
    // init: () => {}
};

jQuery(($) => {
    const config = <%= nameSafe %>_config; // eslint-disable-line

    // IE9+ polyfill for forEach
    if (window.NodeList && !NodeList.prototype.forEach) {
        NodeList.prototype.forEach = Array.prototype.forEach;
    }

    // IE9+ polyfill for forEach
    if (window.HTMLCollection && !HTMLCollection.prototype.forEach) {
        HTMLCollection.prototype.forEach = Array.prototype.forEach;
    }

    console.log('<%= nameSafe %>Ui.init'); // eslint-disable-line no-console
});
