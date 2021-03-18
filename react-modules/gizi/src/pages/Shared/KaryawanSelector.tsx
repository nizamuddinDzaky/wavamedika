import React, {useEffect, useState} from 'react';
import SelectInput, {ISelector} from "../../components/Forms/Input/SelectInput";
import kesalahanService from '../../services/giz_kesalahan.service';
import {detailKaryawan} from "../../pojo/giz_kesalahan/listkaryawan";

interface IProps {
    onDoneLoading?: () => void;
    onChangeSelector?: (ev: ISelector) => void;
    label?: string;
    labelSize?: number;
    colSize?: number;
    error?: any;
    submitted?: boolean;
}

const KaryawanSelector: React.FC<IProps> = (props: IProps) => {
    const [data, setData] = useState<Array<ISelector>>([]);
    const [value, setValue] = useState<ISelector>({value: '', label: ''});
    const [loading, setLoading] = useState<boolean>(false);

    const loadData = async () => {
        try {
            setLoading(true);

            const resp = await kesalahanService.listkaryawan();
            // setData(resp.list);
            const selectorData = resp?.list.map((item: detailKaryawan) => {
                return {
                    label: item?.nama,
                    value: item?.id_karyawan?.toString()
                }
            });

            if(props.onDoneLoading)
                props.onDoneLoading();

            setData(selectorData);
            setLoading(false);

        } catch (e) {
            console.log('error', e);
            setLoading(false);
            setData([]);
        }
    };
    const onChangeSelector = (ev: any) => {
        if(props.onChangeSelector) {
            props.onChangeSelector(ev);
        }

        setValue(ev);
    };

    useEffect(() => {
        loadData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);

    return(
        <>
            <SelectInput
                label={props?.label? props.label: 'Pilih Karyawan'}
                colSize={props?.colSize}
                labelSize={props?.labelSize}
                onChange={onChangeSelector}
                formControlSm
                disabled={false}
                options={data}
                value={value}
                defaultValue={data && data.length > 0 ? data[0] : {value: '', label: '' }}
                loading={loading}
                error={props?.error}
                submitted={props?.submitted}
            />
        </>
    )
};

export default KaryawanSelector;
