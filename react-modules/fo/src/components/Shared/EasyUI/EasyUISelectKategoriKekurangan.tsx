import React, { useEffect, useState } from 'react';
import { Tooltip, ComboBox } from 'rc-easyui';
import angket_pelangganService from '../../../services/angket_pelanggan.service';

interface Props {
    error?: any;
    value?: any;
    onChange?: (e: any) => void;
}

const EasyUISelectKategoriKekurangan: React.FC<Props> = (props: Props) => {
    const [data, setData] = useState<Array<any>>([]);
    const [loading, setLoading] = useState<boolean>(false);
    const getData = async () => {
        try {
            setLoading(true);
            setData([]);
            const resp = await angket_pelangganService.mkt_angketpelanggan_kategori();
            const newData = resp?.list?.map((item: any) => {
                return {
                    value: item.k,
                    text: item.k? item.k: '-'
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

export default EasyUISelectKategoriKekurangan;