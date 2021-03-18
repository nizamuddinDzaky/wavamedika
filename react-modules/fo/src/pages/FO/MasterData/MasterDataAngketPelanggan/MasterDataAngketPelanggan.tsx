import React from 'react';
import MasterDataAngketPelangganList from './MasterDataAngketPelangganList';

const MasterDataAngketPelanggan = () => {
    return (
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <MasterDataAngketPelangganList
                    aktif={true}
                    // optionalProps={optionalProps}
                />
            </div>
        </div>
    )
}

export default MasterDataAngketPelanggan;