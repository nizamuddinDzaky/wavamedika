import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import Metadata from "../../../../pojo/Metadata";
import customForm from "../../../../assets/js/customForm";
import dataDiitService from "../../../../services/giz_masterdiet.service";
import {LinkButton, TextBox, Tooltip} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import {detailJenisDiet} from "../../../../pojo/giz_masterdiet/jenisdiet";

const useListDataDiitByPenyakit: any = () => {
    return [
        {
            id: 'jns_diet',
            title: 'Kode',
            width: "20px",
            editable: true,
            editor: ({ row,error }: any) => (
                <>
                    <Tooltip content={error} tracking>
                        <TextBox
                            value={row?.jns_diet}/>
                    </Tooltip>

                </>
            ),
            editRules: ['required']
        },
        {
            id: 'keterangan',
            title: 'Keterangan',
            width: "80px",
            editable: true,
            editor: ({ row,error }: any) => (
                <>
                    <Tooltip content={error} tracking>
                        <TextBox
                            value={row?.keterangan}/>
                    </Tooltip>

                </>
            ),
            editRules: ['required']
        },
        {
            id: 'warna',
            title: 'Warna',
            width: "50px",
            editable: true,
            editor: ({ row,error }: any) => (
                <>
                    <Tooltip content={error} tracking>
                        <TextBox
                            value={row?.keterangan}/>
                    </Tooltip>

                </>
            ),
            editRules: ['required']
        },
        {
            id: 'kode_warna',
            title: 'Kode Warna',
            width: "50px",
            editable: true,
            editor: (props: any) => {
                console.log('props', props);
                return (
                    <>
                        <div className={'col-4'}>
                            <TextBox
                                value={props.row?.kode_warna}
                                // inputId={'color1'}
                                inputCls={'color1'}

                            />
                        </div>
                        <div className={'col-4'}>
                            <TextBox
                                inputCls={'color-picker color2'}
                                value={props.row?.kode_warna}
                                // inputId={''}

                            />
                        </div>
                    </>
                )
            },
            editRules: ['required']
        },
    ];
};

interface IProps {
    onTableAction?: (e: any) => void;
}

const ListDataDiitByPenyakit: React.FC<IProps> = (props:IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailJenisDiet>>([]);
    const [mode, setMode] = useState<string>('');

    const [meta, setMeta] = useState<Metadata>({});
    const [pageSize] = useState<number>(10);
    const [pageNumber] = useState<number>(1);

    const [selection, setSelection] = useState();


    let tableRef: any = useRef(null);

    const toolBar = ({editingItem}: any) => {
        return(
            <div style={{padding: 4}}>
                <LinkButton plain
                            disabled={(mode === 'add' || mode === 'edit')}
                            onClick={() => addNewData()}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Tambah
                </LinkButton>
                <LinkButton plain
                            disabled={
                                (mode === 'add' || mode === 'edit') ||
                                !selection
                            }
                            onClick={() => removeData()}
                >
                    <i className="flaticon2-trash"></i>
                    &nbsp;
                    Hapus
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
    };

    const addNewData = async () => {
        // await loadDataComboBox();

        const detailData = {
            diet: '',
            keterangan: '',
            kode_warna: '#FFFFFF',
            _new: true
        };

        const currentData = Array.from(data);
        currentData.unshift(detailData);
        setData(currentData);
        setMode('add');
        // tableRef?.beginEdit(data[0]);
    };

    const getData = async () => {
        try {
            setLoading(true);
            const resp = await dataDiitService.jenisdiet();
            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);

        } catch (e) {
            setLoading(false);
            setData([]);
        }
    };

    const removeData = async () => {
        try {
            setLoading(false);

            const data = {
                id_jnsdiet: selection.id_jnsdiet,
            };
            const resp = await dataDiitService.delete_jenisdiet(data);

            if(resp?.metadata && !resp?.metadata?.error) {
                getData();
                setMode('');
                NotifySuccess('Data Diit Gizi', resp?.metadata?.message)
            };
        } catch(e) {
            console.log('error', e);
            setLoading(false);
        }
    };


    const onTableAction = async (e: any) => {
        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            tableRef?.cancelEdit();

            getData();
        }

        if(props.onTableAction) {
            props.onTableAction(e)
        }

        new (customForm as any)(tableRef,'color1', 'color2' ); // for tab on enter, inside table ref
    };
    const onLoadTableRef = (ref: any) => {
        tableRef = ref;
        new (customForm as any)(tableRef,'color1', 'color2' ); // for tab on enter, inside table ref
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
                    jns_diet: event?.row?.jns_diet,
                    keterangan: event?.row?.keterangan,
                    warna: event?.row?.warna,
                    kode_warna: event?.row?.kode_warna.toString().toUpperCase(),

                };
                const resp = await dataDiitService.insert_jenisdiet(payload);
                if(resp?.metadata && !resp?.metadata?.error) {
                    getData();
                    setMode('');
                    NotifySuccess('Data Diit', resp?.metadata?.message)
                }
            } else if(mode === 'edit') {
                // const data = {
                //
                // };
                // const resp = await transactionService.insert(data);
                // listTransaksi();
            } else {

            }
        } catch (e) {
            console.log('error', e);
            setLoading(false);

            if(mode === 'add') {
                tableRef?.beginEdit(data[0]);
            }
        }
    };

    const listDataDiitByPenyakit = useListDataDiitByPenyakit();

    const mounted:any = useRef();
    useEffect(() => {
        if (!mounted.current) {
            mounted.current = true;
            getData();
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    });

    useEffect(() => {
        if(mode === 'add') {
            tableRef?.beginEdit(data[0]);
        }
    }, [data, mode]);


    const onEditValidate = (ev: any) => {
        console.log('ev', ev);
        // let row = Object.assign({}, ev.row);
        // let newData = data.slice();
        // let index = newData.indexOf(ev.row);
        // newData.splice(index, 1, row);

        // console.log('newData', ev);
        // if(!ev.errors) {
        //
        //
        // }


        // setData(newData);

        // setTimeout(() => {
        //     tableRef?.beginEdit(data[index]);
        // }, 1000);
    };


    return(
        <>
            <Table
                height={400}
                disableNumber
                title={'Jenis Data Diit Berdasarkan Penyakit'}
                columns={listDataDiitByPenyakit}
                data={data}
                tableType={'table-custom-2-table-right'}
                loading={loading}
                isPaginate={false}
                total={meta?.row_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                toolbar={toolBar}
                editable={!loading}
                onTableAction={onTableAction}
                selectionMode={mode === '' ? 'single': undefined}
                selection={mode === '' ? selection: null}
                onLoadTableRef={(ref) => onLoadTableRef(ref) }
                onEditCancel={onEditCancel}
                onEditEnd={onEditEnd}
                onSelectionChange={mode === '' ? setSelection: undefined}
                onEditValidate={onEditValidate}
            />
        </>
    )
};

export default ListDataDiitByPenyakit;
