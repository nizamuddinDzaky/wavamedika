import React from "react";
import {detailPetugas} from "../../../../pojo/transaction/transaction.petugas";
import {ComboBox, NumberBox, TextBox, Tooltip} from "rc-easyui";
import {detailDaftarKonsultasi} from "../../../../pojo/giz_konsultasigizi/giz_konsultasigizi.daftarkonsultasi";


const useRiwayatKonsultasiColumn = (
    {
        dataPetugas,
        daftarKonsultasi
    }: {
        dataPetugas: Array<detailPetugas>,
        daftarKonsultasi: Array<detailDaftarKonsultasi>
    }
) => {
    const dataPetugasParsed = dataPetugas.map((item) => {
        return {
            value: item?.id_karyawan,
            text: item?.nama
        }
    });

    const daftarKonsultasiParsed = daftarKonsultasi.map((item) => {
        return {
            value: item?.id_jnsgizi,
            text: item?.gizi
        }
    });


    return [
        {
            id: 'tgl_konsultasi',
            title: 'Tanggal',
            width: "30px",
        },
        {
            id: 'qty',
            title: 'Qty',
            width: "30px",
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
            id: 'kamar',
            title: 'Kamar / Bed',
            width: "30px",
        },
        {
            id: 'konsultasi',
            title: 'Konsultasi',
            width: "30px",
            editable: true,
            editor: ({row, error}: any) => (
                <Tooltip content={error} tracking>
                    <ComboBox
                        value={row?.oleh}
                        data={daftarKonsultasiParsed}
                    ></ComboBox>
                </Tooltip>
            ),
            editRules: ['required']
        },
        {
            id: 'oleh',
            title: 'Oleh',
            width: "30px",
            editable: true,
            editor: ({ row,error }: any) => (
                <>
                    <Tooltip content={error} tracking>
                        <ComboBox
                            value={row?.oleh}
                            data={dataPetugasParsed}
                        ></ComboBox>
                    </Tooltip>

                </>
            ),
            editRules: ['required']
        },
        {
            id: 'kalori',
            title: 'Kalori',
            width: "15px",
            editable: true,
            editor: ({row, error}: any) => (
                <Tooltip content={error} tracking>
                    <NumberBox
                        precision={2}
                        value={row?.kalori}
                    />
                </Tooltip>
            ),
            editRules: ['required']
        },
        {
            id: 'penyakit',
            title: 'Penyakit',
            width: "30px",
            editable: true,
            editor: ({ row,error }: any) => (
                <>
                    <Tooltip content={error} tracking>
                        <TextBox
                            value={row?.penyakit}/>
                    </Tooltip>

                </>
            ),
            editRules: ['required']
        },
        {
            id: 'keterangan',
            title: 'Keterangan',
            width: "40px",
            editable: true,
            editor: ({ row,error }: any) => (
                <>
                    <Tooltip content={error} tracking>
                        <TextBox
                            value={row?.keterangan}/>
                    </Tooltip>

                </>
            ),
            editRules: ['required']
        }
    ];
}

export default useRiwayatKonsultasiColumn;
