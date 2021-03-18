import React, { useState } from 'react';
import HorizontalInput from '../../../../components/Forms/Input/HorizontalInput';
import MasterDataPasienList from './MasterDataPasienList';
import moment from 'moment';
import {ISelector} from '../../../../components/Forms/Input/SelectInput';
import SelectKabupaten from '../../../../components/Shared/SelectKabupaten';
import SelectKecamatan from '../../../../components/Shared/SelectKecamatan';
import SelectJenisPasien from '../../../../components/Shared/SelectJenisPasien';
import SelectSex from '../../../../components/Shared/SelectSex';

interface Input {
    no_mr: number;
    nama: string
}
const MasterDataPasien = () => {
    // const { register, handleSubmit, watch, errors } = useForm<Input>();


    const [noMR, setnoMR] = useState<string>('');
    const [nama, setNama] = useState<string>('');
    const [kecamatan, setKecamatan] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [kabupaten, setKabupaten] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [jnsPasien, setJnsPasien] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [sex, setSex] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });


    const [thn1, setThn1] = useState<any>(moment());
    const [thn2, setThn2] = useState<any>(moment());
    const [umur1, setUmur1] = useState<number>(0);
    const [umur2, setUmur2] = useState<number>(0);


    const [optionalProps, setOptionalProps] = useState<any>({
        thn1: thn1,
        thn2: thn2
    });


    const onClickRefresh = (e: any) => {
        e.preventDefault();

        setOptionalProps({
            no_mr: noMR, thn1, thn2, umur1, umur2, nama,
            kecamatan: kecamatan.value,
            kabupaten: kabupaten.value,
            id_jnspasien: jnsPasien.value,
            sex: sex.value
        });
    }

    // const onSubmit = (data: any) => {
    //     console.log('data', data)
    // }
    return (
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <form className={'kt-form col-xl-12 header-form kt-margin-t-25 row'} 
                    //  onSubmit={handleSubmit(onSubmit)}
                >
                    <div className={'col-xl-4 col-lg-6'}>
                        <h4>Pencarian Data Pasien:</h4>
                        <div className={'row col-xl-12'}>
                            <HorizontalInput
                                value={noMR}
                                onChange={(e) => setnoMR(e.target.value)}
                                label={'Nomor RM'}
                                inputType={'number'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'no_mr'}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={nama}
                                onChange={(e) => setNama(e.target.value)}
                                label={'Nama'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                styles={{paddingTop: 20}}
                                // inputName={'nama'}
                                // ref={register} 
                            />
                            <SelectKecamatan
                                onChange={(e) => setKecamatan(e)}
                            />
                            <SelectKabupaten
                                onChange={(e) => setKabupaten(e)}
                            />
                        </div>
                    </div>
                    <div className={'col-xl-4 col-lg-6'}>
                        <h4>Filtering Pasien:</h4>
                        <div className={'row col-xl-12'}>
                            <HorizontalInput
                                value={thn1}
                                onChange={(e) => setThn1(e)}
                                label={'Tahun'}
                                inputType={'MUIPicker'}
                                MUIViews={['year']}
                                colSize={4}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                            />
                            <HorizontalInput
                                value={thn2}
                                onChange={(e) => setThn2(e)}
                                label={'s/d'}
                                inputType={'MUIPicker'}
                                MUIViews={['year']}
                                colSize={4}
                                labelSize={1}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                            />

                            <HorizontalInput
                                value={umur1}
                                onChange={(e) => setUmur1(e.target.value)}
                                label={'Umur'}
                                inputType={'number'}
                                colSize={4}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                            />
                            <HorizontalInput
                                value={umur2}
                                onChange={(e) => setUmur2(e.target.value)}
                                label={'s/d'}
                                inputType={'number'}
                                colSize={4}
                                labelSize={1}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                            />  
                            
                            <SelectJenisPasien
                                onChange={(e) => setJnsPasien(e)}
                            />

                            <SelectSex
                                onChange={(e) => setSex(e)}
                            />
                        </div>
                    </div>
                    <div className={'col-xl-4 col-lg-2'}>
                        <button 
                            // type={'submit'}
                            onClick={onClickRefresh}
                            className='col-xl-3 col-md-12 btn btn-sm btn-primary kt-margin-t-20 align-bottom col-item-pull-bottom'>
                                <i className={'la la-filter'}/> Refresh
                        </button>
                    </div>
                </form>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <MasterDataPasienList
                    optionalProps={optionalProps}
                />
            </div>
        </div>
    )
}

export default MasterDataPasien;