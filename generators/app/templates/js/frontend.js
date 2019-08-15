/**
 * @file <%= nameFriendly %> frontend.js
 * @summary
 *     Front-end scripting for public pages
 *     PHP variables are provided in `<%= nameSafe %>_config`.
 * @version <%= defaultVersion %>
 * @since   <%= generatorVersion %> DTRT WordPress Plugin Boilerplate Generator
 */

/* eslint-env browser */
/* global document, jQuery, <%= nameSafe %>_config */
/* eslint-disable no-unused-vars */

/**
 * @namespace <%= nameSafe %>_ui
 */
const <%= nameSafe %>_ui = {

    /**
     * Initialise front-end scripting
     * @since <%= defaultVersion %>
     */
    init: () => {
        console.log("<%= nameSafe %>_ui.init");
    }
}

jQuery(document).ready( ($) => {
    const config = <%= nameSafe %>_config;
    <%= nameSafe %>_ui.init();
});
