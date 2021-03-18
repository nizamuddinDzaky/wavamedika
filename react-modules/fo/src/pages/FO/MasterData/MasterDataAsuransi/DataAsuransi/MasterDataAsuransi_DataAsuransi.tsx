import React from 'react';
import {default as DataAsuransi} from './MasterDataAsuransi_DataAsuransiList';

const MasterDataAsuransi_DataAsuransi = () => {
    return (
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <DataAsuransi
                    aktif={true}
                />
            </div>
        </div>
    )
}

export default MasterDataAsuransi_DataAsuransi;