import React, {useRef, useState} from 'react';
import ListPasienAktif from "./ListPasienAktif";
import EntryBeliDarah from "./EntryBeliDarah";
import {detailMRS} from "../../../../pojo/entry/beli_darah/data_pasien_mrs";
import {LinkButton} from "rc-easyui";
import CustomDialog from "../../../../components/Dialog/CustomDialog";
import * as applicationSettings from '../../../../stores/reducer/application.settings.ducks';
import FormControlLabel from "@material-ui/core/FormControlLabel/FormControlLabel";
import Switch from "@material-ui/core/Switch/Switch";
import {connect} from "react-redux";
import {bindActionCreators} from "redux";
import {RouteComponentProps, withRouter} from "react-router";

interface applicationSetting {
    SetToolbarOpenNewPage?: (v: boolean) => void
}

interface PathParams {
}

type propTypes = RouteComponentProps<PathParams> & {
    toolbarOpenNewPage?: boolean;
    applicationSettingActions?: applicationSetting;
}
const BeliDarah: React.FC<propTypes> = (props: propTypes) => {
    const [selectedPasien, setSelectedPasien] = useState<detailMRS>();
    const [openNewPageSwitch, setOpenNewPageSwitch] = useState<boolean>(props.toolbarOpenNewPage!);

    const dialogViewBeliDarah: any = useRef(null);

    const handleOpenBeliDarah = () => {
            dialogViewBeliDarah?.current?.open()
    };

    const toolbar = () => {
        return(
            <>
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
                                onClick={handleOpenBeliDarah}
                    >
                        <i className="flaticon-edit-1"></i>
                        &nbsp;
                        Tindakan Beli Darah
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
                    onDoubleClickCell={() => dialogViewBeliDarah?.current?.open()}
                />
            </div>

            <CustomDialog
                sizing={'large'}
                title={`Beli Darah Pada Pasien`}
                // style={{height:'500px'}}
                ref={dialogViewBeliDarah}
            >
                {(dialogViewBeliDarah.current && selectedPasien && selectedPasien.nama_lengkap && selectedPasien.no_mr) &&
                    <EntryBeliDarah
                        namaPasien={selectedPasien?.nama_lengkap!}
                        no_bill={selectedPasien?.no_mr!}
                        hidePagination={true}
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
)(withRouter(BeliDarah));

