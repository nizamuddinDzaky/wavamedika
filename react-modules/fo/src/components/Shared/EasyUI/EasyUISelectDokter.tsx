import React, { useEffect, useState, useContext } from 'react';
import { Tooltip, ComboBox } from 'rc-easyui';
import DataPasienService from '../../../services/master_datapasien.service';
import poliContext from '../../../stores/context/poliContext';
import _ from 'lodash';

interface Props {
    error?: any;
    value?: any;
    // id_kamar: number;
    index: number;
}

const EasyUISelectDokter: React.FC<Props> = (props: Props) => {
    const [dataDokter, setDataDokter] = useState<Array<any>>([]);
    const [loading, setLoading] = useState<boolean>(false);

    const [data,setData] = useContext(poliContext);

    const getDokter = async () => {
        try {
            setLoading(true);
            setDataDokter([]);
            const payload = {
                id_kamar: data[props.index].klinik
                // id_kamar: 83
            };
            const resp = await DataPasienService.tpp_rencanakontrol_dokter(payload);
            const newData = resp?.list?.map((item: any) => {
                return {
                    value: item.id_karyawan,
                    text: item.nama_lengkap
                };
            })
            setLoading(false);
            setDataDokter(newData);
        } catch(e) {
            console.log('Error', e);
            setLoading(false);
            setDataDokter([]);
        }
    }

    useEffect(() => {
        if(data && data[props.index] && data[props.index].klinik) {
            // set selected dokter to null before fetch
            const newData = _.map(data, (item: any, index: number) => {
                if(index === 0) {
                    item.dokter = '';
                }

                return item;
            });
            setData(newData);
            getDokter();
        }
        
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [data[props.index].klinik])

    if(loading) {
        return (
            <>Loading..</>
        )
    }

    return(
        <>
            {dataDokter && dataDokter.length> 0 &&<Tooltip content={props.error} tracking>
                <ComboBox
                    // disabled={!props?.id_kamar}
                    value={props?.value}
                    data={dataDokter}
                    inputId={'select-dokter'}
                />
            </Tooltip>}
        </>
    )
}

export default EasyUISelectDokter;