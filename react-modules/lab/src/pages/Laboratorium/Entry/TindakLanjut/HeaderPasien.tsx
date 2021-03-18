import React, {useCallback, useEffect, useState} from 'react';
import {detailMRS} from "../../../../pojo/entry/tindak_lanjut/data_pasien_mrs";

interface  IProps{
    idMRS?: number;
    namaPasien?: string;
    umurPasien?: string;
    sexPasien?:string;
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
        <div className="kt-widget1 col-lg-12">
            {!loading ?
                <div className={'kt-widget1__item kt-margin-b-30 row'}>
                        <div className="kt-widget1__info">
                            <h1 className="kt-widget1__title"
                                style={{fontSize: 30}}
                            >{props.namaPasien}</h1>
                            <span
                                className="kt-widget1__desc"
                                style={{fontSize: 16}}
                            >
                                {
                                    `${props.umurPasien} / ${props.sexPasien}`
                                }
                            </span>
                        </div>
                        <span className={'kt-widget1__number'}
                              style={{fontSize: 20}}
                        >
                        </span>
                </div> :
                <div>Loading...</div>
            }
        </div>
    )
};

export default HeaderPasien;
