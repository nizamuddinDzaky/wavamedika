import React, {Suspense} from 'react';
import { Redirect, Route, Switch, withRouter} from 'react-router-dom';
import FOMenuConfig from './config/FOMenuConfig';

// pages
// import PublicPage from "./pages/PublicPage";
import {LayoutContextProvider, LayoutSplashScreen} from "./components/Layout/LayoutContext";
import Layout from "./components/Layout/Layout";
import {useLastLocation} from "react-router-last-location";
import * as routerHelpers from "./helper/RouteHelper";
import {useSelector} from "react-redux";
// import FarmasiMenuConfig from "./config/FarmasiMenuConfig";
// import ErrorsPage from "./AppRouterError";
// import MasterData1 from "./pages/Farmasi/MasterData1";
import AuthPage from "./pages/Auth";
import MasterDataPasien from './pages/FO/MasterData/MasterDataPasien/MasterDataPasien';
import MasterDataAdmission from './pages/FO/MasterData/MasterDataAdmission/MasterDataAdmission';
import MasterDataInstansi from './pages/FO/MasterData/MasterDataInstansi/MasterDataInstansi';
import MasterDataInstansi_FormInstansi from './pages/FO/MasterData/MasterDataInstansi/FormInstansi/MasterDataInstansi_FormInstansi';
import MasterDataInstansi_DataTarifTindakan from './pages/FO/MasterData/MasterDataInstansi/DataTarifTindakan/MasterDataInstansi_DataTarifTindakan';
import Dashboard from './pages/Dashboard';
import PageView_RiwayatPasien from './pages/FO/MasterData/MasterDataPasien/ViewRiwayatPasien/PageViewDetail_RiyawatPasien';
import PageViewDetail_PesanPoli from './pages/FO/MasterData/MasterDataPasien/PesanPoli/PageViewDetail_PesanPoli';
import MasterDataAngketPelanggan from './pages/FO/MasterData/MasterDataAngketPelanggan/MasterDataAngketPelanggan';
import Logout from './pages/Auth/Logout';
import MasterDataFasilitasKerjasama from './pages/FO/MasterData/MasterDataFasilitasKerjasama/MasterDataFasilitasKerjasama';
import MasterDataAsuransi_DataAsuransi from './pages/FO/MasterData/MasterDataAsuransi/DataAsuransi/MasterDataAsuransi_DataAsuransi';
import MasterDataAsuransi_DataTarifTindakan from './pages/FO/MasterData/MasterDataAsuransi/DataTarifTindakan/MasterDataAsuransi_DataTarifTindakan';
import MasterDataAsuransi_FormAsuransi from './pages/FO/MasterData/MasterDataAsuransi/DataAsuransi/FormAsuransi/MasterDataAsuransi_FormAsuransi';
import PesananAntriKlinik from './pages/FO/Antrian/PesananAntriKlinik/PesananAntriKlinik';
import ListPasienAntriAktif from './pages/FO/Antrian/ListPasienAntriAktif/ListPasienAntriAktif';
import RegisterKontrol from './pages/FO/Antrian/RegisterKontrol/RegisterKontrol';
import MasterDataAdmission_FormDataAdmission from './pages/FO/MasterData/MasterDataAdmission/FormAdmission/MasterDataAdmission_FormDataAdmission';
import MasterDataPerujuk from './pages/FO/Rujukan/MasterDataPerujuk/MasterDataPerujuk';
import DaftarNomorKosong from './pages/FO/Antrian/DaftarNomorKosong/DaftarNomorKosong';
import RegisterPesananKontrol from './pages/FO/Antrian/RegisterPesananKontrol/RegisterPesananKontrol';
import AngketPelanggan from './pages/FO/Angket/AngketPelanggan/AngketPelanggan';
import FormAngketPelanggan from './pages/FO/Angket/AngketPelanggan/FormAngketPelanggan/FormAngketPelanggan';


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

                    {history.location.pathname.includes('/fo/dashboard') &&
                        <Route exact={true} path={'/fo/dashboard'} component={Dashboard} />
                    }
                    {/*<Redirect exact from="/" to="/gizi" />*/}

                    {history.location.pathname.includes('/fo') &&
                        <Layout
                            menuConfig={FOMenuConfig}
                        >
                            <Suspense fallback={<><LayoutSplashScreen/></>} >
                                <Switch>
                                    <Route path="/fo/logout" component={Logout} />
                                    <Redirect exact from="/fo" to="/fo/master-data/data-pasien"/>
                                    <Redirect exact from="/fo/master-data" to="/fo/master-data/data-pasien"/>
                                    <Redirect exact from="/fo/master-data/asuransi" to="/fo/master-data/asuransi/data-asuransi"/>
                                    <Redirect exact from="/fo/master-data/asuransi/data-tarif-tindakan" to="/fo/master-data/asuransi/data-tarif-tindakan/BPJS"/>

                                
                                    <Route exact={true} path={'/fo/master-data/data-pasien'} component={MasterDataPasien} />
                                    <Route exact={true} path={'/fo/master-data/data-pasien/:id/riwayat'} component={PageView_RiwayatPasien}/>
                                    <Route exact={true} path={'/fo/master-data/data-pasien/:id/poli'} component={PageViewDetail_PesanPoli}/>

                                    <Route exact={true} path={'/fo/master-data/angket-pelanggan'} component={MasterDataAngketPelanggan} />
                                    <Route exact={true} path={'/fo/master-data/fasilitas-kerjasama'} component={MasterDataFasilitasKerjasama} />

                                    <Route exact={true} path={'/fo/master-data/asuransi/data-asuransi'} component={MasterDataAsuransi_DataAsuransi} />
                                    <Route exact={true} path={'/fo/master-data/asuransi/data-asuransi/:id'} component={MasterDataAsuransi_FormAsuransi} />
                                    <Route exact={true} path={'/fo/master-data/asuransi/data-tarif-tindakan/:kode_instansi'} component={MasterDataAsuransi_DataTarifTindakan} />

                                    <Route exact={true} path={'/fo/master-data/admission/data-admission'} component={MasterDataAdmission} />
                                    <Route exact={true} path={'/fo/master-data/admission/data-admission/:id'} component={MasterDataAdmission_FormDataAdmission} />

                                    <Route exact path={'/fo/antrian/pesanan-antri-klinik'} component={PesananAntriKlinik} />
                                    <Route exact path={'/fo/antrian/list-pasien-antri-aktif'} component={ListPasienAntriAktif} />
                                    <Route exact path={'/fo/antrian/register-kontrol'} component={RegisterKontrol} />
                                    <Route exact path={'/fo/antrian/daftar-nomor-kosong'} component={DaftarNomorKosong} />
                                    <Route exact path={'/fo/antrian/register-pesanan-kontrol'} component={RegisterPesananKontrol} />

                                    <Route exact={true} path={'/fo/master-data/admission'} component={MasterDataAdmission} />
                                    
                                    <Route exact={true} path={'/fo/master-data/instansi/data-instansi'} component={MasterDataInstansi} />
                                    <Route exact={true} path={'/fo/master-data/instansi/data-instansi/:id'} component={MasterDataInstansi_FormInstansi} />
                                    <Route exact={true} path={'/fo/master-data/instansi/data-tarif-tindakan/:kode_instansi'} component={MasterDataInstansi_DataTarifTindakan} />
                                    
                                    <Route exact={true} path={'/fo/angket/angket-pelanggan'} component={AngketPelanggan} />
                                    <Route exact={true} path={'/fo/angket/angket-pelanggan/:id_angketpelanggan'} component={FormAngketPelanggan} />


                                    <Route exact={true} path={'/fo/rujukan/data-perujuk'} component={MasterDataPerujuk} />
                                </Switch>
                            </Suspense>
                        </Layout>
                    }
                </Switch>
            </LayoutContextProvider>
        </>
    );
};

export default withRouter(AppRouter);
