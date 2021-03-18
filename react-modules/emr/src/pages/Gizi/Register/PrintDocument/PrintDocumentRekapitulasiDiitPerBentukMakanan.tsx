import React from 'react';
import {Page, Text, View, Document, StyleSheet, Font} from '@react-pdf/renderer';
import _ from 'lodash';
import moment from 'moment';
import '../../../../assets/js/moment-locale/id.js';
const RobotoFont = require('../../../../assets/fonts/Roboto-Bold.ttf');

interface Props {
    data: any,
    month?: string,
    operator?: string
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
        paddingTop: 35,
        paddingBottom: 65,
        paddingHorizontal: 20,
    },
    header: {
        fontSize: 9,
        marginBottom: 20,
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
        marginTop: 20,
        width: 'auto',
        // borderStyle: 'solid',
        // borderColor: '#000',
        // borderWidth: 1,
    },
    tableRowHeader: {
        backgroundColor: '#919294',
        // flex: 1,
        // alignItems: 'center',
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
        borderBottomStyle: 'solid',
        borderBottomColor: '#919294',
        borderBottomWidth: 1
    },
    tableColHeader: {
        flex: 1,
        // minHeight: 33,
        // height: 22,
        borderStyle: 'solid',
        borderColor: '#000',
        borderWidth: 1,
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
        borderWidth: 1,
    },
    tableColHorizontal: {
        flex: 1,
        flexDirection: 'row',
        // borderStyle: 'solid',
        // borderColor: '#000',
        // borderWidth: 1,
    },
    tableCell: {
        padding: 2,
        fontSize: 8
    },
    tableCellWithBorder: {
        flex:1,
        padding: 5,
        fontSize: 8,
        // borderStyle: 'solid',
        // borderColor: '#000',
        // borderWidth: 1,
    },
});

const PrintDocumentRekapitulasiDiitPerBentukMakanan: React.FC<Props> = (props: Props)  => {
    moment.locale('id');

    let totalNs = 0;
    let totalNl = 0;
    let totalBBK = 0;
    let totalBBH = 0;
    let totalCair = 0;
    let totalPuasa = 0;
    let totalLain = 0;
    let totalBBS = 0;
    let totalMSS = 0;
    let totalHari = 0;

    return (
        <Document>
            <Page orientation="portrait" size="A4" style={styles.body}>
                {/*<View style={styles.header} fixed>*/}
                    {/*<Text>Jl. Panglima Sudirman 99A Kepanjen 65163 Malang</Text>*/}
                    {/*<Text>Telp. 0341-393000 Fax 0341-398398 eMail: info@wavahusada.com</Text>*/}
                    {/*<Text style={styles.line}/>*/}
                {/*</View>*/}
                <Text style={styles.textTitle}>
                    Tabel Konsumsi Makanan Pasien Berdasarkan Bentuk Makanan
                </Text>
                <Text style={styles.textSubTitle}>
                    Periode {moment(props?.month).locale('id').format('MMMM')} Tahun {moment(props?.month).locale('id').format('YYYY')}
                </Text>

                <View style={styles.table}>
                    <View style={styles.tableRowHeader} fixed>
                        <View style={{...styles.tableColHeader, flex: 2}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>TANGGAL</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>NS</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>NL</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>BBK</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>BBH</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>CAIR</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>PUASA</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>LAIN2</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>BBS</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>MSS</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 2}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>Total/Hari</Text>
                        </View>
                    </View>

                    {
                        props?.data && Array.isArray(props?.data) && props?.data.length > 0 &&
                            props?.data.map((item: any, index: number) => {
                                totalNs += item?.ns && _.isNumber(Number(item?.ns))? Number(item?.ns): 0;
                                totalNl += item?.nl && _.isNumber(Number(item?.nl)) ? Number(item?.nl): 0;
                                totalBBK += item?.bbk && _.isNumber(Number(item?.bbk)) ? Number(item?.bbk) : 0;
                                totalBBH += item?.bbh && _.isNumber(Number(item?.bbh)) ? Number(item?.bbh) : 0;
                                totalCair += item?.cair && _.isNumber(Number(item?.cair)) ? Number(item?.cair) : 0;
                                totalPuasa += item?.puasa && _.isNumber(Number(item?.puasa)) ? Number(item?.puasa) : 0;
                                totalLain += item?.lain && _.isNumber(Number(item?.lain)) ? Number(item?.lain) : 0;
                                totalBBS += item?.bbs && _.isNumber(Number(item?.bbs)) ? Number(item?.bbs) : 0;
                                totalMSS += item?.mss && _.isNumber(Number(item?.mss)) ? Number(item?.mss) : 0;
                                totalHari += item?.total && _.isNumber(Number(item?.total)) ? Number(item?.total) : 0;
                                return(
                                    <View style={{...styles.tableRow, textAlign: 'center'}} key={index}>
                                        <View style={{...styles.tableCol, flex: 2}}>
                                            <Text style={{...styles.tableCell}}>{item?.date}</Text>
                                        </View>
                                        <View style={{...styles.tableCol, flex: 1}}>
                                            <Text style={{...styles.tableCell}}>{item?.ns? item ?.ns: '0'}</Text>
                                        </View>
                                        <View style={{...styles.tableCol, flex: 1}}>
                                            <Text style={{...styles.tableCell}}>{item?.nl? item ?.nl: '0'}</Text>
                                        </View>
                                        <View style={{...styles.tableCol, flex: 1}}>
                                            <Text style={{...styles.tableCell}}>{item?.bbk? item ?.bbk: '0'}</Text>
                                        </View>
                                        <View style={{...styles.tableCol, flex: 1}}>
                                            <Text style={{...styles.tableCell}}>{item?.bbh? item ?.bbh: '0'}</Text>
                                        </View>
                                        <View style={{...styles.tableCol, flex: 1}}>
                                            <Text style={{...styles.tableCell}}>{item?.cair? item ?.cair: '0'}</Text>
                                        </View>
                                        <View style={{...styles.tableCol, flex: 1}}>
                                            <Text style={{...styles.tableCell}}>{item?.puasa? item ?.puasa: '0'}</Text>
                                        </View>
                                        <View style={{...styles.tableCol, flex: 1}}>
                                            <Text style={{...styles.tableCell}}>{item?.lain? item ?.lain: '0'}</Text>
                                        </View>
                                        <View style={{...styles.tableCol, flex: 1}}>
                                            <Text style={{...styles.tableCell}}>{item?.bbs? item ?.bbs: '0'}</Text>
                                        </View>
                                        <View style={{...styles.tableCol, flex: 1}}>
                                            <Text style={{...styles.tableCell}}>{item?.mss? item ?.mss: '0'}</Text>
                                        </View>
                                        <View style={{...styles.tableCol, flex: 2}}>
                                            <Text style={{...styles.tableCell}}>{item?.total? item ?.total: '0'}</Text>
                                        </View>
                                    </View>
                                )
                            })
                    }

                    <View style={{...styles.tableRow, textAlign: 'center'}}>
                        <View style={{...styles.tableCol, flex: 2}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>Total</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalNs}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalNl}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalBBK}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalBBH}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalCair}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalPuasa}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalLain}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalBBS}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalMSS}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 2}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalHari}</Text>
                        </View>
                    </View>

                </View>
            </Page>
        </Document>
    )
};

export default PrintDocumentRekapitulasiDiitPerBentukMakanan;
