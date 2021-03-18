import React, { useState, useEffect, useCallback, useRef } from 'react';
import Metadata from '../../../../pojo/Metadata';
import Table from "../../../../components/Table/Table";
import { RouteComponentProps, withRouter } from 'react-router';
import { LinkButton} from 'rc-easyui';
import antrian_pesanan_antri_klinikService from '../../../../services/antrian_pesanan_antri_klinik.service';
import moment from 'moment';
import CustomDialog from '../../../../components/Dialog/CustomDialog';
import SMSPasien from './SMSPasien';

const useDataPesananAntriKlinikColumn = ({handleRowCheck}: {handleRowCheck: (row: any, checked: any) => void}) => {
    return [
        {
            id: 'no_antri',
            title: 'No. Antri',
            width: "20px",
            align: 'center'
        },
        {
            id: 'no_mr',
            title: 'No. MR',
            width: "20px",
        },
        {
            id: 'nama_lengkap',
            title: 'Nama Pasien',
            width: "80px",
            // editable: true,
            // editor: ({row, error, rowIndex}: any) => {
            //     return (
            //         <>
            //             <Tooltip content={error} tracking>
            //                 <TextBox value={row?.uraian}/>
            //             </Tooltip>
            //         </>
            //     )
            // },
            // editRules: ['required']
        },
        {
            id: 'umur',
            title: 'Umur',
            width: "20px",
        },
        {
            id: 'alamat',
            title: 'Alamat',
            width: "60px",
        },
        {
            id: 'kecamatan',
            title: 'Kecamatan',
            width: "40px",
        },
        {
            id: 'tgl_rencana',
            title: 'Tgl Rencana',
            width: '40px',
            render: ({row}: any) => {
                return (
                    moment(row?.tgl_rencana).format('DD-MM-YYYY')
                )
            }
        }
    ];
}

type IProps = RouteComponentProps & {
    onTableAction?: (e: any) => void;
    tgl1?: string;
    tgl2?: string;
    ruang?: string;
    dokter?: string;

}

const PesananAntriKlinikList: React.FC<IProps> = (props: IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);
    const [mode] = useState<string>('');

    const [meta, setMeta] = useState<Metadata>({});
    const [selection, setSelection] = useState<any>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);


    const [tableRef, setTableRef] = useState<any>(null); 
    const smsDialogRef: any = useRef(null);

    const getData = async (limit?: number, page?: number ) => {
        try {
            setLoading(true);
            setSelection(null);

            const payload = {
                halaman: page? page: pageNumber,
                batas: limit? limit: pageSize,
                tgl1: props?.tgl1,
                tgl2: props?.tgl2,
                ruang: props?.ruang,
                dokter: props?.dokter
            }

            const resp = await antrian_pesanan_antri_klinikService.tpp_lapregantripoli_view_lapregantripoli(payload);
            if(resp && Array.isArray(resp.list) && resp.list.length >0) {
                setData(resp.list);
            } else {
                setData([]);
            }

            setMeta(resp.metadata);
            setLoading(false);
        } catch (e) {
            setLoading(false);
            setData([]);
        }
    };


    const onTableAction = async (e: any) => {
        console.log('e', e);

        if(e.pageSize) {
            tableRef?.cancelEdit();
            setPageSize(e?.pageSize);
        }

        if(e.pageNumber) {
            tableRef?.cancelEdit();
            setPageNumber(e?.pageNumber);
        }


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            tableRef?.cancelEdit();

            getData(e.pageSize, e.pageNumber);
        } else {
            getData(e.pageSize, e.pageNumber);
        }

        if(props.onTableAction) {
            props.onTableAction(e)
        }
    };

    // const onEditCancel = (event: any) => {
    //     setMode('');
    //     if (event.row._new) {
    //         const newData = data.filter(row => row !== event.row);
    //         setData(newData);
    //     }
    // };

    // const onEditEnd = async (event: any) => {
    //     try {
    //         setLoading(true);

    //         if(mode === 'add') {
    //             console.log('event?', event?.row);
    //             const payload = {
    //                 indeks: event?.row?.indeks,
    //                 uraian: event?.row?.uraian,
    //             }
    //             const resp = await master_angket_pelangganService.mkt_masterangketpelanggan_insert(payload);
    //             if(resp?.metadata && !resp?.metadata?.error) {
    //                 getData();
    //                 setMode('');
    //                 NotifySuccess('Data Rencana Kontrol', resp?.metadata?.message)
    //             };
    //         }
    //     } catch(e) {
    //         console.log('error', e);
    //         setLoading(false);

    //         if(mode === 'add') {
    //             tableRef?.beginEdit(data[0]);
    //         }
    //     }
    // }

    const handleRowCheck = (row: any, checked: boolean) => {
        if(mode !== 'add') {
            let newData = data.slice();
            let index = newData.indexOf(row);
            console.log('row', index);
            newData.splice(index, 1, Object.assign({}, row, { aktif: checked? '1': '0' }));
            // let checkedRows = newData.filter(row => row.selected);
            console.log('newData', newData);
            setData(newData)
        }
    }

    const listDataPesananAntriKlinikColumn = useDataPesananAntriKlinikColumn({handleRowCheck});

    const handleRefresh = () => {
        getData();
    }

    const handleSMS =() => {
        smsDialogRef?.current?.open();
    }

    // const handleDelete = async () => {
    //     try {
    //         setLoading(true);
    //         const payload = {
    //             id_jnsangketpelanggan: selection?.id_jnsangketpelanggan
    //         }

    //         const resp = await master_angket_pelangganService.mkt_masterangketpelanggan_delete(payload);

    //         if(resp?.metadata && !resp?.metadata?.error) {
    //             getData();
    //             setMode('');
    //             NotifySuccess('Data Angket Pelanggan', resp?.metadata?.message)
    //         };

    //     } catch(error) {
    //         console.log('error', error);

    //         setLoading(false);
    //     }
    // }

    

    // const handleAdd = () => {
    //     const detailData = {
    //         aktif: '1',
    //         indeks: 0,
    //         uraian: '',
    //         _new: true
    //     }

    //     const currentData = Array.from(data);
    //     currentData.unshift(detailData);
    //     setData(currentData);
    //     setMode('add');
    // }

    const onLoadTableRef = (ref: any) => {
        setTableRef(ref)
        // new (customForm as any)(ref); // for tab on enter, inside table ref
    };

    const onSelectionChange = useCallback((e: any) => {
        setSelection(e);
        console.log(e)
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props]);

    // useEffect(() => {
    //     getData();

    //     // eslint-disable-next-line react-hooks/exhaustive-deps
    // },[]);

    useEffect(() => {
        getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.tgl1, props.tgl2, props.dokter, props.ruang])

    useEffect(() => {
        if(tableRef && tableRef !== null && mode === 'add' ) {
            tableRef?.beginEdit(data[0]);
            // console.log('data', data)
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [data, mode]);
    return(
        <>
            <CustomDialog
                sizing={'medium'}
                title={'SMS Pasien'}
                ref={smsDialogRef}
            >
                {
                    smsDialogRef.current && selection?.id_mr &&
                        <SMSPasien
                            id_rencanakontrol={selection?.id_rencanakontrol}
                        />
                }
            </CustomDialog>
            <Table
                isLazy
                title={'Pesanan Antri Klinik'}
                columns={listDataPesananAntriKlinikColumn}
                data={data}
                loading={loading}
                disableNumber
                isPaginate={true}
                total={meta?.row_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                onTableAction={onTableAction}
                onLoadTableRef={(ref: any) => onLoadTableRef(ref) }
                selectionMode={'single'}
                selection={selection}
                editable={!loading}
                onSelectionChange={onSelectionChange}
                onDoubleClickCell={handleSMS}
                toolbar={({editingItem}: any) => {
                    return(
                        <>
                            <div style={{padding: 4}}>
                                <LinkButton plain
                                                onClick={handleSMS}
                                                disabled={!selection?.id_rencanakontrol}
                                    >
                                        <i className="flaticon2-phone"></i>
                                        &nbsp;
                                        SMS
                                </LinkButton>
                                <LinkButton plain
                                            onClick={handleRefresh}
                                            // disabled={(mode === 'add' || mode === 'edit')}
                                >
                                    <i className="flaticon-refresh"></i>
                                    &nbsp;
                                    Refresh
                                </LinkButton>
                            </div>
                        </>
                    )
                }}
                // onEditCancel={onEditCancel}
                // onEditEnd={onEditEnd}
            />
        </>
    )
};

export default withRouter(PesananAntriKlinikList);