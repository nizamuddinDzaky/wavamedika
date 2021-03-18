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
    labelClass?: string;
    inputWrapperClass?: string;
    value?: any;
    hideLabelSemua?: boolean;
}

const SelectDokter: React.FC<Props> = (props: Props) => {
    const [listDokter, setListDokter] = useState<Array<ISelector>>([]);
    const [loading, setLoading] = useState<boolean>(false);


    const [Dokter, setDokter] = useState<ISelector>(props?.defaultValue || {
        value: '_',
        label: 'Semua'
    });
    
    const getData = async () => {
        try {
            setLoading(true);
            const data = await antrian_pesanan_antri_klinikService.tpp_lapregantripoli_dokter();
            let newResp= data?.list.map((item: any) => {
                return {
                    value: item.nl,
                    label: item.nama_lengkap
                }
            });

            if(props.hideLabelSemua){
                newResp = newResp.filter((item) => {
                    return item.value !== '_'
                })
            }

            setLoading(false);
            setListDokter(newResp);
        } catch(e) {
            console.log('e', e);
            setListDokter([]);
            setLoading(false)
        }
    }

    useEffect(() => {
        if(props.value) {
            setDokter(props.value);
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
    // }, [listDokter])

    
    if(loading) {
        return (
            <div>
                Loading...
            </div>
        )
    }
    return(
        <SelectInput
            // inputRef={props?.inputRef}
            value={Dokter}
            onChange={(e) => {
                setDokter(e)

                if(props.onChange)
                    props.onChange(e);
            }}
            label={props?.labelText? props.labelText: 'Dokter'}
            inputType={'text'}
            inputWrapperClass={props?.inputWrapperClass}
            labelClass={props?.labelClass}
            // inputName={props?.inputName}
            colSize={props?.colSize}
            labelSize={props?.labelSize}
            // fontSm={true}
            formControlSm
            disabled={false}
            options={listDokter}
        />
    )
}

export default SelectDokter;