import React, { useState } from 'react';
import HorizontalInput from '../../../../../components/Forms/Input/HorizontalInput';
import {useForm, Controller } from "react-hook-form";
// import { yupResolver } from '@hookform/resolvers';
import * as yup from "yup";
import moment from 'moment';
import { RouteComponentProps, withRouter } from 'react-router';
import SelectManualData from '../../../../../components/Shared/SelectManualData';
import SelectRuang from '../../../../../components/Shared/SelectRuang';
import SelectKelas from '../../../../../components/Shared/SelectKelas';
import SelectKamar from '../../../../../components/Shared/SelectKamar';
import SelectDokter from '../../../../../components/Shared/SelectDokter';
import Label from '../../../../../components/Forms/Input/Label';
import UraianAngketPelangganList from './UraianAngketPelangganList';
import angket_pelangganService from '../../../../../services/angket_pelanggan.service';
import { NotifySuccess } from '../../../../../services/notification.service';
import { Tabs, Tab } from 'react-bootstrap';
import "./customPane.scss";
import KategoriKekuranganList from './KategoriKekuranganList';

interface formInput {
    tgl_input: string;
    usia: string;
    sex: any;
    id_mrs: string;
    kamar: any;
    ruang: any;
    kelas: any;
    nama: string;
    alamat: string;
    telepon: string;
    dokter1: any;
    dokter2: any;
    kepuasan: any;
    perbaikan: string;
}

// const phoneRegExp = /^((\\+[1-9]{1,4}[ \\-]*)|(\\([0-9]{2,3}\\)[ \\-]*)|([0-9]{2,4})[ \\-]*)*?[0-9]{3,4}?[ \\-]*[0-9]{3,4}?$/

const schema = yup.object().shape({
    tgl_input: yup.string().required(),
    usia: yup.string().required(),
    sex: yup.object().shape({
        label: yup.string().required(),
        value: yup.string().required()
    }),
    id_mrs: yup.string().required(),
    kamar: yup.object().shape({
        label: yup.string().required(),
        value: yup.string().required()
    }),
    // ruang: yup.object().shape({
    //     label: yup.string().required(),
    //     value: yup.string().required()
    // }),
    kelas: yup.object().shape({
        label: yup.string().required(),
        value: yup.string().required()
    }),
    nama: yup.string().required(),
    alamat: yup.string().required(),
    telepon: yup.string().required(),
    dokter1: yup.string().required(),
    dokter2: yup.string().required(),
  });

type propTypes = RouteComponentProps<any> & {
    id_angketpelanggan: number;
    data_angketpelanggan?: any;
}

  
const FormAngketPelanggan_Form: React.FC<propTypes> = (props: propTypes) => {
    const [submitting, setSubmitting] = useState<boolean>(false);
    const [data] = useState<any>(
        {
            ...props.data_angketpelanggan,
            tgl_input: moment(props?.data_angketpelanggan?.tgl_input).format('YYYY-MM-DD') || moment().format('YYYY-MM-DD'),
            sex: {
                value: props?.data_angketpelanggan?.sex ||'L',
                label: props?.data_angketpelanggan?.sex === 'P' ? 'Perempuan': 'Laki-Laki' ||'Laki-laki'
            },
            kamar: {
                value: props?.data_angketpelanggan?.id_kamar || '',
                label: props?.data_angketpelanggan?.kamar || '-'
            },
            telepon: props?.data_angketpelanggan?.telepon || '',
            usia: props?.data_angketpelanggan?.usia || '',
            kelas: {
                value: props?.data_angketpelanggan?.kelas !== '-' && props?.data_angketpelanggan?.kelas !== ''? props?.data_angketpelanggan?.kelas: '' || '',
                label: props?.data_angketpelanggan?.kelas || ''
            },
            ruang: {
                value: props?.data_angketpelanggan?.ruang !== '-' && props?.data_angketpelanggan?.ruang !== ''? props?.data_angketpelanggan?.ruang: '' || '',
                label: '-'
            },
            dokter1: {
                value: props?.data_angketpelanggan?.dokter1? `${props?.data_angketpelanggan?.dokter1}`: '' || '',
                label: props?.data_angketpelanggan?.dokter1? `dr. ${props?.data_angketpelanggan?.dokter1}`: '-' || '-',
            },
            dokter2: {
                value: props?.data_angketpelanggan?.dokter2? `${props?.data_angketpelanggan?.dokter2}`: '' || '',
                label: props?.data_angketpelanggan?.dokter2? `dr. ${props?.data_angketpelanggan?.dokter2}`: '-' || '-',
            },
            kepuasan: {
                value: props?.data_angketpelanggan?.kepuasan || '',
                label: props?.data_angketpelanggan?.kepuasan || '-'
            }
            // aktif: props?.data_asuransi?.aktif === "1" ? true: false,
            // masa_berlaku: moment(props.data_asuransi?.masa_berlaku).format('YYYY-MM-DD'),
            // telepon: props?.data_asuransi?.telp,

        }
    )

    const { register, handleSubmit, errors, control, setValue } = useForm<formInput>({
        validationSchema: schema,
        defaultValues: data
    });
    
    const onSubmit = async (data: formInput) => {
        try {
            setSubmitting(true);
            const payload = Object.assign(data, {
                "id_angketpelanggan": props?.id_angketpelanggan,
                "usia": data?.usia,
                "sex": data?.sex?.value,
                "kamar": data?.kamar?.label,
                "tgl_masuk":moment(data?.tgl_input).format('YYYY-MM-DD'),
                "nama": data?.nama,
                "alamat":data?.alamat,
                "telepon":data?.telepon,
                "perbaikan":data?.perbaikan,
                "dokter1": data?.dokter1?.value,
                "dokter2":data?.dokter2?.value,
                "kepuasan":data?.kepuasan?.value,
                "id_kamar":data?.kamar?.value,
                "kelas":data?.kelas?.value,
                "id_mrs": data?.id_mrs,
                "ruang": data?.ruang?.value
            })

            const resp = await angket_pelangganService.mkt_angketpelanggan_update(payload);
            if(resp?.metadata && !resp?.metadata?.error) {
                NotifySuccess('Data Angket Pelanggan', resp?.metadata?.message)
            };

            setSubmitting(false)
        } catch(e) {
            setSubmitting(false);
            console.log('error', e)
        }
    };

    const handleEnter = async (e: any) => {
        try {
            if (e.key === 'Enter') {
                e.preventDefault();
                const id_mrs = control?.fieldsRef?.current?.id_mrs?.ref?.value;
    
                const resp = await angket_pelangganService.mkt_angketpelanggan_view_mrs({id_mrs: id_mrs});
    
                console.log('res', resp);
                if(resp && Array.isArray(resp.list) && resp.list.length >0) {
                    handleSetValue(resp.list[0])
                } else {
                    handleResetValue();
                }
            } 
        } catch(e) {
            console.log('e', e);
        }
    }

    const handleCancel = async () => {
        props?.history?.push(`/fo/angket/angket-pelanggan`)
    }

    const handleSetValue = (data: any) => {
        setValue("alamat", data?.alamat!);
        setValue("nama", data?.nama_lengkap!);
        setValue("kamar", {
            value: data?.id_kamar!,
            label: data?.nama_kamar!
        });
        
        setValue("kelas", {
            value: data?.kelas!,
            label: data?.kelas!
        });
        setValue("sex", {
            value: data?.sex!,
            label: data?.sex === 'P'? 'Perempuan': 'Laki-laki'
        });

        setValue("telepon", data?.telepon!);
        setValue("usia", data?.umur!);
    }

    const handleResetValue = () => {
        setValue("alamat", '');
        setValue("nama", '');
        setValue("kamar", {
            value: '',
            label: '-'
        });
        
        setValue("kelas", {
            value: '',
            label: '-'
        });
        setValue("sex", {
            value: 'L',
            label: 'Laki-laki'
        });

        setValue("telepon", '');
        setValue("usia", '');
    }

    return(
        <form onSubmit={handleSubmit(onSubmit)} className={'kt-form col-xl-12 header-form kt-margin-t-25 row'} >
                <div className={'row col-xl-12 col-lg-12 kt-padding-r-0'}>
                    <HorizontalInput
                        label={'Tgl. Angket'}
                        labelClass={'kt-padding-r-0'}
                        inputType={'date'}
                        inputName={'tgl_input'}
                        inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                        colSize={2}
                        labelSize={1}
                        fontSm={true}
                        formControlSm
                        disabled={false}
                        inputRef={register()}
                        errorClass={'kt-padding-l-0'}
                        error={errors?.tgl_input?.message}
                    />
                    <HorizontalInput
                        label={'No. MRS'}
                        labelClass={'kt-padding-r-0'}
                        inputType={'number'}
                        onKeyDown={handleEnter}
                        inputName={'id_mrs'}
                        inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                        colSize={2}
                        labelSize={1}
                        fontSm={true}
                        formControlSm
                        disabled={false}
                        inputRef={register()}
                        errorClass={'kt-padding-l-0'}
                        error={errors?.id_mrs?.message}
                    />
                    <Controller
                        as={
                            <SelectKamar
                                error={errors?.kamar?.value?.message}
                                colSize={2}
                                labelSize={1}
                                labelText={'Kamar'}
                                labelClass={'kt-font-sm kt-padding-r-0'}
                                inputWrapperClass={'kt-padding-l-0 mobile-full-width'}
                            />
                        }
                        name="kamar"
                        isClearable
                        control={control}
                        onChange={([selected]) => {
                            console.log('onchange kamar', selected)
                            return selected;
                        }}
                    /> 
                    <Controller
                        as={
                            <SelectKelas
                                error={errors?.kelas?.value?.message}
                                colSize={2}
                                labelSize={1}
                                labelText={'Kelas'}
                                labelClass={'kt-font-sm'}
                                inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                            />
                        }
                        name="kelas"
                        isClearable
                        control={control}
                        onChange={([selected]) => {
                            return selected;
                        }}
                    /> 

                    <HorizontalInput
                        label={'Umur'}
                        labelClass={'kt-padding-r-0'}
                        inputType={'text'}
                        inputName={'usia'}
                        inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                        colSize={2}
                        labelSize={1}
                        fontSm={true}
                        formControlSm
                        disabled={false}
                        inputRef={register()}
                        errorClass={'kt-padding-l-0'}
                        error={errors?.usia?.message}
                    />
                
                    <HorizontalInput
                        label={'Nama'}
                        labelClass={'kt-padding-r-0'}
                        inputType={'text'}
                        inputName={'nama'}
                        inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                        colSize={8}
                        labelSize={1}
                        fontSm={true}
                        formControlSm
                        disabled={false}
                        inputRef={register()}
                        errorClass={'kt-padding-l-0'}
                        error={errors?.nama?.message}
                    />

                    <Controller
                        as={
                            <SelectManualData
                                error={errors?.sex?.value?.message}
                                colSize={2}
                                labelSize={1}
                                labelText={'Jenis Kelamin'}
                                labelClass={'kt-padding-r-0 kt-font-sm'}
                                inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                                options={
                                    [
                                        {
                                            value: 'L',
                                            label: 'Laki-Laki'
                                        },
                                        {
                                            value: 'P',
                                            label: 'Perempuan'
                                        }
                                    ]
                                }
                            />
                        }
                        name="sex"
                        isClearable
                        control={control}
                        onChange={([selected]) => {
                            return selected;
                        }}
                        setValue={setValue}
                    />
                    <HorizontalInput
                        label={'Alamat'}
                        labelClass={'kt-padding-r-0'}
                        inputType={'text'}
                        inputName={'alamat'}
                        inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                        colSize={8}
                        labelSize={1}
                        fontSm={true}
                        formControlSm
                        disabled={false}
                        inputRef={register()}
                        errorClass={'kt-padding-l-0'}
                        error={errors?.alamat?.message}
                    />

                    <Controller
                        as={
                            <SelectRuang
                                error={errors?.ruang?.value?.message}
                                colSize={2}
                                labelSize={1}
                                labelText={'Ruang'}
                                labelClass={'kt-padding-r-0 kt-font-sm'}
                                inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                                hideLabelSemua
                            />
                        }
                        name="ruang"
                        isClearable
                        control={control}
                        onChange={([selected]) => {
                            return selected;
                        }}
                    />  

                    <HorizontalInput
                        label={'Telepon'}
                        labelClass={'kt-padding-r-0'}
                        inputType={'text'}
                        inputName={'telepon'}
                        inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                        colSize={8}
                        labelSize={1}
                        fontSm={true}
                        formControlSm
                        disabled={false}
                        inputRef={register()}
                        errorClass={'kt-padding-l-0'}
                        error={errors?.telepon?.message}
                    />
                    
                    <Label
                        label={'Dokter yang merawat'}
                        labelClass={'kt-padding-r-0'}
                        labelSize={3}
                        fontSm={true}
                        formControlSm
                    />
                    
                    <Controller
                        as={
                            <SelectDokter
                                colSize={8}
                                labelSize={1}
                                labelText={'1)'}
                                labelClass={'kt-padding-r-0 kt-font-sm'}
                                inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                                hideLabelSemua
                            />
                        }
                        name="dokter1"
                        isClearable
                        control={control}
                        onChange={([selected]) => {
                            return selected;
                        }}
                    />  
                    <div className="col-xl-3 col-lg-3">
                    </div>
                    <Controller
                        as={
                            <SelectDokter
                                colSize={8}
                                labelSize={1}
                                labelText={'2)'}
                                labelClass={'kt-padding-r-0 kt-font-sm'}
                                inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                                hideLabelSemua
                            />
                        }
                        name="dokter2"
                        isClearable
                        control={control}
                        onChange={([selected]) => {
                            return selected;
                        }}
                    />  
                </div>
                <div className={'row kt-padding-t-10'} style={{maxWidth: '100%'}}>
                    <div className={'col-lg-12 kt-padding-r-0'}>
                        <UraianAngketPelangganList
                            id_angketpelanggan={props?.id_angketpelanggan}
                        />
                    </div>
                </div>
                <div className={'row col-xl-12 col-lg-12 kt-padding-r-0 kt-padding-t-10'}>
                    <Tabs transition={false} id="noanim-tab-example" className="col-xl-12 col-lg-12">
                        <Tab eventKey="tanggapanPelanggan" title="Tanggapan Pelanggan" className="row col-xl-12 col-lg-12 kt-padding-r-0">
                            <div className="row col-lg-12 col-xl-12">
                                <Controller
                                    as={
                                        <SelectManualData
                                            colSize={3}
                                            labelSize={5}
                                            labelText={'Kepuasan dengan layanan di RWSH'}
                                            labelClass={'kt-padding-r-0 kt-font-sm'}
                                            inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                                            options={
                                                [
                                                    {
                                                        value: 'Puas',
                                                        label: 'Puas'
                                                    },
                                                    {
                                                        value: 'Tidak Puas',
                                                        label: 'Tidak Puas'
                                                    }
                                                ]
                                            }
                                        />
                                    }
                                    name="kepuasan"
                                    isClearable
                                    control={control}
                                    onChange={([selected]) => {
                                        return selected;
                                    }}
                                    setValue={setValue}
                                />
                            </div>
                            <div className="row col-lg-12 col-xl-12">
                                <HorizontalInput
                                    label={'Kekurangan disini yang paling perlu segera dilakukan perubahan atau perbaikan'}
                                    labelClass={'kt-padding-r-0'}
                                    inputType={'text'}
                                    inputName={'perbaikan'}
                                    inputWrapperClass={'kt-padding-r-0 mobile-full-width'}
                                    colSize={7}
                                    labelSize={5}
                                    fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    inputRef={register()}
                                    errorClass={'kt-padding-l-0'}
                                    error={errors?.perbaikan?.message}
                                />
                            </div>
                            
                        </Tab>
                        <Tab eventKey="kategoriKekurangan" title="Kategori Kekurangan">
                            <KategoriKekuranganList
                                id_angketpelanggan={props?.id_angketpelanggan}
                            />
                        </Tab>
                    </Tabs>
                </div>
                
                <div className={'row col-xl-12 col-lg-12 kt-padding-r-0 kt-padding-t-20'}>
                        <button type="submit" className={'col-lg-2 col-md-12 btn btn-primary btn-sm'} disabled={submitting}>
                            <i className="fa fa-save"></i>
                            Simpan
                        </button>
                        &nbsp;
                        <button type="button" onClick={handleCancel} className={'col-lg-2 col-md-12 btn btn-secondary btn-sm'}>
                            <i className="fa fa-times"></i>
                            Batal
                        </button>  
                </div>
                
        </form>
    )
}

export default withRouter(FormAngketPelanggan_Form);