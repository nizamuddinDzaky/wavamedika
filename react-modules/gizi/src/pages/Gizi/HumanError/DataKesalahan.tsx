import React, {useEffect, useRef, useState} from 'react';
import kesalahanService from '../../../services/giz_kesalahan.service';
import {detailDataKesalahan} from "../../../pojo/giz_kesalahan/datakesalahan";
import {getDaysArray} from "../../../utils/date.utils";
import Table from "../../../components/Table/Table";
import Metadata from "../../../pojo/Metadata";
import {LinkButton} from "rc-easyui";
import customForm from "../../../assets/js/customForm";
import CustomDialog from "../../../components/Dialog/CustomDialog";
import FormInsertKaryawanKesalahan from "./FormInsertKaryawanKesalahan";
import {NotifySuccess} from "../../../services/notification.service";
import FormInputKesalahan from "./FormInputKesalahan";
import FormControlLabel from "@material-ui/core/FormControlLabel/FormControlLabel";
import Switch from "@material-ui/core/Switch/Switch";

interface Props {
    month?: number;
    year?: number;
    id_jnskaryawan?: number;
    hidePagination?: boolean;
}
const DataKesalahan: React.FC<Props> = (props: Props) => {
    const [openInputKesalahan, setOpenInputKesalahan] = useState<boolean>( false);
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataKesalahan>>([]);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');

    const [selection, setSelection] = useState();
    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const [dateDayList, setDateDayList] = useState<Array<string>>([]);

    const [renderTableColumns, setRenderTableColumns] = useState<Array<any>>([]);


    let tableRef: any = useRef(null);
    let formInsertKaryawanRef: any = useRef(null);
    let formInputKesalahanRef: any = useRef(null);

    const renderColumns = () => {
        const map: Array<Array<any>> = [];
        map.push(
            [
                {
                    id: 'id_karyawan',
                    title: 'ID Karyawan',
                    width: '24px',
                    rowspan: 2
                },
                {
                    id: 'nik',
                    title: 'NIK',
                    width: '40px',
                    rowspan: 2
                },
                {
                    id: 'nama',
                    title: 'Nama',
                    width: '50px',
                    rowspan: 2
                }
            ]
        );
        map.push([]);

        dateDayList.forEach((item: any, index) => {
            map[0].push({
                id: `k${('0' + (index+1)).slice(-2)}-day`,
                title: item?.day,
                width: '15px'
            });
            map[1].push({
                id: `k${('0' + (index+1)).slice(-2)}`,
                title: item?.date,
                width: '15px'
            })
        });


        // jeasy ui somehow render last index, i dunno, what happended to the columns if i remove this will -1 of date render
        if(dateDayList.length === 28) {
            map[0].push({
                id: `a`,
                title: '-',
                width: '0px'
            });
            map[1].push({
                id: `a`,
                title: '-',
                width: '0px'
            });

            map[0].push({
                id: `b`,
                title: '-',
                width: '0px'
            });
            map[1].push({
                id: `b`,
                title: '-',
                width: '0px'
            });

            map[0].push({
                id: `c`,
                title: '-',
                width: '0px'
            });
            map[1].push({
                id: `c`,
                title: '-',
                width: '0px'
            });
        }
        if(dateDayList.length === 29) {
            map[0].push({
                id: `a`,
                title: '-',
                width: '0px'
            });
            map[1].push({
                id: `a`,
                title: '-',
                width: '0px'
            });

            map[0].push({
                id: `b`,
                title: '-',
                width: '0px'
            });
            map[1].push({
                id: `b`,
                title: '-',
                width: '0px'
            });
        }
        if(dateDayList.length === 30) {
            map[0].push({
                id: `a`,
                title: '-',
                width: '0px'
            });
            map[1].push({
                id: `a`,
                title: '-',
                width: '0px'
            });
        }


        // console.log('map column', map);

        setRenderTableColumns(map);
    };

    const getDataKesalahan = async () => {
        try {
            setSelection(null);
            setLoading(true);
            const data = {
                bulan: props.month,
                tahun: props.year,
                id_jnskaryawan: props.id_jnskaryawan? props.id_jnskaryawan: 1
            };
            const resp = await kesalahanService.datakesalahan(data);

            // console.log('data', resp.list);
            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);
        } catch (e) {
            console.log('error',e);
            setLoading(false);
            setData([]);
        }
    };

    const removeData = async () => {
        try {
            setLoading(true);

            const data = {
                id_kesalahan: selection.id_kesalahan
            };
            const resp = await kesalahanService.delete_kesalahan(data);

            if(resp?.metadata && !resp?.metadata?.error) {
                getDataKesalahan();
                setMode('');
                NotifySuccess('Data Kesalahan', resp?.metadata?.message)
            };
        } catch(e) {
            console.log('error', e);
            setLoading(false);
        }
    }

    const onLoadTableRef = (ref: any) => {
        tableRef = ref;
        new (customForm as any)(tableRef); // for tab on enter, inside table ref
    };

    const onTableAction = (e: any) => {
        setPageSize(e?.pageSize);
        setPageNumber(e?.pageNumber);


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            tableRef?.cancelEdit();

            getDataKesalahan();
        }
    };

    useEffect(() => {
        const dateDayList = getDaysArray(props.year!, props.month!);
        setDateDayList(dateDayList);


        getDataKesalahan();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.month, props.year, props.id_jnskaryawan]);


    useEffect(() => {
        renderColumns();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [dateDayList]);
    return(
        <>
            <CustomDialog
                title={'Insert Kesalahan Karyawan'}
                ref={formInsertKaryawanRef}
            >
                {(formInsertKaryawanRef && formInsertKaryawanRef.current)?
                    <FormInsertKaryawanKesalahan
                        dateMonth={props?.month?.toString()}
                        dateYear={props?.year?.toString()}
                        dialogRef={formInsertKaryawanRef}
                        onSuccessSubmiting={getDataKesalahan}
                    />: null
                }
            </CustomDialog>
            <CustomDialog
                title={`Form Input Kesalahan. ID Kesalahan: ${selection?.id_kesalahan? selection?.id_kesalahan: selection?.row?.id_kesalahan}`}
                ref={formInputKesalahanRef}
            >
                {(formInputKesalahanRef && formInputKesalahanRef.current && selection) &&
                    <FormInputKesalahan
                        selectionData={selection}
                        dateMonth={props?.month?.toString()}
                        dateYear={props?.year?.toString()}
                        dialogRef={formInputKesalahanRef}
                        onSuccessSubmiting={getDataKesalahan}
                    />
                }
            </CustomDialog>

            {dateDayList.length > 0 && <Table
                height={400}
                title={'Daftar Data Kesalahan'}
                columns={renderTableColumns}
                data={data}
                loading={loading}
                isPaginate={!props.hidePagination}
                total={meta?.row_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                selectionMode={!openInputKesalahan ? 'single': 'cell'}
                selection={selection}
                onTableAction={onTableAction}
                onLoadTableRef={(ref) => onLoadTableRef(ref) }
                // onDoubleClickCell={}
                onSelectionChange={(ev: any) => {
                    console.log('ev', ev);
                    setSelection(ev)
                }}
                toolbar={
                    () => {
                        return (
                            <>
                                <div style={{ padding: 8 }} >
                                    <FormControlLabel
                                        control={
                                            <Switch
                                                checked={openInputKesalahan}
                                                onChange={() => {
                                                    setOpenInputKesalahan(!openInputKesalahan);
                                                    setSelection(null);
                                                }}
                                                name="openInputKesalahan"
                                                color="primary"
                                            />
                                        }
                                        label="Input Kesalahan (Pilih indeks berdasarkan hari/tanggal)"
                                    />
                                </div>
                                <div style={{ padding: 4 }}>
                                    <LinkButton plain
                                        disabled={openInputKesalahan}
                                        onClick={() => formInsertKaryawanRef?.current?.open()}
                                    >
                                        <i className="la la-plus"></i>
                                        &nbsp;
                                        Insert Karyawan
                                    </LinkButton>
                                    <LinkButton plain
                                                disabled={
                                                    (mode === 'add' || mode === 'edit') ||
                                                    !selection ||
                                                    openInputKesalahan
                                                }
                                                onClick={() => removeData()}
                                    >
                                        <i className="flaticon2-trash"></i>
                                        &nbsp;
                                        Hapus Karyawan
                                    </LinkButton>
                                    <LinkButton plain
                                                disabled={
                                                    !openInputKesalahan ||
                                                    (mode === 'add' || mode === 'edit') ||
                                                    (
                                                        !selection ||
                                                        selection?.column?.props?.field === 'rn' ||
                                                        selection?.column?.props?.field === 'nama' ||
                                                        selection?.column?.props?.field === 'nik' ||
                                                        selection?.column?.props?.field === 'id_karyawan'
                                                    )
                                                }
                                                onClick={() => formInputKesalahanRef?.current?.open()}
                                    >
                                        <i className="la la-plus"></i>
                                        &nbsp;
                                        Input Kesalahan
                                    </LinkButton>
                                </div>
                            </>
                        )
                    }
                }
            />}
        </>
    )
};

export default DataKesalahan;
