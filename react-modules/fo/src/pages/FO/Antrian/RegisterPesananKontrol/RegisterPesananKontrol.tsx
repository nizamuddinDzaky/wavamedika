import React, { useState } from 'react';
import { useForm, Controller } from 'react-hook-form';
import HorizontalInput from '../../../../components/Forms/Input/HorizontalInput';
import moment from 'moment';
import SelectRuang from '../../../../components/Shared/SelectRuang';
import SelectDokter from '../../../../components/Shared/SelectDokter';
import RegisterPesananKontrolList from './RegisterPesananKontrolList';
import SelectKontrol from '../../../../components/Shared/SelectKontrol';
import SelectPesanan from '../../../../components/Shared/SelectPesanan';
// import RekapitulasiRegisterKontrol from './RekapitulasiRegisterKontrol';
// import IndeksPasienKontrol from './IndeksPasienKontrol';

interface formInput {
    tgl1: string;
    tgl2: string;
    unit: any;
    dokter: any;
    kontrol: any;
    tanggal: any;
}

const RegisterPesananKontrol = () => {
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
        kontrol: {
            value: 'Semua',
            label: 'Semua'
        },
        tanggal: {
            value: 'Pesanan', 
            label: 'Pesanan'
        }
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
                    <div className={'col-xl-2 col-lg-2 kt-padding-r-0'}>
                        <div className={'row col-xl-12'}>
                            <Controller
                                    as={
                                        <SelectPesanan
                                            colSize={12}
                                            labelSize={12}
                                        />
                                    }
                                    name='tanggal'
                                    isClearable
                                    control={control}
                                    onChange={([selected]) => {
                                        return selected;
                                    }}
                            />
                        </div>
                    </div>
                    <div className={'col-xl-3 col-lg-3 col-md-12 kt-padding-r-0'}>
                        <div className={'row col-xl-12'}>
                            <HorizontalInput
                                // value={noMR}
                                // onChange={(e) => setnoMR(e.target.value)}
                                label={'Tanggal'}
                                inputType={'date'}
                                colSize={8}
                                labelSize={4}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                inputRef={register()}
                                inputName={'tgl1'}
                                labelClass={'kt-padding-r-0'}
                            />
                            <HorizontalInput
                                // value={noMR}
                                // onChange={(e) => setnoMR(e.target.value)}
                                label={'s/d'}
                                inputType={'date'}
                                colSize={8}
                                labelSize={4}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                inputRef={register()}
                                inputName={'tgl2'}
                                labelClass={'kt-padding-r-0'}
                            />
                        </div>
                    </div>

                    <div className={'col-xl-3 col-lg-3 col-md-12 kt-padding-r-0'}>
                        <div className={'row col-xl-12'}>
                            <Controller
                                as={
                                    <SelectRuang
                                        colSize={8}
                                        labelSize={4}
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

                            <Controller
                                as={
                                    <SelectDokter
                                        colSize={8}
                                        labelSize={4}
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
                    <div className={'col-xl-2 col-lg-2 kt-padding-r-0'}>
                        <div className={'row col-xl-12'}>
                            <Controller
                                    as={
                                        <SelectKontrol
                                            colSize={12}
                                            labelSize={12}
                                        />
                                    }
                                    name='kontrol'
                                    isClearable
                                    control={control}
                                    onChange={([selected]) => {
                                        return selected;
                                    }}
                            />
                        </div>
                    </div>
                    <div className={'col-xl-2 col-lg-2 kt-padding-r-0'}>
                        <button
                            type={'submit'}
                            className='btn btn-sm btn-primary kt-margin-t-10 col-lg-12'>
                                <i className={'la la-filter'}/> Refresh
                        </button>
                    </div>
                </form>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <RegisterPesananKontrolList
                    tgl1={data?.tgl1}
                    tgl2={data?.tgl2}
                    dokter={data?.dokter?.value}
                    ruang={data?.unit?.value}
                    kontrol={data?.kontrol?.value}
                    tanggal={data?.tanggal?.value}
                />
            </div>
        </div>
    )
}

export default RegisterPesananKontrol;