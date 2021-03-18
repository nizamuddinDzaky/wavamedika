import React, { useState } from 'react';
import { useForm, Controller } from 'react-hook-form';
import HorizontalInput from '../../../../components/Forms/Input/HorizontalInput';
import moment from 'moment';
import SelectRuang from '../../../../components/Shared/SelectRuang';
import SelectDokter from '../../../../components/Shared/SelectDokter';
import RekapitulasiRegisterKontrol from './RekapitulasiRegisterKontrol';
import IndeksPasienKontrol from './IndeksPasienKontrol';

interface formInput {
    tgl1: string;
    tgl2: string;
    unit: any;
    dokter: any;
    kontrol: boolean;
}

const RegisterKontrol = () => {
    const [data, setData] = useState<formInput>({
        tgl1: moment().format('YYYY-MM-DD'),
        tgl2: moment().format('YYYY-MM-DD'),
        unit: {
            value: '_',
            label: 'Semua'
        },
        dokter: {
            value: '_',
            label: 'Semua Dokter'
        },
        kontrol: true
    });
    const { register, handleSubmit,control } = useForm<formInput>({
        defaultValues: data
    });

    const onSubmit = (data: formInput) => {
        setData(data);
        console.log('dat', data);
    }
    return (
        <div className={'kt-portlet kt-portlet--no-shadow kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <form className={'kt-form col-xl-12 header-form kt-margin-t-25 row'} 
                    onSubmit={handleSubmit(onSubmit)}
                >
                     <div className={'col-xl-6 col-lg-6 col-md-12'}>
                        <div className={'row col-xl-12'}>
                            <HorizontalInput
                                // value={noMR}
                                // onChange={(e) => setnoMR(e.target.value)}
                                label={'Tgl'}
                                inputType={'date'}
                                colSize={4}
                                labelSize={2}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                inputRef={register()}
                                inputName={'tgl1'}
                                labelClass={'kt-padding-r-0'}
                            />
                            <Controller
                                as={
                                    <SelectRuang
                                        colSize={4}
                                        labelSize={2}
                                        labelText={'Poli'}
                                    />
                                }
                                name="unit"
                                isClearable
                                control={control}
                                onChange={([selected]) => {
                                    return selected;
                                }}
                            />

                        </div>
                        <div className={'row col-xl-12'}>
                            <HorizontalInput
                                // value={noMR}
                                // onChange={(e) => setnoMR(e.target.value)}
                                label={'s/d'}
                                inputType={'date'}
                                colSize={4}
                                labelSize={2}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                inputRef={register()}
                                inputName={'tgl2'}
                                labelClass={'kt-padding-r-0'}
                            />


                            <Controller
                                as={
                                    <SelectDokter
                                        colSize={4}
                                        labelSize={2}
                                    />
                                }
                                name="dokter"
                                isClearable
                                control={control}
                                onChange={([selected]) => {
                                    return selected;
                                }}
                            />
                        </div>
                    </div>
                    <div className={'col-xl-4 col-lg-4'}>
                        <div className={'fcol-form-label col-sm-12 kt-font-sm kt-padding-l-0 form-control-sm col-lg-4 col-sm-12'}>
                            <input type={'checkbox'} name={'kontrol'} ref={register()}/>
                            &nbsp;
                            Kontrol
                        </div>
                        <button 
                            type={'submit'}
                            className='col-xl-3 col-md-12 btn btn-sm btn-primary kt-margin-t-20 align-bottom col-item-pull-bottom'>
                                <i className={'la la-filter'}/> Refresh
                        </button>
                    </div>
                </form>
            </div>
            <div className={'kt-portlet__body header-form kt-padding-t-20'}>
                <div className={'row'}>
                    <div className={'col-xl-4 col-md-4 col-sm-12'}>
                        <RekapitulasiRegisterKontrol
                            tgl1={data?.tgl1}
                            tgl2={data?.tgl2}
                            dokter={data?.dokter?.value}
                            ruang={data?.unit?.value}
                            kontrol={data?.kontrol}
                        />
                    </div>
                    <div className={'col-xl-8 col-md-8 col-sm-12'}>
                        <IndeksPasienKontrol
                            tgl1={data?.tgl1}
                            tgl2={data?.tgl2}
                            dokter={data?.dokter?.value}
                            ruang={data?.unit?.value}
                            kontrol={data?.kontrol}
                        />
                    </div>
                </div>
            </div>
        </div>
    )
}

export default RegisterKontrol;