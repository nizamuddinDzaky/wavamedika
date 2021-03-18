import React, { useState, useEffect } from 'react';
import master_asuransiService from '../../../../../../services/master_asuransi.service';
import KartuAsuransiForm from './KartuAsuransiForm';

interface Props {
    kode_instansi: string;
    isEditable?: boolean;
}
const KartuAsuransi: React.FC<Props> = (props: Props) => {
    const [,setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);
    const [mode, setMode] = useState<string>('');


    const getData = async () => {
        try {
            setLoading(true);
            const payload = {
                kode_instansi: props?.kode_instansi
            }
            const resp = await master_asuransiService.mkt_masterasuransi_kartuasuransi(payload);

            if(resp && resp.list) {
                setData(resp.list)
            } else {
                setData([]);
            }
            setLoading(false);
        } catch(e) {
            console.log('e', e);
        }
    };

    useEffect(() => {
        if(props?.kode_instansi) {
            getData();
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.kode_instansi])


    return (
        <>
            {Array.isArray(data) && data.length === 0 && mode === '' &&
                <div>Kartu peserta tidak ada.</div>
            }
            {
                props?.isEditable && Array.isArray(data) && data.length === 0 && mode === '' &&
                <button className={'btn btn-sm btn-primary'} onClick={() => setMode('add')}><i className={'fas fa-plus'}/>Tambah</button>
            }
            {
                props?.isEditable && Array.isArray(data) && data.length > 0 && mode === '' &&
                <button className={'btn btn-sm btn-primary'}><i className={'fas fa-plus'}/>Edit</button>
            }
            
            {
                props?.isEditable && mode !== '' &&
                <KartuAsuransiForm
                    kode_instansi={props.kode_instansi}
                    onCancel={() => {
                        setMode('');
                    }}
                />
            }
        </>
    )
}

export default KartuAsuransi;