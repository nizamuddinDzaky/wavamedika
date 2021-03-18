import React, { useEffect, useState, useContext } from 'react';
import { Tooltip, ComboBox } from 'rc-easyui';
import antrian_nomor_kosongService from '../../../services/antrian_nomor_kosong.service';
import daftarNomorKosongContext from '../../../stores/context/daftarNomorKosongContext';

interface Props {
    error?: any;
    value?: any;
    onChange?: (e: any) => void;
}

const EasyUISelectDokterTppNomorKosong: React.FC<Props> = (props: Props) => {
    const [data, setData] = useState<Array<any>>([]);
    const [selectedIdDokter, setSelectedIdDokter] = useState<string>('');
    const [loading, setLoading] = useState<boolean>(false);
    const [setSelectedDokter] = useContext(daftarNomorKosongContext);

    const getData = async () => {
        try {
            setLoading(true);
            setData([]);
            const resp = await antrian_nomor_kosongService.tpp_nomorkosong_dokter();
            const newData = resp?.list?.map((item: any) => {
                return {
                    value: item.id_karyawan,
                    text: item.nama
                };
            })

            if(Array.isArray(newData) && newData.length > 0) {
                console.log('props', props.value)
                newData.forEach((item: any) => {
                    // console.log(item)
                    if(item && item.text && props.value.includes(item.text)) {
                        console.log(item.value);
                        setSelectedIdDokter(item.value)
                        setSelectedDokter(item);
                    }
                })
            }
            setLoading(false);
            setData(newData);
        } catch(e) {
            console.log('Error', e);
            setLoading(false);
            setData([]);
        }
    }

    const onChange = (v: any) => {
        if(props.onChange) 
            props.onChange(v);

        if(data && Array.isArray(data) && data.length> 0) {
            const findData = data.find((e: any) => e.value === v);
            console.log('e', findData);
            setSelectedDokter(findData);
        }
       
    }

    useEffect(() => {
        getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
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
                    value={selectedIdDokter || props?.value}
                    data={data}
                    onChange={onChange}
                />
            </Tooltip>}
        </>
    )
}

export default EasyUISelectDokterTppNomorKosong;