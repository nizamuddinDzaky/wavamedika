import {persistReducer} from "redux-persist";
import storage from "redux-persist/lib/storage";
// import {put, takeLatest} from "redux-saga/effects";
// import * as routerHelpers from "../../helper/RouteHelper";
// import {actionTypes} from "./auth.duck";

export const actionTypes = {
    SetToolbarOpenNewPage: "[SetToolbarOpenNewPage] Action",
    // Color: "[Color] Action",
};

const initalState = {
    toolbarOpenNewPage: false,
    // Color: '#ffffff'
};

export const reducer = persistReducer(
    { storage, key: "application-settings", whitelist: ["toolbarOpenNewPage"] },
    (state = initalState, action: any) => {
        switch (action.type) {
            case actionTypes.SetToolbarOpenNewPage: {
                const { toolbarOpenNewPage } = action.payload;

                return {toolbarOpenNewPage};
            }
            // case actionTypes.Color: {
            //     const { Color } = action.payload;
            //     return {
            //         Color
            //     }
            // }

            default:
                return state;
        }
    }
);

export const actions: any = {
    SetToolbarOpenNewPage: (toolbarOpenNewPage: any) => ({ type: actionTypes.SetToolbarOpenNewPage, payload: {toolbarOpenNewPage}}),
    // Color: (Color: string) => ({ type: actionTypes.Color, payload: {Color}})
};
