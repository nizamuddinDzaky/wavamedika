import React, {Suspense} from 'react';
import { Redirect, Route, Switch, withRouter} from 'react-router-dom';
import RadMenuConfig from './config/RadMenuConfig';

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

import MasterDataRadiologi from "./pages/Radiologi/Master/DataRadiologi/MasterDataRadiologi";
import MasterDataPasien from "./pages/Radiologi/Master/DataPasien/MasterDataPasien";
import MasterHasilPemeriksaan from "./pages/Radiologi/Master/HasilPemeriksaan/MasterHasilPemeriksaan";
import MasterFaktorEksposi from "./pages/Radiologi/Master/FaktorEksposi/MasterFaktorEksposi";
import MasterPenggunaanFilm from "./pages/Radiologi/Master/PenggunaanFilm/MasterPenggunaanFilm";

import LaporanPasienRencanaPulang from "./pages/Radiologi/Laporan/PasienRencanaPulang/LaporanPasienRencanaPulang";
import LaporanRegisterRadiologi from "./pages/Radiologi/Laporan/RegisterRadiologi/LaporanRegisterRadiologi";

import EntryPeriksaRadiologi from "./pages/Radiologi/Entry/PeriksaRadiologi/PeriksaRadiologi";
import TindakLanjut from './pages/Radiologi/Entry/TindakLanjut/TindakLanjut';
import RekapPeriksaRadiologi from './pages/Radiologi/Laporan/RekapPeriksaRadiologiPasien/RekapPeriksaRadiologi';

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
        const getBasename = (path: string) => path.substr(0, path.lastIndexOf('/rad'));
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

                    {/*<Redirect exact from="/" to="/rad" />*/}
                    {history.location.pathname.includes('/rad/dashboard') &&
                        <Route exact={true} path={'/rad/dashboard'} component={Dashboard} />
                    }

                    {history.location.pathname.includes('/rad') &&
                        <Layout
                            menuConfig={RadMenuConfig}
                        >
                            <Suspense fallback={<><LayoutSplashScreen/></>} >
                                <Switch>
                                    <Redirect exact from="/rad" to="/rad/master/data-radiologi"/>
                                    <Route path="/rad/logout" component={Logout} />
                                    {/*<Redirect exact from="/rad/dashboard" to="/rad/transaksi"/>*/}
                                    {/*<Route exact={true} path={'/rad/dashboard'} component={PublicPage} />*/}

                                    {/* Master Laboratorium */}
                                    <Route exact={true} path={'/rad/master/data-radiologi'} component={() => <MasterDataRadiologi />} />
                                    <Route exact={true} path={'/rad/master/data-pasien'} component={() => <MasterDataPasien />} />
                                    <Route exact={true} path={'/rad/master/hasil-pemeriksaan'} component={() => <MasterHasilPemeriksaan />} />
                                    <Route exact={true} path={'/rad/master/faktor-eksposi'} component={() => <MasterFaktorEksposi />} />
                                    <Route exact={true} path={'/rad/master/penggunaan-film'} component={() => <MasterPenggunaanFilm />} />

                                    {/* Laporan Radiologi */}
                                    <Route exact={true} path={'/rad/entry/periksa-radiologi'} component={EntryPeriksaRadiologi} />
                                    <Route exact={true} path={'/rad/entry/tindak-lanjut'} component={TindakLanjut} />


                                    {/* Laporan Radiologi */}
                                    <Route exact={true} path={'/rad/laporan/pasien-rencana-pulang'} component={() => <LaporanPasienRencanaPulang />} />
                                    <Route exact={true} path={'/rad/laporan/register-radiologi'} component={() => <LaporanRegisterRadiologi />} />
                                    <Route exact={true} path={'/rad/laporan/rekap-periksa-radiologi-pasien'} component={RekapPeriksaRadiologi} />

                                    {/*<Route path="/rad/error" component={ErrorsPage} />*/}
                                    {/*<Redirect to="/rad/error/error-v3" />*/}
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
