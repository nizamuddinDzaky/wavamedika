import React, { useState, useEffect, useCallback } from 'react';
import Metadata from '../../../../pojo/Metadata';
import Table from "../../../../components/Table/Table";
import { RouteComponentProps, withRouter } from 'react-router';
import master_angket_pelangganService from '../../../../services/master_angket_pelanggan.service';
import { Tooltip, LinkButton, TextBox, NumberBox, CheckBox } from 'rc-easyui';
import { FormControlLabel, Switch } from '@material-ui/core';
import { NotifySuccess } from '../../../../services/notification.service';

const useDataAngketPelangganColumn = ({handleRowCheck}: {handleRowCheck: (row: any, checked: any) => void}) => {
    return [
        {
            id: 'aktif',
            title: 'Aktif',
            width: "4px",
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
            id: 'indeks',
            title: 'Indeks',
            width: "10px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.indeks} min={0}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'uraian',
            title: 'Uraian',
            width: "80px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <TextBox value={row?.uraian}/>
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

const MasterDataAngketPelangganList: React.FC<IProps> = (props: IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [showActive, setShowActive] = useState<boolean>(props?.aktif); 
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
                aktif: showActive? 1: 0
            }

            const resp = await master_angket_pelangganService.mkt_masterangketpelanggan_masterangketpelanggan(payload);
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
                    indeks: event?.row?.indeks,
                    uraian: event?.row?.uraian,
                }
                const resp = await master_angket_pelangganService.mkt_masterangketpelanggan_insert(payload);
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

    const listDataAngketPelangganColumn = useDataAngketPelangganColumn({handleRowCheck});

    const handleRefresh = () => {
        getData();
    }

    const handleDelete = async () => {
        try {
            setLoading(true);
            const payload = {
                id_jnsangketpelanggan: selection?.id_jnsangketpelanggan
            }

            const resp = await master_angket_pelangganService.mkt_masterangketpelanggan_delete(payload);

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
                title={'Data Angket Pelanggan'}
                columns={listDataAngketPelangganColumn}
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
                                    label={`Menampilkan data angket pelanggan ${showActive? 'aktif': 'tidak aktif'}`}
                                />
                            </div>
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
                                            disabled={!showActive || !selection?.id_jnsangketpelanggan}
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

export default withRouter(MasterDataAngketPelangganList);