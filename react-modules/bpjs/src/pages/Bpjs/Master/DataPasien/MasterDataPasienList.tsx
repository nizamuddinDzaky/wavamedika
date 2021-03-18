import React, { useState, useRef, useEffect,useCallback } from 'react';
import Metadata from '../../../../pojo/Metadata';
import customForm from '../../../../assets/js/customForm';
import CustomDialog from '../../../../components/Dialog/CustomDialog';
import Table from "../../../../components/Table/Table";
import master_datapasienservice from '../../../../services/master/datapasien.service';
import moment from 'moment';
import { LinkButton } from 'rc-easyui';
//import ViewRiwayatPasien from './ViewRiwayatPasien/ViewRiwayatPasien';
import { RouteComponentProps, withRouter } from 'react-router';

const listDataPasienColumn = [
    {
        id: 'sex',
        title: 'Sex',
        width: "10px"
    },
    {
        id: 'no_mr',
        title: 'No. RM',
        width: "20px"
    },
    {
        id: 'nama_lengkappx',
        title: 'Nama Pasien',
        width: "50px"
    },
    {
        id: 'umur',
        title: 'Umur',
        width: "30px"
    },
    {
        id: 'desa',
        title: 'Desa',
        width: "23px"
    },
    {
        id: 'kecamatan',
        title: 'Kecamatan',
        width: "23px"
    },
    {
        id: 'tgl_lahir',
        title: 'Tgl Lahir',
        width: "23px"
    },
    {
        id: 'telepon',
        title: 'Telepon',
        width: "23px"
    },
    {
        id: 'operator',
        title: 'Operator',
        width: "20px"
    },
    {
        id: 'lengkap',
        title: 'Lengkap',
        width: "20px"
    },
];
interface OptionalProps {
    no_mr?: string,
    nama?: string,
    kecamatan?: string,
    kabupaten?: string,
    sex?: string,
    id_jnspasien?: number,
    thn1: number,
    thn2: number,
    umur1?: number,
    umur2?: number
}

type IProps = RouteComponentProps & {
    optionalProps?: OptionalProps
    onTableAction?: (e: any) => void;
}

const MasterDataPasienList: React.FC<IProps> = (props: IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);

    const [meta, setMeta] = useState<Metadata>({});
    const [selection, setSelection] = useState<any>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const riwayatPasienRef: any = useRef(null);

    let tableRef: any = useRef(null);

    const getData = async (limit?: number, page?: number ) => {
        try {
            setLoading(true);
            setSelection(null);
            let payloadProps = props?.optionalProps;
            payloadProps = Object.assign(payloadProps, {
                thn1: moment(props?.optionalProps?.thn1).format('YYYY'),
                thn2: moment(props?.optionalProps?.thn2).format('YYYY')
            });

            const payload = {
                halaman: page? page: pageNumber,
                batas: limit? limit: pageSize,
                ...payloadProps
                
            };
            const resp = await master_datapasienservice.tpp_datapasien_view_datapasien(payload);
            
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
        props.history.push('/bpjs/master/data-pasien/'+ selection.id_mr+'/riwayat');

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
            <CustomDialog
                sizing={'large'}
                title={
                    'Riwayat Pasien'
                }
                ref={riwayatPasienRef}
            >
                {/* {
                riwayatPasienRef.current && selection?.id_mr && selection?.sex &&
                    <ViewRiwayatPasien
                        id_mr={selection.id_mr}
                        sex={selection.sex}
                    ></ViewRiwayatPasien>
                } */}
            </CustomDialog>
            <Table
                isLazy
                title={'Daftar Pasien MRS'}
                columns={listDataPasienColumn}
                disableNumber
                data={data}
                loading={loading}
                isPaginate={true}
                total={meta?.total_row_current_page}
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
                        </div>
                    )
                }}
            />
        </>
    )
};

export default withRouter(MasterDataPasienList);