import React from "react";
import { Redirect, Route, Switch } from "react-router-dom";
import ErrorPage from "./pages/ErrorPage";

export default function ErrorsPage() {
    return (
        <Switch>
            <Redirect from="/error" exact={true} to="/error/error-v3" />
            <Route path="/error/error-v3" component={ErrorPage} />
        </Switch>
    );
}
