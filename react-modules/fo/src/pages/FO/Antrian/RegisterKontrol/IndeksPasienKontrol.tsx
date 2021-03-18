import React, { useState, useEffect } from 'react';
import Metadata from '../../../../pojo/Metadata';
import Table from "../../../../components/Table/Table";
import { RouteComponentProps, withRouter } from 'react-router';
import {  LinkButton, CheckBox } from 'rc-easyui';
import moment from 'moment';
import antrian_register_kontrolService from '../../../../services/antrian_register_kontrol.service';

const useColumn = () => {
    return [
        {
            id: 'id_mrs',
            title: 'No. MRS',
            width: "40px",
            align: 'center'
        },
        {
            id: 'nama_lengkap',
            title: 'Nama Pasien',
            width: "60px",
        },
        {
            id: 'kontrol',
            title: 'Kontrol',
            width: "20px",
            align: 'center',
            field: 'ck',
            render: ({ row }: any) => (
                <CheckBox disabled checked={row.kontrol === 1}></CheckBox>
            ),
        },
        {
            id: 'no_mr',
            title: 'No. RM',
            width: "40px",
        },
        {
            id: 'tgl_rencana',
            title: 'Tgl Rencana',
            width: '40px',
            render: ({row}: any) => {
                return (
                    moment(row?.tgl_rencana).format('DD-MM-YYYY')
                )
            }
        },
        {
            id: 'sex',
            title: 'Sex',
            width: "20px",
        },
        {
            id: 'umur',
            title: 'Umur',
            width: "60px",
        },
        
    ];
}

type IProps = RouteComponentProps & {
    onTableAction?: (e: any) => void;
    tgl1?: string;
    tgl2?: string;
    ruang?: string;
    dokter?: string;
    kontrol?: boolean;

}

const IndeksPasienKontrol: React.FC<IProps> = (props: IProps) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);
    const [mode] = useState<string>('');

    const [meta, setMeta] = useState<Metadata>({});
    // const [selection, setSelection] = useState<any>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);


    const [tableRef, setTableRef] = useState<any>(null);

    const getData = async (limit?: number, page?: number ) => {
        try {
            setLoading(true);
            // setSelection(null);

            const payload = {
                halaman: pageNumber,
                batas: pageSize,
                tgl1: props?.tgl1,
                tgl2: props?.tgl2,
                ruang: props?.ruang,
                dokter: props?.dokter,
                kontrol: props?.kontrol? 1: 0
            }

            const resp = await antrian_register_kontrolService.mkt_lapregkontrol_view_lapregkontrol(payload);
            if(resp && Array.isArray(resp.list) && resp.list.length >0) {
                setData(resp.list);
            }

            setMeta(resp.metadata);
            setLoading(false);
        } catch (e) {
            setLoading(false);
            setData([]);
        }
    };


    const onTableAction = async (e: any) => {
        console.log('e', e);

        if(e.pageSize) {
            tableRef?.cancelEdit();
            setPageSize(e?.pageSize);
        }

        if(e.pageNumber) {
            tableRef?.cancelEdit();
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

    const listColumn = useColumn();

    const handleRefresh = () => {
        getData();
    }
    
    const onLoadTableRef = (ref: any) => {
        setTableRef(ref)
        // new (customForm as any)(ref); // for tab on enter, inside table ref
    };

    useEffect(() => {
        getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.tgl1, props.tgl2, props.dokter, props.ruang, props.kontrol])

    useEffect(() => {
        if(tableRef && tableRef !== null && mode === 'add' ) {
            tableRef?.beginEdit(data[0]);
            // console.log('data', data)
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [data, mode]);
    return(
        <>
            <Table
                isLazy
                title={'Indeks Pasien Kontrol'}
                columns={listColumn}
                data={data}
                loading={loading}
                disableNumber
                isPaginate={true}
                total={meta?.row_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                onTableAction={onTableAction}
                onLoadTableRef={(ref: any) => onLoadTableRef(ref) }
                // selectionMode={'single'}
                // selection={selection}
                editable={!loading}
                // onSelectionChange={onSelectionChange}
                // onDoubleClickCell={handleSMS}
                toolbar={({editingItem}: any) => {
                    return(
                        <>
                            <div style={{padding: 4}}>
                                <LinkButton plain
                                            onClick={handleRefresh}
                                            // disabled={(mode === 'add' || mode === 'edit')}
                                >
                                    <i className="flaticon-refresh"></i>
                                    &nbsp;
                                    Refresh
                                </LinkButton>
                            </div>
                        </>
                    )
                }}
                // onEditCancel={onEditCancel}
                // onEditEnd={onEditEnd}
            />
        </>
    )
};

export default withRouter(IndeksPasienKontrol);