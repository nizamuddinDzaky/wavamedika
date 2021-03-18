import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import Metadata from "../../../../pojo/Metadata";
import customForm from "../../../../assets/js/customForm";
import dataDiitService from "../../../../services/giz_masterdiet.service";
import {detailDataDiet} from "../../../../pojo/giz_masterdiet/datadiet";
import {LinkButton, TextBox, Tooltip} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";

const listDataDiitByBentukMakanan = [
    {
        id: 'diet',
        title: 'Kode',
        width: "20px",
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.diet}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'keterangan',
        title: 'Keterangan',
        width: "140px",
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
];

interface IProps {
    onTableAction?: (e: any) => void;
}

const ListDataDiitByBentukMakanan: React.FC<IProps> = (props:IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataDiet>>([]);
    const [mode, setMode] = useState<string>('');

    const [meta, setMeta] = useState<Metadata>({});
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
            const resp = await dataDiitService.datadiet();
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
            setLoading(true);

            const data = {
                id_diet: selection.id_diet,
            };
            const resp = await dataDiitService.delete_diet(data);

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
        } else {
            getData();
        }

        if(props.onTableAction) {
            props.onTableAction(e)
        }
    };
    const onLoadTableRef = (ref: any) => {
        tableRef = ref;
        new (customForm as any)(tableRef); // for tab on enter, inside table ref
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
                    keterangan: event?.row?.keterangan,
                    diet: event?.row?.diet

                };
                const resp = await dataDiitService.insert_diet(payload);
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

    useEffect(() => {
        getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);

    useEffect(() => {
        if(mode === 'add') {
            tableRef?.beginEdit(data[0]);
        }
    }, [data, mode]);

    return(
        <>
            <Table
                height={400}
                disableNumber
                title={'Jenis Data Diit Berdasarkan Bentuk Makanan'}
                columns={listDataDiitByBentukMakanan}
                data={data}
                tableType={'table-custom-2-table-left'}
                loading={loading}
                isPaginate={false}
                total={meta?.row_count}
                toolbar={toolBar}
                editable={!loading}
                onTableAction={onTableAction}
                selectionMode={mode === '' ? 'single': undefined}
                selection={mode === '' ? selection: null}
                onLoadTableRef={(ref) => onLoadTableRef(ref) }
                onEditCancel={onEditCancel}
                onEditEnd={onEditEnd}
                onSelectionChange={mode === '' ? setSelection: undefined}

            />
        </>
    )
};

export default ListDataDiitByBentukMakanan;
