import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../components/Table/Table";
import dataTarifService from '../../../services/dataTarif.service';
import {detailDataTarif} from "../../../pojo/data_tarif/transaction.datatarif";
import Metadata from "../../../pojo/Metadata";

const tindakanColumn = [
    {
        id: 'uraian',
        title: 'Nama Pemeriksaan',
        width: '100px'
    },
    {
        id: 'jenis',
        title: 'Jenis',
        width: '100px'
    }
];

interface IPropsMasterTindakanGizi {
    hidePagination?: boolean;
    toolbar?: any;
}

const MasterTindakanGizi = (props: IPropsMasterTindakanGizi) => {
    let {
        hidePagination
    } = props;

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataTarif>>([]);
    const [meta, setMeta] = useState<Metadata>({});

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const getDataTarif = async () => {
        try {
            setLoading(true);
            const resp = await dataTarifService.datatarif();
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
            getDataTarif();
        }
    };

    const mounted:any = useRef();
    useEffect(() => {
        // fetchListMRS()

        // Component Did Mount
        if (!mounted.current) {
            mounted.current = true;

            getDataTarif();
        }
    }, []);

    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            {/*<div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>*/}
            {/*</div>*/}
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <Table
                    height={400}
                    title={'List Master Tindakan'}
                    columns={tindakanColumn}
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

export default MasterTindakanGizi;
