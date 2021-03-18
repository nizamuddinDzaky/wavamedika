import React, {Suspense} from 'react';
import { Redirect, Route, Switch, withRouter} from 'react-router-dom';
import BpjsMenuConfig from './config/BpjsMenuConfig';

// pages
// import PublicPage from "./pages/PublicPage";
import {LayoutContextProvider, LayoutSplashScreen} from "./components/Layout/LayoutContext";
import Layout from "./components/Layout/Layout";
import {useLastLocation} from "react-router-last-location";
import * as routerHelpers from "./helper/RouteHelper";
import {useSelector} from "react-redux";
// import FarmasiMenuConfig from "./config/FarmasiMenuConfig";
// import ErrorsPage from "./AppRouterError";
import AuthPage from "./pages/Auth";
import Dashboard from "./pages/Dashboard";
import Logout from './pages/Auth/Logout';

import MasterDataPasien from './pages/Bpjs/Master/DataPasien/MasterDataPasien';
import PageView_RiwayatPasien from './pages/Bpjs/Master/DataPasien/ViewRiwayatPasien/PageViewDetail_RiyawatPasien';

import PasienKRSPasien from './pages/Bpjs/Entry/NotifikasiKRS/PasienNotifikasiKRS';

import LaporanPasienMRS from "./pages/Bpjs/Laporan/PasienMRS/LaporanPasienMRS";
import LaporanRegister from './pages/Bpjs/Laporan/Register/LaporanRegister';
import LaporanVerifikasiBPJS from './pages/Bpjs/Laporan/VerifikasiBPJS/LaporanVerifikasiBPJS';
import LaporanVerifikasiInvoice from './pages/Bpjs/Laporan/VerifikasiInvoice/LaporanVerifikasiInvoice';
import LaporanVerifikasiCOBPasien from './pages/Bpjs/Laporan/VerifikasiCOBPasien/LaporanVerifikasiCOBPasien';
import LaporanNotifikasiKRSPasien from './pages/Bpjs/Laporan/NotifikasiKRSPasien/LaporanNotifikasiKRSPasien';
import LaporanStatusPiutang from './pages/Bpjs/Laporan/StatusPiutang/LaporanStatusPiutang';
import LaporanRiwayatKunjunganPasien from './pages/Bpjs/Laporan/RiwayatKunjunganPasien/LaporanRiwayatKunjunganPasien';
import PDPKasir from './pages/Bpjs/Laporan/PDPKasir/PDPKasir';


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
        const getBasename = (path: string) => path.substr(0, path.lastIndexOf('/bpjs'));
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

                    {/*<Redirect exact from="/" to="/bpjs" />*/}
                    {history.location.pathname.includes('/bpjs/dashboard') &&
                        <Route exact={true} path={'/bpjs/dashboard'} component={Dashboard} />
                    }

                    {history.location.pathname.includes('/bpjs') &&
                        <Layout
                            menuConfig={BpjsMenuConfig}
                        >
                            <Suspense fallback={<><LayoutSplashScreen/></>} >
                                <Switch>
                                    <Redirect exact from="/bpjs" to="/bpjs/master/data-pasien"/>
                                    <Route path="/bpjs/logout" component={Logout} />
                                    {/*<Redirect exact from="/bpjs/dashboard" to="/bpjs/transaksi"/>*/}

                                    {/* Master BPJS */}
                                    <Route exact={true} path={'/bpjs/master/data-pasien'} component={() => <MasterDataPasien />} />
                                    <Route exact={true} path={'/bpjs/master/data-pasien/:id/riwayat'} component={PageView_RiwayatPasien} />
                                    {/*<Route path="/bpjs/error" component={ErrorsPage} />*/}
                                    {/*<Redirect to="/bpjs/error/error-v3" />*/}

                                    {/* Entry BPJS */}
                                    <Route exact={true} path={'/bpjs/entry/notifikasi-krs-pasien'} component={() => <PasienKRSPasien />} />

                                    {/* Laporan BPJS */}
                                    <Route exact={true} path={'/bpjs/laporan/pasien-mrs'} component={() => <LaporanPasienMRS />} />
                                    <Route exact={true} path={'/bpjs/laporan/register'} component={() => <LaporanRegister />} />
                                    <Route exact={true} path={'/bpjs/laporan/verifikasi-bpjs'} component={() => <LaporanVerifikasiBPJS />} />
                                    <Route exact={true} path={'/bpjs/laporan/verifikasi-invoice'} component={() => <LaporanVerifikasiInvoice />} />
                                    <Route exact={true} path={'/bpjs/laporan/verifikasi-cob-pasien'} component={() => <LaporanVerifikasiCOBPasien />} />
                                    <Route exact={true} path={'/bpjs/laporan/riwayat-kunjungan-pasien'} component={() => <LaporanRiwayatKunjunganPasien />} />
                                    <Route exact={true} path={'/bpjs/laporan/notifikasi-krs-pasien'} component={() => <LaporanNotifikasiKRSPasien />} />
                                    <Route exact={true} path={'/bpjs/laporan/status-piutang'} component={() => <LaporanStatusPiutang />} />
                                    <Route exact={true} path={'/bpjs/laporan/pdp-kasir'} component={PDPKasir} />
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
