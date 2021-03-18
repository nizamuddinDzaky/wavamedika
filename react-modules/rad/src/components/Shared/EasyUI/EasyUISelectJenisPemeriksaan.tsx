import React, { useEffect, useState } from 'react';
import { Tooltip, ComboBox } from 'rc-easyui';
import dataTarifService from '../../../services/master/data_tarif.service';

interface Props {
    error?: any;
    value?: any;
    onChange?: (e: any) => void;
}

const EasyUISelectJenisPemeriksaan: React.FC<Props> = (props: Props) => {
    const [data, setData] = useState<Array<any>>([]);
    const [loading, setLoading] = useState<boolean>(false);
    const getData = async () => {
        try {
            setLoading(true);
            setData([]);
            const resp = await dataTarifService.datatarifjenispemeriksaan();
            const newData = resp?.list?.map((item: any) => {
                return {
                    value: item.jenis,
                    text: item.jenis
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
        getData();
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

export default EasyUISelectJenisPemeriksaan;