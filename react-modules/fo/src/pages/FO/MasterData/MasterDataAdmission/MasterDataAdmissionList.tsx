import React, { useState, useRef, useEffect,useCallback } from 'react';
import Metadata from '../../../../pojo/Metadata';
import customForm from '../../../../assets/js/customForm';
import CustomDialog from '../../../../components/Dialog/CustomDialog';
import Table from "../../../../components/Table/Table";
import master_admissionservice from '../../../../services/master_admission.service';
import { LinkButton, CheckBox } from 'rc-easyui';
// import ViewRiwayatPasien from './ViewRiwayatPasien/ViewRiwayatPasien';
// import PesanPoli from './PesanPoli/PesanPoli';
import { RouteComponentProps, withRouter } from 'react-router';

const listDataPasienColumn = [
    {
        id: 'aktif',
        title: 'Aktif',
        width: "20px",
        align: 'center',
        field: 'ck',
        render: ({ row }: any) => (
            <CheckBox disabled checked={row.aktif === '1'}></CheckBox>
        ),
        editable: false,
    },
    {
        id: 'nama_instansi',
        title: 'Nama Instansi',
        width: "50px"
    },
    {
        id: 'alamat',
        title: 'Alamat',
        width: '80px'
    },
    {
        id: 'kota',
        title: 'Kota',
        width: "50px"
    },
    {
        id: 'alamat_klaim',
        title: 'Alamat Klaim',
        width: "80px"
    },
];
interface OptionalProps {
    id_instansi?: number,
    kode_instansi?: string,
    aktif?: string,
    nama_instansi?: string,
    alamat?: string,
    kota?: string,
    telp?: string,
    fax?: string,
    kontak?: string,
    hp?: string,
    catatan?: string,
    email?: string,
    website?: any,
    jenis?: string,
    operator?: number,
    tgl_input?: string,
    editor?: number,
    updated?: string,
    alamat_klaim?: any,
    masa_berlaku?: string
}

type IProps = RouteComponentProps & {
    optionalProps?: OptionalProps
    onTableAction?: (e: any) => void;
}

const MasterDataAdmissionList: React.FC<IProps> = (props: IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);

    const [meta, setMeta] = useState<Metadata>({});
    const [selection, setSelection] = useState<any>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const viewKartuRef: any = useRef(null);

    const [tableRef, setTableRef] = useState<any>(null); 


    const getData = async (limit?: number, page?: number ) => {
        try {
            setLoading(true);
            const payload = {
                halaman: page? page: pageNumber,
                batas: limit? limit: pageSize,
                aktif: 1
            };
            const resp = await master_admissionservice.mkt_masteradmission_masteradmission(payload);
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


    const handleAdd = () => {
        props.history.push('/fo/master-data/admission/data-admission/add');
    }

    const handleChange = () => {
        props.history.push('/fo/master-data/admission/data-admission/'+ selection?.kode_instansi);
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

        setSelection(null);
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
            <CustomDialog
                ref={viewKartuRef}
                title={'View Kartu'}
            >
                {viewKartuRef && selection?.id_instansi &&
                    <div>123</div>
                }
            </CustomDialog>
            
            <Table
                disableNumber
                isLazy
                title={'Daftar Admission'}
                columns={listDataPasienColumn}
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
                                        onClick={() => viewKartuRef?.current?.open()}
                                        disabled={!selection?.id_instansi}
                            >
                                <i className="flaticon-edit-1"></i>
                                &nbsp;
                                View Kartu
                            </LinkButton>
                        </div>
                    )
                }}
                onDoubleClickCell={handleChange}
            />
        </>
    )
};

export default withRouter(MasterDataAdmissionList);