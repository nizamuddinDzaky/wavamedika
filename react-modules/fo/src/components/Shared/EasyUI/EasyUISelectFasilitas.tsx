import React, { useEffect, useState } from 'react';
import { Tooltip, ComboBox } from 'rc-easyui';
import master_fasilitas_kerjasamaService from '../../../services/master_fasilitas_kerjasama.service';

interface Props {
    error?: any;
    value?: any;
    onChange?: (e: any) => void;
}

const EasyUISelectFasilitas: React.FC<Props> = (props: Props) => {
    const [data, setData] = useState<Array<any>>([]);
    const [loading, setLoading] = useState<boolean>(false);
    const getFasilitas = async () => {
        try {
            setLoading(true);
            setData([]);
            const payload = {
                halaman: 1,
                batas: 99999
            }
            const resp = await master_fasilitas_kerjasamaService.mkt_masterfasilitas_masterfasilitas(payload);
            const newData = resp?.list?.map((item: any) => {
                return {
                    value: item.id_fasilitas,
                    text: item.nama_fasilitas
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
        getFasilitas();
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

export default EasyUISelectFasilitas;