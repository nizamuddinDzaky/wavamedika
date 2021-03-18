import React, { useState, useEffect, useCallback } from 'react';
import Metadata from '../../../../pojo/Metadata';
import Table from "../../../../components/Table/Table";
import { RouteComponentProps, withRouter } from 'react-router';
import { Tooltip, LinkButton, TextBox } from 'rc-easyui';
import { NotifySuccess } from '../../../../services/notification.service';
import master_fasilitas_kerjasamaService from '../../../../services/master_fasilitas_kerjasama.service';

const useDataFasilitasKerjasamaColumn = () => {
    return [
        {
            id: 'nama_fasilitas',
            title: 'Nama Fasilitas',
            width: "50px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <TextBox value={row?.nama_fasilitas}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'keterangan',
            title: 'Keterangan',
            width: "80px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <TextBox value={row?.keterangan}/>
                        </Tooltip>
                    </>
                )
            }
        },
    ];
}

type IProps = RouteComponentProps & {
    onTableAction?: (e: any) => void;
}

const MasterDataFasilitasKerjasamaList: React.FC<IProps> = (props: IProps) => {
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
                halaman: page? page: pageNumber,
                batas: limit? limit: pageSize,
            }

            const resp = await master_fasilitas_kerjasamaService.mkt_masterfasilitas_masterfasilitas(payload);
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
                console.log('event?', event?.row);
                const payload = {
                    nama_fasilitas: event?.row?.nama_fasilitas,
                    keterangan: event?.row?.keterangan,
                }
                const resp = await master_fasilitas_kerjasamaService.mkt_masterfasilitas_insert(payload);
                if(resp?.metadata && !resp?.metadata?.error) {
                    getData();
                    setMode('');
                    NotifySuccess('Data Fasilitas Kerjasama', resp?.metadata?.message)
                };
            }
        } catch(e) {
            console.log('error', e);
            setLoading(false);

            if(mode === 'add') {
                tableRef?.beginEdit(data[0]);
            }
        }
    }

    const listDataFasilitasKerjasamaColumn = useDataFasilitasKerjasamaColumn();

    const handleRefresh = () => {
        getData();
    }

    const handleDelete = async () => {
        try {
            setLoading(true);
            const payload = {
                id_fasilitas: selection?.id_fasilitas
            }

            const resp = await master_fasilitas_kerjasamaService.mkt_masterfasilitas_delete(payload);

            if(resp?.metadata && !resp?.metadata?.error) {
                getData();
                setMode('');
                NotifySuccess('Data Angket Pelanggan', resp?.metadata?.message)
            };

        } catch(error) {
            console.log('error', error);

            setLoading(false);
        }
    }

    

    const handleAdd = () => {
        const detailData = {
            aktif: '1',
            indeks: 0,
            uraian: '',
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
    }, [])

    useEffect(() => {
        if(tableRef && tableRef !== null && mode === 'add' ) {
            tableRef?.beginEdit(data[0]);
            // console.log('data', data)
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [data, mode]);
    return(
        <>
            {/* <CustomDialog
                sizing={'medium'}
                title={'Info Pasien'}
                ref={infoPasienRef}
            >
                {
                    infoPasienRef.current && selection?.id_mr &&
                        <InfoPasien
                            id_mr={selection.id_mr}
                        ></InfoPasien>
                }
            </CustomDialog> */}
            <Table
                isLazy
                title={'Daftar Fasilitas Kerjasama'}
                columns={listDataFasilitasKerjasamaColumn}
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
                                            disabled={!selection?.id_fasilitas}
                                >
                                    <i className="la la-trash"></i>
                                    &nbsp;
                                    Hapus
                                </LinkButton>

                                <LinkButton plain
                                            onClick={handleRefresh}
                                            disabled={(mode === 'add' || mode === 'edit')}
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

export default withRouter(MasterDataFasilitasKerjasamaList);