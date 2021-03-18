import React, { useState, useEffect, useCallback, useRef } from 'react';
import Metadata from '../../../../../pojo/Metadata';
import Table from "../../../../../components/Table/Table";
import { RouteComponentProps, withRouter } from 'react-router';
import { Tooltip, LinkButton, TextBox, CheckBox } from 'rc-easyui';
import { FormControlLabel, Switch } from '@material-ui/core';
import { NotifySuccess } from '../../../../../services/notification.service';
import master_asuransiService from '../../../../../services/master_asuransi.service';
import CustomDialog from '../../../../../components/Dialog/CustomDialog';
import KartuAsuransi from './KartuAsuransi/KartuAsuransi';

const useDataAsuransiColumn = ({handleRowCheck}: {handleRowCheck: (row: any, checked: any) => void}) => {
    return [
        {
            id: 'aktif',
            title: 'Aktif',
            width: "8px",
            align: 'center',
            field: 'ck',
            render: ({ row }: any) => (
                <CheckBox disabled checked={row.aktif === '1'} onChange={(checked: any) => handleRowCheck(row, checked)}></CheckBox>
            ),
            editable: false,
            // editor: ({row, error, rowIndex}: any) => {
            //     return (
            //         <>
            //             <Tooltip content={error} tracking>
            //                 <CheckBox value={row?.aktif === '1'} min={0}/>
            //             </Tooltip>
            //         </>
            //     )
            // }
        },
        {
            id: 'kode_instansi',
            title: 'Asuransi',
            width: "40px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <TextBox value={row?.kode_instansi}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'nama_instansi',
            title: 'Nama Lengkap',
            width: "50px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <TextBox value={row?.nama_instansi}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'alamat',
            title: 'Alamat',
            width: "80px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <TextBox value={row?.alamat}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'kota',
            title: 'Kota/Kabupaten',
            width: "20px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <TextBox value={row?.kota}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },

    ];
}

type IProps = RouteComponentProps & {
    onTableAction?: (e: any) => void;
    aktif: boolean;
}

const MasterDataAsuransi_DataAsuransiList: React.FC<IProps> = (props: IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [showActive, setShowActive] = useState<boolean>(props?.aktif); 
    const [data, setData] = useState<Array<any>>([]);
    const [mode, setMode] = useState<string>('');

    const [meta, setMeta] = useState<Metadata>({});
    const [selection, setSelection] = useState<any>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);


    const [tableRef, setTableRef] = useState<any>(null); 

    const viewKartuAsuransiRef: any = useRef(null);

    const getData = async (limit?: number, page?: number ) => {
        try {
            setLoading(true);
            setSelection(null);

            const payload = {
                halaman: page? page: pageNumber,
                batas: limit? limit: pageSize,
                aktif: showActive? 1: 0
            }

            const resp = await master_asuransiService.mkt_masterasuransi_masterasuransi(payload);
            if(resp && Array.isArray(resp.list) && resp.list.length >0) {
                setData(resp.list);
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
                    // indeks: event?.row?.indeks,
                    // uraian: event?.row?.uraian,
                }
                const resp = await master_asuransiService.mkt_instansi_insert(payload);
                if(resp?.metadata && !resp?.metadata?.error) {
                    getData();
                    setMode('');
                    NotifySuccess('Data Rencana Kontrol', resp?.metadata?.message)
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

    const listDataAsuransiColumn = useDataAsuransiColumn({handleRowCheck});

    const handleRefresh = () => {
        getData();
    }

    // const handleDelete = async () => {
    //     try {
    //         setLoading(true);
    //         const payload = {
    //             id_jnsangketpelanggan: selection?.id_jnsangketpelanggan
    //         }

    //         // const resp = await master_asuransiService.mkt_masterangketpelanggan_delete(payload);

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

    

    const handleAdd = () => {
        props.history.push('/fo/master-data/asuransi/data-asuransi/add');
    }

    const handleChange = () => {
        props.history.push('/fo/master-data/asuransi/data-asuransi/'+ selection?.kode_instansi);
    }

    const handleDaftarTarifTindakan = () => {
        props.history.push('/fo/master-data/asuransi/data-tarif-tindakan/'+ selection?.kode_instansi);
    }

    const handleViewKartuAsuransi = () => {
        viewKartuAsuransiRef?.current?.open();
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
        setPageNumber(1)
        getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [showActive])

    // useEffect(() => {
    //     if(tableRef && tableRef !== null && mode === 'add' ) {
    //         tableRef?.beginEdit(data[0]);
    //         // console.log('data', data)
    //     }

    //     // eslint-disable-next-line react-hooks/exhaustive-deps
    // }, [data, mode]);
    return(
        <>
            <CustomDialog
                sizing={'medium'}
                title={'Kartu Asuransi'}
                ref={viewKartuAsuransiRef}
            >
                {
                    viewKartuAsuransiRef.current &&
                        // <InfoPasien
                        //     id_mr={selection.id_mr}
                        // ></InfoPasien>
                        <KartuAsuransi
                            kode_instansi={selection?.kode_instansi}
                        />
                }
            </CustomDialog>
            <Table
                isLazy
                title={'Data Asuransi'}
                columns={listDataAsuransiColumn}
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
                            <div style={{ padding: 8 }} >
                                <FormControlLabel
                                    control={
                                        <Switch
                                            checked={showActive}
                                            onChange={() => setShowActive(!showActive)}
                                            name="showActive"
                                            color="primary"
                                        />
                                    }
                                    label={`Menampilkan data asuransi ${showActive? 'aktif': 'tidak aktif'}`}
                                />
                            </div>
                            <div style={{padding: 4}}>
                                <LinkButton plain
                                            // disabled={(mode === 'add' || mode === 'edit')}
                                            onClick={() => handleAdd()}
                                >
                                    <i className="flaticon-edit-1"></i>
                                    &nbsp;
                                    Tambah
                                </LinkButton>
                                <LinkButton plain
                                            disabled={!selection?.kode_instansi}
                                            onClick={() => handleChange()}
                                >
                                    <i className="flaticon-edit-1"></i>
                                    &nbsp;
                                    Ubah
                                </LinkButton>
                                <LinkButton plain
                                            disabled={!selection?.kode_instansi}
                                            onClick={() => handleDaftarTarifTindakan()}
                                >
                                    <i className="flaticon-edit-1"></i>
                                    &nbsp;
                                    Daftar Tarif Tindakan
                                </LinkButton>
                                <LinkButton plain
                                            disabled={!selection?.kode_instansi}
                                            onClick={() => handleViewKartuAsuransi()}
                                >
                                    <i className="flaticon-edit-1"></i>
                                    &nbsp;
                                    View Kartu Asuransi
                                </LinkButton>

                                {/* <LinkButton plain
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
                                </LinkButton> */}

                                {/* <LinkButton plain
                                            onClick={handleDelete}
                                            disabled={!showActive || !selection?.id_jnsangketpelanggan}
                                >
                                    <i className="la la-trash"></i>
                                    &nbsp;
                                    Hapus
                                </LinkButton> */}

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
                onDoubleClickCell={handleChange}
            />
        </>
    )
};

export default withRouter(MasterDataAsuransi_DataAsuransiList);