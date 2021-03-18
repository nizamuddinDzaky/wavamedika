import React, { useState, useEffect, useCallback } from 'react';
import Metadata from '../../../../pojo/Metadata';
import Table from "../../../../components/Table/Table";
import { RouteComponentProps, withRouter } from 'react-router';
import { LinkButton, TextBox, Tooltip} from 'rc-easyui';
import moment from 'moment';
// import DaftarNomorKosong from './DaftarNomorKosong';
import antrian_nomor_kosongService from '../../../../services/antrian_nomor_kosong.service';
import daftarNomorKosongContext from '../../../../stores/context/daftarNomorKosongContext';
import { NotifySuccess } from '../../../../services/notification.service';
import angket_pelangganService from '../../../../services/angket_pelanggan.service';

const useColumn = () => {
    return [
        {
            id: 'tanggal',
            title: 'Tanggal',
            width: "50px",
            // editable: true,
            // editor: ({row, error, rowIndex}: any) => {
            //     return (
            //         <>
            //             <EasyUISelectDokterTppNomorKosong
            //                 value={row?.dokter}
            //                 error={error}
            //             />
            //         </>
            //     )
            // },
            // editRules: ['required']
        },
        {
            id: 'nama',
            title: 'Nama',
            width: "80px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <TextBox value={row?.nama}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'sex',
            title: 'Sex',
            width: "30px",
        },
        {
            id: 'usia',
            title: 'Usia',
            width: "60px",
        },
        {
            id: 'alamat',
            title: 'Alamat',
            width: "100px",
        },
        {
            id: 'ruang',
            title: 'Ruang',
            width: "60px",
        },
        {
            id: 'kelas',
            title: 'Kelas',
            width: "60px",
        },
        {
            id: 'operator',
            title: 'Operator',
            width: "60px",
        },
        {
            id: 'tgl_input',
            title: 'Waktu Input',
            width: "60px",
        },
        
    ];
}

type IProps = RouteComponentProps & {
    onTableAction?: (e: any) => void;
    bulanTahun: any;
    jenis_pasien: string;
    kelas: string;
    kunjungan: string;

}

const AngketPelangganList: React.FC<IProps> = (props: IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);
    const [mode, setMode] = useState<string>('');

    const [meta, setMeta] = useState<Metadata>({});
    const [selection, setSelection] = useState<any>();
    const [selectedDokter, setSelectedDokter] = useState<any>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);


    const [tableRef, setTableRef] = useState<any>(null);

    const getData = async (limit?: number, page?: number ) => {
        try {
            setLoading(true);
            setSelection(null);

            const payload = {
                halaman: pageNumber,
                batas: pageSize,
                bln: Number(moment(props.bulanTahun).format('MM')),
                thn: Number(moment(props.bulanTahun).format('YYYY')),
                jns_pasien: props.jenis_pasien,
                kelas: props.kelas,
                kunj_pasien: props.kunjungan

            }

            const resp = await angket_pelangganService.mkt_dataangketpelanggan_view_dataangketpelanggan(payload);
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

    const onEditCancel = (event: any) => {
        setMode('');
        if (event.row._new) {
            const newData = data.filter(row => row !== event.row);
            setData(newData);
        }
    };

    const onEditEnd = async (event: any) => {
        try {
            setLoading(true);
            if(mode === 'add') {
                // console.log('event?', event?.row);
                const payload = {
                    dokter: selectedDokter?.value,
                    antri: event?.row?.antri
                }
                const resp = await antrian_nomor_kosongService.tpp_nomorkosong_insert(payload);
                if(resp?.metadata && !resp?.metadata?.error) {
                    NotifySuccess('Data Rencana Kontrol', resp?.metadata?.message)
                };

                getData();
                setMode('');
            } else if(mode === 'edit') {
                const payload = {
                    id_antrian: event?.row?.id_antrian,
                    dokter: selectedDokter?.value,
                    antri: event?.row?.antri
                }
            
                const resp = await antrian_nomor_kosongService.tpp_nomorkosong_update(payload);

                if(resp?.metadata && !resp?.metadata?.error) {
                    NotifySuccess('Data Antrian Nomor Kosong', resp?.metadata?.message)
                };

                getData();
                setMode('');
                setSelection(null);
            }
            
            
        } catch(e) {
            console.log('error', e);
            setLoading(false);
            setSelection(null);
            if(mode === 'add') {
                tableRef?.beginEdit(data[0]);
            } else if(mode === 'edit') {
                getData();
                setMode('');
            }
        }
    }

    const listColumn = useColumn();

    const handleRefresh = () => {
        if(mode !== '')
            tableRef?.cancelEdit();

        
        getData();
    }

    const handleEdit = () => {
        // setMode('edit');
        // setSelectedDokter(null);
        
        // if(Array.isArray(data) && data.length > 0) {
        //     tableRef?.beginEdit(selection)
        // }
        props?.history?.push(`/fo/angket/angket-pelanggan/${selection?.id_angketpelanggan}`)
    }

    const handleDelete = async () => {
        try {
            setLoading(true);
            const payload = {
                id_antrian: selection?.id_antrian
            }

            const resp = await antrian_nomor_kosongService.tpp_nomorkosong_delete(payload);

            if(resp?.metadata && !resp?.metadata?.error) {
                NotifySuccess('Data Nomor Kosong', resp?.metadata?.message)
            };

            getData();
            setMode('');

        } catch(error) {
            console.log('error', error);

            setLoading(false);
        }
    }

    

    const handleAdd = async () => {
        try {
            setLoading(true);
            const payload = {}
            const resp = await angket_pelangganService.mkt_dataangketpelanggan_insert(payload);
            console.log('res[',resp);
            if(resp?.metadata && !resp?.metadata?.error) {
                props?.history?.push(`/fo/angket/angket-pelanggan/${resp.metadata?.id}`)
            }
            setLoading(false)
            
        } catch(e) {
            console.log('error', e);
            setLoading(false)
        }
    }

    const onLoadTableRef = (ref: any) => {
        setTableRef(ref)
        // new (customForm as any)(ref); // for tab on enter, inside table ref
    };

    const onSelectionChange = useCallback((e: any) => {
        if(mode!== 'edit') {
            setSelection(e);
        }
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props]);

    // useEffect(() => {
    //     getData();

    //     // eslint-disable-next-line react-hooks/exhaustive-deps
    // },[]);

    useEffect(() => {
        getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.bulanTahun, props.kelas, props.kunjungan, props.jenis_pasien])

    useEffect(() => {
        if(tableRef && tableRef !== null && mode === 'add' ) {
            tableRef?.beginEdit(data[0]);
            // console.log('data', data)
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [data, mode]);
    return(
        <>
            <daftarNomorKosongContext.Provider value={[setSelectedDokter]}>
                <Table
                    isLazy
                    title={'Angket Pelanggan'}
                    columns={listColumn}
                    data={data}
                    loading={loading}
                    disableNumber
                    isPaginate={false}
                    height={400}
                    total={meta?.row_count}
                    pageNumber={pageNumber}
                    pageSize={pageSize}
                    onTableAction={onTableAction}
                    onLoadTableRef={(ref: any) => onLoadTableRef(ref) }
                    selectionMode={'single'}
                    // editMode="cell"
                    // clickToEdit={true}
                    selection={selection}
                    editable={!loading}
                    onSelectionChange={onSelectionChange}
                    toolbar={({editingItem}: any) => {
                        return(
                            <>
                                <div style={{padding: 4}}>
                                    <LinkButton plain
                                                disabled={(mode === 'add' || mode === 'edit')}
                                                onClick={() => handleAdd()}
                                    >
                                        <i className="flaticon-edit-1"></i>
                                        &nbsp;
                                        Tambah
                                    </LinkButton>
                                    <LinkButton plain
                                                onClick={handleEdit}
                                                disabled={(mode === 'add' || mode === 'edit') || !selection?.id_angketpelanggan}
                                    >
                                        <i className="flaticon-edit"></i>
                                        &nbsp;
                                        Ubah
                                    </LinkButton>
                                    <LinkButton plain
                                                disabled={editingItem == null}
                                                onClick={() => tableRef?.endEdit()}
                                    >
                                        <i className="la la-save"></i>
                                        &nbsp;
                                        Simpan
                                    </LinkButton>
                                    <LinkButton plain
                                                disabled={editingItem == null}
                                                onClick={() => tableRef?.cancelEdit()}
                                    >
                                        <i className="la la-times"></i>
                                        &nbsp;
                                        Batal
                                    </LinkButton>
                                    <LinkButton plain
                                                onClick={handleDelete}
                                                disabled={(mode === 'add' || mode === 'edit') || !selection?.id_antrian}
                                    >
                                        <i className="la la-trash"></i>
                                        &nbsp;
                                        Hapus
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
                    onEditCancel={onEditCancel}
                    onEditEnd={onEditEnd}
                />
            </daftarNomorKosongContext.Provider>
        </>
    )
};

export default withRouter(AngketPelangganList);