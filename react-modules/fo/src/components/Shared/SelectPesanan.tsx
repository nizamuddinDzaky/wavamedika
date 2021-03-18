import React, { useState, useEffect } from 'react';
import SelectInput, { ISelector } from '../Forms/Input/SelectInput';

interface Props {
    onChange?: (e: ISelector) => void;
    defaultValue?: any;
    colSize?: number;
    labelSize?: number
}

const SelectPesanan: React.FC<Props> = (props: Props) => {
    const [listKontrol, setListKontrol] = useState<Array<ISelector>>([]);
    const [kontrol, setKontrol] = useState<ISelector>({
        value: 'Pesanan',
        label: 'Pesanan'
    });
    
    const loadKontrol = async () => {
        try {
            const data = [
               
                {
                    value: 'Pesanan',
                    label: 'Pesanan'
                },
                {
                    value: 'Input',
                    label: 'Input'
                }
            ]

            setListKontrol(data);
        } catch(e) {
            console.log('e', e);
            setListKontrol([]);
        }
    }

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
            label={'Tanggal'}
            inputType={'text'}
            colSize={props?.colSize}
            labelSize={props?.labelSize}
            // fontSm={true}
            formControlSm
            disabled={false}
            options={listKontrol}

        />
    )
}

export default SelectPesanan;