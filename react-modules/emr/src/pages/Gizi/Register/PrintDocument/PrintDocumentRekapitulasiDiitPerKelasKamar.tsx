import React from 'react';
import {Page, Text, View, Document, StyleSheet, Font} from '@react-pdf/renderer';
import moment from 'moment';
import '../../../../assets/js/moment-locale/id.js';
const RobotoFont = require('../../../../assets/fonts/Roboto-Bold.ttf');

interface Props {
    data: any,
    dataHeader: any,
    month?: string,
    operator?: string,
    totalPerKaliMakan?: any,
    totalSehari?: any
}

Font.register(
    {
        family: "Roboto",
        src: RobotoFont,
        format: "truetype"
    }

);

const styles = StyleSheet.create({
    body: {
        paddingTop: 20,
        paddingBottom: 25,
        paddingHorizontal: 20,
    },
    header: {
        fontSize: 9,
        textAlign: 'right',
        color: 'grey',
    },
    line: {
        marginTop: 2,
        borderTop: 1,
        borderColor: 'grey',
        width: '100%'
    },
    pageNumberPos: {
        position: 'absolute',
        left: 20,
        right: 20,
        bottom: 20
    },
    pageNumber: {
        position: 'relative',
        flexDirection: 'column'
    },
    pageprint: {
        flexGrow: 1,
        fontSize: 9,
        textAlign: 'right',
        color: 'grey',
        width: '100%',
    },
    timeprint: {
        fontSize: 9,
        textAlign: 'right',
        width: '100%',
        backgroundColor: 'grey'
    },
    text: {
        // margin: 12,
        fontSize: 14,
        textAlign: 'justify',
        fontFamily: 'Times-Roman'
    },
    textTitle: {
        fontFamily: 'Roboto',
        fontSize: 12,
        fontWeight: 700,
        textDecoration: 'underline',
        textAlign: 'center',
    },
    textSubTitle: {
        fontFamily: 'Roboto',
        fontSize: 10,
        textAlign: 'center',
        color: '#919294'
    },
    table: {
        marginTop: 35,
        width: 'auto',
        // borderStyle: 'solid',
        // borderColor: '#000',
        // borderWidth: 1,
    },
    tableRowHeader: {
        backgroundColor: '#919294',
        // flex: 1,
        alignItems: 'center',
        flexDirection: 'row',
        flexWrap: 'wrap',
        // borderStyle: 'solid',
        // borderColor: '#000',
        // borderWidth: 1,
    },
    tableRow: {
        // flex: 1,
        flexDirection: 'row',
        flexWrap: 'wrap',
        textAlign: 'center',
        borderBottomStyle: 'solid',
        borderBottomColor: '#919294',
        borderBottomWidth: 0.4
    },
    tableColHeader: {
        flex: 1,
        // minHeight: 33,
        // height: 22,
        // borderStyle: 'solid',
        // borderColor: '#000',
        // borderWidth: 0.4,
        textAlign: 'center'
    },
    tableColHeaderLast: {
        flex: 1,
        // height: 22,
        borderLeftStyle: 'dashed',
        borderLeftColor: '#000',
        borderLeftWidth: 1,
        borderRightStyle: 'dashed',
        borderRightColor: '#000',
        borderRightWidth: 1,
    },
    tableCol: {
        flex: 1,
        borderStyle: 'solid',
        borderColor: '#000',
        borderWidth: 0.4,
    },
    tableColHorizontal: {
        flex: 1,
        flexDirection: 'row',
        // borderStyle: 'solid',
        // borderColor: '#000',
        // borderWidth: 0.4,
    },
    tableCell: {
        padding: 1,
        fontSize: 8
    },
    tableCellWithBorder: {
        flex:1,
        // padding: 4,
        fontSize: 8,
        borderStyle: 'solid',
        borderColor: '#000',
        borderWidth: 0.4,
    },
});

const PrintDocumentRekapitulasiDiitPerKelasKamar: React.FC<Props> = (props: Props)  => {
    moment.locale('id');

    return (
        <Document>
            <Page orientation="landscape" size="A4" style={styles.body}>
                {/*<View style={styles.header} fixed>*/}
                {/*<Text>Jl. Panglima Sudirman 99A Kepanjen 65163 Malang</Text>*/}
                {/*<Text>Telp. 0341-393000 Fax 0341-398398 eMail: info@wavahusada.com</Text>*/}
                {/*<Text style={styles.line}/>*/}
                {/*</View>*/}
                <Text style={styles.textTitle} fixed>
                    Tabel Konsumsi Makanan Pasien Berdasarkan Kelas Kamar
                </Text>
                <Text style={styles.textSubTitle} fixed>
                    Periode {moment(props?.month).locale('id').format('MMMM')} Tahun {moment(props?.month).locale('id').format('YYYY')}
                </Text>

                <View style={styles.table}>
                    <View style={styles.tableRowHeader} fixed>
                        <View style={{...styles.tableColHeader, flex: 4}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>TANGGAL</Text>
                        </View>
                        {
                            props?.dataHeader?.map((item: any, index: number) => {
                                return(
                                    <View style={{...styles.tableColHeader, flex: 5}} key={index}>
                                        <View style={styles.tableCol}>
                                            <Text style={{...styles.tableCell, fontFamily: 'Roboto', fontWeight: 700, textAlign: 'center'}}>KELAS {item.nama_kelas.toUpperCase()}</Text>
                                        </View>
                                        <View style={{...styles.tableColHorizontal}}>
                                            {item?.defaultGroup.map((item2: any, index: number) => {
                                                return (
                                                    <Text key={index} style={{
                                                        ...styles.tableCellWithBorder,
                                                        fontFamily: 'Roboto', fontWeight: 700, textAlign: 'center',
                                                        flex: 1
                                                    }}>
                                                        {item2.toUpperCase()}
                                                    </Text>
                                                )
                                            })}
                                        </View>
                                    </View>
                                )
                            })
                        }
                    </View>

                    {
                        props?.data && Array.isArray(props?.data) && props?.data.length > 0 &&
                        props?.data.map((item: any, index: number) => {
                            return (
                                <View style={{...styles.tableRow}} key={index}>
                                    <View style={{...styles.tableCol, flex: 4}}>
                                        <Text style={{...styles.tableCell}}>{item?.date}</Text>
                                    </View>
                                    {
                                        !item?.groupByKelasObject && props?.dataHeader?.map((item: any, index: number) => {
                                            return(
                                                <View style={{...styles.tableCol, flex: 5}} key={index}>
                                                    <View style={styles.tableColHorizontal}>
                                                        <Text style={{...styles.tableCellWithBorder, flex: 1}}>0</Text>
                                                        <Text style={{...styles.tableCellWithBorder, flex: 1}}>0</Text>
                                                        <Text style={{...styles.tableCellWithBorder, flex: 1}}>0</Text>
                                                    </View>
                                                </View>
                                            )
                                        })
                                    }
                                    {
                                        item?.groupByKelasObject?.map((item2: any, index: number) => {
                                            return(
                                                <View style={{...styles.tableCol, flex: 5}} key={index}>
                                                    <View style={styles.tableColHorizontal}>
                                                        {
                                                            Object.keys(item2?.object)?.map((item3: any, index3: number) => {
                                                                return <Text key={index3} style={{...styles.tableCellWithBorder, flex: 1}}>{item2?.object[item3]}</Text>
                                                            })
                                                        }
                                                    </View>
                                                </View>
                                            )
                                        })
                                    }

                                </View>
                            )
                        })
                    }

                    <View style={{...styles.tableRow}}>
                        <View style={{...styles.tableCol, flex: 4}}>
                            <Text style={{...styles.tableCell, fontSize: 6}}>Total Per Kali Makan</Text>
                        </View>
                        {
                            props?.totalPerKaliMakan?.map((item2: any, index: number) => {
                                return(
                                    <View style={{...styles.tableCol, flex: 5}} key={index}>
                                        <View style={styles.tableColHorizontal}>
                                            {
                                                Object.keys(item2?.totalObject)?.map((item3: any, index3: number) => {
                                                    return <Text key={index3} style={{...styles.tableCellWithBorder, flex: 1}}>{item2?.totalObject[item3]}</Text>
                                                })
                                            }
                                        </View>
                                    </View>
                                )
                            })
                        }
                    </View>

                    <View style={{...styles.tableRow}}>
                        <View style={{...styles.tableCol, flex: 4}}>
                            <Text style={{...styles.tableCell, fontSize: 6}}>Total Sehari</Text>
                        </View>
                        {
                            props?.totalSehari?.map((item2: any, index: number) => {
                                return(
                                    <View style={{...styles.tableCol, flex: 5}} key={index}>
                                        <View style={styles.tableCol}>
                                            <Text style={{...styles.tableCellWithBorder, flex: 1}}>{item2?.totalSehari}</Text>
                                        </View>
                                    </View>
                                )
                            })
                        }
                    </View>
                </View>

                <View  style={styles.pageNumberPos} fixed>
                    <View style={styles.pageNumber}>
                        {/*<Text style={styles.pageprint} render={({ pageNumber, totalPages }) => (*/}
                            {/*`DAFTAR DIIT PASIEN (Per Tanggal ${moment(props?.tanggal).locale('id').format('DD MMMM YYYY')}) Hal ${pageNumber} dari ${totalPages} halaman`*/}
                        {/*)} fixed />*/}
                        <Text style={styles.timeprint} fixed>
                            {`Waktu cetak ${moment().format('DD/MM/YYYY HH:mm:ss')} oleh ${props?.operator}`}
                        </Text>
                    </View>
                </View>
            </Page>
        </Document>
    )
};

export default PrintDocumentRekapitulasiDiitPerKelasKamar;
