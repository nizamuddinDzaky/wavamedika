import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import {detailDataPemeriksaan} from "../../../../pojo/entry/periksa_lab/data_pemeriksaan";
import {detailDataAlkes} from "../../../../pojo/entry/periksa_lab/data_alkes";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox, ButtonGroup} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
import SelectInput,{ISelector} from '../../../../components/Forms/Input/SelectInput';
import _ from 'lodash';
import moment from 'moment';
import { red } from '@material-ui/core/colors';

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumnDataAlkes =[
    {
        id: 'nama_alkes',
        title: 'nama_alkes',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="1" autoFocus
                    value={row?.nama_alkes}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'qty',
        title: 'Qty',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="3" autoFocus
                    value={row?.qty}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'satuan',
        title: 'Satuan',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="2" autoFocus
                    value={row?.satuan}/>
            </>
        ),
        editRules: ['required']
    },
    
];

const tindakanColumnPeriksaLab = [
    {
        id: 'pemeriksaan',
        title: 'Pemeriksaan',
        width: '100px',
        align: 'left',
        frozen : true,
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="1" autoFocus
                    value={row?.pemeriksaan}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'cito',
        title: 'Cito',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="2" autoFocus
                    value={row?.cito}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'qty',
        title: 'Qty',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="3" autoFocus
                    value={row?.qty}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'oleh',
        title: 'Oleh',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="4" autoFocus
                    value={row?.nomor_rm}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'jumlah',
        title: 'Jumlah',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="5" autoFocus
                    value={row?.jumlah}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'lab',
        title: 'Laboratorium',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="6" autoFocus
                    value={row?.lab}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'specimen',
        title: 'Specimen',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="7" autoFocus
                    value={row?.specimen}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'hari_selesai',
        title: 'Hari Selesai',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="8" autoFocus
                    value={row?.hari_selesai}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'tanggal_selesai',
        title: 'Tanggal Selesai',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="9" autoFocus
                    value={row?.tanggal_selesai}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'catatan',
        title: 'Catatan',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="10" autoFocus
                    value={row?.catatan}/>
            </>
        ),
        editRules: ['required']
    },

];

interface IPropsPeriksaLab {
    hidePagination?: boolean;
}

const PeriksaLab = (props: IPropsPeriksaLab) => {
    const [noLab, setNoLab] = useState<number>(0);
    const [noMRS, setNoMRS] = useState<number>(0);

    const [umur, setUmur] = useState<number>(0);
    const [noFaktur, setNoFaktur] = useState<number>(0);
    const [tanggal, setTanggal] = useState<string>(moment().format('YYYY-MM-DD'));
    const [jam, setJam] = useState<string>('');
    const [opertaor, setOpertaor] = useState<number>(0);
    const [namaLengkap, setNamaLengkap] = useState<string>('');
    const [Alamat, setAlamat] = useState<string>('');
    const [asuransi, setAsuransi] = useState<string>('');
    const [instansi, setInstansi] = useState<string>('');
    const [admission, setAdmission] = useState<string>('');
    const [Perujuk, setPerujuk] = useState<string>('');
    const [noRM, setnoRM] = useState<number>(0);
    const [karyawan, setKaryawan] = useState<string>('');
    const [noMR, setnoMR] = useState<string>('');
    const [FeePasien, setFeePasien] = useState<string>('');
    const [SelisihPasien, setSelisihPasien] = useState<string>('');
    const [nama, setNama] = useState<string>('');
    const [dokter, setDokter] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [namaPaket, setNamaPaket] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [kelas, setKelas] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [kondisiSampel, setKondisiSampel] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [golPemeriksaan, setGolPemeriksaan] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [RSRujukPartial, setRSRujukPartial] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [RuangKamar, setRuangKamar] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [kecamatan, setKecamatan] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [kabupaten, setKabupaten] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [jnsPasien, setJnsPasien] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [sex, setSex] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    
    const [listDokter, setListDokter] = useState<Array<ISelector>>([]);
    const [listNamaPaket, setListNamaPaket] = useState<Array<ISelector>>([]);
    const [listKondisiSampel, setListKondisiSampel] = useState<Array<ISelector>>([]);
    const [listGolPemeriksaan, setListGolPemeriksaan] = useState<Array<ISelector>>([]);
    const [listRSRujukPartial, setListRSRujukPartial] = useState<Array<ISelector>>([]);
    const [listRuangKamar, setListRuangKamar] = useState<Array<ISelector>>([]);
    const [listKelas, setListKelas] = useState<Array<ISelector>>([]);
    const [listKecamatan, setListKecamatan] = useState<Array<ISelector>>([]);
    const [listKabupaten, setListKabupaten] = useState<Array<ISelector>>([]);
    const [listJnsPasien, setListJnsPasien] = useState<Array<ISelector>>([]);
    const [listSex, setListSex] = useState<Array<ISelector>>([]);



    const [thn1, setThn1] = useState<any>(moment());
    const [thn2, setThn2] = useState<any>(moment());
    const [umur1, setUmur1] = useState<number>(0);
    const [umur2, setUmur2] = useState<number>(0);


    const [optionalProps, setOptionalProps] = useState<any>({
        thn1: thn1,
        thn2: thn2
    });


    const onClickRefresh = (e: any) => {
        e.preventDefault();

        setOptionalProps({
            noLab : noLab,
            no_mr: noMR, thn1, thn2, umur1, umur2, nama,
            kecamatan: kecamatan.value,
            kabupaten: kabupaten.value,
            id_jnspasien: jnsPasien.value,
            sex: sex.value
        });
    }

    let {
        hidePagination
    } = props;

    const dataDummyDataAlkes =[
        {
            id: 1,
            nama_alkes: 'medis',
            qty: 45754,
            satuan: 'barang',
        }
    ];

    const dataDummyPeriksaLab = [
        {
            id: 1,
            pemeriksaan: 'medis',
            cito: 'yes',
            qty: 45754,
            oleh: 'ki',
            tanggal: '12-12-2020',
            jumlah: 6434,
            lab: 'A',
            specimen: 'langka',
            hari_selesai: 'rabu',
            tanggal_selesai: '12-12-2020',
            catatan: 'good',
        }
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataPemeriksaan>>(dataDummyPeriksaLab);
    const [dataAlkes, setDataAlkes] = useState<Array<detailDataPemeriksaan>>(dataDummyDataAlkes);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataPemeriksaan>({});
    const [startDate, setStartDate] = useState<string>(moment().format('YYYY-MM-DD'));
    const [endDate, setEndDate] = useState<string>(moment().format('YYYY-MM-DD'));

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
                    <i className="la la-plus"></i>
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
                <LinkButton plain
                            onClick={() => {
                                console.log(selection);
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
            pemeriksaan: '',
            cito: '',
            qty: 0,
            oleh: '',
            tanggal: '',
            jumlah: 0,
            lab: '',
            specimen: '',
            hari_selesai: '',
            tanggal_selesai: '',
            catatan: '',
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
            NotifySuccess('Data Periksa Lab Berhasil Dihapus');

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


    function handleChangeStartDate(e: any){
        console.log(e.target.value);
        // setStartDate(moment(e.target.value, "DD-MM-YYYY", true));
    }

    function handleChangeEndDate(e: any){
        console.log(e.target.value);
        // setEndDate(e.target.value);
    }

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
                    pemeriksaan: event?.row?.pemeriksaan,
                    cito: event?.row?.cito,
                    qty: event?.row?.qty,
                    oleh: event?.row?.oleh,
                    jumlah: event?.row?.jumlah,
                    lab: event?.row?.lab,
                    specimen: event?.row?.specimen,
                    hari_selesai: event?.row?.hari_selesai,
                    tanggal_selesai: event?.row?.tanggal_selesai,
                    catatan: event?.row?.catatan,
                }
                const newData = data;
                newData.push(payload);
                const currentData = newData.filter(row => row !== event.row);
                setData(currentData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Periksa Lab Berhasil Ditambahkan');
                
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
                    pemeriksaan: event?.row?.pemeriksaan,
                    cito: event?.row?.cito,
                    qty: event?.row?.qty,
                    oleh: event?.row?.oleh,
                    jumlah: event?.row?.jumlah,
                    lab: event?.row?.lab,
                    specimen: event?.row?.specimen,
                    hari_selesai: event?.row?.hari_selesai,
                    tanggal_selesai: event?.row?.tanggal_selesai,
                    catatan: event?.row?.catatan,
                }
                const newData = data;
                const index = data.findIndex(row => row.id === event.row.id);
                newData.splice(index, 1);
                newData.splice(index, 0, payload);
                setData(newData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Periksa Lab Berhasil Diubah');
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
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <div className={'kt-form col-xl-12 header-form kt-margin-t-25 row'}>
                    <div className={'col-xl-2'}>
                        <a 
                            // type={'submit'}
                            href={'/lab/entry/terima-lab/cari-biling'}
                            className='col-1 btn btn-sm btn-warning kt-margin-t-20 kt-margin-l-10 float-right'>
                            Cari
                        </a>
                        <a 
                            // type={'submit'}
                            href={'#'}
                            className='col-1 btn btn-sm btn-danger kt-margin-t-20 kt-margin-l-10 float-right'>
                            Hapus
                        </a>
                        <a 
                            // type={'submit'}
                            href={'#'}
                            className='col-1 btn btn-sm btn-primary kt-margin-t-20 float-right'>
                            Simpan
                        </a>
                        
                    </div>
                </div>
            </div>

            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <div className={'kt-form col-lg-12 header-form kt-margin-t-0'}>
                    <hr/>
                    <h4>Pencarian Data Pasien:</h4>
                </div>
            </div>

           

            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <form className={'kt-form col-xl-12 header-form kt-margin-t-0 row'} 
                    //  onSubmit={handleSubmit(onSubmit)}
                >
                    <div className={'col-xl-4 col-lg-4'}>
                        <div className={'row col-xl-12'}>
                             <HorizontalInput
                                value={noFaktur}
                                onChange={(e) => setNoFaktur(e.target.value)}
                                label={'Nomor Faktur'}
                                inputType={'number'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={tanggal}
                                onChange={(e) => setTanggal(e.target.value)}
                                label={'Tanggal'}
                                inputType={'date'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={jam}
                                onChange={(e) => setJam(e.target.value)}
                                label={'Jam'}
                                inputType={'string'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={opertaor}
                                onChange={(e) => setOpertaor(e.target.value)}
                                label={'Operator'}
                                inputType={'number'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={noLab}
                                onChange={(e) => setNoLab(e.target.value)}
                                label={'Nomor Lab'}
                                inputType={'number'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                inputName={'noLab'}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={noMRS}
                                onChange={(e) => setNoMRS(e.target.value)}
                                label={'No MRS'}
                                inputType={'number'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'nama'}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={noRM}
                                onChange={(e) => setnoRM(e.target.value)}
                                label={'No RM'}
                                inputType={'number'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'nama'}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={karyawan}
                                onChange={(e) => setKaryawan(e.target.value)}
                                label={'Karyawan'}
                                inputType={'checkbox'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'nama'}
                                // ref={register} 
                            />
                      </div>
                    </div>
                    <div className={'col-xl-4 col-lg-4'}>
                        <div className={'row col-xl-12'}>
                            <HorizontalInput
                                    value={namaLengkap}
                                    onChange={(e) => setNamaLengkap(e.target.value)}
                                    label={'Nama lengkap'}
                                    inputType={'string'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    // inputName={'nama'}
                                    // ref={register} 
                                />
                                <HorizontalInput
                                    value={umur}
                                    onChange={(e) => setUmur(e.target.value)}
                                    label={'Umur'}
                                    inputType={'number'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    // inputName={'nama'}
                                    // ref={register} 
                                />
                                <HorizontalInput
                                    value={Alamat}
                                    onChange={(e) => setAlamat(e.target.value)}
                                    label={'Alamat'}
                                    inputType={'string'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    // inputName={'nama'}
                                    // ref={register} 
                                />
                                <SelectInput
                                
                                    value={RuangKamar}
                                    onChange={(e) => setRuangKamar(e)}
                                    label={'RuangKamar'}
                                    inputType={'text'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    options={listRuangKamar}
                                />
                                <SelectInput
                                    
                                    value={kelas}
                                    onChange={(e) => setKelas(e)}
                                    label={'Kelas'}
                                    inputType={'text'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    options={listKelas}
                                />
                                <SelectInput
                                
                                    value={dokter}
                                    onChange={(e) => setDokter(e)}
                                    label={'Dokter'}
                                    inputType={'text'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    options={listDokter}
                                />
                                <SelectInput
                                
                                value={namaPaket}
                                onChange={(e) => setNamaPaket(e)}
                                label={'Nama Paket'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                options={listNamaPaket}
                            />
                        </div>
                    </div>
                    <div className={'col-xl-4 col-lg-4'}>
                        <div className={'row col-xl-12'}>
                            <HorizontalInput
                                    value={asuransi}
                                    onChange={(e) => setAsuransi(e.target.value)}
                                    label={'Asuransi'}
                                    inputType={'string'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    // inputName={'no_mr'}
                                    // ref={register} 
                                />
                                <HorizontalInput
                                    value={instansi}
                                    onChange={(e) => setInstansi(e.target.value)}
                                    label={'Instansi'}
                                    inputType={'string'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    // inputName={'nama'}
                                    // ref={register} 
                                />
                                <HorizontalInput
                                    value={admission}
                                    onChange={(e) => setAdmission(e.target.value)}
                                    label={'Admission'}
                                    inputType={'string'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    // inputName={'no_mr'}
                                    // ref={register} 
                                />
                                <HorizontalInput
                                    value={Perujuk}
                                    onChange={(e) => setPerujuk(e.target.value)}
                                    label={'Perujuk'}
                                    inputType={'string'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    // inputName={'no_mr'}
                                    // ref={register} 
                                />
                                <HorizontalInput
                                    value={FeePasien}
                                    onChange={(e) => setFeePasien(e.target.value)}
                                    label={'Fee Dibayar Pasien'}
                                    inputType={'checkbox'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    // inputName={'no_mr'}
                                    // ref={register} 
                                />
                                <HorizontalInput
                                    value={SelisihPasien}
                                    onChange={(e) => setSelisihPasien(e.target.value)}
                                    label={'Selisih Dibayar Pasien'}
                                    inputType={'checkbox'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    // inputName={'no_mr'}
                                    // ref={register} 
                                />
                        </div>
                    </div>
                    <div className={'col-xl-4 col-lg-4 kt-margin-t-20'}>
                        <a 
                            // type={'submit'}
                            href={'/lab/entry/terimaa-sampel/pasien-mrs'}
                            className='col-5 btn btn-sm btn-primary kt-margin-t-20'>
                            Pasien MRS
                        </a>
                        <button 
                            // type={'submit'}
                            onClick={onClickRefresh}
                            className='col-5 btn btn-sm btn-primary kt-margin-t-20 kt-margin-l-10'>
                                <i className={'la la-filter'}/> Refresh
                        </button>
                    </div>
                </form>
            </div>

            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-60'}>
                <div className={'row'}>
                    <div className={'col-lg-8'}>
                        <Table
                            height={450}
                            disableNumber
                            title={'List Pemeriksaan'}
                            columns={tindakanColumnPeriksaLab}
                            tableType={'table-custom-2-table-left'}
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
                    <div className={'col-lg-4'}>
                        <Table
                            height={450}
                            disableNumber
                            title={'List Pemeriksaan'}
                            columns={tindakanColumnDataAlkes}
                            tableType={'table-custom-2-table-right'}
                            data={dataAlkes}
                            loading={loading}
                            // toolbar={toolBar}
                            isPaginate={!hidePagination}
                            total={meta.total_data}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            editable={!loading}
                            filterable={false}
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

            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20 kt-margin-l-30 kt-margin-r-30 border border-success'}>
                <div className={'row kt-margin-t-20 kt-margin-b-20'}>
                    <div className={'col-lg-2'}>
                        <h1 className={'float-right'}>Hasil Lab :</h1>
                    </div>
                    <div className={'col-lg-10'}>
                        <div className={'col-lg-12'}>
                            <div className={'form-group row'}>
                                <HorizontalInput
                                    value={''}
                                    label={'Jumlah_Rp'}
                                    inputType={'text'}
                                    colSize={2}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    inputName={"jumlah"}
                                />
                            </div>
                        </div>
                        <div className={'col-lg-12 kt-margin-t-10'}>
                            <div className={'form-group row'}>
                                <HorizontalInput
                                    value={''}
                                    label={'Diskon_Rp'}
                                    inputType={'text'}
                                    colSize={2}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    inputName={"diskon"}
                                />
                            </div>
                        </div>
                        <div className={'col-lg-12 kt-margin-t-10'}>
                            <div className={'form-group row'}>
                                <HorizontalInput
                                    value={''}
                                    label={'Total_Rp'}
                                    inputType={'text'}
                                    colSize={2}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    inputName={"total"}
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
};

export default PeriksaLab;
