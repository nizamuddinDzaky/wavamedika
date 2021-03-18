import React, { useState, useEffect } from 'react';
import SelectInput, { ISelector } from '../Forms/Input/SelectInput';

interface Props {
    onChange?: (e: ISelector) => void;
    defaultValue?: any;
    colSize?: number;
    inputWrapperClass?: string;
    labelSize?: number;
    labelClass?: string;
    labelText?: string;
    options: Array<ISelector>
    value?: any;
    error?: any;
}

const SelectManualData: React.FC<Props> = (props: Props) => {
    const [listKontrol, setListKontrol] = useState<Array<ISelector>>([]);
    const [kontrol, setKontrol] = useState<ISelector>(props.defaultValue || {
        value: 'Semua',
        label: 'Semua'
    });
    
    const loadKontrol = async () => {
        try {
            const data = props?.options

            setListKontrol(data);
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
            labelClass={props?.labelClass}
            label={props.labelText}
            inputType={'text'}
            colSize={props?.colSize}
            inputWrapperClass={props?.inputWrapperClass}
            labelSize={props?.labelSize}
            // fontSm={true}
            formControlSm
            disabled={false}
            options={listKontrol}
            errorMessage={props?.error}
        />
    )
}

export default SelectManualData;