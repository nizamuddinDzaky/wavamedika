import React, { useState, useEffect } from 'react';
import master_datapasienService from '../../services/master/datapasien.service';
import SelectInput, { ISelector } from '../Forms/Input/SelectInput';

interface Props {
    onChange: (e: ISelector) => void;
}

const SelectKabupaten: React.FC<Props> = (props: Props) => {
    const [listKabupaten, setListKabupaten] = useState<Array<ISelector>>([]);
    const [kabupaten, setKabupaten] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    
    const loadOptionKabupaten = async () => {
        try {
            const data = await master_datapasienService.tpp_datapasien_kabupatenpx();
            const newResp= data?.list.map((item: any) => {
                return {
                    value: item.kb1,
                    label: item.kb2
                }
            });

            setListKabupaten(newResp);
        } catch(e) {
            console.log('e', e);
            setListKabupaten([]);
        }
    }

    useEffect(() => {
        loadOptionKabupaten();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [])

    
    return(
        <SelectInput
            value={kabupaten}
            onChange={(e) => {
                setKabupaten(e)
                props.onChange(e);
            }}
            label={'Kabupaten'}
            inputType={'text'}
            colSize={9}
            labelSize={3}
            // fontSm={true}
            formControlSm
            disabled={false}
            options={listKabupaten}

        />
    )
}

export default SelectKabupaten;