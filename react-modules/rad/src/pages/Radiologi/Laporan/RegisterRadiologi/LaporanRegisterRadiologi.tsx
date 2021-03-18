import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import {detailDataRekap} from "../../../../pojo/laporan/register_radiologi/data_rekap";
import {detailDataDaftarPasien} from "../../../../pojo/laporan/register_radiologi/daftar_pasien";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox, ComboBox, CheckBox} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import _ from 'lodash';

// const operators = ["nofilter", "equal", "notequal", "less", "greater"];
const tindakanColumnRekap = [
    {
        id: 'rekap',
        title: 'Rekapitulasi',
        width: '200px',
        align: 'left'
    },
    {
        id: 'jumlah',
        title: 'Jumlah',
        width: '100px',
        align: 'left'
    }
];
const tindakanColumn = [
    {
        id: 'tanggal',
        title: 'Tanggal',
        width: '30%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.tanggal}/>
                </Tooltip>

            </>
        ),
        editRules: ['required'],
        frozen : true
    },
    {
        id: 'no_mrs',
        title: 'no_mrs',
        width: '30%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.no_mrs}/>
                </Tooltip>

            </>
        ),
        editRules: ['required'],
        frozen : true
    },
    {
        id: 'no_billing',
        title: 'no_billing',
        width: '30%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.no_billing}/>
                </Tooltip>

            </>
        ),
        editRules: ['required'],
        frozen : true
    },
    {
        id: 'nama_pasien',
        title: 'nama_pasien',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.nama_pasien}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'no_rm',
        title: 'no_rm',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.no_rm}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'sex',
        title: 'sex',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.sex}/>
                </Tooltip>

            </>
        ),
        filter:() => (
           
            <ComboBox
            data={[
              {
                value : null, text : 'SEMUA'
              },
              {
                value : 'L', text : 'Laki-Laki',
              },
              {
                value : 'P', text : 'Perempuan'
              }
            ]}
            editable={false}
            inputStyle={{ textAlign: 'center' }}
            />
        
      ),
        editRules: ['required']
    },
    {
        id: 'tanggal_lahir',
        title: 'tanggal_lahir',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.tanggal_lahir}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'umur',
        title: 'umur',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.umur}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'alamat',
        title: 'alamat',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.alamat}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'nama_pemeriksaan',
        title: 'nama_pemeriksaan',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.nama_pemeriksaan}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'pemeriksaan',
        title: 'pemeriksaan',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.pemeriksaan}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'golongan',
        title: 'golongan',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.golongan}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'unit',
        title: 'unit',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.unit}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'rujuk',
        title: 'rujuk',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.rujuk}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'kategori_film',
        title: 'kategori_film',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.kategori_film}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'penggunaan_film',
        title: 'penggunaan_film',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.penggunaan_film}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'kv',
        title: 'kv',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.kv}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'mas',
        title: 'mas',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.mas}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'diagnosa',
        title: 'diagnosa',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.diagnosa}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'hasil_baca',
        title: 'hasil_baca',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.hasil_baca}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'dokter',
        title: 'dokter',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.dokter}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'asuransi',
        title: 'asuransi',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.asuransi}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'pembayaran',
        title: 'pembayaran',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.pembayaran}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'jam_input',
        title: 'jam_input',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.jam_input}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'jam_baca',
        title: 'jam_baca',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.jam_baca}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
];

interface IPropsLaporanRegisterRadiologi {
    hidePagination?: boolean;
}

const LaporanRegisterRadiologi = (props: IPropsLaporanRegisterRadiologi) => {
    let {
        hidePagination
    } = props;

    const dataDummyRekap = [
        {
            id: 1,
            rekap : 'Jumlah Pasien Radiologi',
            jumlah : 327573,
        }
      
    ];

    const dataDummy = [
        {
            id: 1,
            tanggal: '12-12-2020',
            no_mrs: 375,
            no_billing: 3667,
            nama_pasien: 'budi',
            no_rm: 3576,
            sex: 'L',
            tanggal_lahir: '13-12-2020',
            umur : 18,
            alamat : 'jatibanggi',
            nama_pemeriksaan : 'jantung',
            pemeriksaan : 'badan',
            golongan : 'A',
            unit : 'B',
            rujuk : 'RS Iskak',
            kategori_film : 'Act',
            penggunaan_film : 'BTc',
            kv : 2525,
            mas : 27262,
            diagnosa : 'Bagus,sehat',
            hasil_baca : 'sip',
            dokter : 'dani',
            asuransi : 'jiwa',
            pembayaran : 'Lunas',
            jam_input : '12:12',
            jam_baca : '13:15',
        }
      
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataDaftarPasien>>(dataDummy);
    const [datarekap, setDataRekap] = useState<Array<detailDataRekap>>(dataDummyRekap);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataRekap>({});

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
                            onClick={() => addNewData()}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Tambah
                </LinkButton>
                <LinkButton plain
                            disabled={(mode === 'add'|| mode === 'edit')}
                            onClick={() => {
                                tableRef?.beginEdit(selection);
                                setMode('edit');
                            }}
                >
                    <i className="la la-edit"></i>
                    &nbsp;
                    Ubah
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
        if (!tableRef?.endEdit()) {
            return;
        }

        const detailData = {
            tanggal: '',
            no_mrs: 0,
            no_billing: 0,
            nama_pasien: '',
            no_rm: 0,
            sex: 'L',
            tanggal_lahir: '',
            umur : 0,
            alamat : '',
            nama_pemeriksaan : '',
            pemeriksaan : '',
            golongan : '',
            unit : '',
            rujuk : '',
            kategori_film : '',
            penggunaan_film : '',
            kv : 0,
            mas : 0,
            diagnosa : '',
            hasil_baca : '',
            dokter : '',
            asuransi : '',
            pembayaran : '',
            jam_input : '',
            jam_baca : '',
            _new: true
        };

        let newData = Array.from(data);
        newData.unshift(detailData);
        setData(newData);
        setMode('add');
        setSelection({});
        tableRef?.beginEdit(newData[0]);

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

    // const removeData = async () => {
    //     try {
    //         setLoading(true);

    //         const data = {
    //             id_diet: selection.id_diet,
    //         };
    //         const resp = await dataDiitService.delete_diet(data);

    //         if(resp?.metadata && !resp?.metadata?.error) {
    //             getData();
    //             setMode('');
    //             NotifySuccess('Data Diit Gizi', resp?.metadata?.message)
    //         };
    //     } catch(e) {
    //         console.log('error', e);
    //         setLoading(false);
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
            NotifySuccess('Data Radiologi Berhasil Dihapus');

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
                    tanggal: event?.row?.tanggal,
                    no_mrs: event?.row?.no_mrs,
                    no_billing: event?.row?.no_billing,
                    nama_pasien: event?.row?.nama_pasien,
                    no_rm: event?.row?.no_rm,
                    sex: event?.row?.sex,
                    tanggal_lahir: event?.row?.tanggal_lahir,
                    umur: event?.row?.umur,
                    alamat: event?.row?.alamat,
                    nama_pemeriksaan: event?.row?.nama_pemeriksaan,
                    pemeriksaan: event?.row?.pemeriksaan,
                    golongan: event?.row?.golongan,
                    unit: event?.row?.unit,
                    rujuk: event?.row?.rujuk,
                    kategori_film: event?.row?.kategori_film,
                    penggunaan_film: event?.row?.penggunaan_film,
                    kv: event?.row?.kv,
                    mas: event?.row?.mas,
                    diagnosa: event?.row?.diagnosa,
                    hasil_baca: event?.row?.hasil_baca,
                    dokter: event?.row?.dokter,
                    asuransi: event?.row?.asuransi,
                    pembayaran: event?.row?.pembayaran,
                    jam_input: event?.row?.jam_input,
                    jam_baca: event?.row?.jam_baca,
                }
                const newData = data;
                newData.push(payload);
                const currentData = newData.filter(row => row !== event.row);
                setData(currentData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Radiologi Berhasil Ditambahkan');
                
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
                    tanggal: event?.row?.tanggal,
                    no_mrs: event?.row?.no_mrs,
                    no_billing: event?.row?.no_billing,
                    nama_pasien: event?.row?.nama_pasien,
                    no_rm: event?.row?.no_rm,
                    sex: event?.row?.sex,
                    tanggal_lahir: event?.row?.tanggal_lahir,
                    umur: event?.row?.umur,
                    alamat: event?.row?.alamat,
                    nama_pemeriksaan: event?.row?.nama_pemeriksaan,
                    pemeriksaan: event?.row?.pemeriksaan,
                    golongan: event?.row?.golongan,
                    unit: event?.row?.unit,
                    rujuk: event?.row?.rujuk,
                    kategori_film: event?.row?.kategori_film,
                    penggunaan_film: event?.row?.penggunaan_film,
                    kv: event?.row?.kv,
                    mas: event?.row?.mas,
                    diagnosa: event?.row?.diagnosa,
                    hasil_baca: event?.row?.hasil_baca,
                    dokter: event?.row?.dokter,
                    asuransi: event?.row?.asuransi,
                    pembayaran: event?.row?.pembayaran,
                    jam_input: event?.row?.jam_input,
                    jam_baca: event?.row?.jam_baca,
                }
                const newData = data;
                const index = data.findIndex(row => row.id === event.row.id);
                newData.splice(index, 1);
                newData.splice(index, 0, payload);
                setData(newData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Radiologi Berhasil Diubah');
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
            <div className={'row'}>
                    <div className={'col-xl-4 col-md-4 col-sm-12'}>
                        <Table
                            height={450}
                            disableNumber
                            title={'List Data Rekapitulasi'}
                            columns={tindakanColumnRekap}
                            data={datarekap}
                            tableType={'table-custom-2-table-left'}
                            loading={loading}
                            // toolbar={toolBar}
                            isPaginate={!hidePagination}
                            total={meta.total_data}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            editable={!loading}
                            filterable={true}
                            onLoadTableRef={(ref) => onLoadTableRef(ref) }
                            // onEditCancel={onEditCancel}
                            // onEditEnd={onEditEnd}
                        />
                    </div>
                    <div className={'col-xl-8 col-md-8 col-sm-12'}>
                                <Table
                                // height={450}
                                // disableNumber
                                // title={'List Daftar Layanan'}
                                // columns={tindakanColumn}
                                // data={data}
                                // loading={loading}
                                // toolbar={toolBar}
                                // isPaginate={!hidePagination}
                                // total={meta.list_count}
                                // pageNumber={pageNumber}
                                // pageSize={pageSize}
                                // editable={!loading}
                                // filterable={true}
                                // onLoadTableRef={(ref) => onLoadTableRef(ref) }
                                // onTableAction={onTableAction}
                                // onEditCancel={onEditCancel}
                                height={450}
                                disableNumber
                                title={'Data Radiologi'}
                                columns={tindakanColumn}
                                data={data}
                                loading={loading}
                                toolbar={toolBar}
                                isPaginate={!hidePagination}
                                total={meta.total_data}
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
            </div>
        </div>
    )
};

export default LaporanRegisterRadiologi;
