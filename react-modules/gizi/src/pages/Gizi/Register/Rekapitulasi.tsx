import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../components/Table/Table";
import {detailRekapitulasiGizi} from "../../../pojo/giz_lapreggizi/giz_lapreggizi.view_lapreggizi_rekap";
import laporanGiziService from '../../../services/gizLapreggizi.service';
import Metadata from "../../../pojo/Metadata";
import customForm from "../../../assets/js/customForm";

const rekapitulasiColumn = [
    {
        id: 'rekapitulasi',
        title: 'Rekapitulasi',
        width: "50px"
    },
    {
        id: 'jml',
        title: 'Jumlah',
        width: "50px"
    }
];

interface IProps {
    halaman?: number;
    batas?: number;
    tgl1?: string;
    tgl2?: string;
    unit?: string;
}
const Rekapitulasi: React.FC<IProps> = (props: IProps) => {
    const [data, setData ] =  useState<Array<detailRekapitulasiGizi>>([]);
    const [loading, setLoading] = useState<boolean>(false);

    const [meta, setMeta] = useState<Metadata>({});
    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    let tableRef: any = useRef(null);

    const rowCss = (row: any) => {
        if(row?.rekapitulasi?.includes('>')) {
            return {
                background: '#0F9E98',
                fontWeight: 600
            }
        }
    };

    const getData = async () => {
        try {
            setLoading(true);
            const payload = {
                halaman: props?.halaman,
                batas: props?.batas,
                tgl1: props?.tgl1,
                tgl2: props?.tgl2,
                unit: props?.unit
            };
            const resp = await laporanGiziService.view_lapreggizi_rekap(payload);
            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);

        } catch (e) {
            setLoading(false);
            setData([]);
        }
    };

    const onTableAction = (e: any) => {
        console.log('e', e);

        setPageSize(e?.pageSize);
        setPageNumber(e?.pageNumber);


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            tableRef?.cancelEdit();

            getData();
        }
    };
    const onLoadTableRef = (ref: any) => {
        tableRef = ref;
        new (customForm as any)(tableRef); // for tab on enter, inside table ref
    };

    useEffect(() => {
        getData();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.halaman, props.batas, props.tgl1, props.tgl2, props.unit]);

    return (
        <>
            <Table
                title={'Rekapitulasi'}
                columns={rekapitulasiColumn}
                data={data}
                loading={loading}
                total={meta.list_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                tableType={'table-custom-2-table-left'}
                rowCss={rowCss}
                onTableAction={onTableAction}
                onLoadTableRef={(ref) => onLoadTableRef(ref) }
                disableNumber={true}
            />
        </>
    )
};

export default Rekapitulasi;
