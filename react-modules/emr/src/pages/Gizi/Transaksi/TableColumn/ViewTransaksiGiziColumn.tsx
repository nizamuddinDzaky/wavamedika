import React from "react";
import {ComboBox, NumberBox, Tooltip} from "rc-easyui";
import {detailTindakan} from "../../../../pojo/transaction/transaction.tindakan";
import {detailPetugas} from "../../../../pojo/transaction/transaction.petugas";

const useTransaksiGiziColumn = (
    {
        dataTindakan,
        dataPetugas
    }: {
        dataTindakan: Array<detailTindakan>,
        dataPetugas: Array<detailPetugas>
    }
) => {
    const dataTindakanParsed = dataTindakan.map((item) => {
        return {
            value: item?.id_tarif,
            text: item?.uraian
        }
    });

    const dataPetugasParsed = dataPetugas.map((item) => {
        return {
            value: item?.id_karyawan,
            text: item?.nama
        }
    });

    return [
        {
            id: 'tanggal',
            title: 'Tanggal',
            width: '15px'
        },
        {
            id: 'jam',
            title: 'jam',
            width: '15px'
        },
        {
            id: 'uraian',
            title: 'Uraian',
            width: '30px',
            editable: true,
            editor: ({ row, error }: any) => (
                <Tooltip content={error} tracking>
                    <ComboBox
                        value={row?.uraian}
                        data={dataTindakanParsed}/>
                </Tooltip>
            ),
            editRules: ['required']
        },
        {
            id: 'qty',
            title: 'Qty',
            width: '15px',
            editable: true,
            editor: ({row, error}: any) => (
                <Tooltip content={error} tracking>
                    <NumberBox
                        value={row?.qty}/>
                </Tooltip>
            ),
            editRules: ['required']
        },
        {
            id: 'oleh',
            title: 'Oleh',
            width: '30px',
            editable: true,
            editor: ({ row,error }: any) => (
                <>
                    <Tooltip content={error} tracking>
                        <ComboBox
                            value={row?.oleh}
                            data={dataPetugasParsed}/>
                    </Tooltip>

                </>
            ),
            editRules: ['required']
        }
    ];
}

export default useTransaksiGiziColumn;
