import React, {useCallback, useEffect, useRef, useState} from 'react';
import Table from "../../../components/Table/Table";
import Metadata from "../../../pojo/Metadata";
import transactionService from "../../../services/transaction.service";
import {detailListTransaction} from "../../../pojo/transaction/transaction.listtransaksi";
import {LinkButton} from "rc-easyui";
import usePrevious from "../../../helper/HookHelper";
import {detailTindakan} from "../../../pojo/transaction/transaction.tindakan";
import {detailPetugas} from "../../../pojo/transaction/transaction.petugas";
import {detailMRS} from "../../../pojo/MRS";
import {NotifySuccess} from "../../../services/notification.service";
import customForm from '../../../assets/js/customForm';
import useTransaksiGiziColumn from "./TableColumn/ViewTransaksiGiziColumn";
import HeaderPasien from "../../Shared/HeaderPasien";
import moment from "moment";

interface IProps {
    idMRS: number;
    hidePagination?: boolean;
    // toolbar?: any;
}

const ViewTransaksiGizi = (props: IProps) => {
    let {
        hidePagination
    } = props;

    const [loading, setLoading] = useState<boolean>(false);
    const [mode, setMode] = useState<string>('');
    const [data, setData] = useState<Array<detailListTransaction>>([]);
    const [dataTindakan, setDataTindakan] = useState<Array<detailTindakan>>([]);
    const [dataPetugas, setDataPetugas] = useState<Array<detailPetugas>>([]);
    const [selection, setSelection] = useState();

    const [meta, setMeta] = useState<Metadata>({});
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
                            // disabled={
                            //     (mode === 'add' || mode === 'edit') ||
                            //     !selection
                            // }
                            disabled // temporary disabled until backend available
                            onClick={() => {
                                tableRef?.beginEdit(selection);
                                setMode('edit');
                            }}
                >
                    <i className="flaticon-edit-1"></i>
                    &nbsp;
                    Edit
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

    const transaksiGiziColumn = useTransaksiGiziColumn({
        dataTindakan: dataTindakan,
        dataPetugas: dataPetugas
    });

    const listTransaksi = async () => {
        try {
            setLoading(true);
            const resp = await transactionService.listtransaksi(props.idMRS);
            resp.list.map((element) => {
                element.tanggal = moment(element.tanggal).format('DD/MM/YYYY');
                element.jam = moment(element.jam).format('hh:mm:ss');

                return element
            })

            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);

        } catch (e) {
            console.log(e);
            setData([]);
            setLoading(false);
        }
    };

    const listTindakan = async () => {
        try {
            // setLoading(true);
            const resp = await transactionService.tindakan();
            setDataTindakan(resp.list);
            // setLoading(false);

        } catch (e) {
            console.log('error', e);
            setDataTindakan([]);
            // setData([]);
            // setLoading(false);
        }
    };

    const listPetugas = async () => {
        try {
            const resp = await transactionService.petugas();
            setDataPetugas(resp.list);
        }
        catch (e) {
            console.log('error', e);
            setDataPetugas([]);
        }
    };

    const loadDataComboBox = async () => {
        setLoading(true);
        await listTindakan();
        await listPetugas();
        setLoading(false);
    };


    const addNewData = async () => {
        await loadDataComboBox();

        const detailData = {
            id_transaksi: 0,
            uraian: '',
            oleh: '',
            qty: 0,
            _new: true
        };

        const currentData = Array.from(data);
        currentData.unshift(detailData);
        setData(currentData);
        setMode('add');
        // tableRef?.beginEdit(data[0]);
    };

    const removeData = async () => {
        try {
            setLoading(true);

            const data = {
                operator: 1,
                id_transaksi: selection.id_transaksi,
                id_mrs: props.idMRS
            };
            const resp = await transactionService.deleteTransaction(data);

            if(resp?.metadata && !resp?.metadata?.error) {
                listTransaksi();
                setMode('');
                NotifySuccess('Data Transaksi Gizi', resp?.metadata?.message)
            };
        } catch(e) {
            console.log('error', e);
            setLoading(false);
        }
    };

    const onTableAction = (e: any) => {
        console.log('e', e);

        setPageSize(e?.pageSize);
        setPageNumber(e?.pageNumber);


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            tableRef?.cancelEdit();

            listTransaksi();
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
                    id_mrs: props.idMRS,
                    oleh: event?.row?.oleh,
                    // operator:1,
                    id_tarif: event?.row?.uraian,
                    qty: event?.row?.qty

                };
                const resp = await transactionService.insert(payload);
                if(resp?.metadata && !resp?.metadata?.error) {
                    listTransaksi();
                    setMode('');
                    NotifySuccess('Data Transaksi Gizi', resp?.metadata?.message)
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

    const onSelectionChange = useCallback((e: detailMRS) => {
        setSelection(e);
    }, []);

    const mounted:any = useRef();
    const prevIdMRS:any = usePrevious(props.idMRS);
    // const prevEditMode: boolean = usePrevious(editMode);

    useEffect(() => {
        // Component Did Mount
        if (!mounted.current) {
            mounted.current = true;

            listTransaksi();

        } else {
            // Component did update
            if(prevIdMRS !== props.idMRS) {
                listTransaksi();
            }
        }
    });

    // component did update too
    useEffect(() => {
        if(mode === 'add') {
            tableRef?.beginEdit(data[0]);
        }
    }, [data, mode]);

    return(
        <div className={'kt-portlet'}>
            <div className={'kt-portlet__body header-form'}>
                <form className={'kt-form col-lg-12 header-form'}>
                    {props?.idMRS&&
                    <div className={'row'}>
                        <HeaderPasien idMRS={props.idMRS}/>
                    </div>}
                    <div className={'row'}>
                        <Table
                            height={400}
                            tableType={'col-12 table-detail'}
                            title={'Daftar Tindakan Pada Pasien'}
                            columns={transaksiGiziColumn}
                            data={data}
                            loading={loading}
                            toolbar={toolbar}
                            isPaginate={!hidePagination}
                            total={meta.list_count}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            onTableAction={onTableAction}
                            editable={!loading}
                            selectionMode={mode === '' ? 'single': undefined}
                            selection={mode === '' ? selection: null}
                            // onEditBegin={() => setMode('edit')}
                            onLoadTableRef={(ref) => onLoadTableRef(ref) }
                            onEditCancel={onEditCancel}
                            onEditEnd={onEditEnd}
                            onSelectionChange={mode === '' ? onSelectionChange: undefined}
                        />
                    </div>
                </form>
            </div>
        </div>
    )
};

export default ViewTransaksiGizi;
