import React, { useState, useEffect } from 'react';
import Metadata from '../../../../../pojo/Metadata';
// import customForm from '../../../../../assets/js/customForm';
import Table from '../../../../../components/Table/Table';
import dataRiwayatPasienService from '../../../../../services/master/riwayatpasien.service';
import moment from 'moment';

interface Props {
    id_mr: number;
}

const RiwayatPasienColumn = [
    {
        id: 'id_mrs',
        title: 'No MRS',
        width: "18px",
    },
    {
        id: 'unit',
        title: 'Unit',
        width: "25px",
    },
    {
        id: 'tgl_masuk',
        title: 'MRS',
        width: "25px",
    },
    {
        id: 'tgl_krs',
        title: 'KRS',
        width: "25px",
    },
    {
        id: 'cara_masuk',
        title: 'Cara Masuk',
        width: "25px",
    },
    {
        id: 'dokter',
        title: 'Dokter',
        width: "25px",
    },
    {
        id: 'kunjungan',
        title: 'Kunj. Pasien',
        width: "25px",
    },
    {
        id: 'kunjungan_unit',
        title: 'Kunj. Unit',
        width: "25px",
    },
    {
        id: 'kunjungan_kasus',
        title: 'Kunj. Kasus',
        width: "25px",
    },
]


const RiwayatPasien: React.FC<Props> = (props: Props) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);
    const [meta, setMeta] = useState<Metadata>({});

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const getListRiwayat = async () => {
        try {
            setLoading(true);
            const payload = {
                id_mr: props?.id_mr
            }
            const resp = await dataRiwayatPasienService.tpp_riwayatpasien_view_riwayatpasien(payload);
            resp.list.map((element) => {
                element.tgl_masuk = moment(element.tgl_masuk).format('DD/MM/YYYY');
                element.tgl_krs = element.tgl_krs? moment(element.tgl_krs).format('DD/MM/YYYY'): '';

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
    }, [props?.id_mr]);
    
    return (
        <>
            <Table
                title={'Daftar Riwayat Pasien'}
                columns={RiwayatPasienColumn}
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

export default RiwayatPasien;