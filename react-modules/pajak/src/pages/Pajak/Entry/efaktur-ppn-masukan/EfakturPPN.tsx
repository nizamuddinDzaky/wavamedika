import React, {useRef, useState} from 'react';
// import ListPasienAktif from "../BeliDarah/ListPasienAktif";
// import EntryBeliDarah from "../BeliDarah/EntryBeliDarah";
import {detailDataEfaktur} from "../../../../pojo/entry/data_Efaktur";
import {LinkButton} from "rc-easyui";
import CustomDialog from "../../../../components/Dialog/CustomDialog";
import * as applicationSettings from '../../../../stores/reducer/application.settings.ducks';
import FormControlLabel from "@material-ui/core/FormControlLabel/FormControlLabel";
import Switch from "@material-ui/core/Switch/Switch";
import {connect} from "react-redux";
import {bindActionCreators} from "redux";
import {RouteComponentProps, withRouter} from "react-router";
import EntryEfaktur from './EntryEfakturPPN';
import ListEfaktur from './ListEfaktur';
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
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
const EfakturPPN: React.FC<propTypes> = (props: propTypes) => {
    const [startDate, setStartDate] = useState<string>(moment().format('YYYY-MM-DD'));
    const [endDate, setEndDate] = useState<string>(moment().format('YYYY-MM-DD'));

    const [select, setSelection] = useState<detailDataEfaktur>();
    const [openNewPageSwitch, setOpenNewPageSwitch] = useState<boolean>(props.toolbarOpenNewPage!);

    const dialogViewEntryPPNMasukan: any = useRef(null);

    const handleOpenPPNMasukan = () => {
            dialogViewEntryPPNMasukan?.current?.open()
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
                                onClick={handleOpenPPNMasukan}
                    >
                        <i className="flaticon-edit-1"></i>
                        &nbsp;
                        Input Efaktur
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
                <ListEfaktur
                    toolbar={toolbar}
                    hidePagination={true}
                    selectionMode={'single'}
                    onSelect={(e) => setSelection(e)}
                    onDoubleClickCell={() => dialogViewEntryPPNMasukan?.current?.open()}
                />
            </div>

            <CustomDialog
                sizing={'medium'}
                title={`Input Efaktur PPn Masukan`}
                // style={{height:'500px'}}
                ref={dialogViewEntryPPNMasukan}
            >
                {(dialogViewEntryPPNMasukan.current && select && select.supplier && select.no_bukti && select.npwp && select.efaktur) &&
                    <EntryEfaktur
                        supplier={select?.supplier!}
                        no_bukti={select?.no_bukti!}
                        npwp={select?.npwp!}
                        efaktur={select?.efaktur!}
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
)(withRouter(EfakturPPN));

