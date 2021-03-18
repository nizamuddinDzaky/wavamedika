import React from 'react';
import VerticalInput from '../../../../../../components/Forms/Input/VerticalInput';
import HorizontalInput from '../../../../../../components/Forms/Input/HorizontalInput';
import HorizontalTextArea from '../../../../../../components/Forms/TextArea/HorizontalTextArea';
import ButtonSubmit from '../../../../../../components/Forms/Input/ButtonSubmit';
import {useForm } from "react-hook-form";
// import { yupResolver } from '@hookform/resolvers';
import * as yup from "yup";
import moment from 'moment';
import master_asuransiService from '../../../../../../services/master_asuransi.service';
import { NotifySuccess } from '../../../../../../services/notification.service';

interface formInput {
    aktif: boolean;
    kode_instansi: string;
    nama_instansi: string;
    kota: string;
    alamat: string;
    alamat_klaim:  string;
    telepon: string;
    fax: string;
    kontak: string;
    hp: string;
    catatan: string;
    email: string;
    website: string;
    masa_berlaku: string;

}

const phoneRegExp = /^((\\+[1-9]{1,4}[ \\-]*)|(\\([0-9]{2,3}\\)[ \\-]*)|([0-9]{2,4})[ \\-]*)*?[0-9]{3,4}?[ \\-]*[0-9]{3,4}?$/

const schema = yup.object().shape({
    kode_instansi: yup.string().required(),
    nama_instansi: yup.string().required(),
    kota: yup.string().required(),
    alamat:  yup.string().required(),
    alamat_klaim:  yup.string().required(),
    telepon: yup.string().required().matches(phoneRegExp,'masukkan telepon dengan benar.'),
    fax: yup.string().required(),
        // .matches(phoneRegExp,'masukkan fax dengan benar.'),
    kontak: yup.string().required(),
    hp:  yup.string().required(),
        // .matches(phoneRegExp,'masukkan handphone dengan benar.'),
    catatan: yup.string().required(),
    email: yup.string().required().email(),
    website: yup.string().required(),
    masa_berlaku: yup.string().required(),
  });

interface Props {
    data_asuransi?: any;
    mode: 'add' | 'edit'
    onSavedNewData?: (id: string) => void;
    jenis: 'Asuransi' | 'Admission' | 'Instansi';
}
  
const FormDataAsuransi: React.FC<Props> = (props: Props) => {
    const { register, handleSubmit, errors } = useForm<formInput>({
        validationSchema: schema,
        defaultValues: {
            ...props.data_asuransi,
            aktif: props?.data_asuransi?.aktif === "1" ? true: false,
            masa_berlaku: moment(props.data_asuransi?.masa_berlaku).format('YYYY-MM-DD'),
            telepon: props?.data_asuransi?.telp,

        }
    });
    
    const onSubmit = async (data: formInput) => {
        try {
            const payload = Object.assign(data, {
                masa_berlaku: moment(data.masa_berlaku).format('YYYY-MM-DD hh:mm:ss'),
                jenis: props?.jenis,
                aktif: data.aktif? 1: 0,
                kategori: (props.mode === 'add')? 'Tambah': 'Edit',
                nama_lengkap: data.nama_instansi
            })
            const resp = await master_asuransiService.mkt_instansi_insert(payload);
            if(resp?.metadata && !resp?.metadata?.error) {
                if(props.mode === 'add' && props.onSavedNewData) 
                    props.onSavedNewData(data.kode_instansi);
                NotifySuccess('Data Asuransi', resp?.metadata?.message)
            };

        } catch(e) {
            console.log('error', e)
        }
    };

    return(
        <form onSubmit={handleSubmit(onSubmit)} className={'kt-form col-xl-12 header-form kt-margin-t-25 row'} >
             <div className={'row col-xl-12 col-lg-12'}>
                <div className='col-lg-10 col-sm-12'/>
                <div className={'col-lg-2 col-sm-12 kt-align-right'}>
                    <input type={'checkbox'} name={'aktif'} ref={register()}/>
                    &nbsp;
                    Aktif
                </div>
                <VerticalInput
                    label={props.jenis === 'Asuransi'? 'Kode Instansi Asuransi': 'Admission'}
                    inputName={'kode_instansi'}
                    inputRef={register()}
                    labelClass={'kt-padding-l-0'}
                    inputType={'text'}
                    colSize={12}
                    labelSize={3}
                    // fontSm={true}
                    formControlSm
                    disabled={false}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.kode_instansi?.message}
                />
                <VerticalInput
                    label={'Nama Lengkap'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'text'}
                    inputName={'nama_instansi'}
                    colSize={12}
                    labelSize={3}
                    // fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.nama_instansi?.message}
                />
                <HorizontalInput
                    label={'Kota'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'text'}
                    inputName={'kota'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={10}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.kota?.message}
                />
                <HorizontalInput
                    label={'Alamat Kantor'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'text'}
                    inputName={'alamat'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={10}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.alamat?.message}
                />
                <HorizontalTextArea
                    label={'Alamat Klaim'}
                    labelClass={'kt-padding-l-0'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    inputName={'alamat_klaim'}
                    colSize={10}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.alamat_klaim?.message}
                />
                <HorizontalInput
                    label={'Telepon'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'text'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    inputName={'telepon'}
                    colSize={10}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.telepon?.message}
                />
                <HorizontalInput
                    label={'Fax'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'text'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={10}
                    inputName={'fax'}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.fax?.message}
                />
                <HorizontalInput
                    label={'Kontak Person'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'text'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={10}
                    inputName={'kontak'}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.kontak?.message}
                />
                <HorizontalInput
                    label={'Handphone'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'text'}
                    inputName={'hp'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={10}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.hp?.message}
                />
                <HorizontalInput
                    label={'Catatan'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'text'}
                    inputName={'catatan'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={10}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.catatan?.message}
                />
                <HorizontalInput
                    label={'Email'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'text'}
                    inputName={'email'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={10}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.email?.message}
                />
                <HorizontalInput
                    label={'Website'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'text'}
                    inputName={'website'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={10}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.website?.message}
                />
                <HorizontalInput
                    label={'Masa Berlaku'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'date'}
                    inputName={'masa_berlaku'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={10}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.masa_berlaku?.message}
                />

                <ButtonSubmit 
                    text={'Simpan'}
                    labelSize={3}
                    type={'submit'}
                    colOffsetSize={2}
                    className={'btn-sm btn-primary kt-margin-l-10 kt-margin-r-10 kt-margin-lr-0--mobile'}
                ></ButtonSubmit>

             </div>
        </form>
    )
}

export default FormDataAsuransi;