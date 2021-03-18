import React, { useState, useEffect } from 'react';
import master_datapasienService from '../../services/master/datapasien.service';
import SelectInput, { ISelector } from '../Forms/Input/SelectInput';

interface Props {
    onChange: (e: ISelector) => void;
}

const SelectKecamatan: React.FC<Props> = (props: Props) => {
    const [listKecamatan, setListKecamatan] = useState<Array<ISelector>>([]);
    const [kecamatan, setKecamatan] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    
    const loadOptionKecamatan = async () => {
        try {
            const data = await master_datapasienService.tpp_datapasien_kecamatanpx();
            const newResp= data?.list.map((item: any) => {
                return {
                    value: item.kc1,
                    label: item.kc2
                }
            });

            setListKecamatan(newResp);
        } catch(e) {
            console.log('e', e);
            setListKecamatan([]);
        }
    }

    useEffect(() => {
        loadOptionKecamatan();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [])

    
    return(
        <SelectInput
            value={kecamatan}
            onChange={(e) => {
                setKecamatan(e)
                props.onChange(e);
            }}
            label={'Kecamatan'}
            inputType={'text'}
            colSize={9}
            labelSize={3}
            // fontSm={true}
            formControlSm
            disabled={false}
            options={listKecamatan}

        />
    )
}

export default SelectKecamatan;