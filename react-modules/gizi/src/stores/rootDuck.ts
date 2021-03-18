import { all } from "redux-saga/effects";
import { combineReducers } from "redux";

import * as auth from "./reducer/auth.ducks";
import * as applicationSettings from "./reducer/application.settings.ducks";
// import * as event from './ducks/event.duck';
// import * as round from './ducks/round.duck';
// import * as group from './ducks/group.duck';
// import * as tatami from './ducks/tatami.duck';
// import { metronic } from "../_metronic";
import {reducer} from './builder';
export const rootReducer = combineReducers({
    auth: auth.reducer,
    // i18n: metronic.i18n.reducer,
    builder: reducer,
    applicationSettings: applicationSettings.reducer
    // event: event.reducer,
    // round: round.reducer,
    // group: group.reducer,
    // tatami: tatami.reducer
});

export function* rootSaga() {
    yield all([
        auth.saga()
    ]);
}
