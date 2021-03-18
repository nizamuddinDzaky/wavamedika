import React from 'react';
import {toAbsoluteUrl} from '../../utils/theme.utils';
import {Link, Route, Switch} from "react-router-dom";
import Login from "./Login";
// import Registration from "../../app/pages/auth/Registration";
// import ForgotPassword from "../../app/pages/auth/ForgotPassword";

export default class AuthPage extends React.Component{
    render() {
        return (
            <>
                <div className="kt-grid kt-grid--ver kt-grid--root" style={{backgroundColor: '#ffffff'}}>
                    <div
                        id="kt_login"
                        className="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v1"
                    >
                        <div className="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
                            <div
                                className="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside"
                                style={{
                                    backgroundImage: `url(${toAbsoluteUrl("/assets/image/bg-4.jpg")})`
                                }}
                            >
                                <div className="kt-grid__item">
                                    <Link to="/" className="kt-login__logo">
                                        <img
                                            alt="Logo"
                                            src={toAbsoluteUrl("/logo-4.png")}
                                        />
                                    </Link>
                                </div>
                                <div className="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                                    <div className="kt-grid__item kt-grid__item--middle">
                                        <h3 className="kt-login__title">Welcome to Metronic!</h3>
                                        <h4 className="kt-login__subtitle">
                                            The ultimate Bootstrap & Angular 6 admin theme framework for
                                            next generation web apps.
                                        </h4>
                                    </div>
                                </div>
                                {/*<div className="kt-grid__item">*/}
                                {/*<div className="kt-login__info">*/}
                                {/*<div className="kt-login__copyright">*/}
                                {/*&copy; 2018 Metronic*/}
                                {/*</div>*/}
                                {/*<div className="kt-login__menu">*/}
                                {/*<Link to="/terms" className="kt-link">*/}
                                {/*Privacy*/}
                                {/*</Link>*/}
                                {/*<Link to="/terms" className="kt-link">*/}
                                {/*Legal*/}
                                {/*</Link>*/}
                                {/*<Link to="/terms" className="kt-link">*/}
                                {/*Contact*/}
                                {/*</Link>*/}
                                {/*</div>*/}
                                {/*</div>*/}
                                {/*</div>*/}
                            </div>

                            <div className="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
                                <Switch>
                                    <Route path="/auth/login" component={Login} />
                                    {/*<Route path="/auth/registration" component={Registration} />*/}
                                    {/*<Route*/}
                                    {/*path="/auth/forgot-password"*/}
                                    {/*component={ForgotPassword}*/}
                                    {/*/>*/}
                                    {/*<Redirect from="/auth" exact={true} to="/auth/login" />*/}
                                    {/*<Redirect to="/auth/login" />*/}
                                </Switch>
                            </div>
                        </div>
                    </div>
                </div>
            </>
        );
    }

}
