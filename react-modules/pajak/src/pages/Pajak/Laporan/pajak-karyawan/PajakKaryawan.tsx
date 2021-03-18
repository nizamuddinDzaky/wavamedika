import React, {useRef, useState} from 'react';
// import ListPasienAktif from "../BeliDarah/ListPasienAktif";
// import EntryBeliDarah from "../BeliDarah/EntryBeliDarah";
import {detailDataPajakKaryawan} from "../../../../pojo/laporan/data_PajakKaryawan";
import {LinkButton} from "rc-easyui";
import CustomDialog from "../../../../components/Dialog/CustomDialog";
import * as applicationSettings from '../../../../stores/reducer/application.settings.ducks';
import FormControlLabel from "@material-ui/core/FormControlLabel/FormControlLabel";
import Switch from "@material-ui/core/Switch/Switch";
import {connect} from "react-redux";
import {bindActionCreators} from "redux";
import {RouteComponentProps, withRouter} from "react-router";
import ListKaryawan from './ListKaryawan';
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
import EntryPajakKaryawan from './EntryPajakKaryawan';
import moment from 'moment';

interface applicationSetting {
    SetToolbarOpenNewPage?: (v: boolean) => void
}

interface PathParams {
}

type propTypes = RouteComponentProps<PathParams> & {
    toolbarOpenNewPage?: boolean;
    applicationSettingActions?: applicationSetting;
}
const PajakKaryawan: React.FC<propTypes> = (props: propTypes) => {
    const [startDate, setStartDate] = useState<string>(moment().format('YYYY-MM-DD'));
    const [endDate, setEndDate] = useState<string>(moment().format('YYYY-MM-DD'));

    const [select, setSelection] = useState<detailDataPajakKaryawan>();
    const [openNewPageSwitch, setOpenNewPageSwitch] = useState<boolean>(props.toolbarOpenNewPage!);

    const dialogViewEntryPajak: any = useRef(null);

    const handleOpenPajak = () => {
            dialogViewEntryPajak?.current?.open()
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
                                disabled={!select?.id}
                                onClick={handleOpenPajak}
                    >
                        <i className="flaticon-edit-1"></i>
                        &nbsp;
                        Detail Perhitungan Pajak
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
           <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
            <div className={'kt-form col-lg-12 header-form kt-margin-t-25'}>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={startDate}
                            onChange={(e) => setStartDate(e.target.value)}
                            label={'Tanggal Mulai'}
                            inputType={'date'}
                            colSize={2}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                        />
                        <HorizontalInput
                            value={endDate}
                            onChange={(e) => setEndDate(e.target.value)}
                            label={'Tanggal Akhir'}
                            inputType={'date'}
                            colSize={2}
                            formControlSm
                            disabled={false}
                        />
                    </div>
                </div>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <ListKaryawan
                    toolbar={toolbar}
                    hidePagination={true}
                    selectionMode={'single'}
                    onSelect={(e) => setSelection(e)}
                    onDoubleClickCell={() => dialogViewEntryPajak?.current?.open()}
                />
            </div>

            <CustomDialog
                sizing={'large'}
                title={`Detail Pajak Gaji Karyawan`}
                // style={{height:'500px'}}
                ref={dialogViewEntryPajak}
            >
                {(dialogViewEntryPajak.current && select) &&
                    <EntryPajakKaryawan

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
)(withRouter(PajakKaryawan));

