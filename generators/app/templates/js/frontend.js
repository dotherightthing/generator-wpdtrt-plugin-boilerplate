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
/* eslint-disable no-unused-vars */

// eslint-disable-next-line camelcase
const <%= nameSafe %>_ui = {

  /**
   * Method: init
   * 
   * Initialise front-end scripting.
   */
  // init: () => {}
}

// http://stackoverflow.com/a/28771425
document.addEventListener( 'touchstart', () => {
  // nada, this is just a hack to make :focus state render on touch
}, false );

jQuery(document).ready( ($) => {
  // eslint-disable camelcase
  const config = <%= nameSafe %>_config;
  <%= nameSafe %>_ui.init();
  // eslint-enable camelcase
});
