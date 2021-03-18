/* eslint-disable no-script-url,jsx-a11y/anchor-is-valid,no-loop-func,no-undef,no-restricted-globals,strict,no-unused-vars,no-cond-assign,eqeqeq,no-throw-literal,no-unreachable,no-useless-escape,no-redeclare,no-useless-concat,no-unused-expressions,no-sequences */
import KTUtil from "./util";

"use strict";

// plugin setup
var customForm = function(elementId, idColor1, idColor2) {
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
            window.addEventListener('keydown', Plugin.onKeyDown);

            Plugin.declareTypeOfColorPicker();
            Plugin.handleChangeColorPicker();
            return the;
        },
        init: function() {
            the.element = element;
        },
        declareTypeOfColorPicker: function() {
            setTimeout(() => {
                var colorPickerInputElements = element.getElementsByClassName('color-picker');

                if(colorPickerInputElements) {
                    var newColorPickerInputElements = Array.prototype.slice.call(colorPickerInputElements);

                    if(newColorPickerInputElements.length >0 ) {
                        newColorPickerInputElements.forEach((item) => {
                            item.type="color";
                        })
                    }
                }
            }, 500)
        },
        handleChangeColorPicker() {
            setTimeout(() => {
                var color1 = element.getElementsByClassName(idColor1);
                var color2 = element.getElementsByClassName(idColor2);

                if(color1.length > 0 && color2.length > 0) {
                    color1[0].addEventListener('change', function (item) {
                        color2[0].value = item.target.value.toString().toLowerCase();
                    });

                    color2[0].addEventListener('change', function (item) {
                        color1[0].value = item.target.value.toString().toUpperCase();
                    });
                }
            }, 500)

        },
        onKeyDown(e) {
            switch (e.keyCode) {
                case 13: //Enter
                    var focusableElements = element.querySelectorAll('input, select');
                    var index = Array.prototype.indexOf.call(focusableElements, e.target);
                    if(e.shiftKey)
                        focus(focusableElements, index - 1);
                    else {
                        focus(focusableElements, index + 1);
                    }

                    e.preventDefault();
                    break;
                default:
                    break;
            }
            function focus(elements, index) {
                if(elements[index])
                    elements[index].focus()
            }
        }
    };

    // Construct plugin
    Plugin.construct.apply(the);

    return the;
};

// webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = customForm;
}

export default customForm;
