import React, {Suspense} from 'react';
import { Redirect, Route, Switch, withRouter} from 'react-router-dom';
import PajakMenuConfig from './config/PajakMenuConfig';

// pages
// import PublicPage from "./pages/PublicPage";
import {LayoutContextProvider, LayoutSplashScreen} from "./components/Layout/LayoutContext";
import Layout from "./components/Layout/Layout";
import {useLastLocation} from "react-router-last-location";
import * as routerHelpers from "./helper/RouteHelper";
import {useSelector} from "react-redux";
// import ErrorsPage from "./AppRouterError";
import Logout from "./pages/Auth/Logout";
import AuthPage from "./pages/Auth";
import Dashboard from "./pages/Dashboard";

import MasterPTKP from "./pages/Pajak/Master/PTKP/MasterPTKP";
import EntryNPWP from './pages/Pajak/Entry/data-npwp-karyawan/EntryNPWPKaryawan';

import EfakturPPN from './pages/Pajak/Entry/efaktur-ppn-masukan/EfakturPPN';
import NPWPKaryawan from './pages/Pajak/Entry/data-npwp-karyawan/NPWPKaryawan';

import PajakKaryawan from './pages/Pajak/Laporan/pajak-karyawan/PajakKaryawan';
import PPnKeluaran from './pages/Pajak/Laporan/ppn-masukan/PPnKeluaran';

const AppRouter: React.FC = ({history }: any) => {
    const lastLocation = useLastLocation();
    routerHelpers.saveLastLocation(lastLocation);
    const {
        isAuthorized,
        menuConfig,
        userLastLocation
    } = useSelector(
        ({ auth,urls, builder: { menuConfig } }: any) => ({
            menuConfig,
            isAuthorized: auth.user != null,
            userLastLocation: routerHelpers.getLastLocation()
        })
    );

    if(!isAuthorized && (process.env.NODE_ENV === 'production')) {
        const getBasename = (path: string) => path.substr(0, path.lastIndexOf('/pajak'));
        const base = getBasename(window.location.pathname);
        window.location.href = base? base: '/';
    }


    return (
        <>
            <LayoutContextProvider
                history={history}
                menuConfig={menuConfig}
            >
                <Switch>
                    {/* {!isAuthorized && (process.env.NODE_ENV !== 'production') ?
                        (
                            <AuthPage/>
                        ):
                        (
                            <Redirect from="/auth" to={userLastLocation} />
                        )
                    } */}

                    {/*<Redirect exact from="/" to="/pajak" />*/}
                    {history.location.pathname.includes('/pajak/dashboard') &&
                        <Route exact={true} path={'/pajak/dashboard'} component={Dashboard} />
                    }

                    {history.location.pathname.includes('/pajak') &&
                        <Layout
                            menuConfig={PajakMenuConfig}
                        >
                            <Suspense fallback={<><LayoutSplashScreen/></>} >
                                <Switch>
                                    <Redirect exact from="/pajak" to="/pajak/master/ptkp"/>
                                    <Route path="/pajak/logout" component={Logout} />
                                    {/*<Redirect exact from="/pajak/dashboard" to="/pajak/transaksi"/>*/}
                                    {/*<Route exact={true} path={'/pajak/dashboard'} component={PublicPage} />*/}

                                    {/* Master Pajak */}
                                    <Route exact={true} path={'/pajak/master/ptkp'} component={() => <MasterPTKP />} />

                                    {/* Entry Pajak */}
                                    <Route exact={true} path={'/pajak/entry/data-npwp-karyawan'} component={NPWPKaryawan} />
                                    <Route exact={true} path={'/pajak/entry/efaktur-ppn-masukan'} component={EfakturPPN} />

                                    {/* Laporan Pajak */}
                                    <Route exact={true} path={'/pajak/laporan/pajak-karyawan'} component={PajakKaryawan} />
                                    <Route exact={true} path={'/pajak/laporan/ppn-keluaran'} component={PPnKeluaran} />


                                    {/*<Route path="/pajak/error" component={ErrorsPage} />*/}
                                    {/*<Redirect to="/pajak/error/error-v3" />*/}
                                </Switch>
                            </Suspense>
                        </Layout>
                    }
                    {/*{history.location.pathname.includes('/farmasi') &&*/}
                    {/*<Layout*/}
                        {/*menuConfig={FarmasiMenuConfig}*/}
                    {/*>*/}
                        {/*<Suspense fallback={<><LayoutSplashScreen/></>} >*/}
                            {/*<Switch>*/}
                                {/*<Redirect exact from="/farmasi" to="/farmasi/dashboard"/>*/}
                                {/*<Route exact={true} path={'/farmasi/dashboard'} component={PublicPage} />*/}
                                {/*<Route exact={true} path={'/farmasi/master-data/masterData1'} component={MasterData1} />*/}
                                {/*<Route path="/error" component={ErrorsPage} />*/}
                                {/*<Redirect to="/error/error-v3" />*/}
                            {/*</Switch>*/}
                        {/*</Suspense>*/}
                    {/*</Layout>*/}
                    {/*}*/}
                    {/*<Route path="/error" component={ErrorsPage} />*/}
                    {/*<Redirect to="/error/error-v3" />*/}
                </Switch>
            </LayoutContextProvider>
        </>
    );
};

export default withRouter(AppRouter);
