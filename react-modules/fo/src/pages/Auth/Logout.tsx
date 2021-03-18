import React, {useEffect} from "react";
import * as auth from "../../stores/reducer/auth.ducks";
import { connect } from "react-redux";
// import { Redirect } from "react-router-dom";
import {LayoutSplashScreen} from "../../components/Layout/LayoutContext";

const Logout: React.FC<any> = (props: any) => {
    let {
        hasUser
    } = props;

    useEffect(() => {
        if(props.logout)
            props.logout()

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);


    if(!hasUser) {
        const getBasename = (path: string) => path.substr(0, path.lastIndexOf('/fo'));
        const base = getBasename(window.location.pathname);
        window.location.href = base? base: '/';
    };


    return hasUser ? <LayoutSplashScreen />: <div></div>;

}

export default connect(
    ({ user }: any) => ({ hasUser: Boolean(user) }),
    auth.actions
)(Logout);
