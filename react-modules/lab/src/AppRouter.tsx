import React, {Suspense} from 'react';
import { Redirect, Route, Switch, withRouter} from 'react-router-dom';
import LabMenuConfig from './config/LabMenuConfig';

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

import MasterDataLaboratorium from "./pages/Laboratorium/Master/DataLaboratorium/MasterDataLaboratorium";
import MasterDataPasien from "./pages/Laboratorium/Master/DataPasien/MasterDataPasien";
import MasterAlkesLab from "./pages/Laboratorium/Master/AlkesLab/MasterAlkesLab";
import MasterJenisPaket from "./pages/Laboratorium/Master/JenisPaket/MasterJenisPaket";
import MasterDaftarPelayanan from "./pages/Laboratorium/Master/DaftarPelayanan/MasterDaftarPelayanan";
import MasterRsRujukPartial from "./pages/Laboratorium/Master/RsRujukPartial/RsRujukPartial";
import MasterJenisTransfusiDarah from "./pages/Laboratorium/Master/JenisTransfusiDarah/MasterJenisTransfusiDarah";
import MasterGolonganDarah from "./pages/Laboratorium/Master/GolonganDarah/MasterGolonganDarah";
import MasterKondisiSample from "./pages/Laboratorium/Master/KondisiSample/MasterKondisiSample";
import MasterReaksiAlergi from "./pages/Laboratorium/Master/ReaksiAlergi/MasterReaksiAlergi";

import LaporanTransaksiPerBulan from "./pages/Laboratorium/Laporan/TransaksiPerBulan/LaporanTransaksiPerBulan";
import LaporanWaktuTunggu from './pages/Laboratorium/Laporan/WaktuTunggu/LaporanWaktuTunggu';
import LaporanKondisiSampel from './pages/Laboratorium/Laporan/KondisiSampel/LaporanKondisiSampel';
import LaporanRegister from './pages/Laboratorium/Laporan/Register/LaporanRegister';
import LaporanRegisterPemakaianDarah from './pages/Laboratorium/Laporan/Register/LaporanPemakaianDarah';
import LaporanRegisterRujukPartial from './pages/Laboratorium/Laporan/Register/LaporanRujukPartial';
import BeliDarah from './pages/Laboratorium/Entry/BeliDarah/BeliDarah';
import TindakLanjut from './pages/Laboratorium/Entry/TindakLanjut/TindakLanjut';
import TerimaSampel from './pages/Laboratorium/Entry/TerimaSampel/TerimaSampel';
import LaporanPasienMRS from './pages/Laboratorium/Entry/TerimaSampel/PasienMRS';
import TerimaSampelBaru from './pages/Laboratorium/Entry/TerimaSampel/TerimaSampelBaru';
import CariBilling from './pages/Laboratorium/Entry/TerimaSampel/CariBilling';
import PeriksaLab from './pages/Laboratorium/Entry/PeriksaLab/PeriksaLab';
import HasilLab from './pages/Laboratorium/Entry/HasilLab/HasilLab';
import HumanError from './pages/Laboratorium/Entry/HumanError/HumanError';

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
        const getBasename = (path: string) => path.substr(0, path.lastIndexOf('/lab'));
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
                    }
                 */}

                    {/*<Redirect exact from="/" to="/lab" />*/}
                    {history.location.pathname.includes('/lab/dashboard') &&
                        <Route exact={true} path={'/lab/dashboard'} component={Dashboard} />
                    }

                    {history.location.pathname.includes('/lab') &&
                        <Layout
                            menuConfig={LabMenuConfig}
                        >
                            <Suspense fallback={<><LayoutSplashScreen/></>} >
                                <Switch>
                                    <Redirect exact from="/lab" to="/lab/master/data-laboratorium"/>
                                    <Route path="/lab/logout" component={Logout} />
                                    {/*<Redirect exact from="/lab/dashboard" to="/lab/transaksi"/>*/}
                                    {/*<Route exact={true} path={'/lab/dashboard'} component={PublicPage} />*/}

                                    {/*<Redirect exact from="/lab/laporan" to="/lab/laporan/registerGizi"/>*/}

                                    {/* Master Laboratorium */}
                                    <Route exact={true} path={'/lab/master/data-laboratorium'} component={() => <MasterDataLaboratorium />} />
                                    <Route exact={true} path={'/lab/master/data-pasien'} component={() => <MasterDataPasien />} />
                                    <Route exact={true} path={'/lab/master/alkes-lab'} component={() => <MasterAlkesLab />} />
                                    <Route exact={true} path={'/lab/master/jenis-paket'} component={() => <MasterJenisPaket />} />
                                    <Route exact={true} path={'/lab/master/daftar-pelayanan'} component={() => <MasterDaftarPelayanan />} />
                                    <Route exact={true} path={'/lab/master/rs-rujuk-partial'} component={() => <MasterRsRujukPartial />} />
                                    <Route exact={true} path={'/lab/master/jenis-transfusi-darah'} component={() => <MasterJenisTransfusiDarah />} />
                                    <Route exact={true} path={'/lab/master/golongan-darah'} component={() => <MasterGolonganDarah />} />
                                    <Route exact={true} path={'/lab/master/kondisi-sampel'} component={() => <MasterKondisiSample />} />
                                    <Route exact={true} path={'/lab/master/reaksi-alergi'} component={() => <MasterReaksiAlergi />} />



                                    {/* Laporan Laboratorium */}
                                    <Route exact={true} path={'/lab/laporan/transaksi-per-bulan'} component={() => <LaporanTransaksiPerBulan />} />
                                    <Route exact={true} path={'/lab/laporan/rekap-waktu-tunggu'} component={() => <LaporanWaktuTunggu />} />
                                    <Route exact={true} path={'/lab/laporan/laporan-kondisi-sampel'} component={() => <LaporanKondisiSampel />} />
                                    <Route exact={true} path={'/lab/laporan/register'} component={() => <LaporanRegister />} />
                                    <Route exact={true} path={'/lab/laporan/register-pemakaian-darah'} component={() => <LaporanRegisterPemakaianDarah />} />
                                    <Route exact={true} path={'/lab/laporan/register-rujuk-partial'} component={() => <LaporanRegisterRujukPartial />} />
                                    
            
                                    {/* Laporan Laboratorium */}
                                    <Route exact={true} path={'/lab/entry/beli-darah'} component={BeliDarah} />
                                    <Route exact={true} path={'/lab/entry/terimaa-sampel'} component={TerimaSampel} />
                                    <Route exact={true} path={'/lab/entry/terimaa-sampel/baru'} component={TerimaSampelBaru} />
                                    <Route exact={true} path={'/lab/entry/tindak-lanjut'} component={TindakLanjut} />
                                    <Route exact={true} path={'/lab/entry/terima-lab'} component={PeriksaLab} />
                                    <Route exact={true} path={'/lab/entry/terima-lab/cari-biling'} component={CariBilling} />
                                    <Route exact={true} path={'/lab/entry/hasil-lab'} component={HasilLab} />
                                    <Route exact={true} path={'/lab/entry/terimaa-sampel/pasien-mrs'} component={LaporanPasienMRS} />
                                    <Route exact={true} path={'/lab/entry/human-error'} component={HumanError} />


                                    {/*<Route path="/lab/error" component={ErrorsPage} />*/}
                                    {/*<Redirect to="/lab/error/error-v3" />*/}
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
