/**
 * @file <%= nameFriendly %> frontend.js
 * @summary
 *     Front-end scripting for public pages
 *     PHP variables are provided in `<%= nameSafe %>_config`.
 * @version <%= defaultVersion %>
 * @since   <%= generatorVersion %> DTRT WordPress Plugin Boilerplate Generator
 */

/* eslint-env browser */
/* global document, $, jQuery, <%= nameSafe %>_config */

/**
 * @namespace <%= nameSafe %>_ui
 */
var <%= nameSafe %>_ui = {

    /**
     * Initialise front-end scripting
     * @since <%= defaultVersion %>
     */
    init: function() {
        console.log("<%= nameSafe %>_ui.init");
    }
}

jQuery(document).ready(function ($) {

    "use strict";

    var config = <%= nameSafe %>_config;
    <%= nameSafe %>_ui.init();
});
