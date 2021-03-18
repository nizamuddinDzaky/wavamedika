import React, { useState, useRef, useEffect,useCallback } from 'react';
import Metadata from '../../../../pojo/Metadata';
import customForm from '../../../../assets/js/customForm';
import Table from "../../../../components/Table/Table";
import master_dataperujukservice from '../../../../services/rujukan_perujuk.service';
import { LinkButton } from 'rc-easyui';
// import ViewRiwayatPasien from './ViewRiwayatPasien/ViewRiwayatPasien';
// import PesanPoli from './PesanPoli/PesanPoli';
import { RouteComponentProps, withRouter } from 'react-router';
// import InfoPasien from './InfoPasien/InfoPasien';

const listDataPerujukColumn = [
    {
        id: 'aktif',
        title: 'Aktif',
        width: "10px"
    },
    {
        id: 'kode_perujuk',
        title: 'Kode',
        width: "10px"
    },
    {
        id: 'jenis',
        title: 'Jenis',
        width: "10px"
    },
    {
        id: 'nama_perujuk',
        title: 'Nama Perujuk',
        width: "10px"
    },
    {
        id: 'sex',
        title: 'Sex',
        width: "10px"
    },
    {
        id: 'alamat',
        title: 'Alamat',
        width: "10px"
    },
    {
        id: 'kelurahan',
        title: 'Desa',
        width: "10px"
    },
    {
        id: 'kecamatan',
        title: 'Kecamatan',
        width: "10px"
    },
    {
        id: 'kabupaten',
        title: 'Kabupaten/Kota',
        width: "10px"
    },
];
interface OptionalProps {
    nama_perujuk?: string,
    kecamatan?: string,
    kelurahan?: string,
    target?: string,
    jenis?: string
}

type IProps = RouteComponentProps & {
    optionalProps?: OptionalProps
    onTableAction?: (e: any) => void;
}

const MasterDataPerujukList: React.FC<IProps> = (props: IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);

    const [meta, setMeta] = useState<Metadata>({});
    const [selection, setSelection] = useState<any>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const infoPasienRef: any = useRef(null);


    let tableRef: any = useRef(null);

    const getData = async (limit?: number, page?: number ) => {
        try {
            setLoading(true);
            setSelection(null);
            let payloadProps = props?.optionalProps;
            // payloadProps = Object.assign(payloadProps, {
            //     thn1: moment(props?.optionalProps?.thn1).format('YYYY'),
            //     thn2: moment(props?.optionalProps?.thn2).format('YYYY')
            // });

            const payload = {
                halaman: page? page: pageNumber,
                batas: limit? limit: pageSize,
                aktif: 1,
                ...payloadProps
                
            };
            const resp = await master_dataperujukservice.mkt_masterperujuk_masterperujuk(payload);
            resp.list.map((element) => {
                // element.tgl_mrs = moment(element.tgl_mrs).format('DD/MM/YYYY');
                // element.tgl_konsultasi = moment(element.tgl_konsultasi).format('DD/MM/YYYY');
                return element
            })
            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);

        } catch (e) {
            setLoading(false);
            setData([]);
        }
    };

    const handleOpenRiwayat = () => {
        // riwayatPasienRef?.current?.open();
        props.history.push('/fo/master-data/data-pasien/'+ selection.id_mr+'/riwayat');

    }

    const handleOpenPesanPoli = () => {
        // pesanPoliRef?.current?.open();
        props.history.push('/fo/master-data/data-pasien/'+ selection.id_mr+'/poli');
    }

    const handleOpenIndeksPasien = () => {

    }

    const handleOpenInfoPasien = () => {
        infoPasienRef?.current?.open();
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

        // setSelection(null);
    };
    const onLoadTableRef = (ref: any) => {
        tableRef = ref;
        new (customForm as any)(tableRef); // for tab on enter, inside table ref
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
                isLazy
                title={'Daftar Perujuk'}
                columns={listDataPerujukColumn}
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
                        <div style={{padding: 4}}>
                            <LinkButton plain
                                        onClick={handleOpenRiwayat}
                                        disabled={!selection?.no_mr}
                            >
                                <i className="flaticon-edit-1"></i>
                                &nbsp;
                                Lihat Riwayat Pasien
                            </LinkButton>

                            <LinkButton plain
                                        onClick={handleOpenPesanPoli}
                                        disabled={!selection?.no_mr}
                            >
                                <i className="flaticon-edit-1"></i>
                                &nbsp;
                                Pesan Poli
                            </LinkButton>

                            <LinkButton plain
                                        onClick={handleOpenIndeksPasien}
                                        disabled={!selection?.no_mr}
                            >
                                <i className="flaticon-edit-1"></i>
                                &nbsp;
                                Indeks Pasien
                            </LinkButton>

                            <LinkButton plain
                                        onClick={handleOpenInfoPasien}
                                        disabled={!selection?.no_mr}
                            >
                                <i className="flaticon-edit-1"></i>
                                &nbsp;
                                Info Pasien
                            </LinkButton>
                        </div>
                    )
                }}
            />
        </>
    )
};

export default withRouter(MasterDataPerujukList);