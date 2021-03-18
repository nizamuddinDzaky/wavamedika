import { persistReducer } from "redux-persist";
import storage from "redux-persist/lib/storage";
import { put, takeLatest } from "redux-saga/effects";
// import { getUserByToken } from "../../crud/auth.crud";
import * as routerHelpers from "../../helper/RouteHelper";

export const actionTypes = {
    Login: "[Login] Action",
    Logout: "[Logout] Action",
    Register: "[Register] Action",
    UserRequested: "[Request User] Action",
    UserLoaded: "[Load User] Auth API"
};

const initialAuthState: any = {
    user: undefined,
    authToken: undefined
};

export const reducer = persistReducer(
    { storage, key: "demo4-auth", whitelist: ["user", "authToken"] },
    (state: any = initialAuthState, action: any) => {
        switch (action.type) {
            case actionTypes.Login: {
                const userData = action.payload.data;

                return { user: userData };
            }

            case actionTypes.Register: {
                const { authToken } = action.payload;

                return { authToken, user: undefined };
            }

            case actionTypes.Logout: {
                routerHelpers.forgotLastLocation();
                return initialAuthState;
            }

            case actionTypes.UserLoaded: {
                const { user } = action.payload;

                return { ...state, user };
            }

            default:
                return state;
        }
    }
);

export const actions: any = {
    login: (data: any) => ({ type: actionTypes.Login, payload: { data } }),
    // register: (authToken: any) => ({
    //     type: actionTypes.Register,
    //     payload: { authToken }
    // }),
    logout: () => ({ type: actionTypes.Logout }),
    requestUser: (user: any) => ({ type: actionTypes.UserRequested, payload: { user } }),
    fulfillUser: (user: any) => ({ type: actionTypes.UserLoaded, payload: { user } })
};

export function* saga() {
    yield takeLatest(actionTypes.Login, function* loginSaga() {
        // console.log('action')
        yield put(actions.requestUser());
    });

    yield takeLatest(actionTypes.Register, function* registerSaga() {
        yield put(actions.requestUser());
    });

    yield takeLatest(actionTypes.UserRequested, function* userRequested() {
        // const { data: user } = yield getUserByToken();

        // yield put(actions.fulfillUser(
        //     {
        //         "id": 1,
        //         "username": "admin",
        //         "email": "admin@demo.com",
        //         "accessToken": "access-token-8f3ae836da744329a6f93bf20594b5cc",
        //         "refreshToken": "access-token-f8c137a2c98743f48b643e71161d90aa",
        //         "roles": [
        //             1
        //         ],
        //         "pic": "//media/users/300_25.jpg",
        //         "fullname": "Sean",
        //         "occupation": "CEO",
        //         "companyName": "Keenthemes",
        //         "phone": "456669067890",
        //         "address": {
        //             "addressLine": "L-12-20 Vertex, Cybersquare",
        //             "city": "San Francisco",
        //             "state": "California",
        //             "postCode": "45000"
        //         },
        //         "socialNetworks": {
        //             "linkedIn": "https://linkedin.com/admin",
        //             "facebook": "https://facebook.com/admin",
        //             "twitter": "https://twitter.com/admin",
        //             "instagram": "https://instagram.com/admin"
        //         }
        //     }
        // ));
    });
}
