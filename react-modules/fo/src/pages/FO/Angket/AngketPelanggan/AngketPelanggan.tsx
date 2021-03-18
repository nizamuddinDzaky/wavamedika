import React, { useState } from 'react';
import { useForm, Controller } from 'react-hook-form';
import HorizontalInput from '../../../../components/Forms/Input/HorizontalInput';
import moment from 'moment';
import AngketPelangganList from './AngketPelangganList';
import SelectKelas from '../../../../components/Shared/SelectKelas';
import SelectKunjungan from '../../../../components/Shared/SelectKunjungan';
import SelectManualData from '../../../../components/Shared/SelectManualData';
// import RekapitulasiRegisterKontrol from './RekapitulasiRegisterKontrol';
// import IndeksPasienKontrol from './IndeksPasienKontrol';

interface formInput {
    bulanTahun: any;
    jenis_pasien: any;
    kelas: any;
    kunjungan: any;
}

const AngketPelanggan = () => {
    const [data, setData] = useState<formInput>({
        bulanTahun: moment(),
        jenis_pasien: {
            value: 'SEMUA',
            label: 'Semua'
        },
        kelas: {
            value: '_',
            label: 'Semua'
        },
        kunjungan: {
            value: 'SEMUA',
            label: 'Semua'
        },
    });
    const { handleSubmit,control } = useForm<formInput>({
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
                    <div className={'col-xl-3 col-lg-3 col-md-12 kt-padding-r-0'}>
                        <div className={'row col-xl-12'}>
                            <Controller
                                as={
                                    <HorizontalInput
                                        // value={thn1}
                                        // onChange={(e) => setThn1(e)}
                                        label={'Bulan/Tahun'}
                                        inputType={'MUIPicker'}
                                        MUIViews={['month', 'year']}
                                        colSize={8}
                                        labelSize={4}
                                        // fontSm={true}
                                        formControlSm
                                        disabled={false}
                                    />
                                }
                                name="bulanTahun"
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
                            <Controller
                                as={
                                    <SelectManualData
                                        colSize={8}
                                        labelSize={4}
                                        labelText={'Jenis Pasien'}
                                        options={
                                            [
                                                {
                                                    value: 'SEMUA',
                                                    label: 'SEMUA'
                                                },
                                                {
                                                    value: 'Reguler',
                                                    label: 'Reguler'
                                                },
                                                {
                                                    value: 'Asuransi',
                                                    label: 'Asuransi'
                                                }
                                            ]
                                        }
                                    />
                                }
                                name="jenis_pasien"
                                isClearable
                                control={control}
                                onChange={([selected]) => {
                                    return selected;
                                }}
                            />

                            <Controller
                                as={
                                    <SelectKelas
                                        colSize={8}
                                        labelSize={4}
                                    />
                                }
                                name="kelas"
                                isClearable
                                control={control}
                                onChange={([selected]) => {
                                    return selected;
                                }}
                            />
                        </div>
                    </div>
                    <div className={'col-xl-3 col-lg-3 kt-padding-r-0'}>
                        <div className={'row col-xl-12'}>
                            <Controller
                                    as={
                                        <SelectKunjungan
                                            colSize={8}
                                            labelSize={4}
                                            labelText={'Kunjungan'}
                                        />
                                    }
                                    name='kunjungan'
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
                            <button
                                type={'submit'}
                                className='btn btn-sm btn-primary col-xl-12 kt-margin-t-5'>
                                    <i className={'la la-filter'}/> Refresh
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <AngketPelangganList
                    bulanTahun={data?.bulanTahun}
                    kunjungan={data?.kunjungan?.value}
                    kelas={data?.kelas?.value}
                    jenis_pasien={data?.jenis_pasien?.value}
                />
            </div>
        </div>
    )
}

export default AngketPelanggan;