import React, { useState, useEffect } from 'react';
import SelectInput, { ISelector } from '../Forms/Input/SelectInput';

interface Props {
    onChange?: (e: ISelector) => void;
    defaultValue?: any;
    colSize?: number;
    labelSize?: number;
    labelText?: string;
}

const SelectKontrol: React.FC<Props> = (props: Props) => {
    const [listKontrol, setListKontrol] = useState<Array<ISelector>>([]);
    const [kontrol, setKontrol] = useState<ISelector>({
        value: 'Semua',
        label: 'Semua'
    });
    
    const loadKontrol = async () => {
        try {
            const data = [
                {
                    value: 'Semua',
                    label: 'Semua'
                },
                {
                    value: 'Datang',
                    label: 'Datang'
                },
                {
                    value: 'Tidak Datang',
                    label: 'Tidak Datang'
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
            label={props?.labelText? props.labelText : 'Kontrol'}
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

export default SelectKontrol;