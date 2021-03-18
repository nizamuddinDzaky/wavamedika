import React, {Suspense} from 'react';
import { Redirect, Route, Switch, withRouter} from 'react-router-dom';
import GiziMenuConfig from './config/GiziMenuConfig';

// pages
// import PublicPage from "./pages/PublicPage";
import {LayoutContextProvider, LayoutSplashScreen} from "./components/Layout/LayoutContext";
import Layout from "./components/Layout/Layout";
import {useLastLocation} from "react-router-last-location";
import * as routerHelpers from "./helper/RouteHelper";
import {useSelector} from "react-redux";
// import FarmasiMenuConfig from "./config/FarmasiMenuConfig";
// import ErrorsPage from "./AppRouterError";
import MasterTindakanGizi from "./pages/Gizi/Master/MasterTindakanGizi";
// import MasterData1 from "./pages/Farmasi/MasterData1";
import TransaksiGizi from "./pages/Gizi/Transaksi/TransaksiGizi";
import RegisterGizi from "./pages/Gizi/Register/RegisterGizi";
import Logout from "./pages/Auth/Logout";
import PageViewTransaksiGizi from "./pages/Gizi/Transaksi/PageViewTransaksiGizi";
import PageViewRiwayatKonsultasi from "./pages/Gizi/Transaksi/PageViewRiwayatKonsultasi";
import DiitPasien from "./pages/Gizi/DiitPasien/DiitPasien";
import MasterDataDiit from "./pages/Gizi/Master/Diit/MasterDataDiit";
import HumanError from "./pages/Gizi/HumanError/HumanError";
import PasienRencanaPulang from "./pages/Gizi/PasienRencanaPulang/PasienRencanaPulang";
import PageViewPMKP from "./pages/Gizi/Transaksi/PageViewPMKP";
import AuthPage from "./pages/Auth";
import Dashboard from "./pages/Dashboard";

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
        const getBasename = (path: string) => path.substr(0, path.lastIndexOf('/gizi'));
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
                    {!isAuthorized && (process.env.NODE_ENV !== 'production') ?
                        (
                            <AuthPage/>
                        ):
                        (
                            <Redirect from="/auth" to={userLastLocation} />
                        )
                    }

                    {/*<Redirect exact from="/" to="/gizi" />*/}
                    {history.location.pathname.includes('/gizi/dashboard') &&
                        <Route exact={true} path={'/gizi/dashboard'} component={Dashboard} />
                    }

                    {history.location.pathname.includes('/gizi') &&
                        <Layout
                            menuConfig={GiziMenuConfig}
                        >
                            <Suspense fallback={<><LayoutSplashScreen/></>} >
                                <Switch>
                                    <Redirect exact from="/gizi" to="/gizi/transaksi"/>
                                    <Route path="/gizi/logout" component={Logout} />
                                    {/*<Redirect exact from="/gizi/dashboard" to="/gizi/transaksi"/>*/}
                                    {/*<Route exact={true} path={'/gizi/dashboard'} component={PublicPage} />*/}
                                    <Route exact={true} path={'/gizi/transaksi'} component={TransaksiGizi} />
                                    <Route exact={true} path={'/gizi/transaksi/:id/viewTransaksi'} component={PageViewTransaksiGizi} />
                                    <Route exact={true} path={'/gizi/transaksi/:id/viewRiwayatKonsultasi'} component={PageViewRiwayatKonsultasi} />
                                    <Route exact={true} path={'/gizi/transaksi/:id/viewPMKP/unit/:idUnit'} component={PageViewPMKP} />

                                    {/*<Redirect exact from="/gizi/laporan" to="/gizi/laporan/registerGizi"/>*/}
                                    <Route exact={true} path={'/gizi/registerGizi'} component={RegisterGizi} />
                                    <Route exact={true} path={'/gizi/daftarDiitPasien'} component={DiitPasien} />
                                    <Route exact={true} path={'/gizi/humanError'} component={HumanError} />
                                    <Route exact={true} path={'/gizi/pasienRencanaPulang'} component={() => <PasienRencanaPulang hidePagination/>} />


                                    <Redirect exact from="/gizi/master-data" to="/gizi/master-data/tindakanGizi"/>
                                    <Route exact={true} path={'/gizi/master-data/tindakanGizi'} component={() => <MasterTindakanGizi hidePagination/>} />
                                    <Route exact={true} path={'/gizi/master-data/dataDiit'} component={MasterDataDiit} />

                                    {/*<Route path="/gizi/error" component={ErrorsPage} />*/}
                                    {/*<Redirect to="/gizi/error/error-v3" />*/}
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
