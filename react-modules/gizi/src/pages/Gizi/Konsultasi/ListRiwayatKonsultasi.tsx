import React, {useCallback, useEffect, useRef, useState} from 'react';
import konsultasiGiziService from "../../../services/konsultasiGizi.service";
import Table from "../../../components/Table/Table";
import Metadata from "../../../pojo/Metadata";
import { LinkButton } from "rc-easyui";
import customForm from "../../../assets/js/customForm";
import {NotifySuccess} from "../../../services/notification.service";
import {detailMRS} from "../../../pojo/giz_konsultasigizi/giz_konsultasigizi.datamrs";
import {detailPetugas} from "../../../pojo/transaction/transaction.petugas";
import transactionService from "../../../services/transaction.service";
import useRiwayatKonsultasiColumn from "./TableColumn/ListRiwayatKonsultasiColumn";
import {detailDaftarKonsultasi} from "../../../pojo/giz_konsultasigizi/giz_konsultasigizi.daftarkonsultasi";

interface IProps {
    idMRS: number;
    dataPasien: detailMRS;
    hidePagination?: boolean;
}

const ListRiwayatKonsultasi: React.FC<IProps> = (props: IProps) => {
    const [data, setData ] = useState<Array<any>>([]);
    const [dataPetugas, setDataPetugas] = useState<Array<detailPetugas>>([]);
    const [daftarKonsultasi, setDaftarKonsultasi] = useState<Array<detailDaftarKonsultasi>>([]);
    const [meta, setMeta] = useState<Metadata>({});
    const [loading, setLoading] = useState<boolean>(false);
    const [mode, setMode] = useState<string>('');

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

    const riwayatKonsultasiColumn = useRiwayatKonsultasiColumn({
        dataPetugas: dataPetugas,
        daftarKonsultasi: daftarKonsultasi
    });

    const getListRiwayatKonsultasi = useCallback(async () => {
        try {
            setLoading(true);
            const resp = await konsultasiGiziService.datakonsultasigizi({id_mrs: props.idMRS, id_kamar: props?.dataPasien?.id_kamar});
            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);
        } catch (e) {
            console.log('error', e);
            setLoading(false);
        }
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.idMRS, props.dataPasien]);

    const listPetugas = async () => {
        try {
            const resp = await transactionService.petugas();
            setDataPetugas(resp.list);
        }
        catch (e) {
            console.log('error', e);
            setDataPetugas([]);
        }
    }

    const listKonsultasi = async () => {
        try {
            const resp = await konsultasiGiziService.daftarKonsultasi();
            setDaftarKonsultasi(resp.list);
        }
        catch (e) {
            console.log('error', e);
            setDaftarKonsultasi([]);
        }
    }

    const loadDataComboBox = async () => {
        setLoading(true);
        await listPetugas();
        await listKonsultasi();
        setLoading(false);
    };

    const addNewData = async () => {
        await loadDataComboBox();

        const detailData = {
            qty: 0,
            kamar: props?.dataPasien?.nama_kamar,
            konsultasi: '',
            oleh: '',
            kalori: 0,
            penyakit: '',
            keterangan: '',
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
                operator: 1,
                id_gizi: selection.id_gizi,
                id_mrs: props.idMRS
            };
            const resp = await konsultasiGiziService.deleteTransaction(data);

            if(resp?.metadata && !resp?.metadata?.error) {
                getListRiwayatKonsultasi();
                setMode('');
                NotifySuccess('Data Riwayat Konsultasi Gizi', resp?.metadata?.message)
            };

        } catch(e) {
            console.log('error', e);
            setLoading(false);
        }
    };

    const onTableAction = (e: any) => {
        setPageSize(e?.pageSize);
        setPageNumber(e?.pageNumber);


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            getListRiwayatKonsultasi();
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
                    id_mrs: props?.idMRS,
                    qty: event?.row?.qty,
                    kamar: props?.dataPasien?.nama_kamar,
                    // konsultasi: event?.row?.konsultasi,
                    oleh: event?.row?.oleh,
                    kalori: event?.row?.kalori,
                    penyakit: event?.row?.penyakit,
                    keterangan: event?.row?.keterangan,
                    id_jnsgizi: event?.row?.konsultasi

                };
                const resp = await konsultasiGiziService.insert(payload);
                if(resp?.metadata && !resp?.metadata?.error) {
                    getListRiwayatKonsultasi();
                    setMode('');
                    NotifySuccess('Data Riwayat Konsultasi Gizi', resp?.metadata?.message)
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

    const onSelectionChange = useCallback((e: any) => {
        setSelection(e);
    }, []);


    useEffect(() => {
        if(props.idMRS && props?.dataPasien?.id_kamar) {
            getListRiwayatKonsultasi();
        }
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.idMRS, props?.dataPasien?.id_kamar, getListRiwayatKonsultasi]);

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
                title={'Daftar Riwayat Konsultasi Pasien'}
                columns={riwayatKonsultasiColumn}
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
                onSelectionChange={mode === '' ? onSelectionChange: undefined}
            />
        </>
    )
};

export default ListRiwayatKonsultasi;
