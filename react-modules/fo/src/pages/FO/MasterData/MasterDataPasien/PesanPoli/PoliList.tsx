import React, { useState, useEffect, useCallback } from 'react';
import Metadata from '../../../../../pojo/Metadata';
// import customForm from '../../../../../assets/js/customForm';
import Table from '../../../../../components/Table/Table';
import dataPasienService from '../../../../../services/master_datapasien.service';
import moment from 'moment';
import { LinkButton, TextBox, Tooltip, DateBox, TimeSpinner } from 'rc-easyui';
import '../../../../../assets/js/moment-locale/id.js';
import _ from 'lodash';
import EasyUISelectPoli from '../../../../../components/Shared/EasyUI/EasyUISelectPoli';
import EasyUISelectDokter from '../../../../../components/Shared/EasyUI/EasyUISelectDokter';
import poliContext from '../../../../../stores/context/poliContext';
import EasyUITextBoxNoAntri from '../../../../../components/Shared/EasyUI/EasyUITextBoxNoAntri';
import { NotifySuccess } from '../../../../../services/notification.service';

interface Props {
    id_mr: number;
    onSelection?: (e: any) => void;
}
 
const useListDataRencanaKontrol: any = () => {
    return [
        {
            id: 'tgl_rencana',
            title: 'Tanggal',
            width: "30px",
            editable: true,
            editor: ({row, error}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                           <DateBox 
                                format={'dd/MM/yyyy'}
                                value={row?.tgl_rencana}
                            />
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required'],
            render: ({row}: any) => {
                return (
                    <>
                        {moment(row?.tgl_rencana).format('DD-MM-YYYY')}
                    </>
                )
            }
        },
        {
            id: 'jam',
            title: 'Jam',
            width: "25px",
            editable: true,
            editor: ({row, error}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <TimeSpinner inputId="t1" value={row?.jam}></TimeSpinner>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'hari',
            title: 'Hari',
            width: "25px",
            editable: true,
            editor: ({row, error}: any) => {
                return (
                    <>
                        <Tooltip content={error} tracking>
                            <TextBox inputId={'day-input'} disabled/>
                        </Tooltip>
                    </>
                )
            }
        },
        {
            id: 'klinik',
            title: 'Klinik',
            width: "25px",
            editable: true,
            editor: ({row, error}: any) => {
                return(
                    <>
                        <EasyUISelectPoli
                            error={error}
                            value={row?.klinik}
                        />
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'dokter',
            title: 'Dokter',
            width: "25px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return(
                    <>
                        <EasyUISelectDokter
                            error={error}
                            value={row?.dokter}
                            // id_kamar={row?.klinik}
                            index={rowIndex}
                        />
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'no_antri',
            title: 'No.Antri',
            width: "25px",
            editable: true,
            editor: ({row, error, rowIndex}: any) => {
                return(
                    <>
                        <EasyUITextBoxNoAntri
                            error={error}
                            value={row?.no_antri}
                            index={rowIndex}
                        />
                    </>
                )
            },
            editRules: ['required']
        },
        {
            id: 'keterangan',
            title: 'Keterangan',
            width: "25px",
            editable: true,
            editor: ({row, error}: any) => {
                return(
                    <>
                        <Tooltip content={error} tracking>
                            <TextBox value={row?.keterangan}/>
                        </Tooltip>
                    </>
                )
            },
            editRules: ['required']
        }
    ]
}

moment.locale('id');
const PoliList: React.FC<Props> = (props: Props) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [mode, setMode] = useState<string>('');

    
    const [data, setData] = useState<Array<any>>([]);
    const [meta, setMeta] = useState<Metadata>({});

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);
    const [tableRef, setTableRef] = useState<any>(null); 

    const [selection, setSelection] = useState<any>();

    let listDataRencanaKontrol = useListDataRencanaKontrol();

    const getListRencanaKontrol = async () => {
        try {
            setLoading(true);
            setSelection(null);
            const payload = {
                id_mr: props?.id_mr
            }
            const resp = await dataPasienService.tpp_rencanakontrol_datarencanakontrol(payload);
            resp.list.map((element) => {
                element.tgl_rencana = moment(element.tgl_rencana).format('DD/MM/YYYY');
                element.jam = element.jam? moment(element.jam).format('HH:mm'): '';

                return element
            })

            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);

        } catch (e) {
            console.log('error', e);
            setLoading(false);
        }
    };

    const addNewData = () => {
        const detailData = {
            tgl_rencana: '',
            jam: '00:00',
            hari: '',
            klinik: '',
            dokter: '',
            no_antri: '',
            keterangan: '',
            _new: true
        }

        const currentData = Array.from(data);
        currentData.unshift(detailData);
        setData(currentData);
        setMode('add');
    }

    const onTableAction = (e: any) => {
        setPageSize(e?.pageSize);
        setPageNumber(e?.setPageNumber);

        if(mode === 'add' || mode === 'edit') {
            tableRef?.cancelEdit();
        }


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            getListRencanaKontrol();
        }
    };

    const onEditBegin = (e: any) => {
    }

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
                    id_mr: Number(props?.id_mr),
                    id_mrs: Number(props?.id_mr),
                    id_kamar: event?.row?.klinik,
                    tgl_rencana: moment(event?.row?.tgl_rencana).format('YYYY-MM-DD'),
                    hari: event?.row?.hari,
                    jam: event?.row?.jam,
                    poli: event?.row?.klinik,
                    dokter: event?.row?.dokter,
                    no_antri: event?.row?.no_antri,
                    keterangan: event?.row?.keterangan
                }
                const resp = await dataPasienService.tpp_rencanakontrol_insert(payload);
                if(resp?.metadata && !resp?.metadata?.error) {
                    getListRencanaKontrol();
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

    const onEditValidate = (event: any) => {
        const newData = _.map(data, (item: any, index: number) => {
            if(index === 0) {
                if(item.tgl_rencana) {
                    item.hari = moment(item?.tgl_rencana).format('dddd');

                    const inputElement: HTMLInputElement = document.getElementById('day-input') as HTMLInputElement;
                    inputElement.value = moment(item?.tgl_rencana).format('dddd');
                }
            }
            return item;
        })
        
        setData(newData);
    }

    const onSelectionChange = useCallback((e: any) => {
        setSelection(e);
        if(props.onSelection)
            props?.onSelection(e);
        console.log(e)
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props]);

    const onLoadTableRef = (ref: any) => {
        // tableRef = ref;
        setTableRef(ref)
    }

    useEffect(() => {
        getListRencanaKontrol();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props?.id_mr]);

    useEffect(() => {
        if(tableRef !== null && mode === 'add' ) {
            tableRef?.beginEdit(data[0]);
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [data, mode]);

    return (
        <>
            <poliContext.Provider value={[data,setData]}>
                <Table
                    tableType={'kt-table--no-margin'}
                    title={'Daftar Rencana Kontrol'}
                    columns={listDataRencanaKontrol}
                    data={data}
                    loading={loading}
                    // toolbar={props.toolbar}
                    isPaginate={true}
                    total={meta.list_count}
                    pageNumber={pageNumber}
                    pageSize={pageSize}
                    editable={!loading}
                    onTableAction={onTableAction}
                    height={400}
                    toolbar={({editingItem}: any) => {
                        return(
                            <div style={{padding: 4}}>
                                <LinkButton plain
                                            disabled={(mode === 'add' || mode === 'edit')}
                                            onClick={() => addNewData()}
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
                            </div>
                            
                        )
                    }}
                    selectionMode={'single'}
                    selection={selection}
                    onSelectionChange={onSelectionChange}
                    onLoadTableRef={(ref) => onLoadTableRef(ref) }
                    onEditCancel={onEditCancel}
                    onEditEnd={onEditEnd}
                    onEditValidate={onEditValidate}
                    onEditBegin={onEditBegin}
                />
            </poliContext.Provider>
        </>
    )
}

export default PoliList;