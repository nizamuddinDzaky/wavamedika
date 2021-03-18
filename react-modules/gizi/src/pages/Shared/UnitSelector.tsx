import React, {useEffect, useState} from 'react';
import SelectInput, {ISelector} from "../../components/Forms/Input/SelectInput";
import laporanGiziService from '../../services/gizLapreggizi.service';
import {detailIndeksMRS} from "../../pojo/giz_lapreggizi/tpp_indeksmrs.unit";

interface IProps {
    onDoneLoading?: () => void;
    onChangeSelector?: (ev: ISelector) => void;
    label?: string;
}

const UnitSelector: React.FC<IProps> = (props: IProps) => {
    const [data, setData] = useState<Array<ISelector>>([]);
    const [value, setValue] = useState<ISelector>({value: '', label: ''});
    const [loading, setLoading] = useState<boolean>(false);

    const loadData = async () => {
        try {
            setLoading(true);

            const resp = await laporanGiziService.unit();
            // setData(resp.list);
            const selectorData = resp?.list.map((item: detailIndeksMRS) => {
                return {
                    label: item?.u,
                    value: item?.nama_unit
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
                label={props?.label? props.label: 'Nama Unit'}
                colSize={2}
                onChange={onChangeSelector}
                formControlSm
                disabled={false}
                options={data}
                value={value}
                defaultValue={data && data.length > 0 ? data[0] : {value: '', label: '' }}
                loading={loading}
            />
        </>
    )
};

export default UnitSelector;
