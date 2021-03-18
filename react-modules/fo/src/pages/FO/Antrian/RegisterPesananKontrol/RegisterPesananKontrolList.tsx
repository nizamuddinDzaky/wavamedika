import React, { useState, useEffect } from 'react';
import Metadata from '../../../../pojo/Metadata';
import Table from "../../../../components/Table/Table";
import { RouteComponentProps, withRouter } from 'react-router';
import {  LinkButton } from 'rc-easyui';
import antrian_register_pesanan_kontrolService from '../../../../services/antrian_register_pesanan_kontrol.service';

const useColumn = () => {
    return [
        {
            id: 'no_mr',
            title: 'No. Awal',
            width: "30px",
            align: 'center'
        },
        {
            id: 'nama_lengkap',
            title: 'No. Akhir',
            width: "30px",
        },
        {
            id: 'kontrol',
            title: 'Nama Pasien',
            width: "80px"
        },
        {
            id: 'no_mr',
            title: 'No. RM',
            width: "40px",
        },
        {
            id: 'id_mrs',
            title: 'No. MRS',
            width: "40px",
        },
        {
            id: 'sex',
            title: 'Sex',
            width: "20px",
        },
        {
            id: 'umur',
            title: 'Umur',
            width: "50px",
        },
        {
            id: 'alamat',
            title: 'Alamat',
            width: "90px",
        },
        {
            id: 'kecamatan',
            title: 'Kecamatan',
            width: "60px",
        },
        {
            id: 'telepon',
            title: 'Telepon/HP',
            width: "80px",
        }
    ];
}

type IProps = RouteComponentProps & {
    onTableAction?: (e: any) => void;
    tgl1?: string;
    tgl2?: string;
    ruang?: string;
    dokter?: string;
    kontrol?: 'Semua' | 'Datang' | 'Tidak Datang';
    tanggal?: 'Pesanan' | 'Input',
    

}

const RegisterPesananKontrolList: React.FC<IProps> = (props: IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);
    const [mode] = useState<string>('');

    const [meta, setMeta] = useState<Metadata>({});
    // const [selection, setSelection] = useState<any>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);


    const [tableRef, setTableRef] = useState<any>(null);

    const getData = async (limit?: number, page?: number ) => {
        try {
            setLoading(true);
            // setSelection(null);

            const payload = {
                halaman: pageNumber,
                batas: pageSize,
                tgl1: props?.tgl1,
                tgl2: props?.tgl2,
                ruang: props?.ruang,
                dokter: props?.dokter,
                kontrol: props?.kontrol,
                tanggal: props?.tanggal,
                poli: '_'
            }

            const resp = await antrian_register_pesanan_kontrolService.mkt_lapregpesanankontrol_view_lapregpesanankontrol(payload);
            if(resp && Array.isArray(resp.list) && resp.list.length >0) {
                setData(resp.list);
            }

            setMeta(resp.metadata);
            setLoading(false);
        } catch (e) {
            setLoading(false);
            setData([]);
        }
    };


    const onTableAction = async (e: any) => {
        console.log('e', e);

        if(e.pageSize) {
            tableRef?.cancelEdit();
            setPageSize(e?.pageSize);
        }

        if(e.pageNumber) {
            tableRef?.cancelEdit();
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

    const listColumn = useColumn();

    const handleRefresh = () => {
        getData();
    }
    
    const onLoadTableRef = (ref: any) => {
        setTableRef(ref)
        // new (customForm as any)(ref); // for tab on enter, inside table ref
    };

    useEffect(() => {
        getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.tgl1, props.tgl2, props.dokter, props.ruang, props.kontrol, props.tanggal])

    useEffect(() => {
        if(tableRef && tableRef !== null && mode === 'add' ) {
            tableRef?.beginEdit(data[0]);
            // console.log('data', data)
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [data, mode]);
    return(
        <>
            <Table
                isLazy
                title={'Register Pesanan Kontrol'}
                columns={listColumn}
                data={data}
                loading={loading}
                disableNumber
                isPaginate={true}
                total={meta?.row_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                onTableAction={onTableAction}
                onLoadTableRef={(ref: any) => onLoadTableRef(ref) }
                // selectionMode={'single'}
                // selection={selection}
                editable={!loading}
                // onSelectionChange={onSelectionChange}
                // onDoubleClickCell={handleSMS}
                toolbar={({editingItem}: any) => {
                    return(
                        <>
                            <div style={{padding: 4}}>
                                <LinkButton plain
                                                // onClick={handleSMS}
                                                // disabled={!selection?.id_rencanakontrol}
                                    >
                                        <i className="flaticon2-phone"></i>
                                        &nbsp;
                                        SMS
                                </LinkButton>
                                <LinkButton plain
                                            onClick={handleRefresh}
                                            // disabled={(mode === 'add' || mode === 'edit')}
                                >
                                    <i className="flaticon-refresh"></i>
                                    &nbsp;
                                    Refresh
                                </LinkButton>
                            </div>
                        </>
                    )
                }}
                // onEditCancel={onEditCancel}
                // onEditEnd={onEditEnd}
            />
        </>
    )
};

export default withRouter(RegisterPesananKontrolList);