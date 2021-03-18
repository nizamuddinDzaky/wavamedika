import React, { useState } from 'react';
import HorizontalInput from '../../../../components/Forms/Input/HorizontalInput';
import moment from 'moment';
import {ISelector} from '../../../../components/Forms/Input/SelectInput';
import ListPemeriksaan from './ListPemeriksaan';
import ListBahan from './ListBahan';

interface Input {
    no_mr: number;
    nama: string
}

interface Props {
    // no_bukti?: string;
    
}

const EntryPeriksaRadiologi:React.FC<Props> = (props: Props) =>  {
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
                <div className={'kt-form col-xl-12 header-form kt-margin-t-25 row'} 
                    //  onSubmit={handleSubmit(onSubmit)}
                >
                    <div className={'col-xl-3 col-lg-3'}>
                    <div className={'row col-xl-12'}>
                        <HorizontalInput
                                value={''}
                                // onChange={(e) => setnoMR(e.target.value)}
                                label={'No.Faktur'}
                                inputType={'number'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'no_mr'}
                                // ref={register} 
                            />
                            </div>
                            </div>
                    <div className={'col-xl-3 col-lg-3'}>
                    <div className={'row col-xl-12'}>
                            <HorizontalInput
                                value={''}
                                // onChange={(e) => setnoMR(e.target.value)}
                                label={'Tanggal'}
                                inputType={'date'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'no_mr'}
                                // ref={register} 
                            />
                            </div>
                            </div>
                        <div className={'col-xl-3 col-lg-3'}>
                        <div className={'row col-xl-12'}>
                            <HorizontalInput
                                value={''}
                                // onChange={(e) => setnoMR(e.target.value)}
                                label={'Jam'}
                                inputType={'time'}
                                colSize={6}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'no_mr'}
                                // ref={register} 
                            />
                            </div>
                            </div>
                            <div className={'col-xl-3 col-lg-3'}>
                            <div className={'row col-xl-12'}>
                            <HorizontalInput
                                value={''}
                                // onChange={(e) => setnoMR(e.target.value)}
                                label={'Operator'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'no_mr'}
                                // ref={register} 
                            />
                            </div>
                            </div>
                            <hr/>
                </div>
                
            </div>

            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
            <form className={'kt-form col-xl-12 header-form kt-margin-t-25 row'} 
                    //  onSubmit={handleSubmit(onSubmit)}
                >
                    <div className={'col-xl-4 col-lg-4'}>
                        <h4 className={'mx-2'}>Pencarian Pasien:</h4>
                        <button 
                            // type={'submit'}
                            onClick={onClickRefresh}
                            className='col-xl-11 mx-2 col-md-12 btn btn-sm btn-primary align-bottom col-item-pull-bottom'>
                                <i className={'la la-filter'}/> Pasien MRS
                        </button>
                        <div className={'row col-xl-12 kt-margin-t-15'}>
                            <HorizontalInput
                                value={noMR}
                                onChange={(e) => setnoMR(e.target.value)}
                                label={'Nomor MRS'}
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
                                label={'Nomor RM'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'nama'}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={''}
                                onChange={(e) => setUmur2(e.target.value)}
                                label={'Asuransi'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                            /> 
                        </div>
                    </div>
                    <div className={'col-xl-4 col-lg-4 kt-margin-t-15'}>
                        <div className={'row col-xl-12'}>
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
                                // inputName={'nama'}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={nama}
                                onChange={(e) => setNama(e.target.value)}
                                label={'Alamat'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'nama'}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={nama}
                                onChange={(e) => setNama(e.target.value)}
                                label={'Ruang/Kamar'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'nama'}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={''}
                                onChange={(e) => setUmur2(e.target.value)}
                                label={'Dr.Pengirim'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                            />  
                            <HorizontalInput
                                value={''}
                                onChange={(e) => setUmur2(e.target.value)}
                                label={'Instansi'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                            /> 
                            
                        </div>
                    </div>
                    <div className={'col-xl-4 col-lg-4 kt-margin-t-15'}>
                    <div className={'row col-xl-12'}>
                        <HorizontalInput
                                value={nama}
                                onChange={(e) => setNama(e.target.value)}
                                label={'Umur'}
                                inputType={'number'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'nama'}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={nama}
                                onChange={(e) => setNama(e.target.value)}
                                label={'Lahir'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'nama'}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={nama}
                                onChange={(e) => setNama(e.target.value)}
                                label={'Kelas'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                                // inputName={'nama'}
                                // ref={register} 
                            />
                            <HorizontalInput
                                value={''}
                                onChange={(e) => setUmur2(e.target.value)}
                                label={'Dr.Pembaca'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                            />  
                            <HorizontalInput
                                value={''}
                                onChange={(e) => setUmur2(e.target.value)}
                                label={'Admission'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                // fontSm={true}
                                formControlSm
                                disabled={false}
                            /> 
                            
                        </div>
                    </div>
                    
                </form>
                </div>

            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20 '}>
                <ListPemeriksaan

                />
                
            </div>
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <div className={'kt-form col-lg-12 header-form'}>
                <div className={'form-group row'}>
                    <div className={'col-lg-7'}></div>
                    <HorizontalInput
                            value={''}
                            label={'Jumlah '}
                            inputType={'text'}
                            labelSize={2}
                            colSize={3}
                            // fontSm={true}
                            disabled={true}
                        />
                        </div>
                        <div className={'form-group row'}>
                        <div className={'col-lg-7'}></div>
                        <HorizontalInput
                            value={''}
                            label={'Diskon '}
                            inputType={'text'}
                            labelSize={2}
                            colSize={3}
                            // fontSm={true}
                            disabled={true}
                        />
                        </div>
                        <div className={'form-group row'}>
                        <div className={'col-lg-7'}></div>
                        <HorizontalInput
                            value={''}
                            label={'Total '}
                            inputType={'text'}
                            labelSize={2}
                            colSize={3}
                            // fontSm={true}
                            disabled={true}
                        />
                        </div>
                        </div>
                    </div>

            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-10 kt-margin-t-20 '}>
                <ListBahan

                />
                
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20  '}>
                <ListBahan

                />
                
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20  '}>
            <div className={'row mx-2'}>
            <div className={'form-control-sm'}>
                    <button 
                            // type={'submit'}
                            // onClick={onClickBack}
                            className='col-lg-12 form-control form-control-sm btn btn-sm btn-primary'>
                                <i className={'fas fa-edit'}/> Tambah
                    </button>
                </div>
                <div className='form-control-sm'>
                    <button 
                            // type={'submit'}
                            // onClick={onClickBack}
                            className='col-lg-12 form-control form-control-sm btn btn-sm btn-primary'>
                                <i className={'fas fa-save'}/> Simpan
                    </button>
                </div>
                <div className='form-control-sm'>
                    <button 
                            // type={'submit'}
                            // onClick={onClickBack}
                            className='col-lg-12 form-control form-control-sm btn btn-sm btn-primary'>
                                <i className={'fas fa-trash'}/> Hapus
                    </button>
                </div>
                <div className='form-control-sm'>
                    <button 
                            // type={'submit'}
                            // onClick={onClickBack}
                            className='col-lg-12 form-control form-control-sm btn btn-sm btn-primary'>
                                <i className={'fas fa-search'}/> Cari
                    </button>
                </div>
                <div className='form-control-sm'>
                    <button 
                            // type={'submit'}
                            // onClick={onClickBack}
                            className='col-lg-12 form-control form-control-sm btn btn-sm btn-primary'>
                                <i className={'fas fa-save'}/> Cetak
                    </button>
                </div>
                
            </div>
            </div>
            
        </div>
    )
}

export default EntryPeriksaRadiologi;