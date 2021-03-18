/* eslint-disable no-script-url,jsx-a11y/anchor-is-valid,no-loop-func,no-undef,no-restricted-globals,strict,no-unused-vars,no-cond-assign,eqeqeq,no-throw-literal,no-unreachable,no-useless-escape,no-redeclare,no-useless-concat,no-unused-expressions,no-sequences */
import KTUtil from "./util";

"use strict";

// plugin setup
var customTableEasyUI = function(elementId) {
    // Main object
    var the = this;
    var init = false;

    // Get element object
    if(elementId.el)
        var element = KTUtil.get(elementId.el);
    else
        return;

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
            if(element) {
                Plugin.setColumnWidth();
            }
            return the;
        },
        init: function() {
            the.element = element;
        },
        setColumnWidth: function () {
            var colElement = element.getElementsByTagName('col');

            if(colElement) {
                var newColElements = Array.prototype.slice.call(colElement);
                if(newColElements.length > 0) {
                    newColElements.forEach(function (item) {
                        if(item.style.width) {
                            var widthString = item.style.width;
                            if(widthString) {
                                var newWidth = Number(widthString.replace('px', ''));
                                item.style.removeProperty('width');
                                item.width = window.innerWidth > 600? newWidth*4 + 'px': newWidth* 4 + '';
                            }
                        }
                    });
                }
            }

        }
    };

    // Construct plugin
    Plugin.construct.apply(the);

    return the;
};

// webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = customTableEasyUI;
}

export default customTableEasyUI;
