// import { toAbsoluteUrl } from "../_metronic/utils/utils";
// const img = toAbsoluteUrl("image/media/demos/demo4/header.jpg");
import {toAbsoluteUrl} from "../../utils/theme.utils";

export const initLayoutConfig = {
    "demo": "demo4",
    "colors": {
        "state": {
            "brand": "#366cf3",
            "light": "#ffffff",
            "dark": "#282a3c",
            "primary": "#5867dd",
            "success": "#34bfa3",
            "info": "#36a3f7",
            "warning": "#ffb822",
            "danger": "#fd3995"
        },
        "base": {
            "label": [
                "#c5cbe3",
                "#a1a8c3",
                "#3d4465",
                "#3e4466"
            ],
            "shape": [
                "#f0f3ff",
                "#d9dffa",
                "#afb4d4",
                "#646c9a"
            ]
        }
    },
    "self": {
        "body": {
            "backgroundImage": toAbsoluteUrl('/logo-4.png')
        }
    },
    "loader": {
        "enabled": true,
        "type": "brand"
    },
    "toolbar": {
        "display": true
    },
    "header": {
        "self": {
            "width": "fixed",
            "fixed": {
                "desktop": {
                    "enabled": true,
                    "mode": "menu"
                },
                "mobile": true
            }
        },
        "menu": {
            "self": {
                "display": true,
                "root-arrow": false,
                "icon-style": "duotone"
            },
            "desktop": {
                "arrow": true,
                "toggle": "click",
                "submenu": {
                    "skin": "light",
                    "arrow": true
                }
            },
            "mobile": {
                "submenu": {
                    "skin": "dark",
                    "accordion": true
                }
            }
        }
    },
    "subheader": {
        "display": true,
        "layout": "subheader-v1",
        "fixed": true,
        "width": "fixed",
        "layouts": {
            "subheader-v1": "Subheader v1",
            "subheader-v2": "Subheader v2",
            "subheader-v3": "Subheader v3",
            "subheader-v4": "Subheader v4"
        },
        "style": "transparent"
    },
    "content": {
        "width": "fixed"
    },
    "footer": {
        "self": {
            "width": "fixed",
            "layout": "basic"
        }
    },
    "aside": {
        "self": {
            "fixed": false
        },
        "menu": {
            "dropdown": true
        }
    }
};

let LayoutConfig = JSON.parse(JSON.stringify(initLayoutConfig)); // deep object copy
export default LayoutConfig;
