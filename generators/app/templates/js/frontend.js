/**
 * File: js/frontend.js
 *
 * Front-end scripting for public pages.
 *
 * Note:
 * - PHP variables are provided in <%= nameSafe %>_config.
 *
 * Since:
 *   <%= generatorVersion %> - DTRT WordPress Plugin Boilerplate Generator
 */

/* global jQuery, <%= nameSafe %>_config */
/* eslint-disable camelcase, no-unused-vars */

/**
 * Object: <%= nameSafe %>_ui
 */
const <%= nameSafe %>_ui = {

  /**
   * Method: init
   *
   * Initialise front-end scripting.
   */
  // init: () => {}
};

// http://stackoverflow.com/a/28771425
document.addEventListener( 'touchstart', () => {
  // nada, this is just a hack to make :focus state render on touch
}, false );

jQuery( document ).ready( ( $ ) => { // eslint-disable-line no-unused-vars
  const config = <%= nameSafe %>_config; // eslint-disable-line no-unused-vars
  <%= nameSafe %>_ui.init();
} );
