import React from 'react';
import MasterDataInstansiList from './MasterDataInstansiList';

const MasterDataInstansi= () => {
    return (
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <MasterDataInstansiList />
            </div>
        </div>
    )
}

export default MasterDataInstansi;