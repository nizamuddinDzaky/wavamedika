import React, {useRef, useState} from 'react';
import ListPasienAktif from "../../Shared/ListPasienAktif";
import {detailMRS} from "../../../pojo/MRS";
import {LinkButton} from "rc-easyui";
import CustomDialog from "../../../components/Dialog/CustomDialog";
import ViewTransaksiGizi from "./ViewTransaksiGizi";
import ViewRiwayatKonsultasiGizi from "../Konsultasi/ViewRiwayatKonsultasiGizi";
import * as applicationSettings from '../../../stores/reducer/application.settings.ducks';
import FormControlLabel from "@material-ui/core/FormControlLabel/FormControlLabel";
import Switch from "@material-ui/core/Switch/Switch";
import {connect} from "react-redux";
import {bindActionCreators} from "redux";
import {RouteComponentProps, withRouter} from "react-router";
import PMKP from "../PMKP/PMKP";

interface applicationSetting {
    SetToolbarOpenNewPage?: (v: boolean) => void
}

interface PathParams {
}

type propTypes = RouteComponentProps<PathParams> & {
    toolbarOpenNewPage?: boolean;
    applicationSettingActions?: applicationSetting;
}
const TransaksiGizi: React.FC<propTypes> = (props: propTypes) => {
    const [selectedPasien, setSelectedPasien] = useState<detailMRS>();
    const [openNewPageSwitch, setOpenNewPageSwitch] = useState<boolean>(props.toolbarOpenNewPage!);

    const dialogViewTindakan: any = useRef(null);
    const dialogViewRiwayatKonsultasi: any = useRef(null);
    const dialogViewPMKP: any = useRef(null);

    const handleChangeOpenToolbarNewPage = () => {
        setOpenNewPageSwitch(!openNewPageSwitch);

        if(props.applicationSettingActions && props.applicationSettingActions.SetToolbarOpenNewPage)
            props.applicationSettingActions.SetToolbarOpenNewPage(!openNewPageSwitch);
    };

    const handleOpenViewTransaksi = () => {
        if(!openNewPageSwitch) {
            dialogViewTindakan?.current?.open()
        } else {
            props.history.push(`/gizi/transaksi/${selectedPasien?.id_mrs}/viewTransaksi`)
        }
    };

    const handleOpenRiwayatKonsultasi = () => {
        if(!openNewPageSwitch) {
            dialogViewRiwayatKonsultasi?.current?.open()
        } else {
            props.history.push(`/gizi/transaksi/${selectedPasien?.id_mrs}/viewRiwayatKonsultasi`)
        }
    }

    const handleOpenPMKP = () => {
        if(!openNewPageSwitch) {
            dialogViewPMKP?.current?.open()
        } else {
            props.history.push(`/gizi/transaksi/${selectedPasien?.id_mrs}/viewPMKP/unit/${selectedPasien?.id_unit}`)
        }
    }

    const toolbar = () => {
        return(
            <>
                <div style={{ padding: 8 }} >
                    <FormControlLabel
                        control={
                            <Switch
                                checked={openNewPageSwitch}
                                onChange={handleChangeOpenToolbarNewPage}
                                name="openNewPage"
                                color="primary"
                            />
                        }
                        label="Mode tampilan sub form di halaman lain"
                    />
                </div>
                <div style={{ padding: 4 }}>
                    {/*<LinkButton plain>*/}
                        {/*<i className={'flaticon2-trash'}/>*/}
                        {/*Hapus*/}
                    {/*</LinkButton>*/}
                    {/*<LinkButton plain>*/}
                        {/*<i className="flaticon-edit-1"*/}
                           {/*onClick={test}*/}
                        {/*></i>*/}
                        {/*Edit*/}
                    {/*</LinkButton>*/}
                    <LinkButton plain
                                disabled={!selectedPasien?.id_mrs}
                                onClick={handleOpenViewTransaksi}
                    >
                        <i className="flaticon-edit-1"></i>
                        &nbsp;
                        Tindakan Pada Pasien
                    </LinkButton>
                    <LinkButton plain
                                disabled={!selectedPasien?.id_mrs}
                                onClick={handleOpenRiwayatKonsultasi}
                    >
                        <i className="flaticon-edit-1"></i>
                        &nbsp;
                        Riwayat Konsultasi
                    </LinkButton>
                    {/*<LinkButton plain*/}
                                {/*disabled={!selectedPasien?.id_mrs}*/}
                                {/*// onClick={handleOpenRiwayatKonsultasi}*/}
                    {/*>*/}
                        {/*<i className="flaticon-edit-1"></i>*/}
                        {/*&nbsp;*/}
                        {/*Register Gizi*/}
                    {/*</LinkButton>*/}
                    {/*<LinkButton plain*/}
                                {/*disabled={!selectedPasien?.id_mrs}*/}
                                {/*// onClick={handleOpenRiwayatKonsultasi}*/}
                    {/*>*/}
                        {/*<i className="flaticon-edit-1"></i>*/}
                        {/*&nbsp;*/}
                        {/*Daftar Diit Pasien*/}
                    {/*</LinkButton>*/}
                    {/*<LinkButton plain*/}
                                {/*disabled={!selectedPasien?.id_mrs}*/}
                                {/*// onClick={handleOpenRiwayatKonsultasi}*/}
                    {/*>*/}
                        {/*<i className="flaticon-edit-1"></i>*/}
                        {/*&nbsp;*/}
                        {/*Human Error*/}
                    {/*</LinkButton>*/}
                    {/*<LinkButton plain*/}
                                {/*disabled={!selectedPasien?.id_mrs}*/}
                        {/*// onClick={handleOpenRiwayatKonsultasi}*/}
                    {/*>*/}
                        {/*<i className="flaticon-edit-1"></i>*/}
                        {/*&nbsp;*/}
                        {/*Pasien Rencana Pulang*/}
                    {/*</LinkButton>*/}
                    <LinkButton plain
                                disabled={!selectedPasien?.id_mrs}
                                style={{color: 'red'}}
                                onClick={handleOpenPMKP}
                    >
                        <i className="flaticon-edit-1"></i>
                        &nbsp;
                        PMKP
                    </LinkButton>

                </div>
            </>
        )
    };


    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            {/*<div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>*/}
            {/*</div>*/}
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <ListPasienAktif
                    toolbar={toolbar}
                    hidePagination={true}
                    selectionMode={'single'}
                    onSelect={(e) => setSelectedPasien(e)}
                    onDoubleClickCell={() => dialogViewTindakan?.current?.open()}
                />
            </div>

            <CustomDialog
                sizing={'large'}
                title={`Tindakan Pada Pasien: ${selectedPasien?.nama_lengkap}`}
                // style={{height:'500px'}}
                ref={dialogViewTindakan}
            >
                {(dialogViewTindakan.current && selectedPasien && selectedPasien.id_mrs) &&
                    <ViewTransaksiGizi
                        idMRS={selectedPasien?.id_mrs!}
                        hidePagination={true}
                    />
                }
            </CustomDialog>
            <CustomDialog
                sizing={'large'}
                title={`Riwayat Konsultasi Pasien: ${selectedPasien?.nama_lengkap}`}
                // style={{height:'500px'}}
                ref={dialogViewRiwayatKonsultasi}
            >
                {(dialogViewRiwayatKonsultasi.current && selectedPasien && selectedPasien.id_mrs) &&
                    <ViewRiwayatKonsultasiGizi
                        idMRS={selectedPasien?.id_mrs!}
                    />
                }
            </CustomDialog>
            <CustomDialog
                sizing={'large'}
                title={`PMKP Pasien: ${selectedPasien?.nama_lengkap}`}
                // style={{height:'500px'}}
                ref={dialogViewPMKP}
            >
                {(dialogViewPMKP.current && selectedPasien && selectedPasien.id_mrs && selectedPasien.id_unit) &&
                    <PMKP
                        idMRS={selectedPasien?.id_mrs!}
                        idUnit={selectedPasien?.id_unit!}
                    />
                }
            </CustomDialog>

        </div>
    )
}

// export default TransaksiGizi;

const mapStateToProps = ({ applicationSettings: {toolbarOpenNewPage} }: any) => ({
    toolbarOpenNewPage
});

function mapDispatchToProps(dispatch: any) {
    return {
        applicationSettingActions: bindActionCreators(applicationSettings.actions, dispatch),
    }
}
export default connect(
    mapStateToProps,
    mapDispatchToProps
)(withRouter(TransaksiGizi));

