import React, { useState, useEffect, useCallback } from 'react';
import Metadata from '../../../../../pojo/Metadata';
import Table from "../../../../../components/Table/Table";
import { RouteComponentProps, withRouter } from 'react-router';
import { LinkButton, Tooltip, ComboBox, TextBox, CheckBox} from 'rc-easyui';
import { NotifySuccess } from '../../../../../services/notification.service';
import angket_pelangganService from '../../../../../services/angket_pelanggan.service';
import EasyUISelectKategoriKekurangan from '../../../../../components/Shared/EasyUI/EasyUISelectKategoriKekurangan';

const useColumn = () => {
    return [
        {
            id: 'kategori',
            title: 'Kategori',
            width: "50px",
            editable: true,
            editor: ({row, error}: any) => {
                return (
                    <EasyUISelectKategoriKekurangan
                        value={row?.kategori}
                        error={error}
                    />
                )
            },
            editRules: ['required']
        },
        {
            id: 'tanggapan',
            title: 'Tanggapan',
            width: "50px",
            editable: true,
            editor: ({row, error}: any) => {
                return (
                    <Tooltip tracking>
                        <ComboBox
                            value={row?.tanggapan}
                            data={[
                                {
                                    value: 'Baik',
                                    text: 'Baik',
                                },
                                {
                                    value: 'Kurang',
                                    text: 'Kurang',
                                },
                            ]}
                        />
                    </Tooltip>
                )
            },
            editRules: ['required']
        },
        {
            id: 'komentar',
            title: 'Komentar',
            width: "100px",
            editable: true,
            editor: ({row, error}: any) => {
                return (
                    <Tooltip tracking>
                        <TextBox value={row?.komentar}/>
                    </Tooltip>
                )
            },
            editRules: ['required']
        },
        {
            id: 'solusi',
            title: 'Solusi',
            width: "30px",
            align: 'center',
            field: 'ck',
            editor: ({ row }: any) => {
                return (
                    <Tooltip tracking>
                        <CheckBox checked={row?.solusi === '1' || row?.solusi === true}></CheckBox>
                    </Tooltip>  
                )
            },
            render: ({ row }: any) => {
                return (
                    <Tooltip tracking>
                        <CheckBox disabled checked={row?.solusi === '1' || row?.solusi === true}></CheckBox>
                    </Tooltip>  
                )
            },
            editable: true,
        },
        {
            id: 'penanganan',
            title: 'Penanganan',
            width: "80px",
            editable: true,
            editor: ({row, error}: any) => {
                return (
                    <Tooltip tracking>
                        <TextBox value={row?.penanganan}/>
                    </Tooltip>
                )
            },
            editRules: ['required']
        },
    ];
}

type IProps = RouteComponentProps & {
    onTableAction?: (e: any) => void;
    id_angketpelanggan: number;

}

const KategoriKekuranganList: React.FC<IProps> = (props: IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);
    const [mode, setMode] = useState<string>('');

    const [meta, setMeta] = useState<Metadata>({});
    const [selection, setSelection] = useState<any>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);


    const [tableRef, setTableRef] = useState<any>(null);

    const getData = async (limit?: number, page?: number ) => {
        try {
            setLoading(true);
            setSelection(null);
            const payload = {
                id_angketpelanggan: props?.id_angketpelanggan
            }

            const resp = await angket_pelangganService.mkt_angketpelanggan_view_datakekurangan(payload);
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
                const payload = {
                    id_angketpelanggan: props?.id_angketpelanggan,
                    kategori: event?.row?.kategori,
                    kategori_bk: event?.row?.tanggapan,
                    perbaikan: event?.row?.perbaikan,
                    solusi: event?.row?.solusi? 1: 0,
                    penanganan: event?.row?.penanganan
                }
                const resp = await angket_pelangganService.mkt_angketpelanggan_insert_kekurangan(payload);
                if(resp?.metadata && !resp?.metadata?.error) {
                    NotifySuccess('Data Kategori Kekurangan', resp?.metadata?.message)
                };

                getData();
                setMode('');
            } else if(mode === 'edit') {
                const payload = {
                    id_angketpelanggan_kategori: event?.row?.id_angketpelanggan_kategori,
                    id_angketpelanggan: event?.row?.id_angketpelanggan,
                    kategori: event?.row?.kategori,
                    kategori_bk: event?.row?.tanggapan,
                    perbaikan: event?.row?.perbaikan,
                    solusi: event?.row?.solusi? 1: 0,
                    penanganan: event?.row?.penanganan
                }
            
                const resp = await angket_pelangganService.mkt_angketpelanggan_update_kekurangan(payload);

                if(resp?.metadata && !resp?.metadata?.error) {
                    NotifySuccess('Data Kategori Kekurangan', resp?.metadata?.message)
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
        setMode('edit');
        
        if(Array.isArray(data) && data.length > 0) {
            tableRef?.beginEdit(selection)
        }
        
    }

    const handleDelete = async () => {
        try {
            setLoading(true);
            const payload = {
                id_angketpelanggan_kategori: selection?.id_angketpelanggan_kategori
            }

            const resp = await angket_pelangganService.mkt_angketpelanggan_delete_kekurangan(payload);

            if(resp?.metadata && !resp?.metadata?.error) {
                NotifySuccess('Data Kategori Kekurangan', resp?.metadata?.message)
            };

            getData();
            setMode('');

        } catch(error) {
            console.log('error', error);

            setLoading(false);
        }
    }

    

    const handleAdd = () => {
        const detailData = {
            kategori: '',
            tanggapan: '',
            komentar: '',
            solusi: '',
            penanganan: '',
            _new: true
        }

        const currentData = Array.from(data);
        currentData.unshift(detailData);
        setData(currentData);
        setMode('add');
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
    }, [props?.id_angketpelanggan])

    useEffect(() => {
        if(tableRef && tableRef !== null && mode === 'add' ) {
            tableRef?.beginEdit(data[0]);
            // console.log('data', data)
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [data, mode]);
    return(
        <>
            <Table
                tableType={'kt-margin-r-0'}
                isLazy
                title={'Daftar Ketegori Kekurangan'}
                columns={listColumn}
                data={data}
                loading={loading}
                disableNumber
                isPaginate={false}
                height={150}
                minHeight={150}
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
                                            disabled={(mode === 'add' || mode === 'edit') || !selection?.id_angketpelanggan_kategori}
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
                                            disabled={(mode === 'add' || mode === 'edit') || !selection?.id_angketpelanggan_kategori}
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
        </>
    )
};

export default withRouter(KategoriKekuranganList);