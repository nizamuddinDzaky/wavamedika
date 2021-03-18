import React, { useEffect, useState } from 'react';
import { Tooltip, ComboBox } from 'rc-easyui';
import master_asuransiService from '../../../services/master_asuransi.service';

interface Props {
    error?: any;
    value?: any;
    onChange?: (e: any) => void;
}

const EasyUISelectJenisTindakan: React.FC<Props> = (props: Props) => {
    const [data, setData] = useState<Array<any>>([]);
    const [loading, setLoading] = useState<boolean>(false);
    const getData = async () => {
        try {
            setLoading(true);
            setData([]);
            const resp = await master_asuransiService.mkt_masterasuransi_jenistindakan();
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

export default EasyUISelectJenisTindakan;