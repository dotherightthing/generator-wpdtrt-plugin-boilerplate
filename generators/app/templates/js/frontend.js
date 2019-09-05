/**
 * File: frontend.js
 *
 * <%= nameFriendly %>
 *
 * Front-end scripting for public pages.
 *
 * PHP variables are provided in `<%= nameSafe %>_config`.
 *
 * @since DTRT WordPress Plugin Boilerplate Generator <%= generatorVersion %>
 */

/* eslint-env browser */
/* global jQuery, <%= nameSafe %>_config */
/* eslint-disable no-unused-vars, no-undef */

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
