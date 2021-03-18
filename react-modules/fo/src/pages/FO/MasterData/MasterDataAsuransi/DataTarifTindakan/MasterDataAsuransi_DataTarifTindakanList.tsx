import React, { useState, useEffect, useCallback } from 'react';
import Metadata from '../../../../../pojo/Metadata';
import Table from "../../../../../components/Table/Table";
import { RouteComponentProps, withRouter } from 'react-router';
import { Tooltip, LinkButton, TextBox, NumberBox, CheckBox } from 'rc-easyui';
import { NotifySuccess } from '../../../../../services/notification.service';
import master_asuransiService from '../../../../../services/master_asuransi.service';
import EasyUISelectJenisTindakan from '../../../../../components/Shared/EasyUI/EasyUISelectJenisTindakan';

const useDataTarifTindakanColumn = ({handleRowCheck}: {handleRowCheck: (row: any, checked: any) => void}) => {
    return [
        {
            id: 'aktif',
            title: 'Aktif',
            width: "40px",
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
            id: 'kode_tindakan',
            title: 'Kode',
            width: "150px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <TextBox value={row?.kode_tindakan}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'nama_tindakan',
            title: 'Nama Tindakan',
            width: "250px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <TextBox value={row?.nama_tindakan}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'jenis',
            title: 'Jenis',
            width: "200px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <EasyUISelectJenisTindakan
                            error={error}
                            value={row?.jenis}
                        />
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'tarif',
            title: 'Tarif',
            width: "100px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.tarif}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'vvip',
            title: 'VVIP',
            width: "100px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.tarif}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'vip',
            title: 'VIP',
            width: "100px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.tarif}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'vipa',
            title: 'VIPA',
            width: "100px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.tarif}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'vipb',
            title: 'VIPB',
            width: "100px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.tarif}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'i',
            title: 'I',
            width: "100px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.tarif}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'ii',
            title: 'II',
            width: "100px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.tarif}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'iii',
            title: 'III',
            width: "100px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.tarif}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'iiia',
            title: 'IIIA',
            width: "100px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.tarif}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'iiib',
            title: 'IIIB',
            width: "100px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.tarif}/>
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
    kode_instansi?: string;
}

const MasterDataAsuransi_DataTarifTindakanList: React.FC<IProps> = (props: IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [showActive] = useState<boolean>(props?.aktif); 
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
                aktif: showActive? 1: 0,
                kode_instansi: props?.kode_instansi? props.kode_instansi: 'BPJS'
            }

            const resp = await master_asuransiService.mkt_masterasuransi_masterasuransitarif(payload);
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
                    aktif: event?.row?.aktif,
                    kode_instansi: props?.kode_instansi,
                    kode_tindakan: event?.row?.kode_tindakan,
                    nama_tindakan: event?.row?.nama_tindakan,
                    jenis: event?.row?.jenis,
                    tarif: event?.row?.tarif,
                    vvip: event?.row?.vvip,
                    vip: event?.row?.vip,
                    vipa: event?.row?.vipa,
                    vipb: event?.row?.vipb,
                    i: event?.row?.i,
                    ii: event?.row?.ii,
                    iii: event?.row?.iii,
                    iiia: event?.row?.iiia,
                    iiib: event?.row?.iiib,

                    // indeks: event?.row?.indeks,
                    // uraian: event?.row?.uraian,
                }
                const resp = await master_asuransiService.mkt_masterasuransi_insert_asuransitarif(payload);
                if(resp?.metadata && !resp?.metadata?.error) {
                    getData();
                    setMode('');
                    NotifySuccess('Data Tarif Tindakan', resp?.metadata?.message)
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

    const listDataTarifTindakanColumn = useDataTarifTindakanColumn({handleRowCheck});

    const handleRefresh = () => {
        getData();
    }

    const handleDelete = async () => {
        try {
            setLoading(true);
            const payload = {
                id_instansitarif: selection?.id_instansitarif
            }

            const resp = await master_asuransiService.mkt_masterasuransi_delete_asuransitarif(payload);

            if(resp?.metadata && !resp?.metadata?.error) {
                getData();
                setMode('');
                NotifySuccess('Data Tarif Tindakan', resp?.metadata?.message)
            };

        } catch(error) {
            console.log('error', error);

            setLoading(false);
        }
    }

    

    const handleAdd = () => {
        // props.history.push('/fo/master-data/asuransi/data-tarif-tindakan/add');
        const detailData = {
            aktif: '1',
            kode_tindakan: '',
            nama_tindakan: '',
            jenis: '',
            tarif: '',
            vvip: 0,
            vip: 0,
            vipa: 0,
            vipb: 0,
            i: 0,
            ii: 0,
            iii: 0,
            iiia: 0,
            iiib: 0,
            _new: true
        }

        const currentData = Array.from(data);
        currentData.unshift(detailData);
        setData(currentData);
        setMode('add');
    }

    // const handleChange = () => {
    //     // props.history.push('/fo/master-data/asuransi/data-tarif-tindakan/'+ selection?.kode_instansi);
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
        setPageNumber(1)
        getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [showActive])

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
                ref={formAddAsuransi}
            >
                {
                    formAddAsuransi.current &&
                        // <InfoPasien
                        //     id_mr={selection.id_mr}
                        // ></InfoPasien>
                        <div>123</div>
                }
            </CustomDialog> */}
            <Table
                isLazy
                title={`Data Tarif Tindakan Asuransi: ${props.kode_instansi}`}
                columns={listDataTarifTindakanColumn}
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
                            {/* <div style={{ padding: 8 }} >
                                <FormControlLabel
                                    control={
                                        <Switch
                                            checked={showActive}
                                            onChange={() => setShowActive(!showActive)}
                                            name="showActive"
                                            color="primary"
                                        />
                                    }
                                    label={`Menampilkan data tarif tindakan ${showActive? 'aktif': 'tidak aktif'}`}
                                />
                            </div> */}
                            <div style={{padding: 4}}>
                                <LinkButton plain
                                            disabled={(mode === 'add' || mode === 'edit')}
                                            onClick={() => handleAdd()}
                                >
                                    <i className="flaticon-edit-1"></i>
                                    &nbsp;
                                    Tambah
                                </LinkButton>
                                {/* <LinkButton plain
                                            disabled={!selection?.id_instansitarif}
                                            onClick={() => handleChange()}
                                >
                                    <i className="flaticon-edit-1"></i>
                                    &nbsp;
                                    Ubah
                                </LinkButton> */}
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
                                            disabled={(mode === 'add' || mode === 'edit') || !showActive || !selection?.id_instansitarif}
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

export default withRouter(MasterDataAsuransi_DataTarifTindakanList);