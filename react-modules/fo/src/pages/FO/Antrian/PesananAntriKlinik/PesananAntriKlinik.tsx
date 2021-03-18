import React, { useState } from 'react';
import PesananAntriKlinikList from './PesananAntriKlinikList';
import HorizontalInput from '../../../../components/Forms/Input/HorizontalInput';
import { useForm, Controller } from 'react-hook-form';
import moment from 'moment';
import SelectRuang from '../../../../components/Shared/SelectRuang';
import SelectDokter from '../../../../components/Shared/SelectDokter';

interface formInput {
    tgl1: string;
    tgl2: string;
    ruang: any;
    dokter: any;
}


const PesananAntriKlinik = () => {
    const [data, setData] = useState<formInput>({
        tgl1: moment().format('YYYY-MM-DD'),
        tgl2: moment().format('YYYY-MM-DD'),
        ruang: {
            value: '_',
            label: 'Semua'
        },
        dokter: {
            value: '_',
            label: 'Semua Dokter'
        }
    });

    const { register, handleSubmit,control } = useForm<formInput>({
        defaultValues: data
    });

    const onSubmit = (data: formInput) => {
        setData(data);
        console.log('data', data);
    }

    return (
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
             <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <form className={'kt-form col-xl-12 header-form kt-margin-t-25 row'} 
                    onSubmit={handleSubmit(onSubmit)}
                >
                     <div className={'col-xl-6 col-lg-6 col-md-12'}>
                        <div className={'row col-xl-12'}>
                            <HorizontalInput
                                // value={noMR}
                                // onChange={(e) => setnoMR(e.target.value)}
                                label={'Tgl MRS'}
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
                           {/* <div className={'col-xl-1 col-lg-1'}/> */}
                            
                            <Controller
                                as={
                                    <SelectRuang
                                        colSize={4}
                                        labelSize={2}
                                    />
                                }
                                name="ruang"
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
                            />

                            {/* <div className={'col-xl-1 col-lg-1'}/> */}

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
                            <button 
                                type={'submit'}
                                className='col-xl-3 col-md-12 btn btn-sm btn-primary kt-margin-t-20 align-bottom col-item-pull-bottom'>
                                    <i className={'la la-filter'}/> Refresh
                            </button>
                    </div>
                </form>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <PesananAntriKlinikList
                    tgl1={data?.tgl1}
                    tgl2={data?.tgl2}
                    dokter={data?.dokter?.value}
                    ruang={data?.ruang?.value}
                />
            </div>
        </div>
    )
}

export default PesananAntriKlinik;