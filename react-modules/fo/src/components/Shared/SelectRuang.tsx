import React, { useState, useEffect } from 'react';
import SelectInput, { ISelector } from '../Forms/Input/SelectInput';
import antrian_pesanan_antri_klinikService from '../../services/antrian_pesanan_antri_klinik.service';

interface Props {
    onChange?: (e: ISelector) => void;
    // inputRef?: any;
    // inputName?: string;
    defaultValue?: any;
    colSize?: number;
    labelSize?: number;
    labelText?: string;
    labelClass?: any;
    inputWrapperClass?: any;
    value?: any;
    hideLabelSemua?: boolean;
    error?: any;
}

const SelectRuang: React.FC<Props> = (props: Props) => {
    const [listRuang, setListRuang] = useState<Array<ISelector>>([]);
    const [loading, setLoading] = useState<boolean>(false);


    const [ruang, setRuang] = useState<ISelector>(props?.defaultValue || {
        value: '_',
        label: 'Semua'
    });
    
    const getData = async () => {
        try {
            setLoading(true);
            const data = await antrian_pesanan_antri_klinikService.tpp_lapregantripoli_ruang();
            let newResp= data?.list.map((item: any) => {
                return {
                    value: item.km,
                    label: item.nama_kamar
                }
            });

            if(props.hideLabelSemua){
                newResp = newResp.filter((item) => {
                    return item.value !== '_'
                })
            }

            setLoading(false);
            setListRuang(newResp);
        } catch(e) {
            console.log('e', e);
            setListRuang([]);
            setLoading(false)
        }
    }

    useEffect(() => {
        if(props.value) {
            setRuang(props.value);
        }
        
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.value])

    useEffect(() => {
        getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [])

    // useEffect(() => {
    //     if(props.onChange && props.defaultValue) {
    //         props.onChange(props.defaultValue);
    //     }
    // }, [listRuang])

    
    if(loading) {
        return (
            <div>
                Loading...
            </div>
        )
    }
    return(
        <SelectInput
            inputWrapperClass={props?.inputWrapperClass}
            labelClass={props?.labelClass}
            // inputRef={props?.inputRef}
            value={ruang}
            onChange={(e) => {
                setRuang(e)

                if(props.onChange)
                    props.onChange(e);
            }}
            label={props.labelText? props.labelText: 'Ruang'}
            inputType={'text'}
            // inputName={props?.inputName}
            colSize={props?.colSize}
            labelSize={props?.labelSize}
            // fontSm={true}
            formControlSm
            disabled={false}
            options={listRuang}
            errorMessage={props?.error}
        />
    )
}

export default SelectRuang;