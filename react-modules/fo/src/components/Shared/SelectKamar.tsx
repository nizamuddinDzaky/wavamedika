import React, { useState, useEffect } from 'react';
import SelectInput, { ISelector } from '../Forms/Input/SelectInput';
import angket_pelangganService from '../../services/angket_pelanggan.service';

interface Props {
    onChange?: (e: ISelector) => void;
    defaultValue?: any;
    colSize?: number;
    labelSize?: number;
    labelText?: string;
    labelClass?: string;
    inputWrapperClass?: string;
    value?: any;
    error?: any;
}

const SelectKamar: React.FC<Props> = (props: Props) => {
    const [listKontrol, setListKontrol] = useState<Array<ISelector>>([]);
    const [kontrol, setKontrol] = useState<ISelector>(props.defaultValue || {
        value: 'Semua',
        label: 'Semua'
    });
    
    const loadKontrol = async () => {
        try {
            const data = await angket_pelangganService.mkt_angketpelanggan_kamar();
            const newResp= data?.list.map((item: any) => {
                return {
                    value: item.id_kamar,
                    label: item.nama_kamar
                }
            });

            setListKontrol(newResp);
        } catch(e) {
            console.log('e', e);
            setListKontrol([]);
        }
    }

    useEffect(() => {
        if(props.value) {
            setKontrol(props.value);
        }
        
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.value])

    useEffect(() => {
        loadKontrol();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [])

    
    return(
        <SelectInput
            value={kontrol}
            onChange={(e) => {
                setKontrol(e)

                if(props.onChange)
                    props.onChange(e);
            }}
            label={props?.labelText? props.labelText : 'Kontrol'}
            inputType={'text'}
            colSize={props?.colSize}
            labelSize={props?.labelSize}
            // fontSm={true}
            formControlSm
            disabled={false}
            options={listKontrol}
            labelClass={props?.labelClass}
            inputWrapperClass={props?.inputWrapperClass}
            errorMessage={props?.error}
        />
    )
}

export default SelectKamar;