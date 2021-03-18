import React, { useState, useEffect } from 'react';
import Metadata from '../../../../../pojo/Metadata';
// import customForm from '../../../../../assets/js/customForm';
import Table from '../../../../../components/Table/Table';
import dataRiwayatPasienService from '../../../../../services/master/riwayatpasien.service';
import moment from 'moment';

interface Props {
    id_mrs: number;
    unit: string;
}

const TindakanPasienColumn = [
    {
        id: 'id_transaksi',
        title: 'ID Transaksi',
        width: "18px",
    },
    
    {
        id: 'tanggal',
        title: 'KRS',
        width: "25px",
    },
    {
        id: 'jam',
        title: 'Jam',
        width: '25px'
    },
    {
        id: 'uraian',
        title: 'Uraian',
        width: "30px",
    },
    {
        id: 'oleh',
        title: 'Oleh',
        width: "25px",
    },
    {
        id: 'qty',
        title: 'Qty',
        width: "10px",
    }
]


const TindakanPasien: React.FC<Props> = (props: Props) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);
    const [meta, setMeta] = useState<Metadata>({});

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const getListRiwayat = async () => {
        try {
            setLoading(true);
            const payload = {
                id_mrs: props?.id_mrs,
                unit: '_'
            }
            const resp = await dataRiwayatPasienService.tpp_riwayatpasien_view_riwayatpasien_tindakan(payload);
            resp.list.map((element) => {
                element.tanggal = moment(element.tanggal).format('DD/MM/YYYY');
                element.jam = moment(element.tanggal).format('HH:mm:ss');


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

    const onTableAction = (e: any) => {
        setPageSize(e?.pageSize);
        setPageNumber(e?.setPageNumber);


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            getListRiwayat();
        }
    };

    useEffect(() => {
        getListRiwayat();
        
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props?.id_mrs, props?.unit]);
    
    return (
        <>
            <Table
                title={'Daftar Riwayat Tindakan Pada Pasien'}
                columns={TindakanPasienColumn}
                data={data}
                loading={loading}
                // toolbar={props.toolbar}
                isPaginate={true}
                total={meta.list_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                onTableAction={onTableAction}
                height={400}
            />
        </>
    )
}

export default TindakanPasien;