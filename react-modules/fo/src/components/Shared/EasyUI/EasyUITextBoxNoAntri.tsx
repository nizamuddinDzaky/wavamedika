import React, { useEffect, useState, useContext } from 'react';
import { Tooltip, TextBox } from 'rc-easyui';
import DataPasienService from '../../../services/master_datapasien.service';
import poliContext from '../../../stores/context/poliContext';
import _ from 'lodash';
import moment from 'moment';

interface Props {
    error?: any;
    value?: any;
    index: number;
    // id_kamar: number;
}

const EasyUITextBoxNoAntri: React.FC<Props> = (props: Props) => {
    const [dataNoAntri, setDataNoAntri] = useState<Array<any>>([]);
    const [loading, setLoading] = useState<boolean>(false);

    const [data,setData] = useContext(poliContext);

    const getNoAntri = async () => {
        try {
            setLoading(true);
            setDataNoAntri([]);
            const payload = {
                id_dokter: data[props.index].dokter,
                tanggal: moment(data[props.index].tgl_rencana).format('YYYY-MM-DD')
            };
            const resp = await DataPasienService.tpp_rencanakontrol_noantri(payload);
            
            setLoading(false);
            setDataNoAntri(resp.list);
        } catch(e) {
            console.log('Error', e);
            setLoading(false);
            setDataNoAntri([]);
        }
    }

    useEffect(() => {
        if(data[props.index] && data[props.index].dokter && data[props.index].tgl_rencana) {
            // set selected dokter to null before fetch
            const newData = _.map(data, (item: any, index: number) => {
                if(index === props.index) {
                    item.no_antri = '';
                }

                return item;
            });
            setData(newData);


            getNoAntri();            
        }
        
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [data[props.index].dokter, data[props.index].tgl_rencana])

    if(loading) {
        return (
            <>Loading..</>
        )
    }

    return(
        <>
            <Tooltip content={props.error} tracking>
                <TextBox value={dataNoAntri[0]?.no_antri} disabled/>
            </Tooltip>
            
        </>
    )
}

export default EasyUITextBoxNoAntri;