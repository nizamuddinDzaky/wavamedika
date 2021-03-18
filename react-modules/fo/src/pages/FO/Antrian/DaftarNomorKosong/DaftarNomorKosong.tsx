import React from 'react';
import DaftarNomorKosongList from './DaftarNomorKosongList';

const DaftarNomorKosong = () => {
    return (
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <DaftarNomorKosongList/>
            </div>
        </div>
    )
}

export default DaftarNomorKosong;