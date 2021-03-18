import React, {useCallback, useEffect, useRef, useState} from 'react';
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import CustomDialog from "../../../../components/Dialog/CustomDialog";
import Table from "../../../../components/Table/Table";
import moment from "moment";
import Metadata from "../../../../pojo/Metadata";
import { detailMRS } from '../../../../pojo/entry/notifikasi_krs/data_pasien_mrs';
import MRSService from "../../../../services/MRS.service";
import EntryPostKRS from "./EntryPostKRS";

interface IProps {
    hidePagination?: boolean;
    toolbar?: any;
    selectionMode?: string;
    onSelect?: (params: detailMRS) => void;
    onDoubleClickCell?: () => void
}

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumn = [
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
        id: 'nama_lengkap',
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
    }
];


const PasienKRSPasien: React.FC<IProps> = (props: IProps) => {
    let {
        hidePagination
    } = props;

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailMRS>>();
    const [meta, setMeta] = useState<Metadata>({});
    const [selectedPasien, setSelectedPasien] = useState<detailMRS>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const dialogViewPostKRS: any = useRef(null);

    const handleOpenPostKRS = () => {
            dialogViewPostKRS?.current?.open()
    };

    const toolbar = () => {
        return(
            <>
                <div style={{ padding: 4 }}>
                    <LinkButton plain
                                disabled={!selectedPasien?.id_mrs}
                                onClick={handleOpenPostKRS}
                    >
                        <i className="flaticon-edit-1"></i>
                        &nbsp;
                        Notifikasi Post KRS
                    </LinkButton>
                </div>
            </>
        )
    }

    const getListMRS = async () => {
        try {
            setLoading(true);
            const resp = await MRSService.getListMRS();
            resp.list.map((element) => {
                element.tgl_mrs = moment(element.tgl_mrs).format('DD/MM/YYYY');
                return element
            })

            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);

        } catch (e) {
            console.log(e);
            setLoading(false);
        }
    };

    const onSelectionChange = useCallback((e: detailMRS) => {
        setSelectedPasien(e);

        if(props.onSelect) {
            props.onSelect(e);
        }
    }, [props]);

    const onTableAction = (e: any) => {
        setPageSize(e?.pageSize);
        setPageNumber(e?.setPageNumber);

        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            getListMRS();
        }
    };


    const mounted:any = useRef();
    useEffect(() => {
        // fetchListMRS()

        // Component Did Mount
        if (!mounted.current) {
            mounted.current = true;

            getListMRS();
        }
    }, []);

    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
            <Table
                title={'Daftar Pasien Yang Masuk Rumah Sakit'}
                columns={tindakanColumn}
                disableNumber
                filterable={true}
                data={data}
                loading={loading}
                toolbar={toolbar}
                isPaginate={!hidePagination}
                total={meta.list_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                onTableAction={onTableAction}
                selectionMode={'single'}
                selection={selectedPasien}
                // onSelect={(e) => setSelectedPasien(e)}
                onSelectionChange={onSelectionChange}
                onDoubleClickCell={() => dialogViewPostKRS?.current?.open()}
                height={470}
            />
            <CustomDialog
                sizing={'large'}
                title={`Entry Notifikasi Pasien Post KRS`}
                // style={{height:'500px'}}
                ref={dialogViewPostKRS}
            >
                {(dialogViewPostKRS.current && selectedPasien && selectedPasien.nama_lengkap && selectedPasien.no_mr) &&
                    <EntryPostKRS
                        namaPasien={selectedPasien?.nama_lengkap!}
                        no_bill={selectedPasien?.no_mr!}
                        hidePagination={true}
                    />
                }
               
            </CustomDialog>
            </div>
        </div>
    )
};

export default PasienKRSPasien;