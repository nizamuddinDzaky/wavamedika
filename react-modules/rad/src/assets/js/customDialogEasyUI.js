/* eslint-disable no-script-url,jsx-a11y/anchor-is-valid,no-loop-func,no-undef,no-restricted-globals,strict,no-unused-vars,no-cond-assign,eqeqeq,no-throw-literal,no-unreachable,no-useless-escape,no-redeclare,no-useless-concat,no-unused-expressions,no-sequences */
import KTUtil from "./util";

"use strict";

// plugin setup
var customDialogEasyUI = function(ref) {
    // Main object
    var the = this;
    var init = false;

    // Get element object
    var element = KTUtil.get(ref.el);

    if (!element) {
        return;
    }

    ////////////////////////////
    // ** Private Methods  ** //
    ////////////////////////////

    var Plugin = {
        /**
         * Construct
         */

        construct: function() {
            return the;
        },
        init: function() {
            the.element = element;
        }
    };

    // Construct plugin
    Plugin.construct.apply(the);

    return the;
};

// webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = customDialogEasyUI;
}

export default customDialogEasyUI;
