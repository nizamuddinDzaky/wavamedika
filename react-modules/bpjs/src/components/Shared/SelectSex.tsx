import React, { useState, useEffect } from 'react';
import SelectInput, { ISelector } from '../Forms/Input/SelectInput';

interface Props {
    onChange: (e: ISelector) => void;
}

const SelectSex: React.FC<Props> = (props: Props) => {
    const [listSex, setListSex] = useState<Array<ISelector>>([]);
    const [sex, setSex] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    
    const loadOptionSex = async () => {
        try {
            const newResp = [
                {
                    value: '_',
                    label: 'Semua'
                },
                {
                    value: 'L',
                    label: 'Laki-Laki'
                },
                {
                    value: 'P',
                    label: 'Perempuan'
                },
            ]

            setListSex(newResp);
        } catch(e) {
            console.log('e', e);
            setListSex([]);
        }
    }

    useEffect(() => {
        loadOptionSex();


        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [])

    
    return(
        <SelectInput
            value={sex}
            onChange={(e) => {
                setSex(e)
                props.onChange(e);
            }}
            label={'Sex'}
            inputType={'text'}
            colSize={9}
            labelSize={3}
            // fontSm={true}
            formControlSm
            disabled={false}
            options={listSex}

        />
    )
}

export default SelectSex;