import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../components/Table/Table";
import pasienRencanaPulangService from '../../../services/gizDatarencanapulang.service';
// import {detailDataTarif} from "../../../pojo/data_tarif/transaction.datatarif";
import Metadata from "../../../pojo/Metadata";

const pasienRencanaPulangColumn = [
    {
        id: 'no_mrs',
        title: 'No MRS',
        width: '30px'
    },
    {
        id: 'nama',
        title: 'Nama Lengkap',
        width: '50px'
    },
    {
        id: 'no_rm',
        title: 'No RM',
        width: '30px'
    },
    {
        id: 'rencana_pulang',
        title: 'Rencana Pulang',
        width: '30px'
    },
    {
        id: 'kamar',
        title: 'Kamar',
        width: '30px'
    },
    {
        id: 'kelas',
        title: 'Kelas',
        width: '30px'
    },
    {
        id: 'status',
        title: 'Status',
        width: '30px'
    },
    {
        id: 'umur',
        title: 'Umur',
        width: '30px'
    }
];

interface IPropsPasienRencanaPulang {
    hidePagination?: boolean;
    toolbar?: any;
}

const PasienRencanaPulang = (props: IPropsPasienRencanaPulang) => {
    let {
        hidePagination
    } = props;

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);
    const [meta, setMeta] = useState<Metadata>({});

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const getData = async () => {
        try {
            setLoading(true);
            const resp = await pasienRencanaPulangService.datarencanapulang();
            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);

        } catch (e) {
            console.log(e);
            setLoading(false);
        }
    };

    const onTableAction = (e: any) => {
        console.log('e', e);

        setPageSize(e?.pageSize);
        setPageNumber(e?.pageNumber);


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            getData();
        }
    };

    const mounted:any = useRef();
    useEffect(() => {
        // fetchListMRS()

        // Component Did Mount
        if (!mounted.current) {
            mounted.current = true;

            getData();
        }
    }, []);

    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            {/*<div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>*/}
            {/*</div>*/}
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <Table
                    height={400}
                    title={'List Pasien Rencana Pulang'}
                    columns={pasienRencanaPulangColumn}
                    data={data}
                    loading={loading}
                    toolbar={props.toolbar}
                    isPaginate={!hidePagination}
                    total={meta.list_count}
                    pageNumber={pageNumber}
                    pageSize={pageSize}
                    onTableAction={onTableAction}
                />
            </div>
        </div>
    )
};

export default PasienRencanaPulang;
