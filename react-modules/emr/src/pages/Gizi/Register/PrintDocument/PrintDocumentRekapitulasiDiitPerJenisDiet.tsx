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

const PrintDocumentRekapitulasiDiitPerJenisDiet: React.FC<Props> = (props: Props)  => {
    moment.locale('id');

    let totalRG = 0;
    let totalDM = 0;
    let totalRP = 0;
    let totalRL = 0;
    let totalDJ = 0;
    let totalRPU = 0;
    let totalRS = 0;
    let totalRGDM = 0;
    let totalRGRP = 0;
    let totalRGDMRP = 0;
    let totalDH = 0;
    let totalDL = 0;

    return (
        <Document>
            <Page orientation="portrait" size="A4" style={styles.body}>
                {/*<View style={styles.header} fixed>*/}
                {/*<Text>Jl. Panglima Sudirman 99A Kepanjen 65163 Malang</Text>*/}
                {/*<Text>Telp. 0341-393000 Fax 0341-398398 eMail: info@wavahusada.com</Text>*/}
                {/*<Text style={styles.line}/>*/}
                {/*</View>*/}
                <Text style={styles.textTitle}>
                    Tabel Konsumsi Makanan Pasien Berdasarkan Jenis Diet
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
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>RG</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>DM</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>RP</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>RL</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>DJ</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>Rpu</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>RS</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>RGDM</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>RGRP</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>RGDMRP</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>DH</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>DL</Text>
                        </View>
                    </View>

                    {
                        props?.data && Array.isArray(props?.data) && props?.data.length > 0 &&
                        props?.data.map((item: any, index: number) => {
                            totalRG += item?.rg && _.isNumber(Number(item?.rg))? Number(item?.rg): 0;
                            totalDM += item?.dm && _.isNumber(Number(item?.dm)) ? Number(item?.dm): 0;
                            totalRP += item?.rp && _.isNumber(Number(item?.rp)) ? Number(item?.rp) : 0;
                            totalRL += item?.rj && _.isNumber(Number(item?.rl)) ? Number(item?.rl) : 0;
                            totalDJ += item?.dj && _.isNumber(Number(item?.dj)) ? Number(item?.dj) : 0;
                            totalRPU += item?.rpu && _.isNumber(Number(item?.rpu)) ? Number(item?.rpu) : 0;
                            totalRS += item?.rs && _.isNumber(Number(item?.rs)) ? Number(item?.rs) : 0;
                            totalRGDM += item?.rgdm && _.isNumber(Number(item?.rgdm)) ? Number(item?.rgdm) : 0;
                            totalRGRP += item?.rgrp && _.isNumber(Number(item?.rgrp)) ? Number(item?.rgrp) : 0;
                            totalRGDMRP += item?.rgdmrp && _.isNumber(Number(item?.rgdmrp)) ? Number(item?.rgdmrp) : 0;
                            totalDH += item?.dh && _.isNumber(Number(item?.dh)) ? Number(item?.dh) : 0;
                            totalDL += item?.dl && _.isNumber(Number(item?.dl)) ? Number(item?.dl) : 0;
                            return(
                                <View style={{...styles.tableRow, textAlign: 'center'}} key={index}>
                                    <View style={{...styles.tableCol, flex: 2}}>
                                        <Text style={{...styles.tableCell}}>{item?.date}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.rg? item ?.rg: '0'}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.dm? item ?.dm: '0'}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.rp? item ?.rp: '0'}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.rl? item ?.rl: '0'}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.dj? item ?.dj: '0'}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.rpu? item ?.rpu: '0'}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.rs? item ?.rs: '0'}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.rgdm? item ?.rgdm: '0'}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.rgrp? item ?.rgrp: '0'}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.rgdmrp? item ?.rgdmrp: '0'}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.dh? item ?.dh: '0'}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.dl? item ?.dl: '0'}</Text>
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
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalRG}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalDM}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalRP}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalRL}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalDJ}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalRPU}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalRS}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalRGDM}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalRGRP}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalRGDMRP}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalDH}</Text>
                        </View>
                        <View style={{...styles.tableCol, flex: 1}}>
                            <Text style={{...styles.tableCell,fontFamily: 'Roboto', fontWeight: 700}}>{totalDL}</Text>
                        </View>
                    </View>

                </View>
            </Page>
        </Document>
    )
};

export default PrintDocumentRekapitulasiDiitPerJenisDiet;
