import React, {useCallback, useEffect, useRef, useState} from 'react';
import Table from "../../../components/Table/Table";
import Metadata from "../../../pojo/Metadata";
import {ComboBox, LinkButton, TextBox, Tooltip} from "rc-easyui";
import pmkpService from "../../../services/giz_pmkp.service";
import {detailPMKPPasien} from "../../../pojo/giz_pmkppasien/datapmkppasien";
import customForm from "../../../assets/js/customForm";
import {NotifySuccess} from "../../../services/notification.service";
import {detailIndikatorUnit} from "../../../pojo/giz_pmkppasien/indikatorunit";

interface Props {
    idUnit: number
    idMRS: number
    hidePagination?: boolean
}

const usePMKPColumn = (
    {
        dataIndikator,

    }: {
        dataIndikator: Array<detailIndikatorUnit>,
    }
) => {
    const dataIndikatorParsed = dataIndikator.map((item) => {
        return {
            value: item?.id_pmkp,
            text: item?.indikator_sasaran
        }
    });

    return [
        {
            id: 'tgl_input',
            title: 'Tanggal Input',
            width: "30px",
        },
        {
            id: 'indikator_unit',
            title: 'Indikator Unit',
            width: "100px",
            editable: true,
            editor: ({row, error}: any) => (
                <Tooltip content={error} tracking>
                    <ComboBox
                        value={row?.indikator_unit}
                        data={dataIndikatorParsed}
                    ></ComboBox>
                </Tooltip>
            ),
            editRules: ['required']
        },
        {
            id: 'pilihan',
            title: 'Pilihan',
            width: "30px",
            editable: true,
            editor: ({ row,error }: any) => (
                <>
                    <Tooltip content={error} tracking>
                        <TextBox
                            value={row?.pilihan}/>
                    </Tooltip>

                </>
            ),
            editRules: ['required']
        },
        {
            id: 'verif',
            title: 'Verif',
            width: "30px",
        },
    ]
}
const ListPMKP: React.FC<Props> = (props: Props) => {
    const [data, setData ] = useState<Array<detailPMKPPasien>>([]);
    const [meta, setMeta] = useState<Metadata>({});
    const [loading, setLoading] = useState<boolean>(false);
    const [mode, setMode] = useState<string>('');

    const [dataIndikator,setDataIndikator] = useState<Array<detailIndikatorUnit>>([])

    const [selection, setSelection] = useState();
    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    let tableRef: any = useRef(null);

    const toolbar = ({editingItem}: any) => {
        return(
            <div style={{ padding: 4 }}>
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

    const PMKPColumn = usePMKPColumn({
        dataIndikator: dataIndikator
    });


    const getListPMKP = useCallback(async () => {
        try {
            setLoading(true);
            const resp = await pmkpService.datapmkppasien({id_mrs: props.idMRS, id_unit: props?.idUnit});
            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);
        } catch (e) {
            console.log('error', e);
            setLoading(false);
        }
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.idMRS, props.idUnit]);

    const listIndikator = async () => {
        try {
            const payload = {
                id_mrs: props?.idMRS,
                // id_unit: props?.idUnit //using static first 44
                id_unit: 44
            };


            const resp = await pmkpService.indikatorunit(payload);
            setDataIndikator(resp.list);
        }
        catch (e) {
            console.log('error', e);
            setDataIndikator([]);
        }
    }

    const loadDataComboBox = async () => {
        setLoading(true);
        await listIndikator();
        setLoading(false);
    };

    const addNewData = async () => {
        await loadDataComboBox();

        const detailData = {
            tgl_input: '',
            indikator_unit: '',
            pilihan: '',
            verif: '',
            _new: true
        };

        const currentData = Array.from(data);
        currentData.unshift(detailData);
        setData(currentData);
        setMode('add');
    };

    const removeData = async () => {
        try {
            setLoading(true);

            const data = {
                id_indikatorpasien: selection.id_indikatorpasien
            };
            const resp = await pmkpService.deleteDataPmkp(data);

            if(resp?.metadata && !resp?.metadata?.error) {
                getListPMKP();
                setMode('');
                NotifySuccess('Data PMKP', resp?.metadata?.message)
            };

        } catch(e) {
            console.log('error', e);
            setLoading(false);
        }
    };

    const onLoadTableRef = (ref: any) => {
        tableRef = ref;
        new (customForm as any)(tableRef); // for tab on enter, inside table ref
    };

    const onTableAction = (e: any) => {
        setPageSize(e?.pageSize);
        setPageNumber(e?.pageNumber);


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            getListPMKP();
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
                    id_mrs: props?.idMRS,
                    // id_unit: props?.idUnit,
                    id_unit: 44, // static 44 dulu
                    id_pmkp: event?.row?.indikator_unit,
                    pilihan: event?.row?.pilihan,
                    verif: null

                };
                const resp = await pmkpService.insert(payload);
                if(resp?.metadata && !resp?.metadata?.error) {
                    getListPMKP();
                    setMode('');
                    NotifySuccess('Data Riwayat PMKP', resp?.metadata?.message)
                };
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
        if(props.idMRS && props?.idUnit) {
            getListPMKP();
        }
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.idMRS, props?.idUnit]);

    useEffect(() => {
        if(mode === 'add') {
            tableRef?.beginEdit(data[0]);
        }
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [data, mode]);

    return(
        <>
            <Table
                height={400}
                tableType={'col-12 table-detail'}
                title={'Daftar PMKP'}
                columns={PMKPColumn}
                data={data}
                loading={loading}
                toolbar={toolbar}
                isPaginate={!props.hidePagination}
                total={meta.list_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                editable={!loading}
                selectionMode={mode === '' ? 'single': undefined}
                selection={mode === '' ? selection: null}
                onTableAction={onTableAction}
                onLoadTableRef={(ref) => onLoadTableRef(ref) }
                onEditCancel={onEditCancel}
                onEditEnd={onEditEnd}
                onSelectionChange={mode === '' ? setSelection: undefined}
            />
        </>
    )
}

export default ListPMKP;
