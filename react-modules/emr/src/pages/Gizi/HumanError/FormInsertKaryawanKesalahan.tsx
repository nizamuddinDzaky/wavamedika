import React, {useState} from 'react';
import {ISelector} from "../../../components/Forms/Input/SelectInput";
import KaryawanSelector from "../../Shared/KaryawanSelector";
import HorizontalInput from "../../../components/Forms/Input/HorizontalInput";
import JenisAddKesalahanSelector from "../../Shared/JenisAddKesalahanSelector";
import {FormikProps, withFormik} from "formik";
import * as Yup from 'yup';
import kesalahanService from '../../../services/giz_kesalahan.service';
import moment from "moment";
import {NotifySuccess} from "../../../services/notification.service";

interface Props {
    dateMonth?: string;
    dateYear?: string;
    dialogRef?: any;
    onSuccessSubmiting?: () => void;
}

interface FormValues {
    jenis?: ISelector,
    karyawan?: ISelector,
    month?: string;
}


const FormInsertKaryawanKesalahan = (props: Props & FormikProps<FormValues>) => {
    const [submitted, setSubmitted] = useState<boolean>(false);

    const handleChange = (ev: any, name: string) => {
        props.setFieldValue(name, ev);
    };

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
                            value={props?.values?.month}
                            onChange={props.handleChange}
                            label={'Tanggal'}
                            inputName={'month'}
                            inputType={'month'}
                            colSize={8}
                            labelSize={4}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                            error={props?.errors?.month}
                            submitted={submitted}
                        />
                    </div>
                    <div className={'form-group row'}>
                        <KaryawanSelector
                            colSize={8}
                            labelSize={4}
                            onChangeSelector={ev => handleChange(ev, 'karyawan')}
                            error={props?.errors?.karyawan}
                            submitted={submitted}
                        />
                    </div>
                    <div className={'form-group row'}>
                        <JenisAddKesalahanSelector
                            colSize={8}
                            labelSize={4}
                            onChangeSelector={(ev) => handleChange(ev, 'jenis')}
                            error={props?.errors?.jenis}
                            submitted={submitted}
                        />
                    </div>
                    <div className={'form-group row'}>
                        <div className={'col-lg-4'}/>
                        <div className={'col-lg-8'}>
                            <button
                                disabled={props?.isSubmitting}
                                className="btn btn-sm btn-primary"
                            >Tambah Kesalahan Karyawan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    )
};

const formikEnhancer = withFormik<Props, FormValues>({
    validationSchema: Yup.object().shape({
        month: Yup.string().required('Bulan - Tahun Dibutuhkan'),
        jenis:
            Yup.object().shape({
                value: Yup.string().required("Jenis Dibutuhkan")
            }),
        karyawan:
            Yup.object().shape({
                value: Yup.string().required("Karyawan Dibutuhkan")
            })
    }),
    mapPropsToValues: props => ({
        month: props?.dateYear + '-' + ('0'+props?.dateMonth).slice(-2),
        jenis: {
            value: '',
            label: ''
        },
        karyawan: {
            value: '',
            label: ''
        }
    }),
    handleSubmit: async (values, { setSubmitting, props }) => {
        try {
            const payload = {
                id_karyawan: values?.karyawan?.value,
                jenis: values?.jenis?.value,
                bulan: moment(values?.month).format('MM'),
                tahun: moment(values?.month).format('YYYY')
            };

            const resp = await kesalahanService.insert_kesalahan(payload);

            if(resp?.metadata && !resp?.metadata?.error) {
                NotifySuccess('Data Kesalahan', resp?.metadata?.message)
            }

            setSubmitting(false);

            if(props.onSuccessSubmiting)
                props.onSuccessSubmiting();

            props?.dialogRef?.current?.close();
        } catch (e) {
            console.log('error', e);
            setSubmitting(false);
        }
    }
});


export default formikEnhancer(FormInsertKaryawanKesalahan);
