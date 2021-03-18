import React, {useCallback, useEffect, useRef, useState} from 'react';
import HorizontalInput from "../../../components/Forms/Input/HorizontalInput";
import UnitSelector from "../../Shared/UnitSelector";
import {ISelector} from "../../../components/Forms/Input/SelectInput";
import moment from "moment";
import serviceDataDietPasien from '../../../services/gizDatadietpasien.service';
import Metadata from "../../../pojo/Metadata";
import customForm from "../../../assets/js/customForm";
import Table from "../../../components/Table/Table";
import {LinkButton} from "rc-easyui";
import CustomDialog from "../../../components/Dialog/CustomDialog";
import FormDiitPasien from "./FormDiitPasien";
import {RouteComponentProps, withRouter} from "react-router";
import {bindActionCreators} from "redux";
import * as applicationSettings from "../../../stores/reducer/application.settings.ducks";
import {connect} from "react-redux";
import Switch from "@material-ui/core/Switch/Switch";
import FormControlLabel from "@material-ui/core/FormControlLabel/FormControlLabel";
import diitPasienColumn from './TableColumn/DiitPasienColumn';
import MasterDataDiit from '../Master/Diit/MasterDataDiit';
import FormPrintDiit from './FormPrintDiit';
import {detailMRS} from "../../../pojo/MRS";

interface applicationSetting {
    SetToolbarOpenNewPage?: (v: boolean) => void
}

interface PathParams {
}

type propTypes = RouteComponentProps<PathParams> & {
    toolbarOpenNewPage?: boolean;
    applicationSettingActions?: applicationSetting;
}

const DiitPasien:React.FC<propTypes> = (props: propTypes) => {
    const [openNewPageSwitch, setOpenNewPageSwitch] = useState<boolean>(props.toolbarOpenNewPage!);

    const [date, setDate] = useState<string>(moment('2020-04-20').format('YYYY-MM-DD'));
    const [selectedUnit, setSelectedUnit]= useState<string>('_');
    const [loading, setLoading] = useState<boolean>(false);

    const [selection, setSelection] = useState();

    const [data, setData ] =  useState<Array<any>>([]);

    const [meta, setMeta] = useState<Metadata>({});
    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    let tableRef: any = useRef(null);
    const dialogFormDiitPasien: any = useRef(null);
    const dialogDataDiit: any = useRef(null);
    const dialogPrintDiit: any = useRef(null);

    const toolbar = () => {
        return (
            <>
                <div style={{padding: 8}}>
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
                <div style={{padding: 4}}>
                    <LinkButton plain
                                disabled // temporary disabled until backend available
                                onClick={() => {
                                    dialogFormDiitPasien?.current?.open()
                                }}
                    >
                        <i className="flaticon-edit-1"></i>
                        &nbsp;
                        Edit
                    </LinkButton>
                    <LinkButton plain
                        // disabled // temporary disabled until backend available
                                onClick={handleClickPrintDiit}
                    >
                        <i className="flaticon-edit-1"></i>
                        &nbsp;
                        Cetak Diit
                    </LinkButton>
                    <LinkButton plain
                        // disabled // temporary disabled until backend available
                                onClick={handleClickDataDiit}
                    >
                        <i className="flaticon-edit-1"></i>
                        &nbsp;
                        Data Diit
                    </LinkButton>
                </div>
                <div className="kt-separator kt-separator--space-sm"></div>
            </>
        )
    };

    const handleChangeOpenToolbarNewPage = () => {
        setOpenNewPageSwitch(!openNewPageSwitch);

        if(props.applicationSettingActions && props.applicationSettingActions.SetToolbarOpenNewPage)
        props.applicationSettingActions.SetToolbarOpenNewPage(!openNewPageSwitch);
    };

    const handleClickPrintDiit = () => {
        dialogPrintDiit?.current?.open()
    };

    const handleClickDataDiit = () => {
        if(!openNewPageSwitch) {
            dialogDataDiit?.current?.open()
        } else {
            props.history.push(`/gizi/master-data/dataDiit`)
        }
    };

    const onChangeUnit = (ev: ISelector) => {
        if(ev.value)
            setSelectedUnit(ev?.value);
    };

    const daftarDiitPasien = async () => {
        try {
            setLoading(true);

            const payload = {
                tanggal: date,
                unit: selectedUnit
            };
            const resp = await serviceDataDietPasien.datadietpasien(payload);
            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);

        } catch (e) {
            setLoading(false);
            setData([]);
        }
    };

    const onTableAction = (e: any) => {
        console.log('e', e);

        setPageSize(e?.pageSize);
        setPageNumber(e?.pageNumber);


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            tableRef?.cancelEdit();

            // daftarDiitPasien();
        }
    };

    const onLoadTableRef = (ref: any) => {
        tableRef = ref;
        new (customForm as any)(tableRef); // for tab on enter, inside table ref
    };

    const onSelectionChange = useCallback((e: detailMRS) => {
        setSelection(e);
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props]);

    useEffect(() => {
        daftarDiitPasien();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [selectedUnit, date]);

    return (
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <div className={'kt-form col-lg-12 header-form kt-margin-t-25'}>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={date}
                            onChange={(e) => setDate(e.target.value)}
                            label={'Tanggal'}
                            inputType={'date'}
                            colSize={2}
                            formControlSm
                            disabled={false}
                        />
                        <UnitSelector
                            label={'Ruang'}
                            onChangeSelector={onChangeUnit}
                        />
                    </div>
                </div>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <Table
                    height={400}
                    title={'Daftar Diit Pasien'}
                    data={data}
                    toolbar={toolbar}
                    loading={loading}
                    isPaginate={false}
                    total={meta.list_count}
                    pageNumber={pageNumber}
                    pageSize={pageSize}
                    onTableAction={onTableAction}
                    onLoadTableRef={(ref) => onLoadTableRef(ref) }
                    disableNumber={false}
                    columns={diitPasienColumn}
                    selectionMode={'single'}
                    selection={selection}
                    onSelectionChange={onSelectionChange}
                >
                </Table>
            </div>

            <CustomDialog
                sizing={'large'}
                title={`Edit Diit Pasien`}
                // style={{height:'500px'}}
                ref={dialogFormDiitPasien}
            >
                    {(
                        dialogFormDiitPasien.current) &&
                        // selectedPasien &&
                        // selectedPasien.id_mrs) &&
                    <FormDiitPasien
                        idMRS={200100031}
                    />}
            </CustomDialog>
            <CustomDialog
                sizing={'large'}
                title={`Data Diit`}
                // style={{height:'500px'}}
                ref={dialogDataDiit}
            >
                    {(
                        dialogDataDiit.current) &&
                        // selectedPasien &&
                        // selectedPasien.id_mrs) &&
                        <MasterDataDiit/>
                    }
            </CustomDialog>
            <CustomDialog
                sizing={'medium'}
                title={`Form Cetak Stiker Diit Tanggal ${date} Unit: ${selectedUnit} ID Riwayat Diet: ${selection?.id_riwayatdiet ?selection?.id_riwayatdiet: 'null'}`}
                // style={{height:'500px'}}
                ref={dialogPrintDiit}
                    >
                    {(
                        dialogPrintDiit.current) &&
                    // selectedPasien &&
                    // selectedPasien.id_mrs) &&
                    <FormPrintDiit
                        idRiwayatDiet={selection && selection.id_riwayatdiet}
                        dialogRefs={dialogPrintDiit.current}
                        tanggal={date}
                        unit={selectedUnit}
                    />
            }
            </CustomDialog>
        </div>
    )
};

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
)(withRouter(DiitPasien));
