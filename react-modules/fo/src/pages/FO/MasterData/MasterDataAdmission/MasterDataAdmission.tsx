import React from 'react';
import MasterDataAdmissionList from './MasterDataAdmissionList';

const MasterDataAdmission = () => {
    return (
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <MasterDataAdmissionList/>
            </div>
        </div>
    )
}

export default MasterDataAdmission;