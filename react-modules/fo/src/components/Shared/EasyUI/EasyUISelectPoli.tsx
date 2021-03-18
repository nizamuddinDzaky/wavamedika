import React, { useEffect, useState } from 'react';
import { Tooltip, ComboBox } from 'rc-easyui';
import DataPasienService from '../../../services/master_datapasien.service';

interface Props {
    error?: any;
    value?: any;
    onChange?: (e: any) => void;
}

const EasyUISelectPoli: React.FC<Props> = (props: Props) => {
    const [data, setData] = useState<Array<any>>([]);
    const [loading, setLoading] = useState<boolean>(false);
    const getPoli = async () => {
        try {
            setLoading(true);
            setData([]);
            const resp = await DataPasienService.tpp_rencanakontrol_poli();
            const newData = resp?.list?.map((item: any) => {
                return {
                    value: item.id_kamar,
                    text: item.kamar
                };
            })
            setLoading(false);
            setData(newData);
        } catch(e) {
            console.log('Error', e);
            setLoading(false);
            setData([]);
        }
    }

    useEffect(() => {
        getPoli();
    }, [])

    if(loading) {
        return (
            <>Loading..</>
        )
    }

    return(
        <>
            {data && data.length > 0 && <Tooltip content={props.error} tracking>
                <ComboBox
                    value={props?.value}
                    data={data}
                    onChange={props?.onChange}
                />
            </Tooltip>}
        </>
    )
}

export default EasyUISelectPoli;