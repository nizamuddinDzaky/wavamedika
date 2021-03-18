import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import {detailDataListPemeriksaan} from "../../../../pojo/entry/hasil_lab/list_pemeriksaan";
import {detailDataStatusPemeriksaan} from "../../../../pojo/entry/hasil_lab/status_pemeriksaan";
import {detailDataHasilPemeriksaan} from "../../../../pojo/entry/hasil_lab/hasil_pemeriksaan";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox, ButtonGroup} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
import SelectInput,{ISelector} from '../../../../components/Forms/Input/SelectInput';
import _ from 'lodash';
import moment from 'moment';
import { red } from '@material-ui/core/colors';

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumnHasilPemeriksaan = [
    {
        id: 'hasil_pemeriksaan',
        title: 'Hasil Pemeriksaan',
        width: '1000px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="1" autoFocus
                    value={row?.hasil_pemeriksaan}/>
            </>
        ),
        editRules: ['required']
    }
];


const tindakanColumnStatusPemeriksaan = [
    {
        id: 'no_lab',
        title: 'No Lab',
        width: '100px',
        align: 'left',
        frozen : true,
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="1" autoFocus
                    value={row?.no_lab}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'selesai_operator',
        title: 'Selesai Operator',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="2" autoFocus
                    value={row?.selesai_operator}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'waktu_selesai',
        title: 'Waktu Selesai',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="3" autoFocus
                    value={row?.waktu_selesai}/>
            </>
        ),
        editRules: ['required']
        }
];


const tindakanColumnHasilLab = [
    {
        id: 'tanggal',
        title: 'Tanggal',
        width: '100px',
        align: 'left',
        frozen : true,
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="1" autoFocus
                    value={row?.tanggal}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'no_lab',
        title: 'No LAB',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="2" autoFocus
                    value={row?.no_lab}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'hasil_pemeriksaan',
        title: 'Hasil Pemeriksaan',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="3" autoFocus
                    value={row?.hasil_pemeriksaan}/>
            </>
        ),
        editRules: ['required']
        }
];

interface IPropsHasilLab {
    hidePagination?: boolean;
}

const HasilLab = (props: IPropsHasilLab) => {
    const [noLab, setNoLab] = useState<number>(0);
    const [noMRS, setNoMRS] = useState<number>(0);

    const [umur, setUmur] = useState<number>(0);
    const [noFaktur, setNoFaktur] = useState<number>(0);
    const [tanggal, setTanggal] = useState<string>(moment().format('YYYY-MM-DD'));
    const [jam, setJam] = useState<string>('');
    const [opertaor, setOpertaor] = useState<number>(0);
    const [namaLengkap, setNamaLengkap] = useState<string>('');
    const [JenisKelamin, setJenisKelamin] = useState<string>('');
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
    const [Pemeriksa, setPemeriksa] = useState<ISelector>({
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
    const [listPemeriksa, setListPemeriksa] = useState<Array<ISelector>>([]);
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

    const dataDummyHasilLab = [
        {
            id: 1,
            tanggal: '12-12-2020',
            no_lab: 43974,
            hasil_pemeriksaan: 'bagus',
        }
    ];

    const dataDummyHasilPemeriksaan = [
        {
            id: 1,
            hasil_pemeriksaan: 'bagus',
        }
    ];

    const dataDummyStatusPemeriksaan = [
        {
            id: 1,
            no_lab: 9848497,
            selesai_operator: '12-02-2020',
            waktu_selesai: '12-03-2020',
        }
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataListPemeriksaan>>(dataDummyHasilLab);
    const [dataStatus, setDataStatus] = useState<Array<detailDataStatusPemeriksaan>>(dataDummyStatusPemeriksaan);
    const [dataHasil, setDataHasil] = useState<Array<detailDataHasilPemeriksaan>>(dataDummyHasilPemeriksaan);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataListPemeriksaan>({});
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

    const toolBarList = ({editingItem}: any) => {
        return(
            <div style={{padding: 4}}>
                <div className={'form-group row'}>
                             <HorizontalInput
                                    value={''}
                                    label={'Nama'}
                                    inputType={'select'}
                                    colSize={4}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    inputName={"nama"}
                                />
                <LinkButton>
                    entry
                </LinkButton>
                </div>
            </div>
        )
    };

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
            tanggal: '',
            no_lab: 0,
            hasil_pemeriksaan: '',
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
                    tanggal: event?.row?.tanggal,
                    no_lab: event?.row?.no_lab,
                    hasil_pemeriksaan: event?.row?.hasil_pemeriksaan,
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
                    tanggal: event?.row?.tanggal,
                    no_lab: event?.row?.no_lab,
                    hasil_pemeriksaan: event?.row?.hasil_pemeriksaan,
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
                            href={'#'}
                            className='col-1 btn btn-sm btn-warning kt-margin-t-20 kt-margin-l-10 float-right'>
                            Edit
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
                    <div className={'col-xl-4 col-lg-6'}>
                        <div className={'row col-xl-12'}>
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
                         <HorizontalInput
                            value={Perujuk}
                            onChange={(e) => setPerujuk(e.target.value)}
                            label={'Perujuk'}
                            inputType={'string'}
                            colSize={9}
                            labelSize={3}
                            // fontSm={true}
                            formControlSm
                            disabled={true}
                            // inputName={'no_mr'}
                            // ref={register} 
                        />
                      </div>
                    </div>
                    <div className={'row col-xl-4 col-lg-6'}>
                    <HorizontalInput
                                value={namaLengkap}
                                onChange={(e) => setNamaLengkap(e.target.value)}
                                label={'Nama Pasien'}
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
                                value={JenisKelamin}
                                onChange={(e) => setJenisKelamin(e.target.value)}
                                label={'Jenis Kelamin'}
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
                                
                                value={Pemeriksa}
                                onChange={(e) => setPemeriksa(e)}
                                label={'Pemeriksa'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                options={listPemeriksa}
                            />
                    </div>
                    <div className={'col-xl-2 col-lg-2 kt-margin-t-20'}>
                        <button 
                            // type={'submit'}
                            onClick={onClickRefresh}
                            className='col-12 btn btn-sm btn-primary kt-margin-t-20 kt-margin-l-10'>
                                <i className={'la la-filter'}/> Refresh
                        </button>
                    </div>
                </form>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-60'}>
                <div className={'row'}>
                    <div className={'col-lg-6'}>
                        <Table
                        height={100}
                        disableNumber
                        title={'List Pemeriksaan'}
                        columns={tindakanColumnHasilLab}
                        tableType={'table-custom-2-table-left'}
                        data={data}
                        toolbar={toolBarList}
                        loading={loading}
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
                    <div className={'col-lg-6'}>
                        <Table
                            height={100}
                            disableNumber
                            title={'Status Pemeriksaan'}
                            columns={tindakanColumnStatusPemeriksaan}
                            tableType={'table-custom-2-table-right'}
                            data={dataStatus}
                            loading={loading}
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
                <div className={'col-lg-10 kt-margin-l-90'}>
                        <Table
                            height={70}
                            disableNumber
                            title={'Hasil Pemeriksaan'}
                            columns={tindakanColumnHasilPemeriksaan}
                            tableType={'table-custom-2-table-top'}
                            data={dataHasil}
                            loading={loading}
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
    )
};

export default HasilLab;
