import React, { useEffect, useState, useContext } from 'react';
import { Tooltip, ComboBox } from 'rc-easyui';
import master_instansiService from '../../../services/master_instansi.service';
import asuransiContext from '../../../stores/context/asuransiContext';

interface Props {
    error?: any;
    value?: any;
    onChange?: (e: any) => void;
}

const EasyUISelectAsuransi: React.FC<Props> = (props: Props) => {
    const [data, setData] = useState<Array<any>>([]);
    const [loading, setLoading] = useState<boolean>(false);

    const [setSelectedAsuransi] = useContext(asuransiContext);

    const getAdmission = async () => {
        try {
            setLoading(true);
            setData([]);
            const resp = await master_instansiService.tpp_mrs_asuransi();
            const newData = resp?.list?.map((item: any) => {
                return {
                    value: item.kode_instansi,
                    text: item.nama_instansi
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
        getAdmission();
    }, [])

    const onChange = (v:any) => {
        if(props.onChange) {
            props?.onChange(v);
        }


        if(Array.isArray(data) && data.length > 0) {
            const find = data.find((e: any) => e.value === v);
            if(find && find.value)
                setSelectedAsuransi(find);
        }
        
    }

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
                    onChange={onChange}
                />
            </Tooltip>}
        </>
    )
}

export default EasyUISelectAsuransi;