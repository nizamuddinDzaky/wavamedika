import React, { useState, useEffect } from 'react';
import antrian_pesanan_antri_klinikService from '../../../../services/antrian_pesanan_antri_klinik.service';
import SMSPasienForm from './SMSPasienForm';

interface Props {
    id_rencanakontrol?: string;
}

const SMSPasien:React.FC<Props> = (props: Props) => {
    const [data, setData] = useState<any>();
    const [loading, setLoading] = useState<boolean>(false);

    const getData = async () => {
        try {
            setLoading(true);
            const resp = await antrian_pesanan_antri_klinikService.mkt_sms_view_sms({
                id_rencanakontrol: props?.id_rencanakontrol
            })

            if(resp.list && Array.isArray(resp.list) && resp.list.length > 0 ) {
                setData(resp.list[0]);
            } else {
                setData(null);
            }
            setLoading(false);
        } catch(e) {
            setLoading(false);
            console.log('e', e);
        }
    }

    useEffect(() => {
        if(props.id_rencanakontrol) {
            getData()
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.id_rencanakontrol])

    if(loading) {
        return (
            <div>Loading..</div>
        )
    }
    return (
        <>
            {!loading && <SMSPasienForm
                id_rencanakontrol={props?.id_rencanakontrol}
                data={data}
            />}
        </>
    )
}

export default SMSPasien;