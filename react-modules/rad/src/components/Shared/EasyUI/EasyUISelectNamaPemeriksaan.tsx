import React, { useEffect, useState, useContext } from 'react';
import { Tooltip, ComboBox } from 'rc-easyui';
import dataTarifService from '../../../services/master/data_tarif.service';
import daftarNamaPemeriksaanContext from '../../../stores/context/daftarNamaPemeriksaanContext';

interface Props {
    error?: any;
    value?: any;
    onChange?: (e: any) => void;
}

const EasyUISelectNamaPemeriksaan: React.FC<Props> = (props: Props) => {
    const [data, setData] = useState<Array<any>>([]);
    const [selectedIdTarif, setSelectedIdTarif] = useState<string>('');
    const [loading, setLoading] = useState<boolean>(false);
    const [setSelectedTarif] = useContext(daftarNamaPemeriksaanContext);

    const getData = async () => {
        try {
            setLoading(true);
            setData([]);
            const resp = await dataTarifService.datatarifnamapemeriksaan();
            const newData = resp?.list?.map((item: any) => {
                return {
                    value: item.id_tarif,
                    text: item.nama_pemeriksaan
                };
            })

            if(Array.isArray(newData) && newData.length > 0) {
                console.log('props', props.value)
                newData.forEach((item: any) => {
                    // console.log(item)
                    if(item && item.text && props.value.includes(item.text)) {
                        console.log(item.value);
                        setSelectedIdTarif(item.value)
                        setSelectedTarif(item);
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
            setSelectedTarif(findData);
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
                    value={selectedIdTarif || props?.value}
                    data={data}
                    onChange={onChange}
                />
            </Tooltip>}
        </>
    )
}

export default EasyUISelectNamaPemeriksaan;