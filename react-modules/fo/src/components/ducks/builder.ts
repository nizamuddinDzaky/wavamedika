import objectPath from "object-path";
import { persistReducer } from "redux-persist";
import storage from "redux-persist/lib/storage";

import LayoutConfig from "../Layout/LayoutConfig";
import MenuConfig from "../Layout/MenuConfig";


export const actionTypes = {
    SetMenuConfig: "builder/SET_MENU_CONFIG",
    SetLayoutConfigs: "builder/SET_LAYOUT_CONFIGS",
    SetLayoutConfigsWithPageRefresh:
        "builder/SET_LAYOUT_CONFIGS_WITH_PAGE_REFRESH",
    SetHtmlClassService: "builder/SET_HTML_CLASS_SERVICE"
};

export const selectors = {
    getClasses: (store: any, params: any) => {
        const { htmlClassServiceObjects } = store.builder;

        return htmlClassServiceObjects
            ? htmlClassServiceObjects.getClasses(params.path, params.toString)
            : "";
    },
    getAttributes: (store: any, params: any) => {
        if (params.path) {
            // if path is specified, get the value within object
            const { htmlClassServiceObjects } = store.builder;

            return htmlClassServiceObjects
                ? htmlClassServiceObjects.getAttributes(params.path)
                : [];
        }

        return [];
    },
    getConfig: (state: any, path: any) => {
        const { layoutConfig } = state.builder;

        if (path) {
            // if path is specified, get the value within object
            return objectPath.get(layoutConfig, path);
        }

        return "";
    },

    getLogo: ({ builder: { layoutConfig } }: any) => {
        const menuAsideLeftSkin = objectPath.get(layoutConfig, "brand.self.skin");
        // set brand logo
        const logoObject = objectPath.get(layoutConfig, "self.logo");
        let logo;
        if (typeof logoObject === "string") {
            logo = logoObject;
        }

        if (typeof logoObject === "object") {
            logo = objectPath.get(logoObject, menuAsideLeftSkin + "");
        }

        if (typeof logo === "undefined") {
            try {
                const logos = objectPath.get(layoutConfig, "self.logo");
                logo = logos[Object.keys(logos)[0]];
            } catch (e) {}
        }
        return logo;
    },

    getStickyLogo: (store: any) => {
        const { layoutConfig } = store.builder;
        let logo = objectPath.get(layoutConfig, "self.logo.sticky");
        if (typeof logo === "undefined") {
            logo = selectors.getLogo(store);
        }
        return logo + "";
    }
};

const initialState = {
    menuConfig: MenuConfig,
    layoutConfig: LayoutConfig,
    htmlClassServiceObjects: undefined
};

export const reducer = persistReducer(
    {
        storage,
        key: "build-demo4",
        blacklist: ["htmlClassServiceObjects"]
    },
    (state: any = initialState, { type, payload }: any) => {
        switch (type) {
            case actionTypes.SetMenuConfig:
                return { ...state, menuConfig: payload };

            case actionTypes.SetLayoutConfigs:
                return { ...state, layoutConfig: payload };

            case actionTypes.SetLayoutConfigsWithPageRefresh: {
                return { ...state, layoutConfig: payload };
            }
            case actionTypes.SetHtmlClassService:
                return { ...state, htmlClassServiceObjects: payload };

            default:
                return state;
        }
    }
);

export const actions = {
    setMenuConfig: (payload: any) => ({ payload, type: actionTypes.SetMenuConfig }),

    setLayoutConfigs:  (payload: any) => ({
        payload,
        type: actionTypes.SetLayoutConfigs
    }),

    setLayoutConfigsWithPageRefresh:  (payload: any) => ({
        payload,
        type: actionTypes.SetLayoutConfigsWithPageRefresh
    }),

    setHtmlClassService:  (payload: any) => ({
        payload,
        type: actionTypes.SetHtmlClassService
    })
};
