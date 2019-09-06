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

/* eslint-env browser */
/* global jQuery, <%= nameSafe %>_config */
/* eslint-disable no-unused-vars, no-undef */

/**
 * Object: <%= nameSafe %>_ui
 */
const <%= nameSafe %>_ui = { // eslint-disable-line camelcase

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

jQuery( document ).ready( ( $ ) => {
  const config = <%= nameSafe %>_config; // eslint-disable-line camelcase
  <%= nameSafe %>_ui.init();
} );
