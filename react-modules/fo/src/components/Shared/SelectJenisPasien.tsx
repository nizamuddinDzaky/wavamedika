import React, { useState, useEffect } from 'react';
import master_datapasienService from '../../services/master_datapasien.service';
import SelectInput, { ISelector } from '../Forms/Input/SelectInput';

interface Props {
    onChange?: (e: ISelector) => void;
    colSize?: number;
    labelSize?: number;
    labelText?: string;
}

const SelectJenisPasien: React.FC<Props> = (props: Props) => {
    const [listJnsPasien, setListJnsPasien] = useState<Array<ISelector>>([]);
    const [jnsPasien, setJnsPasien] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    
    const loadOptionJnsPasien = async () => {
        try {
            const data = await master_datapasienService.tpp_datapasien_jnspasien();
            const newResp= data?.list.map((item: any) => {
                return {
                    value: item.id_jnspasien,
                    label: item.jenis_pasien
                }
            });

            setListJnsPasien(newResp);
        } catch(e) {
            console.log('e', e);
            setListJnsPasien([]);
        }
    }

    useEffect(() => {
        loadOptionJnsPasien();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [])

    
    return(
        <SelectInput
            value={jnsPasien}
            onChange={(e) => {
                setJnsPasien(e)
                if(props.onChange)
                    props.onChange(e);
            }}
            label={props?.labelText? props?.labelText: 'JnsPasien'}
            inputType={'text'}
            colSize={props?.colSize?props?.colSize: 9}
            labelSize={props?.labelSize?props?.labelSize: 3}
            // fontSm={true}
            formControlSm
            disabled={false}
            options={listJnsPasien}

        />
    )
}

export default SelectJenisPasien;