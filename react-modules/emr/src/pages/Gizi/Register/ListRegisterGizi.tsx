import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../components/Table/Table";
import {detailViewLapRegGizi} from "../../../pojo/giz_lapreggizi/giz_lapreggizi.view_lapreggizi";
import Metadata from "../../../pojo/Metadata";
import customForm from "../../../assets/js/customForm";
import laporanGiziService from "../../../services/gizLapreggizi.service";
import {LinkButton} from "rc-easyui";
import CustomDialog from "../../../components/Dialog/CustomDialog";
import FormRekapitulasiDiitPerKelasRuangan from "./RekapitulasiDiit/FormRekapitulasiDiitPerKelasRuangan";
import moment from 'moment';

const listLaporanGiziColumn = [
    {
        id: 'tgl_konsultasi',
        title: 'Tanggal',
        width: "30px"
    },
    {
        id: 'id_mrs',
        title: 'No MRS',
        width: "30px"
    },
    {
        id: 'nama_lengkap',
        title: 'Nama Pasien',
        width: "50px"
    },
    {
        id: 'tgl_mrs',
        title: 'Tgl MRS',
        width: "30px"
    },
    {
        id: 'sex',
        title: 'Sex',
        width: "15px"
    },
    {
        id: 'umur',
        title: 'Umur',
        width: "15px"
    },
    {
        id: 'alamat',
        title: 'Alamat',
        width: "30px"
    },
    {
        id: 'konsultasi',
        title: 'Konsultasi',
        width: "30px"
    }
];

interface IProps {
    halaman?: number;
    batas?: number;
    tgl1?: string;
    tgl2?: string;
    unit?: string;
    onTableAction?: (e: any) => void;
}

const ListRegisterGizi: React.FC<IProps> = (props:IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailViewLapRegGizi>>([]);

    const [meta, setMeta] = useState<Metadata>({});

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const [typeOpenRekap, setTypeOpenRekap] = useState<string>('');

    const laporanDiitPerKelasRuangan: any = useRef(null);

    let tableRef: any = useRef(null);

    const getData = async (limit?: number, page?: number ) => {
        try {
            setLoading(true);
            const payload = {
                halaman: page? page: pageNumber,
                batas: limit? limit: pageSize,
                tgl1: props?.tgl1,
                tgl2: props?.tgl2,
                unit: props?.unit
            };
            const resp = await laporanGiziService.view_lapreggizi(payload);
            resp.list.map((element) => {
                element.tgl_mrs = moment(element.tgl_mrs).format('DD/MM/YYYY');
                element.tgl_konsultasi = moment(element.tgl_konsultasi).format('DD/MM/YYYY');
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

    const handleOpenRekap = (v: string) => {
        setTypeOpenRekap(v);

        laporanDiitPerKelasRuangan?.current?.open();
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
    };
    const onLoadTableRef = (ref: any) => {
        tableRef = ref;
        new (customForm as any)(tableRef); // for tab on enter, inside table ref
    };

    useEffect(() => {
        getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.tgl1, props.tgl2, props.unit]);

    return(
        <>
            <CustomDialog
                sizing={'small'}
                title={
                    typeOpenRekap === 'byKelasRuangan'?
                        'Laporan Rekapitulasi Diit Per Kelas Ruangan':
                        typeOpenRekap === 'byBentukMakanan'?
                            'Laporan Rekapitulasi Diit Per Bentuk Makanan':
                            typeOpenRekap === 'byJenisDiet' ?
                            'Laporan Rekapitulasi Diit Per Jenis Diet': ''
                }
                ref={laporanDiitPerKelasRuangan}
            >
                {laporanDiitPerKelasRuangan && laporanDiitPerKelasRuangan.current &&
                    <FormRekapitulasiDiitPerKelasRuangan
                        dateMonth={moment(props?.tgl2).format('MM')}
                        dateYear={moment(props?.tgl2).format('YYYY')}
                        type={typeOpenRekap}
                    />
                }
            </CustomDialog>
            <Table
                isLazy
                title={'Daftar Register Gizi'}
                columns={listLaporanGiziColumn}
                data={data}
                tableType={'table-custom-2-table-right'}
                loading={loading}
                isPaginate={true}
                total={meta?.row_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                onTableAction={onTableAction}
                onLoadTableRef={(ref) => onLoadTableRef(ref) }
                toolbar={() => {
                    return(
                        <div style={{padding: 4}}>
                            <LinkButton plain
                                        onClick={() => handleOpenRekap('byKelasRuangan')}
                            >
                                <i className="flaticon-edit-1"></i>
                                &nbsp;
                                Rekapitulasi Diit Per Kelas Ruangan
                            </LinkButton>
                            <LinkButton plain
                                        // disabled
                                        onClick={() => handleOpenRekap('byBentukMakanan')}
                            >
                                <i className="flaticon-edit-1"></i>
                                &nbsp;
                                Rekapitulasi Diit Per Bentuk Makanan
                            </LinkButton>
                            <LinkButton plain
                                        onClick={() => handleOpenRekap('byJenisDiet')}
                                        // disabled
                            >
                                <i className="flaticon-edit-1"></i>
                                &nbsp;
                                Rekapitulasi Diit Per Jenis Diet
                            </LinkButton>

                        </div>
                    )
                }}
            />
        </>
    )
};

export default ListRegisterGizi;
