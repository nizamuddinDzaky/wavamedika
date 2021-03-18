import React, { useState, useEffect,useCallback } from 'react';
import Metadata from '../../../../pojo/Metadata';
import customForm from '../../../../assets/js/customForm';
import Table from "../../../../components/Table/Table";
import master_instansiservice from '../../../../services/master_instansi.service';
import { LinkButton, CheckBox } from 'rc-easyui';
// import ViewRiwayatPasien from './ViewRiwayatPasien/ViewRiwayatPasien';
// import PesanPoli from './PesanPoli/PesanPoli';
import {withRouter } from 'react-router';

const listDataInstansiColumn = [
    {
        id: 'aktif',
        title: 'Aktif',
        width: "8px",
        align: 'center',
        field: 'ck',
        render: ({ row }: any) => (
            <CheckBox disabled checked={row.aktif === '1'}></CheckBox>
        ),
        editable: false
    },
    {
        id: 'kode_instansi',
        title: 'Asuransi',
        width: "40px"
    },
    {
        id: 'nama_instansi',
        title: 'Nama Instansi',
        width: "50px"
    },
    {
        id: 'alamat',
        title: 'Alamat',
        width: "50px"
    },
    {
        id: 'kota',
        title: 'Kota',
        width: "50px"
    },
    {
        id: 'alamat_klaim',
        title: 'Alamat Klaim',
        width: "50px"
    },
];

const MasterDataInstansiList: React.FC = (props: any) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);

    const [meta, setMeta] = useState<Metadata>({});
    const [selection, setSelection] = useState<any>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const [tableRef, setTableRef] = useState<any>(null); 

    const getData = async (limit?: number, page?: number ) => {
        try {
            setLoading(true);
            const payload = {
                halaman: page? page: pageNumber,
                batas: limit? limit: pageSize,
                aktif: 1
                
            };
            const resp = await master_instansiservice.mkt_masterinstansi_masterinstansi(payload);
        
            
            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);

        } catch (e) {
            setLoading(false);
            setData([]);
        }
    };

    const handleAdd = () => {
        props.history.push('/fo/master-data/instansi/data-instansi/add');
    }

    const handleChange = () => {
        props.history.push('/fo/master-data/instansi/data-instansi/'+ selection?.kode_instansi);
    }

    const handleDaftarTarifTindakan = () => {
        props.history.push('/fo/master-data/instansi/data-tarif-tindakan/'+ selection?.kode_instansi);
    }

    const handleRefresh = () => {
        getData();
    }


    const onTableAction = async (e: any) => {
        console.log('e', e);

        if(e.pageSize) {
            setPageSize(e?.pageSize);
        }

        if(e.pageNumber) {
            setPageNumber(e?.pageNumber);
        }


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            tableRef?.cancelEdit();

            getData(e.pageSize, e.pageNumber);
        } else {
            getData(e.pageSize, e.pageNumber);
        }

        if(props.onTableAction) {
            props.onTableAction(e)
        }
    };
    const onLoadTableRef = (ref: any) => {
        setTableRef(ref)
        new (customForm as any)(ref); // for tab on enter, inside table ref
    };

    const onSelectionChange = useCallback((e: any) => {
        setSelection(e);
        console.log(e)
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props]);

    useEffect(() => {
        getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props?.optionalProps]);

    
    return(
        <>
            <Table
                disableNumber
                isLazy
                title={'Data Instansi'}
                columns={listDataInstansiColumn}
                data={data}
                loading={loading}
                isPaginate={true}
                total={meta?.row_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                onTableAction={onTableAction}
                onLoadTableRef={(ref: any) => onLoadTableRef(ref) }
                selectionMode={'single'}
                selection={selection}
                onSelectionChange={onSelectionChange}
                toolbar={() => {
                    return(
                        <>
                        <div style={{padding: 4}}>
                                <LinkButton plain
                                            // disabled={(mode === 'add' || mode === 'edit')}
                                            onClick={() => handleAdd()}
                                >
                                    <i className="flaticon-edit-1"></i>
                                    &nbsp;
                                    Tambah
                                </LinkButton>
                                <LinkButton plain
                                            disabled={!selection?.kode_instansi}
                                            onClick={() => handleChange()}
                                >
                                    <i className="flaticon-edit-1"></i>
                                    &nbsp;
                                    Ubah
                                </LinkButton>
                                <LinkButton plain
                                            disabled={!selection?.kode_instansi}
                                            onClick={() => handleDaftarTarifTindakan()}
                                >
                                    <i className="flaticon-edit-1"></i>
                                    &nbsp;
                                    Daftar Tarif Tindakan
                                </LinkButton>
                                <LinkButton plain
                                            onClick={handleRefresh}
                                >
                                    <i className="flaticon-refresh"></i>
                                    &nbsp;
                                    Refresh
                                </LinkButton>
                            </div>
                        </>
                    )
                }}

                onDoubleClickCell={handleChange}
            />
        </>
    )
};

export default withRouter(MasterDataInstansiList);