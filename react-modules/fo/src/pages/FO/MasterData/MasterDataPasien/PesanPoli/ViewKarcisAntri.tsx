import React, { useEffect, useState } from 'react';
import master_datapasienService from '../../../../../services/master_datapasien.service';

interface Props {
    id_rencanakontrol: number;
}
const ViewKarcisAntri: React.FC<Props> = (props: Props) => {
    const [data, setData] = useState<any>();

    const getData = async() => {
        try {
            const resp = await master_datapasienService.tpp_rencanakontrol_karcisantri({id_rencanakontrol: props.id_rencanakontrol});

            if(resp && resp.list && Array.isArray(resp.list) && resp.list.length > 0) {
                setData(resp.list[0])
            }

            console.log('resp', resp);
        } catch(e) {
            console.log('e',e);
        }
    }

    useEffect(() => {
        if(props.id_rencanakontrol)
            getData();


        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.id_rencanakontrol])

    
    return (
        <div>
            nama: {data?.nama_lengkap}
        </div>
    )
}

export default ViewKarcisAntri