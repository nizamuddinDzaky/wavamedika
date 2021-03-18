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

import MasterDataLaboratorium from "./pages/Laboratorium/Master/DataLaboratorium/MasterDataLaboratorium";
import MasterDataPasien from "./pages/Laboratorium/Master/DataPasien/MasterDataPasien";
import MasterAlkesLab from "./pages/Laboratorium/Master/AlkesLab/MasterAlkesLab";
import MasterJenisPaket from "./pages/Laboratorium/Master/JenisPaket/MasterJenisPaket";
import MasterDaftarPelayanan from "./pages/Laboratorium/Master/DaftarPelayanan/MasterDaftarPelayanan";
import MasterRsRujukPartial from "./pages/Laboratorium/Master/RsRujukPartial/RsRujukPartial";
import MasterJenisTransfusiDarah from "./pages/Laboratorium/Master/MasterJenisTransfusiDarah/ListJenisTransfusiDarah";
import MasterGolonganDarah from "./pages/Laboratorium/Master/GolonganDarah/MasterGolonganDarah";
import MasterKondisiSample from "./pages/Laboratorium/Master/KondisiSample/MasterKondisiSample";
import MasterReaksiAlergi from "./pages/Laboratorium/Master/ReaksiAlergi/MasterReaksiAlergi";

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
                    {!isAuthorized && (process.env.NODE_ENV !== 'production') ?
                        (
                            <AuthPage/>
                        ):
                        (
                            <Redirect from="/auth" to={userLastLocation} />
                        )
                    }

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
                                    <Route exact={true} path={'/lab/transaksi'} component={TransaksiGizi} />
                                    <Route exact={true} path={'/lab/transaksi/:id/viewTransaksi'} component={PageViewTransaksiGizi} />
                                    <Route exact={true} path={'/lab/transaksi/:id/viewRiwayatKonsultasi'} component={PageViewRiwayatKonsultasi} />
                                    <Route exact={true} path={'/lab/transaksi/:id/viewPMKP/unit/:idUnit'} component={PageViewPMKP} />

                                    {/*<Redirect exact from="/lab/laporan" to="/lab/laporan/registerGizi"/>*/}
                                    <Route exact={true} path={'/lab/registerGizi'} component={RegisterGizi} />
                                    <Route exact={true} path={'/lab/daftarDiitPasien'} component={DiitPasien} />
                                    <Route exact={true} path={'/lab/humanError'} component={HumanError} />
                                    <Route exact={true} path={'/lab/pasienRencanaPulang'} component={() => <PasienRencanaPulang hidePagination/>} />


                                    <Redirect exact from="/lab/master-data" to="/lab/master-data/tindakanGizi"/>
                                    <Route exact={true} path={'/lab/master-data/tindakanGizi'} component={() => <MasterTindakanGizi hidePagination/>} />
                                    <Route exact={true} path={'/lab/master-data/dataDiit'} component={MasterDataDiit} />

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
