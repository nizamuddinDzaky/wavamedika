import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import {detailDataLaboratorium} from "../../../../pojo/master/data_laboratorium/data_laboratorium";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import _ from 'lodash';

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumn = [
    {
        id: 'kode_tarif',
        title: 'Kode Tarif',
        width: '100px',
        align: 'left'
    },
    {
        id: 'nama_pemeriksaan',
        title: 'Nama Pemeriksaan',
        width: '400px',
        align: 'left'
    },
    {
        id: 'jenis',
        title: 'Jenis',
        width: '150px',
        align: 'left'
    },
    {
        id: 'golongan',
        title: 'Golongan',
        width: '150px',
        align: 'left'
    },
    {
        id: 'specimen',
        title: 'Specimen',
        width: '150px',
        align: 'left'
    },
    {
        id: 'rujuk_ke',
        title: 'Rujuk Ke',
        width: '150px',
        align: 'left'
    },
    {
        id: 'bahan',
        title: 'Bahan',
        width: '150px',
        align: 'left'
    },
    {
        id: 'hari_kerja',
        title: 'Hari_Kerja',
        width: '150px',
        align: 'left'
    },
    {
        id: 'waktu_hasil',
        title: 'Waktu Hasil',
        width: '150px',
        align: 'left'
    },
    {
        id: 'waktu_hari',
        title: 'Waktu Hari',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'vvip',
        title: 'VVIP',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'vvipb',
        title: 'VVIPB',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'vipa',
        title: 'VIPA',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'vipb',
        title: 'VIPB',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'vip',
        title: 'VIP',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'vipc',
        title: 'VIPC',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'utama',
        title: 'Utama',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'i',
        title: 'I',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'ia',
        title: 'IA',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'ib',
        title: 'IB',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'ii',
        title: 'II',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'iia',
        title: 'IIA',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'iib',
        title: 'IIB',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'iii',
        title: 'III',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'bpjs_vip',
        title: 'BPJS_VIP',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'bpjs_1',
        title: 'BPJS-1',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'bpjs_2',
        title: 'BPJS-2',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'bpjs_3',
        title: 'BPJS-3',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'biaya',
        title: 'Biaya',
        width: '150px',
        align: 'left'
    },
    {
        id: 'sampel',
        title: 'Sampel',
        width: '150px',
        align: 'left'
    },
    {
        id: 'tarif_rujukan',
        title: 'Tarif Rujukan',
        width: '150px',
        align: 'right',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
];

interface IPropsMasterDataLaboratorium {
    hidePagination?: boolean;
}

const MasterDataLaboratorium = (props: IPropsMasterDataLaboratorium) => {
    let {
        hidePagination
    } = props;

    const dataDummy = [
        {
            id: 1,
            kode_tarif: '6744',
            nama_pemeriksaan: 'Pemakaian Darah (Bank Darah Wava)',
            jenis: 'PERMINTAAN DARAH',
            golongan: 'Sedang',
            specimen: 'WH',
            rujuk_ke: 'Wava Husada',
            bahan: '2 ML EDTA',
            hari_kerja: 'tiap hari kerja',
            waktu_hasil: '1 jam',
            waktu_hari: 1,
            vvip: 400000,
            vvipb: 400000,
            vipa: 400000,
            vipb: 400000,
            vip: 400000,
            vipc: 400000,
            utama: 400000,
            i: 400000,
            ia: 400000,
            ib: 400000,
            ii: 400000,
            iia: 400000,
            iib: 400000,
            iii: 400000,
            bpjs_vip: 400000,
            bpjs_1: 400000,
            bpjs_2: 400000,
            bpjs_3: 400000,
            biaya: 'Pembelian Darah',
            sampel: 'PMI',
            tarif_rujukan: 400000,
        },
        {
            id: 2,
            kode_tarif: '5686',
            nama_pemeriksaan: '17-OH Progresteron (LC-MS/MS)',
            jenis: 'Hormon',
            golongan: 'Canggih',
            specimen: 'Rujuk',
            rujuk_ke: 'Prodia',
            bahan: '2 cc Darah Beku',
            hari_kerja: 'tiap hari kerja',
            waktu_hasil: '10 hari',
            waktu_hari: 10,
            vvip: 1164000,
            vvipb: 1164000,
            vipa: 1164000,
            vipb: 1164000,
            vip: 1164000,
            vipc: 1164000,
            utama: 1164000,
            i: 1164000,
            ia: 1164000,
            ib: 1164000,
            ii: 1164000,
            iia: 1164000,
            iib: 1164000,
            iii: 1164000,
            bpjs_vip: 1164000,
            bpjs_1: 1164000,
            bpjs_2: 1164000,
            bpjs_3: 1164000,
            biaya: 'Laboratorium',
            sampel: 'Hormon',
            tarif_rujukan: 1164000,
        },
        {
            id: 3,
            kode_tarif: '6067',
            nama_pemeriksaan: '25 (OH) Vit. D',
            jenis: 'LAIN-LAIN',
            golongan: 'Canggih',
            specimen: 'Rujuk',
            rujuk_ke: 'Prodia',
            bahan: '1 ml serum',
            hari_kerja: 'tiap hari kerja',
            waktu_hasil: '2 hari',
            waktu_hari: 2,
            vvip: 410000,
            vvipb: 410000,
            vipa: 410000,
            vipb: 410000,
            vip: 410000,
            vipc: 410000,
            utama: 410000,
            i: 410000,
            ia: 410000,
            ib: 410000,
            ii: 410000,
            iia: 410000,
            iib: 410000,
            iii: 410000,
            bpjs_vip: 410000,
            bpjs_1: 410000,
            bpjs_2: 410000,
            bpjs_3: 410000,
            biaya: 'Laboratorium',
            sampel: 'LAIN-LAIN',
            tarif_rujukan: 410000,
        },
        {
            id: 4,
            kode_tarif: '3639',
            nama_pemeriksaan: 'ACA',
            jenis: 'KIMIA- GINJAL',
            golongan: 'Canggih',
            specimen: 'Rujuk',
            rujuk_ke: 'Prodia',
            bahan: '20 urin segar',
            hari_kerja: 'tiap hari kerja',
            waktu_hasil: '1 hari',
            waktu_hari: 1,
            vvip: 828000,
            vvipb: 828000,
            vipa: 828000,
            vipb: 828000,
            vip: 828000,
            vipc: 828000,
            utama: 828000,
            i: 828000,
            ia: 828000,
            ib: 828000,
            ii: 828000,
            iia: 828000,
            iib: 828000,
            iii: 828000,
            bpjs_vip: 828000,
            bpjs_1: 828000,
            bpjs_2: 828000,
            bpjs_3: 828000,
            biaya: 'Laboratorium',
            sampel: 'IMUNOLOGI - SEROLOGI',
            tarif_rujukan: 828000,
        },
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataLaboratorium>>(dataDummy);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataLaboratorium>({});

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    let tableRef: any = useRef(null);

    // const getDataTarif = async () => {
    //     try {
    //         setLoading(true);
    //         const resp = await dataTarifService.datatarif();
    //         setData(resp.list);
    //         setMeta(resp.metadata);
    //         setLoading(false);

    //     } catch (e) {
    //         console.log(e);
    //         setLoading(false);
    //     }
    // };

    // const onTableAction = (e: any) => {
    //     console.log('e', e);

    //     setPageSize(e?.pageSize);
    //     setPageNumber(e?.pageNumber);


    //     /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
    //     /// Next jika ada update akan diganti
    //     if(e.refresh) {
    //         // getDataTarif();
    //     }
    // };

    function isEmpty(obj: object) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }
        return true;
    }

    const mounted:any = useRef();
    useEffect(() => {
        // fetchListMRS()

        // Component Did Mount
        if (!mounted.current) {
            mounted.current = true;

            // getDataTarif();
        }
    }, []);

    const toolBar = ({editingItem}: any) => {
        return(
            <div style={{padding: 4}}>
                <LinkButton plain
                            disabled={(mode === 'add' || mode === 'edit')}
                            // onClick={() => addNewData()}
                            onClick={() => window.alert('Under Development')}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Tambah
                </LinkButton>
                <LinkButton plain
                            disabled={(mode === 'add'|| mode === 'edit')}
                            onClick={() => {
                                // tableRef?.beginEdit(selection);
                                // setMode('edit');
                                window.alert('Under Development')
                            }}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Ubah
                </LinkButton>
                <LinkButton plain
                            disabled={
                                (mode === 'add' || mode === 'edit') ||
                                !selection
                            }
                            // onClick={() => removeData()}
                            onClick={() => window.alert('Under Development')}
                >
                    <i className="flaticon2-trash"></i>
                    &nbsp;
                    Hapus
                </LinkButton>
                <LinkButton plain
                            disabled={editingItem == null}
                            // onClick={() => tableRef?.endEdit()}
                            onClick={() => window.alert('Under Development')}
                >
                    <i className="la la-save"></i>
                    &nbsp;
                    Simpan
                </LinkButton>
                <LinkButton plain
                            disabled={editingItem == null}
                            // onClick={() => tableRef?.cancelEdit()}
                            onClick={() => window.alert('Under Development')}
                >
                    <i className="la la-times"></i>
                    &nbsp;
                    Batal
                </LinkButton>
                <LinkButton plain
                            onClick={() => {
                                console.log(selection);
                                window.alert('Under Development')
                            }}
                >
                    <i className="la la-times"></i>
                    &nbsp;
                    Debugging
                </LinkButton>
            </div>
        )
    };

    const addNewData = async () => {
        // await loadDataComboBox();

        if (!tableRef?.endEdit()) {
            return;
        }

        const detailData = {
            id: 0,
            nama_alkes: '',
            sat_besar: '',
            qty: 0,
            sat_kecil: '',
            _new: true
        };

        let newData = Array.from(data);
        newData.unshift(detailData);
        setData(newData);
        setMode('add');
        setSelection({});
        tableRef?.beginEdit(newData[0]);

        // const currentData = Array.from(data);
        // currentData.unshift(detailData);
        // setData(currentData);
        // setMode('add');
        // tableRef?.beginEdit(data[0]);
    };

    // const getData = async () => {
    //     try {
    //         setLoading(true);
    //         const resp = await dataDiitService.datadiet();
    //         setData(resp.list);
    //         setMeta(resp.metadata);
    //         setLoading(false);

    //     } catch (e) {
    //         setLoading(false);
    //         setData([]);
    //     }
    // };

    const removeData = async () => {
        try {
            setLoading(true);

            // const data = {
            //     id_diet: selection.id_diet,
            // };
            // const resp = await dataDiitService.delete_diet(data);

            // if(resp?.metadata && !resp?.metadata?.error) {
            //     getData();
            //     setMode('');
            //     NotifySuccess('Data Diit Gizi', resp?.metadata?.message)
            // };

            const newData = data.filter(row => row.id !== selection.id);
            setData(newData);
            setLoading(false);
            NotifySuccess('Data Alkes Lab Berhasil Dihapus');

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

            // getData();
        } else {
            // getData();
        }

        // if(props.onTableAction) {
        //     props.onTableAction(e)
        // }
    };

    const onLoadTableRef = (ref: any) => {
        tableRef = ref;
        new (customForm as any)(tableRef); // for tab on enter, inside table ref
        console.log(tableRef);
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
                // const payload = {
                //     keterangan: event?.row?.keterangan,
                //     diet: event?.row?.diet

                // };
                // const resp = await dataDiitService.insert_diet(payload);
                // if(resp?.metadata && !resp?.metadata?.error) {
                //     getData();
                //     setMode('');
                //     NotifySuccess('Data Diit', resp?.metadata?.message)
                // }

                const payload = {
                    id: Number((data[data.length - 1 ]).id)+1,
                    nama_alkes: event?.row?.nama_alkes,
                    sat_besar: event?.row?.sat_besar,
                    qty: Number(event?.row?.qty),
                    sat_kecil: event?.row?.sat_kecil,
                }
                const newData = data;
                newData.push(payload);
                const currentData = newData.filter(row => row !== event.row);
                setData(currentData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Alkes Lab Berhasil Ditambahkan');
                
                // const newData = Array.from(data);
                // newData.unshift(payload);
                // setData(newData);
                // setMode('');
                // setLoading(false);
                // NotifySuccess('Data Alkes Berhasil Ditambahkan');
            } else if(mode === 'edit') {
                // const data = {
                //
                // };
                // const resp = await transactionService.insert(data);
                // listTransaksi();
                const payload = {
                    id: event?.row?.id,
                    nama_alkes: event?.row?.nama_alkes,
                    sat_besar: event?.row?.sat_besar,
                    qty: Number(event?.row?.qty),
                    sat_kecil: event?.row?.sat_kecil,
                }
                const newData = data;
                const index = data.findIndex(row => row.id === event.row.id);
                newData.splice(index, 1);
                newData.splice(index, 0, payload);
                setData(newData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Alkes Lab Berhasil Diubah');
            } else {
                setLoading(false);
            }
        } catch (e) {
            console.log('error', e);
            setLoading(false);

            if(mode === 'add') {
                tableRef?.beginEdit(data[0]);
            }
        }
    };

    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            {/*<div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>*/}
            {/*</div>*/}
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <Table
                    height={450}
                    disableNumber
                    title={'List Alkes Lab'}
                    columns={tindakanColumn}
                    data={data}
                    loading={loading}
                    toolbar={toolBar}
                    isPaginate={!hidePagination}
                    total={meta.list_count}
                    pageNumber={pageNumber}
                    pageSize={pageSize}
                    editable={!loading}
                    filterable={true}
                    selectionMode={(mode === 'edit' || mode === 'add') ? '' : 'single'}
                    selection={isEmpty(selection) && null}
                    onSelectionChange={(selection) => setSelection(selection)}
                    onLoadTableRef={(ref) => onLoadTableRef(ref) }
                    onTableAction={onTableAction}
                    onEditCancel={onEditCancel}
                    onEditEnd={onEditEnd}
                />
            </div>
        </div>
    )
};

export default MasterDataLaboratorium;
