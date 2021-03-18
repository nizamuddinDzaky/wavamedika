import React, {useCallback, useEffect, useState} from 'react';
import {detail} from "../../pojo/master_datapasien/tpp_riwayatpasien-view_datapasien_riwayat";
import dataPasienService from '../../services/master_datapasien.service';
import clsx from 'clsx';
// import konsultasiGiziService from '../../services/konsultasiGizi.service';
// import pmkpService from '../../services/giz_pmkp.service';


interface  IProps{
    idMR: number;
    // isPMKP?: boolean;
    style?: any;
    sex?: string;
    classNames?: string;
    onLoading?: (v: boolean) => void;
    onLoadPasienData?: (v: any) => void;
}

const HeaderPasien: React.FC<IProps> =(props: IProps) => {
    const [pasienData, setPasienData ] = useState<detail>();
    const [loading, setLoading] = useState<boolean>(false);

    const getPasienData = useCallback(async () => {
        try {
            setLoading(true);
            if(props.onLoading)
                props.onLoading(true);
            let resp: any;

            resp = await dataPasienService.tpp_riwayatpasien_view_datapasien_riwayat({id_mr: props.idMR});
            // if(!props?.isPMKP)
            //     resp = await konsultasiGiziService.datamrs({id_mrs: props.idMRS});
            // else
            //     resp = await pmkpService.datamrs({id_mrs: props?.idMRS});

            if(resp && resp.list && Array.isArray(resp.list) && resp.list.length === 1) {
                setPasienData(resp.list[0]);

                if(props.onLoadPasienData) {
                    props.onLoadPasienData(resp.list[0]);
                }
            } else {
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

            if(props.onLoadPasienData) {
                props.onLoadPasienData(null);
            }
            setLoading(false);
        }
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.idMR]);

    useEffect(() => {
        if(props.idMR) {
            getPasienData();
        }
    }, [props.idMR, getPasienData]);

    return(
        <div className={clsx("kt-widget1 col-lg-12", props.classNames)} style={props.style}>
            {!loading ?
                <div className={'kt-widget1__item kt-margin-b-30 row kt-padding-0'}>
                        <div className="kt-widget1__info">
                            <h1 className="kt-widget1__title"
                                style={{fontSize: 30}}
                            >
                                {props?.sex? <i className={clsx({'fa fa-venus': props?.sex === 'P', 'fa fa-mars': props?.sex === 'L'})}/>: null}
                                {props?.sex&& '\u00A0' }
                                {pasienData?.nama_lengkappx}
                            </h1>
                            <span
                                className="kt-widget1__desc"
                                style={{fontSize: 16}}
                            >
                                {
                                    `${pasienData?.no_mr}`
                                }
                            </span>
                        </div>
                        {/* <span className={'kt-widget1__number'}
                              style={{fontSize: 20}}
                        >
                            {
                                pasienData?.nama_kamar
                            }
                        </span> */}
                </div> :
                <div>Loading...</div>
            }
        </div>
    )
};

export default HeaderPasien;
