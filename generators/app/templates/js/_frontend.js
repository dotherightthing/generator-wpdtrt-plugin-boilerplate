/**
 * @file js/_frontend.js
 * @summary Scripting for the public front-end.
 * @description PHP variables are provided in <%= nameSafe %>_config.
 * @requires DTRT WordPress Plugin Boilerplate Generator <%= generatorVersion %>
 */

/* globals jQuery, <%= nameSafe %>_config */
/* eslint-disable camelcase, no-unused-vars */

/**
 * jQuery object
 *
 * @external jQuery
 * @see {@link http://api.jquery.com/jQuery/}
 */

/**
 * @namespace <%= nameJsSafe %>Ui
 */
const <%= nameJsSafe %>Ui = {

    /**
     * Method: init
     *
     * Initialise front-end scripting.
     */
    // init: () => {}
};

jQuery(($) => {
    const config = <%= nameSafe %>_config; // eslint-disable-line

    console.log('<%= nameJsSafe %>Ui.init'); // eslint-disable-line no-console
});
