import React from 'react';
import { useForm } from 'react-hook-form';
import * as yup from 'yup';
import HorizontalTextArea from '../../../../../../components/Forms/TextArea/HorizontalTextArea';
import HorizontalInput from '../../../../../../components/Forms/Input/HorizontalInput';
import ButtonSubmit from '../../../../../../components/Forms/Input/ButtonSubmit';

interface Props {
    onSuccess?: () => void;
    onCancel?: () => void;
    kode_instansi: string;
}

const schema = yup.object().shape({
    keterangan: yup.string().required(),
    foto: yup.mixed().test('fileFormat', 'format file hanya JPEG/JPG', (value) => {
        return value[0] && ['image/jpg', 'image/jpeg'].includes(value[0].type);
    }),
    // link: yup.string()
});

interface formInput {
    keterangan: string;
    foto?: any;
    // link?: string;
}
const KartuAsuransiForm: React.FC<Props> = (props: Props) => {
    const { register, handleSubmit, errors } = useForm<formInput>({
        validationSchema: schema
    });

    const onSubmit = async (data: formInput) => {
        console.log('data', data);
    };

    return(
        <form onSubmit={handleSubmit(onSubmit)} className={'kt-form col-xl-12 header-form kt-margin-t-25 row'} >
            <div className={'row col-xl-12 col-lg-12'}>
                <HorizontalInput
                    label={'Foto'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'file'}
                    inputName={'foto'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={10}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.foto?.message}
                />
                {/* <label className={'col-form-label col-sm-12 form-control-sm kt-form-sm'}>Atau</label> */}
                {/* <HorizontalInput
                    label={'Link'}
                    labelClass={'kt-padding-l-0'}
                    inputType={'text'}
                    inputName={'link'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    colSize={10}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.link?.message}
                /> */}
                <HorizontalTextArea
                    label={'Keterangan'}
                    labelClass={'kt-padding-l-0'}
                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                    inputName={'keterangan'}
                    colSize={10}
                    labelSize={2}
                    fontSm={true}
                    formControlSm
                    disabled={false}
                    inputRef={register()}
                    errorClass={'kt-padding-l-0'}
                    error={errors?.keterangan?.message}
                />
                <ButtonSubmit
                    text={'Simpan'}
                    labelSize={3}
                    type={'submit'}
                    colOffsetSize={2}
                    className={'btn-sm btn-primary kt-margin-l-10 kt-margin-r-10 kt-margin-lr-0--mobile'}
                ></ButtonSubmit>
                <ButtonSubmit
                    text={'Batal'}
                    labelSize={3}
                    type={'button'}
                    colOffsetSize={0}
                    action={() => {
                        if(props.onCancel){
                            props.onCancel()
                        }
                    }}
                    className={'btn-sm btn-secondary kt-margin-lr-0--mobile'}
                ></ButtonSubmit >
            </div>
        </form>
            
    )
}

export default KartuAsuransiForm;