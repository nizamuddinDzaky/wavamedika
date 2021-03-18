import React, { useState, useRef, useEffect } from 'react';
import Metadata from '../../../../../pojo/Metadata';
import customForm from '../../../../../assets/js/customForm';
import Table from '../../../../../components/Table/Table';
import dataPasienService from '../../../../../services/master_datapasien.service';

const listRekapitulasi = [
    {
        id: 'rekapitulasi',
        title: 'Rekapitulasi',
        width: "40px",
        
    },
    {
        id: 'jumlah',
        title: 'Jumlah',
        width: "15px",
        
    }
];

interface Props {
    id_mr: number;
    addMargin?: boolean;
    onTableAction?: (e: any) => void;
}

const Rekapitulasi:React.FC<Props> = (props: Props) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);

    const [meta, setMeta] = useState<Metadata>({});

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
                id_mr: props?.id_mr
            }
            const resp = await dataPasienService.tpp_riwayatpasien_view_riwayatpasien_rekap(payload);
            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);

        } catch (e) {
            setLoading(false);
            setData([]);
        }
    };

    const onTableAction = async (e: any) => {
        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            tableRef?.cancelEdit();

            getData();
        } else {
            getData();
        }

        if(props.onTableAction) {
            props.onTableAction(e)
        }
    };

    const onLoadTableRef = (ref: any) => {
        tableRef = ref;
        new (customForm as any)(tableRef); // for tab on enter, inside table ref
    };
    
    useEffect(() => {
        getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);

    return (
        <>
            <Table
                height={400}
                disableNumber
                title={'Rekapitulasi'}
                columns={listRekapitulasi}
                data={data}
                tableType={props?.addMargin? 'table-custom-2-table-left': 'kt-margin-l-0'}
                loading={loading}
                isPaginate={false}
                total={meta?.row_count}
                editable={false}
                onTableAction={onTableAction}
                onLoadTableRef={(ref) => onLoadTableRef(ref) }
                rowCss={rowCss}
            />
        </>
    )
}

export default Rekapitulasi;