import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import {detailDataPasienLab} from "../../../../pojo/master/data_pasien/data_pasien_lab";
import {detailDataRiwayatLab} from "../../../../pojo/master/data_pasien/data_riwayat_lab";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import _ from 'lodash';
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
import moment from 'moment';

const tindakanColumnPasien = [
    {
        id: 'nomor_rm',
        title: 'Nomor RM',
        width: '100px',
        align: 'left'
    },
    {
        id: 'nama_lengkap',
        title: 'Nama Lengkap',
        width: '200px',
        align: 'left'
    },
    {
        id: 'sex',
        title: 'Sex',
        width: '50px',
        align: 'left'
    },
    {
        id: 'umur',
        title: 'Umur',
        width: '50px',
        align: 'left'
    },
    {
        id: 'desa',
        title: 'Desa',
        width: '100px',
        align: 'left'
    },
    {
        id: 'kecamatan',
        title: 'Kecamatan',
        width: '100px',
        align: 'left'
    },
    {
        id: 'tmp_lahir',
        title: 'TmpLahir',
        width: '100px',
        align: 'left'
    },
    {
        id: 'tgl_lahir',
        title: 'TglLahir',
        width: '100px',
        align: 'left'
    },
    {
        id: 'telepon',
        title: 'Telepon',
        width: '100px',
        align: 'left'
    },
    {
        id: 'catatan',
        title: 'Catatan',
        width: '100px',
        align: 'left'
    }
];

const tindakanColumnRiwayat = [
    {
        id: 'nomor_mrs',
        title: 'Nomor MRS',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="1" autoFocus
                    value={row?.nomor_mrs}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'tgl_mrs',
        title: 'Tgl MRS',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="2" autoFocus
                    value={row?.tgl_mrs}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'unit',
        title: 'Unit',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="3" autoFocus
                    value={row?.unit}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'pembayaran',
        title: 'Pembayaran',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="4" autoFocus
                    value={row?.pembayaran}/>
            </>
        ),
        editRules: ['required']
    }
];

interface IPropsMasterDataPasien {
    hidePagination?: boolean;
}

const MasterDataPasien = (props: IPropsMasterDataPasien) => {
    let {
        hidePagination
    } = props;

    var dataDummyPasien = [
        {
            id: 1,
            nomor_rm: '11111111',
            nama_lengkap: 'Nama Pasien 1',
            sex: 'L',
            umur: '30 th',
            desa: 'Genengan',
            kecamatan: 'Pakisaji',
            tmp_lahir: 'MALANG',
            tgl_lahir: '25/06/1948',
            telepon: '12345678910',
            catatan: 'Catatan 1',
            riwayat: [1] 
        },
        {
            id: 2,
            nomor_rm: '22222222',
            nama_lengkap: 'Nama Pasien 2',
            sex: 'P',
            umur: '40 th',
            desa: 'Jatirejoyoso',
            kecamatan: 'Kepanjen',
            tmp_lahir: 'MALANG',
            tgl_lahir: '11/07/1938',
            telepon: '12345678910',
            catatan: 'Catatan 2',
            riwayat: [2]  
        },
        {
            id: 3,
            nomor_rm: '33333333',
            nama_lengkap: 'Nama Pasien 3',
            sex: 'L',
            umur: '50 th',
            desa: 'Babadan',
            kecamatan: 'Ngajum',
            tmp_lahir: 'PAMEKASAN',
            tgl_lahir: '20/03/1928',
            telepon: '12345678910',
            catatan: 'Catatan 3',
            riwayat: [3]  
        },
        {
            id: 4,
            nomor_rm: '44444444',
            nama_lengkap: 'Nama Pasien 4',
            sex: 'P',
            umur: '50 th',
            desa: 'Purworejo',
            kecamatan: 'Donomulyo',
            tmp_lahir: 'MALANG',
            tgl_lahir: '05/09/1918',
            telepon: '12345678910',
            catatan: 'Catatan 4' ,
            riwayat: [4] 
        }
    ];

    var dataDummyRiwayat = [
        {
            id: 1,
            nomor_mrs: '200310690',
            tgl_mrs: '20/03/2020',
            unit: 'IGD',
            pembayaran: 'Piutang'
        },
        {
            id: 2,
            nomor_mrs: '200310690',
            tgl_mrs: '20/03/2020',
            unit: 'KLINIK RAWAT JALAN',
            pembayaran: 'Piutang'
        },
        {
            id: 3,
            nomor_mrs: '16074348',
            tgl_mrs: '21/07/2016',
            unit: 'IGD',
            pembayaran: 'Lunas'
        },
        {
            id: 4,
            nomor_mrs: '14010743',
            tgl_mrs: '08/01/2014',
            unit: 'PENUNJANG PELAYANAN MEDIS',
            pembayaran: 'Lunas'
        }
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [dataPasien, setDataPasien] = useState<Array<detailDataPasienLab>>(dataDummyPasien);
    const [dataRiwayat, setDataRiwayat] = useState<Array<detailDataRiwayatLab>>([]);
    const [masterDataRiwayat, setMasterDataRiwayat] = useState<Array<detailDataRiwayatLab>>(dataDummyRiwayat);
    const [metaPasien, setMetaPasien] = useState<Metadata>({});
    const [metaRiwayat, setMetaRiwayat] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selectionPasien, setSelectionPasien] = useState<detailDataPasienLab>({});
    const [selectionRiwayat, setSelectionRiwayat] = useState<detailDataRiwayatLab>({});

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

    const toolBarRiwayat = ({editingItem}: any) => {
        return(
            <div style={{padding: 4}}>
                <LinkButton plain
                            disabled={(mode === 'add' || mode === 'edit' || isEmpty(selectionPasien))}
                            onClick={() => addNewData()}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Tambah
                </LinkButton>
                <LinkButton plain
                            disabled={(mode === 'add'|| mode === 'edit' || isEmpty(selectionRiwayat))}
                            onClick={() => {
                                tableRef?.beginEdit(selectionRiwayat);
                                setMode('edit');
                            }}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Ubah
                </LinkButton>
                <LinkButton plain
                            disabled={
                                (mode === 'add' || mode === 'edit' || isEmpty(selectionRiwayat)) ||
                                !selectionRiwayat
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
                                console.log(masterDataRiwayat);
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
            nomor_mrs: '',
            tgl_mrs: '',
            unit: '',
            pembayaran: '',
            _new: true
        };

        let newData = Array.from(dataRiwayat);
        newData.unshift(detailData);
        setDataRiwayat(newData);
        setMode('add');
        setSelectionRiwayat({});
        tableRef?.beginEdit(newData[0]);

        // const currentData = Array.from(data);
        // currentData.unshift(detailData);
        // setData(currentData);
        // setMode('add');
        // tableRef?.beginEdit(data[0]);
    };

    // // const getData = async () => {
    // //     try {
    // //         setLoading(true);
    // //         const resp = await dataDiitService.datadiet();
    // //         setData(resp.list);
    // //         setMeta(resp.metadata);
    // //         setLoading(false);

    // //     } catch (e) {
    // //         setLoading(false);
    // //         setData([]);
    // //     }
    // // };

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

            const newData = masterDataRiwayat.filter(row => row.id !== selectionRiwayat.id);
            setMasterDataRiwayat(newData);
            setLoading(false);
            NotifySuccess('Data Riwayat Pasien Berhasil Dihapus');

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
    };

    const onEditCancel = (event: any) => {
        setMode('');
        if (event.row._new) {
            const newData = dataRiwayat.filter(row => row !== event.row);
            setDataRiwayat(newData);
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
                    id: Number((dataDummyRiwayat[dataDummyRiwayat.length - 1 ]).id)+1,
                    nomor_mrs: event?.row?.nomor_mrs,
                    tgl_mrs: event?.row?.tgl_mrs,
                    unit: event?.row?.unit,
                    pembayaran: event?.row?.pembayaran,
                }

                //menambah row data dummy riwayat
                const newData = masterDataRiwayat;
                newData.push(payload);
                const currentData = newData.filter(row => row !== event.row);
                setMasterDataRiwayat(currentData);

                //menambahkan id row riwayat baru pada array riwayat di pasien
                for (var i in dataDummyPasien) {
                    if (dataDummyPasien[i].id === selectionPasien.id) {
                       dataDummyPasien[i].riwayat.push(payload.id);
                       break; //Stop this loop, we found it!
                    }
                }
                setDataPasien(dataDummyPasien);
                handleSelectionPasienChange(selectionPasien);

                setMode('');
                setLoading(false);
                NotifySuccess('Data Riwayat Berhasil Ditambahkan');
                
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
                    nomor_mrs: event?.row?.nomor_mrs,
                    tgl_mrs: event?.row?.tgl_mrs,
                    unit: event?.row?.unit,
                    pembayaran: event?.row?.pembayaran,
                }

                //merubah row data riwayat
                setMode('');
                setLoading(false);
                NotifySuccess('Data Riwayat Berhasil Ditambahkan');
                const newData = masterDataRiwayat;
                const index = masterDataRiwayat.findIndex(row => row.id === event.row.id);
                newData.splice(index, 1);
                newData.splice(index, 0, payload);
                setMasterDataRiwayat(newData);

                //menambahkan id row riwayat baru pada array riwayat di pasien
                // for (var i in dataDummyPasien) {
                //     if (dataDummyPasien[i].id === selectionPasien.id) {
                //        dataDummyPasien[i].riwayat.push(payload.id);
                //        break; //Stop this loop, we found it!
                //     }
                // }
                // setDataPasien(dataDummyPasien);
                // handleSelectionPasienChange(selectionPasien);

                setMode('');
                setLoading(false);
                NotifySuccess('Data Riwayat Berhasil Diubah');
            } else {
                setLoading(false);
            }
        } catch (e) {
            console.log('error', e);
            setLoading(false);

            if(mode === 'add') {
                tableRef?.beginEdit(dataRiwayat[0]);
            }
        }
    };

    function handleSelectionPasienChange(selection: any){
        const newRiwayatData = masterDataRiwayat.filter(function(riwayat){
            return selection.riwayat.indexOf(riwayat.id) !== -1;
        });
        setDataRiwayat(newRiwayatData);
        setSelectionPasien(selection);
    }

    function handleSelectionRiwayatChange(selection: any){
        setSelectionRiwayat(selection);
    }

    function handleChangeStartDate(e: any){
        console.log(e.target.value);
        // setStartDate(moment(e.target.value, "DD-MM-YYYY", true));
    }

    function handleChangeEndDate(e: any){
        console.log(e.target.value);
        // setEndDate(e.target.value);
    }

    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <div className={'kt-form col-lg-12 header-form kt-margin-t-25'}>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={startDate}
                            onChange={(e) => handleChangeStartDate(e)}
                            label={'Tanggal'}
                            inputType={'date'}
                            colSize={2}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                            inputName={"tes"}
                        />
                        <HorizontalInput
                            value={endDate}
                            onChange={(e) => handleChangeEndDate(e)}
                            label={'Sampai'}
                            inputType={'date'}
                            colSize={2}
                            formControlSm
                            disabled={false}
                        />
                    </div>
                </div>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <div className={'row'}>
                    <div className={'col-xl-8 col-md-8 col-sm-12'}>
                        <Table
                            height={450}
                            disableNumber
                            title={'List Data Pasien'}
                            columns={tindakanColumnPasien}
                            data={dataPasien}
                            tableType={'table-custom-2-table-left'}
                            loading={loading}
                            // toolbar={toolBar}
                            isPaginate={!hidePagination}
                            total={metaPasien.list_count}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            editable={!loading}
                            filterable={true}
                            selectionMode={(mode === 'edit' || mode === 'add') ? '' : 'single'}
                            selection={isEmpty(selectionPasien) && null}
                            onSelectionChange={(selection) => handleSelectionPasienChange(selection)}
                            onLoadTableRef={(ref) => onLoadTableRef(ref) }
                            onTableAction={onTableAction}
                            // onEditCancel={onEditCancel}
                            // onEditEnd={onEditEnd}
                        />
                    </div>
                    <div className={'col-xl-4 col-md-4 col-sm-12'}>
                        <Table
                            height={450}
                            disableNumber
                            title={'List Data Riwayat'}
                            columns={tindakanColumnRiwayat}
                            data={dataRiwayat}
                            tableType={'table-custom-2-table-right'}
                            loading={loading}
                            toolbar={toolBarRiwayat}
                            isPaginate={!hidePagination}
                            total={metaRiwayat.list_count}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            paginationOptions={'small'}
                            editable={!loading}
                            filterable={true}
                            selectionMode={(mode === 'edit' || mode === 'add') ? '' : 'single'}
                            selection={isEmpty(selectionRiwayat) && null}
                            onSelectionChange={(selection) => handleSelectionRiwayatChange(selection)}
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

export default MasterDataPasien;
