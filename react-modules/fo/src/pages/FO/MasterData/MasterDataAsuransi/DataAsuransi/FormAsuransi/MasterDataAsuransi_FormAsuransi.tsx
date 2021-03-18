import React, { useEffect, useState } from 'react';
import { RouteComponentProps, withRouter } from 'react-router';
import DetailPageWrapper from '../../../../../Shared/DetailPageWrapper';
import FormDataAsuransi from './FormDataAsuransi';
import master_asuransiService from '../../../../../../services/master_asuransi.service';
import { Tabs, Tab } from 'react-bootstrap';
import Admission from './Admission';
import Fasilitas from './Fasilitas';
import KartuAsuransi from '../KartuAsuransi/KartuAsuransi';

type propTypes = RouteComponentProps<any> & {
}

const MasterDataAsuransi_FormAsuransi: React.FC<propTypes> = (props: propTypes) => {
    const [mode, setMode] = useState<string>('');
    const [loading, setLoading] = useState<boolean>(false);
    const [dataAsuransi, setDataAsuransi] = useState<any>(null);
    useEffect(() => {
        if(props.match.params.id === 'add') {
            setMode('add');
        } else {
            setMode('edit')
            getDataDetail();
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    },[])

    const onSavedNewData = (kode_instansi: string) => {
        props?.history?.push(`/fo/master-data/asuransi/data-asuransi/${kode_instansi}`);

        setTimeout(() => {
            window.location.reload();
        }, 2000)
    }

    const getDataDetail = async () => {
        try {
            setLoading(true);
            const resp = await master_asuransiService.mkt_instansi_view_instansi({kode_instansi: props?.match?.params?.id})
            if(resp?.metadata && !resp?.metadata?.error) {
                if(Array.isArray(resp?.list) && resp.list.length > 0) {
                    setDataAsuransi(resp.list[0]);
                }
            };
            setLoading(false);
        } catch(e) {
            setLoading(false);
            setDataAsuransi(null);
        }
    };

    return (
        <DetailPageWrapper
            backLink={'/fo/master-data/asuransi/data-asuransi'}
            headerRightToolbar={
                <>
                    <>
                        &nbsp;
                        <button 
                            type={'button'}
                            disabled={mode==='add'}
                            onClick={() => {
                                props?.history?.push(`/fo/master-data/asuransi/data-tarif-tindakan/${props?.match?.params?.id}`);
                            }}
                            className='col-lg-4 col-sm-12 form-control form-control-sm btn btn-sm btn-info'>
                                <i className={'fas fa-eye'}/> Lihat Daftar Tarif Tindakan
                        </button>
                        &nbsp;
                        <button 
                            type={'button'}
                            disabled={mode==='add'}
                            onClick={() => {
                                props?.history?.push(`/fo/master-data/asuransi/data-tarif-tindakan/${props?.match?.params?.id}`);
                            }}
                            className='col-lg-2 col-sm-12 form-control form-control-sm btn btn-sm btn-primary'>
                                <i className={'fas fa-print'}/> Cetak
                        </button>
                    </>
                    
                </>
            }
        >

            {!loading?
            <div className={'kt-portlet kt-portlet--no-shadow'}>
                <div className={'kt-portlet__body header-form kt-padding-t-0'}>
                    {mode === 'add' || (mode === 'edit' && dataAsuransi !== null)?
                    <div className="row">
                        <div className={'col-xl-6 col-md-12 col-sm-12'}>
                            <FormDataAsuransi
                                data_asuransi={dataAsuransi}
                                mode={mode}
                                onSavedNewData={onSavedNewData}
                                jenis={'Asuransi'}
                            />
                        </div>
                        <div className={'col-xl-6 col-md-12 col-sm-12'}>
                            <Tabs transition={false} id="noanim-tab-example">
                                <Tab eventKey="admission" title="Admission" disabled={!dataAsuransi}>
                                    {dataAsuransi?
                                    <>
                                        Under Construction (API masih error!)
                                        {mode!=='add' && <Admission/> }
                                    </>:
                                    <>
                                    Simpan Data Informasi Asuransi Terlebih Dahulu
                                    </>}
                                </Tab>
                                <Tab eventKey="foto" title="Insert Foto Kartu Peserta" disabled={!dataAsuransi}>
                                    Under Construction
                                    {mode!=='add' && <KartuAsuransi
                                        kode_instansi={props?.match?.params?.id}
                                        isEditable
                                    />}
                                </Tab>
                                <Tab eventKey="fasilitas" title="Fasilitas" disabled={!dataAsuransi}>
                                    {dataAsuransi&&
                                    <>
                                        Under Construction (API masih error!)
                                        {mode!=='add' && <Fasilitas/> }
                                    </>}
                                </Tab>
                                
                            </Tabs>
                        </div>
                    </div>:
                    <div className="row">Data tidak ditemukan</div>
                    }
                </div>
            </div>:
            <div className={'kt-portlet kt-portlet--no-shadow'}>
                <div className={'kt-portlet__body header-form kt-padding-t-0'}>
                    <div className={'row'}>
                        Loading...
                    </div>
                </div>
            </div>}
        </DetailPageWrapper>
    )
}

export default withRouter(MasterDataAsuransi_FormAsuransi);