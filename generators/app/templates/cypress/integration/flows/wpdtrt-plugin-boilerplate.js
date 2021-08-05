/**
 * @file cypress/integration/flows/<%= name %>.js
 * @summary Cypress spec for End-to-End UI testing.
 * @requires DTRT WordPress Plugin Boilerplate Generator <%= generatorVersion %>
 * {@link https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/wiki/Testing-&-Debugging:-Cypress.io|Testing & Debugging: Cypress.io}
 */

/* eslint-disable prefer-arrow-callback */
/* eslint-disable max-len */

// Test principles:
// ARRANGE: SET UP APP STATE > ACT: INTERACT WITH IT > ASSERT: MAKE ASSERTIONS

// Aliases are cleared between tests
// https://stackoverflow.com/questions/49431483/using-aliases-in-cypress

// Passing arrow functions (“lambdas”) to Mocha is discouraged
// https://mochajs.org/#arrow-functions
/* eslint-disable func-names */

const componentClass = '<%= name %>';

describe('Default test', function () {
    before(function () {
        // load local web page
        cy.visit('/path/to/page');
    });

    beforeEach(function () {
        // refresh the page to reset the UI state
        cy.reload();

        // @aliases
        cy.get(`.${componentClass}`).as('<%= nameFriendlySafe %>');

        // scroll component into view,
        // as Cypress can't always 'see' elements below the fold
        cy.get('@<%= nameFriendlySafe %>')
            .scrollIntoView({
                offset: {
                    top: 100,
                    left: 0
                }
            })
            .should('be.visible');
    });

    describe('Setup', function () {
        it('Has prerequisites', function () {
            // check that the plugin object is available
            cy.window().should('have.property', '<%= nameFriendlySafe %>Ui');

            // check that it's an object
            cy.window().then((win) => {
                expect(win.<%= nameFriendlySafe %>Ui).to.be.a('object');
            });
        });
    });

    describe('Load', function () {
        it('Loads', function () {
            // check that the component has been assigned the correct class (redundant check)
            cy.get('@<%= nameFriendlySafe %>')
                .should('have.class', '<%= name %>');

            // test the accessibility of the component state using Tenon.io
            // Note: add a wrapper around the component so that the HTML can be submitted independently
            // and in its entirety
            cy.get('@<%= nameFriendlySafe %>').then((componentName) => {
                // testing the contents rather than the length gives a more useful error object
                cy.task('tenonAnalyzeHtml', `${componentName.html()}`)
                // an empty resultSet indicates that there are no errors
                    .its('resultSet').should('be.empty');
            });
        });
    });
});
