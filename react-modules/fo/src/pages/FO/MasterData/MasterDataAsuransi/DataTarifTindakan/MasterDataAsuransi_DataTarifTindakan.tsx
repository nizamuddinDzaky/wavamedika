import React from 'react';
import {default as DataTarifTindakanList} from './MasterDataAsuransi_DataTarifTindakanList';
import { RouteComponentProps, withRouter } from 'react-router';
import DetailPageWrapper from '../../../../Shared/DetailPageWrapper';

type propTypes = RouteComponentProps<any> & {
}

const MasterDataAsuransi_DataTarifTindakan: React.FC<propTypes> = (props: propTypes) => {
    console.log('[props', props);
    return (
        <DetailPageWrapper
            backLink={'/fo/master-data/asuransi/data-asuransi'}
            backTitle={'Kembali (Pilih Instansi Asuransi)'}
            backButtonClass={'col-lg-5 col-md-12 col-sm-12 col-xs-12'}
        > 
            <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
                <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                    <DataTarifTindakanList
                        aktif={true}
                        kode_instansi={props?.match?.params?.kode_instansi}
                    />
                </div>
            </div>
        </DetailPageWrapper>
    )
}

export default withRouter(MasterDataAsuransi_DataTarifTindakan);