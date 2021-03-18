import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import {detailDataAlkes} from "../../../../pojo/entry/terima_sampel/baru/data_alkes";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox, CheckBox} from "rc-easyui";
import SelectInput,{ISelector} from '../../../../components/Forms/Input/SelectInput';
import {NotifySuccess} from "../../../../services/notification.service";
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
import _ from 'lodash';
import moment from 'moment';
import { red } from '@material-ui/core/colors';

import { detailDataKimiaKarbo } from '../../../../pojo/entry/terima_sampel/baru/data_kimia_karbo';
import { detailDataHematologi } from '../../../../pojo/entry/terima_sampel/baru/data_hematologi';
import { detailDataKimiaHati } from '../../../../pojo/entry/terima_sampel/baru/data_kimia_hati';

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumnTerimaSampelBaru = [
    {
        id: 'cek',
        title: 'Cek',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <Tooltip tracking>
                    <CheckBox value={row?.cek} checked={row?.cek}></CheckBox>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
        render: ({row}: any) => (
            <>
                <div>
                    <CheckBox checked={row?.cek}></CheckBox>
                </div>
            </>
        )
    },
    {
        id: 'uraian',
        title: 'Uraian',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="2" autoFocus
                    value={row?.uraian}/>
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
    }
];

interface IPropsTerimaSampelBaru {
    hidePagination?: boolean;
}

const TerimaSampelBaru = (props: IPropsTerimaSampelBaru) => {
    const [noLab, setNoLab] = useState<number>(0);
    const [noMRS, setNoMRS] = useState<number>(0);
    const [asuransi, setAsuransi] = useState<string>('');
    const [instansi, setInstansi] = useState<string>('');
    const [admission, setAdmission] = useState<string>('');
    const [rujukPartial, setRujukPartial] = useState<string>('');
    const [noMR, setnoMR] = useState<string>('');
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

    const dataDummyAlkes = [
        {
            id: 1,
            cek: false,
            uraian: 'Sampling',
            qty : 1 ,
        }
    ];
    const dataDummyHematologi = [
        {
            id: 1,
            cek: false,
            uraian: 'hapusan malaria',
            qty : 1 ,
        },
        {
            id: 2,
            cek: false,
            uraian: 'hapusan darah',
            qty : 1 ,
        }
    ];
    const dataDummyKimiaKarbo = [
        {
            id: 1,
            cek: false,
            uraian: 'Gdp',
            qty : 1 ,
        }
    ];
    const dataDummyKimiaHati = [
        {
            id: 1,
            cek: false,
            uraian: 'Total Protein',
            qty : 1 ,
        }
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataAlkes>>(dataDummyAlkes);
    const [dataHematologi, setDataHematologi] = useState<Array<detailDataHematologi>>(dataDummyHematologi);
    const [dataKimiaKarbo, setDataKimiaKarbo] = useState<Array<detailDataKimiaKarbo>>(dataDummyKimiaKarbo);
    const [dataKimiaHati, setDataKimiaHati] = useState<Array<detailDataKimiaHati>>(dataDummyKimiaHati);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataAlkes>({});
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
                {/* <LinkButton plain
                            disabled={(mode === 'add' || mode === 'edit')}
                            onClick={() => addNewData()}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Tambah
                </LinkButton> */}
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
            cek: true,
            uraian : '',
            qty: 0,
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
            NotifySuccess('Data Terima Sampel Berhasil Dihapus');

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
                    cek: event?.row?.cek,
                    uraian: event?.row?.uraian,
                    qty: event?.row?.qty,
                }
                const newData = data;
                newData.push(payload);
                const currentData = newData.filter(row => row !== event.row);
                setData(currentData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Terima Sampel Berhasil Ditambahkan');
                
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
                    cek: event?.row?.cek,
                    uraian: event?.row?.uraian,
                    qty: event?.row?.qty,
                }
                const newData = data;
                const index = data.findIndex(row => row.id === event.row.id);
                newData.splice(index, 1);
                newData.splice(index, 0, payload);
                setData(newData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Terima Sampel Berhasil Diubah');
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
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <div className={'kt-form col-xl-12 header-form kt-margin-t-25 row'}>
                    <div className={'col-xl-2'}>
                        <a 
                            // type={'submit'}
                            href={'#'}
                            className='col-1 btn btn-sm btn-secondary kt-margin-t-20 kt-margin-l-10 float-right'>
                            Batal
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
                </div>
            </div>
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <form className={'kt-form col-xl-12 header-form kt-margin-t-0 row'} 
                    //  onSubmit={handleSubmit(onSubmit)}
                >
                    <div className={'col-xl-4'}>
                        <h4>Pencarian Data Pasien:</h4>
                        <div className={'row col-xl-12'}>
                            <HorizontalInput
                                value={noLab}
                                onChange={(e) => setNoLab(e.target.value)}
                                label={'Nomor Lab'}
                                inputType={'number'}
                                colSize={4}
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
                                colSize={4}
                                labelSize={1}
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
                                colSize={4}
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
                            colSize={4}
                            labelSize={1}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                            options={listNamaPaket}
                        />
                         <div className={'col-xl-2 kt-margin-b-20'}>
                            <a 
                                // type={'submit'}
                                href={'/lab/entry/terimaa-sampel/pasien-mrs'}
                                className='col-1 btn btn-sm btn-primary kt-margin-t-20'
                                >Pasien MRS
                            </a>
                            <button 
                                // type={'submit'}
                                onClick={onClickRefresh}
                                className='col-1 btn btn-sm btn-primary kt-margin-t-20 kt-margin-l-10'>
                                    <i className={'la la-filter'}/> Proses
                            </button>
                        </div>
                        <HorizontalInput
                                value={asuransi}
                                onChange={(e) => setAsuransi(e.target.value)}
                                label={'Asuransi'}
                                inputType={'string'}
                                colSize={4}
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
                                colSize={4}
                                labelSize={1}
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
                                colSize={4}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'no_mr'}
                                // ref={register} 
                            />
                             <HorizontalInput
                                value={rujukPartial}
                                onChange={(e) => setRujukPartial(e.target.value)}
                                label={'Rujuk Partial'}
                                inputType={'checkbox'}
                                colSize={4}
                                labelSize={1}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'no_mr'}
                                // ref={register} 
                            />
                             <SelectInput
                            
                                value={kondisiSampel}
                                onChange={(e) => setKondisiSampel(e)}
                                label={'Sampel'}
                                inputType={'text'}
                                colSize={4}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                options={listKondisiSampel}
                             />
                             
                             <SelectInput
                            
                                value={golPemeriksaan}
                                onChange={(e) => setGolPemeriksaan(e)}
                                label={'Gol.Pemeriksaan'}
                                inputType={'text'}
                                colSize={4}
                                labelSize={1}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                options={listKondisiSampel}
                            />
                            <SelectInput
                            
                            value={kondisiSampel}
                            onChange={(e) => setKondisiSampel(e)}
                            label={'Sampel'}
                            inputType={'text'}
                            colSize={4}
                            labelSize={3}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                            options={listKondisiSampel}
                         />
                         
                      </div>
                    </div>
                    <div className={'col-xl-2'}>
                        <button 
                            // type={'submit'}
                            onClick={onClickRefresh}
                            className='col-1 btn btn-sm btn-primary kt-margin-t-20 kt-margin-l-60'>
                                <i className={'la la-filter'}/> Refresh
                        </button>
                    </div>
                </form>
            </div>

            {/*<div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>*/}
            {/*</div>*/}
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <Table
                    height={40}
                    disableNumber
                    title={'List Data Alkes'}
                    columns={tindakanColumnTerimaSampelBaru}
                    data={data}
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
                <Table
                    height={40}
                    disableNumber
                    title={'List Data Hematologi'}
                    columns={tindakanColumnTerimaSampelBaru}
                    data={dataHematologi}
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
                <Table
                    height={40}
                    disableNumber
                    title={'List Data Kimia Karbohidrat'}
                    columns={tindakanColumnTerimaSampelBaru}
                    data={dataKimiaKarbo}
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
                <Table
                    height={40}
                    disableNumber
                    title={'List Data Kimia Hati'}
                    columns={tindakanColumnTerimaSampelBaru}
                    data={dataKimiaHati}
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
    )
};

export default TerimaSampelBaru;
