import React, {useEffect, useRef, useState} from 'react';
// import komplainService from '../../../services/giz_kesalahan.service';
import {detailDataKomplain} from "../../../../pojo/entry/lab_kesalahan/datakomplain";
import {getDaysArray} from "../../../../utils/date.utils";
import Table from "../../../../components/Table/Table";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton} from "rc-easyui";
import customForm from "../../../../assets/js/customForm";
import {NotifySuccess} from "../../../../services/notification.service";
import FormControlLabel from "@material-ui/core/FormControlLabel/FormControlLabel";
import Switch from "@material-ui/core/Switch/Switch";
import FormInputKomplain from "./FormInputKomplain";
import CustomDialog from "../../../../components/Dialog/CustomDialog";

interface Props {
    month?: number;
    year?: number;
    id_jnskaryawan?: number;
    hidePagination?: boolean;
}
const DataKomplain: React.FC<Props> = (props: Props) => {
    const [openInputKomplain, setOpenInputKomplain] = useState<boolean>( false);
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataKomplain>>([]);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');

    const [selection, setSelection] = useState();
    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const [dateDayList, setDateDayList] = useState<Array<string>>([]);

    const [renderTableColumns, setRenderTableColumns] = useState<Array<any>>([]);
    let formInputKomplainRef: any = useRef(null);


    let tableRef: any = useRef(null);

    const renderColumns = () => {
        const map: Array<Array<any>> = [];
        map.push(
            [{
                id: 'kode',
                title: 'Kode',
                width: '40px',
                rowspan: 2
            },
                {
                    id: 'nama_unit',
                    title: 'Nama Unit',
                    width: '50px',
                    rowspan: 2
                }]
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

    // const getDataKomplain = async () => {
    //     try {
    //         setLoading(true);
    //         const data = {
    //             bulan: props.month,
    //             tahun: props.year,
    //             id_jnskaryawan: props.id_jnskaryawan? props.id_jnskaryawan: 1
    //         };
    //         const resp = await komplainService.datakomplain(data);

    //         // console.log('data', resp.list);
    //         setData(resp.list);
    //         setMeta(resp.metadata);
    //         setLoading(false);
    //     } catch (e) {
    //         console.log('error',e);
    //         setLoading(false);
    //         setData([]);
    //     }
    // };

    // const insertUnit = async () => {
    //     try{
    //         setLoading(true);
    //         const data = {
    //             bulan: props.month,
    //             tahun: props.year
    //         }
    //         const resp = await komplainService.insert_komplain(data);

    //         if(resp?.metadata && !resp?.metadata?.error) {
    //             NotifySuccess('Data Komplain', resp?.metadata?.message);
    //         }

    //         getDataKomplain();
    //     } catch (e) {
    //         setLoading(false);
    //     }
    // };

    // const removeData = async () => {
    //     try {
    //         setLoading(true);

    //         const data = {
    //             id_komplain: selection.id_komplain
    //         };
    //         const resp = await komplainService.delete_komplain(data);

    //         if(resp?.metadata && !resp?.metadata?.error) {
    //             getDataKomplain();
    //             setMode('');
    //             NotifySuccess('Data Komplain', resp?.metadata?.message)
    //         };
    //     } catch(e) {
    //         console.log('error', e);
    //         setLoading(false);
    //     }
    // }

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

            // getDataKomplain();
        }
    };

    useEffect(() => {
        const dateDayList = getDaysArray(props.year!, props.month!);
        setDateDayList(dateDayList);


        // getDataKomplain();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.month, props.year, props.id_jnskaryawan]);


    useEffect(() => {
        renderColumns();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [dateDayList]);
    return(
        <>
            <CustomDialog
                // title={`Form Input Komplain. ID Komplain: ${selection?.id_komplain? selection?.id_komplain: selection?.row?.id_komplain}`}
                title={`Form Input Komplain`}
                ref={formInputKomplainRef}
            >
                {(formInputKomplainRef && formInputKomplainRef.current && selection) &&
                <FormInputKomplain
                    selectionData={selection}
                    dateMonth={props?.month?.toString()}
                    dateYear={props?.year?.toString()}
                    dialogRef={formInputKomplainRef}
                    // onSuccessSubmiting={getDataKomplain}
                />
                }
            </CustomDialog>
            {dateDayList.length > 0 && <Table
                height={400}
                title={'Daftar Data Komplain'}
                columns={renderTableColumns}
                data={data}
                loading={loading}
                isPaginate={!props.hidePagination}
                total={meta?.row_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                selectionMode={!openInputKomplain ? 'single': 'cell'}
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
                                                checked={openInputKomplain}
                                                onChange={() => {
                                                    setOpenInputKomplain(!openInputKomplain);
                                                    // setSelection(null);
                                                }}
                                                name="openInputKomplain"
                                                color="primary"
                                            />
                                        }
                                        label="Input Komplain (Pilih indeks berdasarkan hari/tanggal)"
                                    />
                                </div>
                                <div style={{ padding: 4 }}>
                                    <LinkButton plain
                                                disabled={openInputKomplain}
                                                // onClick={() => insertUnit()}
                                    >
                                        <i className="la la-plus"></i>
                                        &nbsp;
                                        Insert Unit
                                    </LinkButton>
                                    <LinkButton plain
                                                disabled={
                                                    (mode === 'add' || mode === 'edit') ||
                                                    !selection ||
                                                    openInputKomplain
                                                }
                                                // onClick={() => removeData()}
                                    >
                                        <i className="flaticon2-trash"></i>
                                        &nbsp;
                                        Hapus Unit
                                    </LinkButton>
                                    <LinkButton plain
                                                // disabled={
                                                //     !openInputKomplain ||
                                                //     (mode === 'add' || mode === 'edit') ||
                                                //     (
                                                //         !selection ||
                                                //         selection?.column?.props?.field === 'rn' ||
                                                //         selection?.column?.props?.field === 'kode' ||
                                                //         selection?.column?.props?.field === 'nama_unit'
                                                //     )
                                                // }
                                                onClick={() => formInputKomplainRef?.current?.open()}
                                    >
                                        <i className="la la-plus"></i>
                                        &nbsp;
                                        Input Komplain
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

export default DataKomplain;
