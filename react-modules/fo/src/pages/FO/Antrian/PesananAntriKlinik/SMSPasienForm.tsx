import React, { useState } from 'react';
import { useForm } from 'react-hook-form';
import antrian_pesanan_antri_klinikService from '../../../../services/antrian_pesanan_antri_klinik.service';
import HorizontalInput from '../../../../components/Forms/Input/HorizontalInput';
import HorizontalTextArea from '../../../../components/Forms/TextArea/HorizontalTextArea';
import * as yup from 'yup';
import ButtonSubmit from '../../../../components/Forms/Input/ButtonSubmit';
import { NotifySuccess } from '../../../../services/notification.service';
import moment from 'moment';

interface formInput {
    tanggal_sms: string;
    isi_sms: string;
}

interface Props {
    data?: any;
    id_rencanakontrol?: string;
}

const schema = yup.object().shape({
    isi_sms: yup.string().required(),
    tanggal_sms: yup.string()
})
const SMSPasienForm:React.FC<Props> = (props: Props) => {
    const [loading, setLoading] = useState<boolean>(false)
    const { register, handleSubmit, errors } = useForm<formInput>({
        defaultValues: {
            ...props?.data,
            tanggal_sms: moment(props?.data?.tanggal_sms).format('YYYY-MM-DD'),
        },
        validationSchema:  schema
    });

    const onSubmit = async (data: any) => {
        try {
            setLoading(true);
            const resp = await antrian_pesanan_antri_klinikService.mkt_sms_update({
                id_rencanakontrol: props.id_rencanakontrol,
                ...data
            });

            if(resp?.metadata && !resp?.metadata?.error) {
                NotifySuccess('Data SMS Pasien', resp?.metadata?.message)
            };

            setLoading(false);
        } catch(e) {
            console.log('e', e)
            setLoading(false);
        }
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} className={'kt-form col-xl-12 header-form kt-margin-t-25 row'} >
             <div className={'row col-xl-12 col-lg-12'}>
                <HorizontalInput
                    label={'Tanggal Penerimaan'}
                    inputName={'tanggal_sms'}
                    inputType={'date'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={9}
                    labelSize={3}
                    fontSm={true}
                    formControlSm
                    disabled={true}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.tanggal_sms?.message}
                />
                <HorizontalTextArea
                    label={'Isi'}
                    inputName={'isi_sms'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={9}
                    labelSize={3}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.isi_sms?.message}
                />

                <ButtonSubmit
                    text={'Simpan'}
                    labelSize={3}
                    type={'submit'}
                    colOffsetSize={3}
                    disabled={loading}
                    className={'btn-sm btn-primary kt-margin-l-10 kt-margin-r-10 kt-margin-lr-0--mobile'}
                ></ButtonSubmit>
                {/* <ButtonSubmit 
                    text={'Batal'}
                    labelSize={3}
                    type={'button'}
                    colOffsetSize={0}
                    className={'btn-sm btn-secondary kt-margin-l-10 kt-margin-r-10 kt-margin-lr-0--mobile'}
                ></ButtonSubmit> */}
                
            </div>
        </form>
    )
}

export default SMSPasienForm;