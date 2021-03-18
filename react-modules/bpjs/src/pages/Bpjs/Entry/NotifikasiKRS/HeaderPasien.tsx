import React, {useCallback, useEffect, useState} from 'react';
import { detailMRS } from '../../../../pojo/entry/notifikasi_krs/data_pasien_mrs';

interface  IProps{
    namaPasien?: string;
    idMRS?: number;
    isPMKP?: boolean;
    onLoading?: (v: boolean) => void;
    onLoadPasienData?: (v: any) => void;
}

const HeaderPasien: React.FC<IProps> = (props: IProps) => {
    const [pasienData, setPasienData ] = useState<detailMRS>();
    const [loading, setLoading] = useState<boolean>(false);

    const getPasienData = useCallback(async () => {
        try {
            setLoading(true);
            if(props.onLoading)
                props.onLoading(true);
            let resp: any;

            if(resp && resp.list && Array.isArray(resp.list) && resp.list.length === 1) {
                setPasienData(resp.list[0]);

                if(props.onLoadPasienData) {
                    props.onLoadPasienData(resp.list[0]);
                }
            }
            if(props.onLoading)
                props.onLoading(false);
            setLoading(false);
        } catch (e) {
            console.log('error', e);
            if(props.onLoading)
                props.onLoading(false);
            setLoading(false);
        }
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.idMRS]);

    useEffect(() => {
        if(props.idMRS) {
            getPasienData();
        }
    }, [props.idMRS, getPasienData]);

    return(
        <div className="kt-widget col-lg-12">
            {!loading ?
                <div className={'kt-widget__item  row'}>
                        <div className="kt-widget__info">
                            <h1 className="kt-widget__title"
                                style={{fontSize: 30}}
                            >{props.namaPasien}</h1>
                        </div>
                </div> :
                <div>Loading...</div>
            }
        </div>
    )
};

export default HeaderPasien;