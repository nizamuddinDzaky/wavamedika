import React, {useState} from 'react';
import {FormikProps, withFormik} from "formik";
import * as Yup from "yup";
import HorizontalInput from "../../../components/Forms/Input/HorizontalInput";
import moment from 'moment';
import kesalahanService from '../../../services/giz_kesalahan.service';
import {NotifySuccess} from "../../../services/notification.service";

interface Props {
    selectionData: any
    dateMonth?: string;
    dateYear?: string;
    dialogRef?: any;
    onSuccessSubmiting?: () => void;
}

interface FormValues {
    month?: string;
    indeks?: string;
    id_karyawan?: number;
    id_kesalahan?: number;
    masalah?: string;
    solusi?: string;

}

const FormInputKesalahan = (props: Props & FormikProps<FormValues>) => {
    const [submitted, setSubmitted] = useState<boolean>(false);

    return(
        <div className={'kt-portlet'}>
            <div className={'kt-portlet__body kt-portlet__body header-form'}>
                <form className={'kt-form col-xl-12 header-form'} onSubmit={(ev: any) => {
                    ev.preventDefault();
                    setSubmitted(true);
                    props.handleSubmit();
                }}>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={props?.values?.id_kesalahan}
                            onChange={props.handleChange}
                            label={'ID Kesalahan'}
                            inputName={'id_kesalahan'}
                            inputType={'text'}
                            colSize={8}
                            labelSize={4}
                            // fontSm={true}
                            formControlSm
                            disabled={true}
                            error={props?.errors?.id_kesalahan}
                            submitted={submitted}
                        />
                    </div>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={props?.values?.month}
                            onChange={props.handleChange}
                            label={'Bulan - Tahun'}
                            inputName={'month'}
                            inputType={'month'}
                            colSize={8}
                            labelSize={4}
                            // fontSm={true}
                            formControlSm
                            disabled={true}
                            error={props?.errors?.month}
                            submitted={submitted}
                        />
                    </div>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={props?.values?.indeks}
                            onChange={props.handleChange}
                            label={'Indeks'}
                            inputName={'indeks'}
                            inputType={'text'}
                            colSize={8}
                            labelSize={4}
                            // fontSm={true}
                            formControlSm
                            disabled={true}
                            error={props?.errors?.indeks}
                            submitted={submitted}
                        />
                    </div>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={props?.values?.masalah}
                            onChange={props.handleChange}
                            label={'Masalah'}
                            inputName={'masalah'}
                            inputType={'text'}
                            colSize={8}
                            labelSize={4}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                            error={props?.errors?.masalah}
                            submitted={submitted}
                        />
                    </div>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={props?.values?.solusi}
                            onChange={props.handleChange}
                            label={'Solusi'}
                            inputName={'solusi'}
                            inputType={'text'}
                            colSize={8}
                            labelSize={4}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                            error={props?.errors?.solusi}
                            submitted={submitted}
                        />
                    </div>
                    <div className={'form-group row'}>
                        <div className={'col-lg-4'}/>
                        <div className={'col-lg-4'}>
                            <button
                                disabled={props?.isSubmitting}
                                className="btn btn-primary btn-sm"
                            >Tambah Kesalahan</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    )
};


const formikEnhancer = withFormik<Props, FormValues>({
    validationSchema: Yup.object().shape({
        month: Yup.string().required('Kolom Bulan - Tahun dibutuhkan'),
        indeks: Yup.string().required('Kolom Indeks dibutuhkan'),
        masalah: Yup.string().required('Kolom Masalah dibutuhkan'),
        solusi: Yup.string().required('Kolom Solusi dibutuhkan'),
    }),
    mapPropsToValues: props => ({
        month: props?.dateYear + '-' + ('0'+props?.dateMonth).slice(-2),
        // indeks: props?.selectionData?.row?.
        indeks: props?.selectionData?.column?.props?.field?.replace('k', ''),
        id_karyawan: props?.selectionData?.row?.id_karyawan,
        id_kesalahan: props?.selectionData?.row?.id_kesalahan,
        solusi: '',
        masalah: ''
    }),
    handleSubmit: async (values, { setSubmitting, props }) => {
        try {
            const payload = {
                id_kesalahan: values?.id_kesalahan,
                id_karyawan: values?.id_karyawan,
                indeks: values?.indeks,
                bulan: moment(values?.month).format('MM'),
                tahun: moment(values?.month).format('YYYY'),
                masalah: values?.masalah,
                solusi: values?.solusi,
            };

            const resp = await kesalahanService.insert_dtlkesalahan(payload);

            if(resp?.metadata && !resp?.metadata?.error) {
                NotifySuccess('Data Kesalahan Detail', resp?.metadata?.message)
            }
            setSubmitting(false);

            if(props.onSuccessSubmiting)
                props.onSuccessSubmiting();

            props?.dialogRef?.current?.close();
        } catch (e) {
            console.log('err', e)
            setSubmitting(false);
        }
    }
});


export default formikEnhancer(FormInputKesalahan);
