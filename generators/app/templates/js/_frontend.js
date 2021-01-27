/**
 * @file js/_frontend.js
 * @summary Scripting for the public front-end.
 * @description PHP variables are provided in <%= nameSafe %>_config.
 * @requires DTRT WordPress Plugin Boilerplate Generator <%= generatorVersion %>
 */

/* globals jQuery, <%= nameSafe %>_config */
/* eslint-disable camelcase, no-unused-vars */

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

    /* eslint-disable */

    // Polyfill for forEach
    if (window.NodeList && !NodeList.prototype.forEach) {
        NodeList.prototype.forEach = Array.prototype.forEach;
    }

    // Polyfill for forEach
    if (window.HTMLCollection && !HTMLCollection.prototype.forEach) {
        HTMLCollection.prototype.forEach = Array.prototype.forEach;
    }

    // Polyfill for includes
    // https://www.cluemediator.com/object-doesnt-support-property-or-method-includes-in-ie
    if (!Array.prototype.includes) {
        Object.defineProperty(Array.prototype, 'includes', {
            value: function (searchElement, fromIndex) {

                if (this == null) {
                    throw new TypeError('"this" is null or not defined');
                }

                // 1. Let O be ? ToObject(this value).
                var o = Object(this);

                // 2. Let len be ? ToLength(? Get(O, "length")).
                var len = o.length >>> 0;

                // 3. If len is 0, return false.
                if (len === 0) {
                    return false;
                }

                // 4. Let n be ? ToInteger(fromIndex).
                //    (If fromIndex is undefined, this step produces the value 0.)
                var n = fromIndex | 0;

                // 5. If n ≥ 0, then
                //  a. Let k be n.
                // 6. Else n < 0,
                //  a. Let k be len + n.
                //  b. If k < 0, let k be 0.
                var k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);

                function sameValueZero(x, y) {
                    return x === y || (typeof x === 'number' && typeof y === 'number' && isNaN(x) && isNaN(y));
                }

                // 7. Repeat, while k < len
                while (k < len) {
                    // a. Let elementK be the result of ? Get(O, ! ToString(k)).
                    // b. If SameValueZero(searchElement, elementK) is true, return true.
                    if (sameValueZero(o[k], searchElement)) {
                        return true;
                    }
                    // c. Increase k by 1. 
                    k++;
                }

                // 8. Return false
                return false;
            }
        });
    }

    /* eslint-enable */

    console.log('<%= nameJsSafe %>Ui.init'); // eslint-disable-line no-console
});
