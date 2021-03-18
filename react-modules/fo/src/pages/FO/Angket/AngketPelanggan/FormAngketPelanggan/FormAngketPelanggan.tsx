import React, { useEffect, useState } from 'react';
import { RouteComponentProps, withRouter } from 'react-router';
import DetailPageWrapper from '../../../../Shared/DetailPageWrapper';
import angket_pelangganService from '../../../../../services/angket_pelanggan.service';
import {default as Form} from './FormAngketPelanggan_Form';

type propTypes = RouteComponentProps<any> & {
}

const FormAngketPelanggan: React.FC<propTypes> = (props: propTypes) => {
    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<any>(null);

    useEffect(() => {
        getDataDetail();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [])

    const getDataDetail = async () => {
        try {
            setLoading(true);
            const resp = await angket_pelangganService.mkt_dataangketpelanggan_view_angketpelanggan({id_angketpelanggan: props?.match?.params?.id_angketpelanggan})
            if(resp?.metadata && !resp?.metadata?.error) {
                if(Array.isArray(resp?.list) && resp.list.length > 0) {
                    setData(resp.list[0]);
                }

                if(resp && resp.list && resp.list[0]) {
                    setData(resp.list[0]);
                }
            };
            setLoading(false);
        } catch(e) {
            setLoading(false);
            setData(null);
        }
    };

    return (
        <DetailPageWrapper
            backLink={'/fo/angket/angket-pelanggan'}
        >
            {!loading?
                <div className={'kt-portlet kt-portlet--no-shadow'}>
                    <div className={'kt-portlet__body header-form kt-padding-t-0 kt-padding-r-5'}>
                        {
                            data !== null?
                                <div className="row">
                                    <div className={'col-xl-12 col-md-12 col-sm-12'}>
                                        <Form
                                            data_angketpelanggan={data}
                                            id_angketpelanggan={props?.match?.params?.id_angketpelanggan}
                                        />
                                    </div>
                                </div>
                            :
                            <div className="row">Data tidak ditemukan/ tidak diizinkan</div>
                        }
                    </div>
                </div>
                :
                <div className={'kt-portlet kt-portlet--no-shadow'}>
                    <div className={'kt-portlet__body header-form kt-padding-t-0'}>
                        <div className={'row'}>
                            Loading...
                        </div>
                    </div>
                </div>
            }
            
        </DetailPageWrapper>
    )
}

export default withRouter(FormAngketPelanggan);