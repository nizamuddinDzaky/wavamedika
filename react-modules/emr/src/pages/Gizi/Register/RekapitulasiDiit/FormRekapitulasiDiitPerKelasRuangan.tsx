import React, {useState} from 'react';
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
import laporanGiziService from '../../../../services/gizLapreggizi.service';
import {FormikProps, withFormik} from "formik";
import * as Yup from "yup";
import moment from "moment";
import {pdf} from "@react-pdf/renderer";
import PrintDocumentRekapitulasiDiitPerBentukMakanan
    from "../PrintDocument/PrintDocumentRekapitulasiDiitPerBentukMakanan";
import {getDaysArray} from "../../../../utils/date.utils";
import _ from "lodash";
import PrintDocumentRekapitulasiDiitPerJenisDiet from "../PrintDocument/PrintDocumentRekapitulasiDiitPerJenisDiet";
import PrintDocumentRekapitulasiDiitPerKelasKamar from "../PrintDocument/PrintDocumentRekapitulasiDiitPerKelasKamar";
import {connect} from "react-redux";
import AdblockDetect from "../../../../components/Adblock/AdblockDetect";

interface Props {
    dateMonth?: string;
    dateYear?: string;
    type?: string | 'byKelasRuangan' | 'byBentukMakanan' | 'byJenisDiet';
    user: any;
}

interface FormValues {
    month?: string;
}

const FormRekapitulasiDiitPerKelasRuangan = (props: Props & FormikProps<FormValues>) => {
    const [submitted, setSubmitted] = useState<boolean>(false);
    return(
        <div className={'kt-portlet'}>
            <div className={'kt-portlet__body kt-portlet__body header-form'}>
                <form className={'kt-form col-xl-12 header-form'} onSubmit={(ev: any) => {
                    ev.preventDefault();
                    setSubmitted(true);
                    props.handleSubmit();
                }}>
                    <AdblockDetect/>
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
                            disabled={false}
                            error={props?.errors?.month}
                            submitted={submitted}
                        />
                    </div>
                    <div className={'form-group row'}>
                        <div className={'col-lg-4'}/>
                        <div className={'col-lg-8'}>
                            <button
                                disabled={props?.isSubmitting}
                                className="btn btn-primary btn-sm"
                            >Cetak</button>
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
    }),
    mapPropsToValues: props => ({
        month: props?.dateYear + '-' + ('0'+props?.dateMonth).slice(-2),
    }),
    handleSubmit: async (values, { setSubmitting, props }) => {
        try {
            const payload = {
                bulan: moment(values?.month).format('MM'),
                tahun: moment(values?.month).format('YYYY'),
            };

            if(props.type === "byKelasRuangan") {
                const resp = await laporanGiziService.view_laprekapdiet_kelas(payload);

                if(resp.list.length > 0) {
                    const dates = getDaysArray(Number(moment(values.month).format('YYYY')), Number(moment(values.month).format('MM')));
                    let dataPrint;
                    if (dates
                        // && resp.list
                    ) {

                        // const dummy = [
                        //     {
                        //         "tgl_diet": "2020-04-20 00:00:00",
                        //         "pgvvpb": "0",
                        //         "sgvvpb": "0",
                        //         "srvvpb": "0",
                        //         "pgutm": "0",
                        //         "sgutm": "0",
                        //         "srutm": "0",
                        //         "pgvvip": "0",
                        //         "sgvvip": "0",
                        //         "srvvip": "0",
                        //         "pgvipa": "0",
                        //         "sgvipa": "0",
                        //         "srvipa": "0",
                        //         "pgvipb": "0",
                        //         "sgvipb": "0",
                        //         "srvipb": "0",
                        //         "pgvipc": "0",
                        //         "sgvipc": "0",
                        //         "srvipc": "0",
                        //         "pgvip": "0",
                        //         "sgvip": "0",
                        //         "srvip": "0",
                        //         "pgi": "0",
                        //         "sgi": "0",
                        //         "sri": "0",
                        //         "pgii": "0",
                        //         "sgii": "0",
                        //         "srii": "0",
                        //         "pgiii": "1",
                        //         "sgiii": "1",
                        //         "sriii": "1"
                        //     },
                        //     {
                        //         "tgl_diet": "2020-04-21 00:00:00",
                        //         "pgvvpb": "0",
                        //         "sgvvpb": "0",
                        //         "srvvpb": "0",
                        //         "pgutm": "0",
                        //         "sgutm": "0",
                        //         "srutm": "0",
                        //         "pgvvip": "0",
                        //         "sgvvip": "1",
                        //         "srvvip": "1",
                        //         "pgvipa": "0",
                        //         "sgvipa": "0",
                        //         "srvipa": "0",
                        //         "pgvipb": "1",
                        //         "sgvipb": "0",
                        //         "srvipb": "0",
                        //         "pgvipc": "0",
                        //         "sgvipc": "0",
                        //         "srvipc": "0",
                        //         "pgvip": "0",
                        //         "sgvip": "0",
                        //         "srvip": "0",
                        //         "pgi": "0",
                        //         "sgi": "0",
                        //         "sri": "0",
                        //         "pgii": "0",
                        //         "sgii": "0",
                        //         "srii": "0",
                        //         "pgiii": "1",
                        //         "sgiii": "2",
                        //         "sriii": "1"
                        //     }
                        //
                        // ];

                        let listKelas: Array<string> = ['vvip', 'vvpb', 'vipa', 'vip', 'vipb', 'utm', 'i', 'ii', 'iii'];
                        let defaultObject: Array<any> = [];
                        let defaultGroupByKelasObject: Array<any> = [];
                        let totalItemByKelas: Array<any> = [];
                        let totalSehariByKelas: Array<any> = [];
                        let newObjectResponse: Array<any>;
                        newObjectResponse = _.map(resp.list, (item: any, indexRoot: number) => {
                            let groupByKelasObject: Array<any> =  [];
                            let indexEmptyObject: Array<number> = [];

                            _.each(listKelas, (item2: any, index: number) => {
                                if(indexRoot === 0) {
                                    totalItemByKelas[index] = {
                                        nama_kelas: item2,
                                        totalObject: {}
                                    }

                                    totalSehariByKelas[index] = {
                                        nama_kelas: item2,
                                        totalSehari: 0
                                    }

                                }

                                const srObjectResponse = _.pickBy(item, (value: any, key: string) => {
                                    return key.replace(key.substr(0,2), '') === item2
                                });

                                // console.log('srObjectResponse',srObjectResponse);

                                if(!_.isEmpty(srObjectResponse)) {
                                    // if(defaultObject && defaultObject.length === 0 ) {
                                    //     defaultObject = _.map(srObjectResponse, (item: any, key: any) => {
                                    //         return key.substring(0, 2);
                                    //     })
                                    // }
                                    defaultObject = _.map(srObjectResponse, (item: any, key: any) => {
                                        if(indexRoot === 0 ) {
                                            totalItemByKelas[index].totalObject[key] = Number(0);
                                        }
                                        totalItemByKelas[index].totalObject[key] += Number(item);
                                        totalSehariByKelas[index].totalSehari += Number(item);
                                        return key.substring(0, 2);
                                    })

                                    // groupByKelasObject[index] = {[`${item2}`]: srObjectResponse};
                                    groupByKelasObject[index] = {
                                        nama_kelas: item2,
                                        object: srObjectResponse
                                    };



                                } else {
                                    indexEmptyObject.push(index);
                                }

                                // Filling empty object
                                // console.log('default', defaultObject);
                                if(defaultObject.length > 0 && indexEmptyObject.length > 0) {
                                    // console.log('default', defaultObject);
                                    // console.log('empty index', indexEmptyObject);
                                    // console.log('detect', listKelas[indexEmptyObject]);

                                    _.each(indexEmptyObject, (item: number) => {
                                        // console.log('detect', listKelas[item])
                                        let newObjectFromDefault: any = {};
                                         _.each(defaultObject, (item3: any) => {
                                             // newObjectFromDefault[`${item3}${listKelas[item]}`] = "0";
                                             newObjectFromDefault[`${item3}${listKelas[item]}`] = "0";
                                        });


                                        // groupByKelasObject[item] = {[`${listKelas[item]}`]: newObjectFromDefault}
                                        groupByKelasObject[item] = {
                                            nama_kelas: listKelas[item],
                                            object: newObjectFromDefault
                                        }

                                        defaultGroupByKelasObject[item] = {
                                            nama_kelas: listKelas[item],
                                            defaultGroup: defaultObject
                                        };
                                    });

                                    indexEmptyObject = [];
                                }

                                if(defaultObject.length > 0) {
                                    defaultGroupByKelasObject[index] = {
                                        nama_kelas: `${item2}`,
                                        defaultGroup: defaultObject
                                    };
                                }
                            });

                            return {
                                groupByKelasObject,
                                tanggal: item?.tgl_diet ? moment(item.tgl_diet).format('DD'): null
                            };
                        });

                        // console.log('new', newObjectResponse)
                        dataPrint = _.merge(_.keyBy(dates, 'date'), _.keyBy(newObjectResponse, 'tanggal'));
                        const dataValues = _.orderBy(_.values(dataPrint), 'date','asc');

                        const blob = await pdf(<PrintDocumentRekapitulasiDiitPerKelasKamar
                            dataHeader={defaultGroupByKelasObject}
                            data={dataValues} month={values.month}
                            operator={props?.user?.nama_lengkap}
                            totalPerKaliMakan={totalItemByKelas}
                            totalSehari={totalSehariByKelas}
                        />).toBlob();
                        const fileURL = URL.createObjectURL(blob);

                        const printWindow = window.open(fileURL,'','width=800,height=500');

                        if(printWindow)
                            printWindow.print();
                    }
                }
            } else if(props.type === 'byBentukMakanan') {
                const resp = await laporanGiziService.view_laprekapdiet_bentuk(payload);

                if(resp.list.length > 0) {
                    const dates = getDaysArray(Number(moment(values.month).format('YYYY')), Number(moment(values.month).format('MM')));
                    let dataPrint;
                    if(dates && resp.list) {
                        dataPrint = _.merge(_.keyBy(dates, 'date'), _.keyBy(resp.list, 'tanggal'));
                        const dataValues = _.orderBy(_.values(dataPrint), 'date','asc');

                        const blob = await pdf(<PrintDocumentRekapitulasiDiitPerBentukMakanan data={dataValues} month={values.month}/>).toBlob();
                        const fileURL = URL.createObjectURL(blob);

                        const printWindow = window.open(fileURL,'','width=800,height=500');
                        if(printWindow)
                            printWindow.print();
                    }
                }
            } else if(props.type === "byJenisDiet") {
                const resp = await laporanGiziService.view_laprekapdiet_jenis(payload);

                if(resp.list.length > 0) {
                    const dates = getDaysArray(Number(moment(values.month).format('YYYY')), Number(moment(values.month).format('MM')));
                    let dataPrint;
                    if(dates && resp.list) {
                        dataPrint = _.merge(_.keyBy(dates, 'date'), _.keyBy(resp.list, 'tanggal'));
                        const dataValues = _.orderBy(_.values(dataPrint), 'date','asc');

                        const blob = await pdf(<PrintDocumentRekapitulasiDiitPerJenisDiet data={dataValues} month={values.month}/>).toBlob();
                        const fileURL = URL.createObjectURL(blob);

                        const printWindow = window.open(fileURL,'','width=800,height=500');
                        if(printWindow)
                            printWindow.print();
                    }
                }
            }

            // if(resp?.metadata && !resp?.metadata?.error) {
            //     NotifySuccess('Data Kesalahan Detail', resp?.metadata?.message)
            // }
            setSubmitting(false);

            // if(props.onSuccessSubmiting)
            //     props.onSuccessSubmiting();
            //
            // props?.dialogRef?.current?.close();
        } catch (e) {
            console.log('err', e)
            setSubmitting(false);
        }
    }
});

const mapStateToProps = ({ auth: { user } }: any) => ({
    user
});

export default connect(mapStateToProps)(formikEnhancer(FormRekapitulasiDiitPerKelasRuangan));
