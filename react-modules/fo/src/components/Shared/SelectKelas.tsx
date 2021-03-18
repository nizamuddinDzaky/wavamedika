import React, { useState, useEffect } from 'react';
import SelectInput, { ISelector } from '../Forms/Input/SelectInput';
import angket_pelangganService from '../../services/angket_pelanggan.service';

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
    hideSemua?: boolean;
    value?: any;
    error?: any;
}

const SelectKelas: React.FC<Props> = (props: Props) => {
    const [listRuang, setListRuang] = useState<Array<ISelector>>([]);
    const [loading, setLoading] = useState<boolean>(false);


    const [ruang, setRuang] = useState<ISelector>(props?.defaultValue || {
        value: '_',
        label: 'Semua'
    });
    
    const getData = async () => {
        try {
            setLoading(true);
            const data = await angket_pelangganService.mkt_angketpelanggan_kelas();
            const newResp= data?.list.map((item: any) => {
                return {
                    value: item.kelas,
                    label: item.kelas
                }
            });

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
            // inputRef={props?.inputRef}
            value={ruang}
            onChange={(e) => {
                setRuang(e)

                if(props.onChange)
                    props.onChange(e);
            }}
            label={props.labelText? props.labelText: 'Kelas'}
            inputType={'text'}
            // inputName={props?.inputName}
            colSize={props?.colSize}
            labelSize={props?.labelSize}
            // fontSm={true}
            formControlSm
            disabled={false}
            options={listRuang}
            labelClass={props?.labelClass}
            inputWrapperClass={props?.inputWrapperClass}
            errorMessage={props?.error}
        />
    )
}

export default SelectKelas;