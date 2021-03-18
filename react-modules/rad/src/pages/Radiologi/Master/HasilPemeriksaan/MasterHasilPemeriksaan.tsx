import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import {detailDataRadiologi} from "../../../../pojo/master/hasil_pemeriksaan/data_radiologi";
import {detailHasilPemeriksaan} from "../../../../pojo/master/hasil_pemeriksaan/data_hasil";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import _ from 'lodash';
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
import moment from 'moment';

const tindakanColumnRadiologi = [
    {
        id: 'nama',
        title: 'Nama',
        width: '100px',
        align: 'left'
    },
    
];

const tindakanColumnHasil = [
    {
        id: 'kategori',
        title: 'Kategori',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="1" autoFocus
                    value={row?.kategori}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'jenis_hasil',
        title: 'Deskripsi Jenis Hasil',
        width: '250px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="2" autoFocus
                    value={row?.jenis_hasil}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'diagnosa_klinis',
        title: 'Diagnosa Klinis',
        width: '400px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="3" autoFocus
                    value={row?.diagnosa_klinis}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'kesimpulan',
        title: 'Kesimpulan',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="4" autoFocus
                    value={row?.kesimpulan}/>
            </>
        ),
        editRules: ['required']
    }
];

interface IPropsMasterHasilPemeriksaan {
    hidePagination?: boolean;
}

const MasterHasilPemeriksaan = (props: IPropsMasterHasilPemeriksaan) => {
    let {
        hidePagination
    } = props;

    var dataDummyRadiologi = [
        {
            id: 1,
            nama : 'CT ABD',
            hasil: [1] 
        },
        {
            id: 2,
            nama : 'CT ABD B',
            hasil: [2]  
        },
        {
            id: 3,
            nama : 'CT ABD C',
            hasil: [3]  
        },
    ];

    var dataDummyHasil = [
        {
            id: 1,
            kategori : 'CT SCAN',
            jenis_hasil: 'CT Scan Kepala tanpa kontras dengan tebal irisan 7 mm',
            diagnosa_klinis: 'Tampak sulci yang dalam dan gyri yang melebar',
            kesimpulan: 'Brain atrophy'
        },
        {
            id: 2,
            kategori : 'CT SCAN B',
            jenis_hasil: 'CT Scan Kepala tanpa kontras dengan tebal irisan 7 mm',
            diagnosa_klinis: 'Tampak sulci yang dalam dan gyri yang melebar',
            kesimpulan: 'Brain atrophy'
        },
        {
            id: 3,
            kategori : 'CT SCAN C',
            jenis_hasil: 'CT Scan Kepala tanpa kontras dengan tebal irisan 7 mm',
            diagnosa_klinis: 'Tampak sulci yang dalam dan gyri yang melebar',
            kesimpulan: 'Brain atrophy'
        },
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [dataRadiologi, setDataRadiologi] = useState<Array<detailDataRadiologi>>(dataDummyRadiologi);
    const [dataHasil, setDataHasil] = useState<Array<detailHasilPemeriksaan>>([]);
    const [masterDataHasil, setMasterDataHasil] = useState<Array<detailHasilPemeriksaan>>(dataDummyHasil);
    const [metaRadiologi, setMetaRadiologi] = useState<Metadata>({});
    const [metaHasil, setMetaHasil] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selectionRadiologi, setSelectionRadiologi] = useState<detailDataRadiologi>({});
    const [selectionHasil, setSelectionHasil] = useState<detailHasilPemeriksaan>({});

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
                            disabled={(mode === 'add' || mode === 'edit' || isEmpty(selectionRadiologi))}
                            onClick={() => addNewData()}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Tambah
                </LinkButton>
                <LinkButton plain
                            disabled={(mode === 'add'|| mode === 'edit' || isEmpty(selectionHasil))}
                            onClick={() => {
                                tableRef?.beginEdit(selectionHasil);
                                setMode('edit');
                            }}
                >
                    <i className="la la-edit"></i>
                    &nbsp;
                    Ubah
                </LinkButton>
                <LinkButton plain
                            disabled={
                                (mode === 'add' || mode === 'edit' || isEmpty(selectionHasil)) ||
                                !selectionHasil
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
            id: 0,
            kategori: '',
            jenis_hasil: '',
            diagnosa_klinis: '',
            kesimpulan: '',
            _new: true
        };

        let newData = Array.from(dataHasil);
        newData.unshift(detailData);
        setDataHasil(newData);
        setMode('add');
        setSelectionHasil({});
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

            const newData = masterDataHasil.filter(row => row.id !== selectionHasil.id);
            setMasterDataHasil(newData);
            setLoading(false);
            NotifySuccess('Hasil Pemeriksaan Pasien Berhasil Dihapus');

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
            const newData = dataHasil.filter(row => row !== event.row);
            setDataHasil(newData);
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
                    id: Number((dataDummyHasil[dataDummyHasil.length - 1 ]).id)+1,
                    kategori: event?.row?.kategori,
                    jenis_hasil: event?.row?.jenis_hasil,
                    diagnosa_klinis: event?.row?.diagnosa_klinis,
                    kesimpulan: event?.row?.kesimpulan,
                }

                //menambah row data dummy riwayat
                const newData = masterDataHasil;
                newData.push(payload);
                const currentData = newData.filter(row => row !== event.row);
                setMasterDataHasil(currentData);

                //menambahkan id row riwayat baru pada array riwayat di pasien
                for (var i in dataDummyRadiologi) {
                    if (dataDummyRadiologi[i].id === selectionRadiologi.id) {
                       dataDummyRadiologi[i].hasil.push(payload.id);
                       break; //Stop this loop, we found it!
                    }
                }
                setDataRadiologi(dataDummyRadiologi);
                handleSelectionRadiologiChange(selectionRadiologi);

                setMode('');
                setLoading(false);
                NotifySuccess('Hasil Pemeriksaan Berhasil Ditambahkan');
                
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
                    kategori: event?.row?.kategori,
                    jenis_hasil: event?.row?.jenis_hasil,
                    diagnosa_klinis: event?.row?.diagnosa_klinis,
                    kesimpulan: event?.row?.kesimpulan,
                }

                //merubah row data riwayat
                setMode('');
                setLoading(false);
                NotifySuccess('Hasil Pemeriksaan Berhasil Ditambahkan');
                const newData = masterDataHasil;
                const index = masterDataHasil.findIndex(row => row.id === event.row.id);
                newData.splice(index, 1);
                newData.splice(index, 0, payload);
                setMasterDataHasil(newData);

                //menambahkan id row riwayat baru pada array riwayat di pasien
                // for (var i in dataDummyRadiologi) {
                //     if (dataDummyRadiologi[i].id === selectionRadiologi.id) {
                //        dataDummyRadiologi[i].riwayat.push(payload.id);
                //        break; //Stop this loop, we found it!
                //     }
                // }
                // setDataRadiologi(dataDummyRadiologi);
                // handleSelectionRadiologiChange(selectionRadiologi);

                setMode('');
                setLoading(false);
                NotifySuccess('Hasil Pemeriksaan Berhasil Diubah');
            } else {
                setLoading(false);
            }
        } catch (e) {
            console.log('error', e);
            setLoading(false);

            if(mode === 'add') {
                tableRef?.beginEdit(dataHasil[0]);
            }
        }
    };

    function handleSelectionRadiologiChange(selection: any){
        const newHasilData = masterDataHasil.filter(function(hasil){
            return selection.hasil.indexOf(hasil.id) !== -1;
        });
        setDataHasil(newHasilData);
        setSelectionRadiologi(selection);
    }

    function handleSelectionHasilChange(selection: any){
        setSelectionHasil(selection);
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
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <div className={'row'}>
                    <div className={'col-xl-4 col-md-4 col-sm-12'}>
                        <Table
                            height={450}
                            disableNumber
                            title={'List Data Radiologi'}
                            columns={tindakanColumnRadiologi}
                            data={dataRadiologi}
                            tableType={'table-custom-2-table-left'}
                            loading={loading}
                            // toolbar={toolBar}
                            isPaginate={!hidePagination}
                            total={metaRadiologi.total_data}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            editable={!loading}
                            filterable={true}
                            selectionMode={(mode === 'edit' || mode === 'add') ? '' : 'single'}
                            selection={isEmpty(selectionRadiologi) && null}
                            onSelectionChange={(selection) => handleSelectionRadiologiChange(selection)}
                            onLoadTableRef={(ref) => onLoadTableRef(ref) }
                            onTableAction={onTableAction}
                            // onEditCancel={onEditCancel}
                            // onEditEnd={onEditEnd}
                        />
                    </div>
                    <div className={'col-xl-8 col-md-8 col-sm-12'}>
                        <Table
                            height={450}
                            disableNumber
                            title={'List Hasil Pemeriksaan'}
                            columns={tindakanColumnHasil}
                            data={dataHasil}
                            tableType={'table-custom-2-table-right'}
                            loading={loading}
                            toolbar={toolBarRiwayat}
                            isPaginate={!hidePagination}
                            total={metaHasil.total_data}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            paginationOptions={'small'}
                            editable={!loading}
                            filterable={true}
                            selectionMode={(mode === 'edit' || mode === 'add') ? '' : 'single'}
                            selection={isEmpty(selectionHasil) && null}
                            onSelectionChange={(selection) => handleSelectionHasilChange(selection)}
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

export default MasterHasilPemeriksaan;
