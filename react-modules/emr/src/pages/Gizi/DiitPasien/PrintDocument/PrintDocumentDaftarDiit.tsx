import React from 'react';
import {Page, Text, View, Document, StyleSheet, Font} from '@react-pdf/renderer';
import moment from 'moment';
import '../../../../assets/js/moment-locale/id.js';
const RobotoFont = require('../../../../assets/fonts/Roboto-Bold.ttf');

interface Props {
    data: any,
    tanggal?: string,
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
        borderBottomStyle: 'dashed',
        borderBottomColor: '#919294',
        borderBottomWidth: 1
    },
    tableColHeader: {
        flex: 1,
        // minHeight: 33,
        // height: 22,
        borderLeftStyle: 'dashed',
        borderLeftColor: '#000',
        borderLeftWidth: 1,
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
        // borderStyle: 'solid',
        // borderColor: '#000',
        // borderWidth: 1,
    },
    tableColHorizontal: {
        flex: 1,
        flexDirection: 'row',
        // borderStyle: 'solid',
        // borderColor: '#000',
        // borderWidth: 1,
    },
    tableCell: {
        padding: 5,
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

const PrintDocumentDaftarDiit: React.FC<Props> = (props: Props)  => {
    moment.locale('id');
    console.log('locale', moment.locale())
    console.log('supported locales', moment.locales());
    return (
        <Document>
            <Page orientation="landscape" size="A4" style={styles.body}>
                <View style={styles.header} fixed>
                    <Text>Jl. Panglima Sudirman 99A Kepanjen 65163 Malang</Text>
                    <Text>Telp. 0341-393000 Fax 0341-398398 eMail: info@wavahusada.com</Text>
                    <Text style={styles.line}/>
                </View>

                <Text style={styles.textTitle}>
                    DAFTAR DIIT PASIEN
                </Text>
                <Text style={styles.textSubTitle}>
                    Per Hari {moment(props?.tanggal).locale('id').format('dddd')} tanggal {moment(props?.tanggal).format('DD MMMM YYYY')}
                </Text>

                <View style={styles.table}>
                    <View style={styles.tableRowHeader} fixed>
                        <View style={{...styles.tableColHeader, flex: 1}}>
                            <Text style={{...styles.tableCell, fontWeight: 700}}>Kelas</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 2}}>
                            <Text style={{...styles.tableCell, fontWeight: 700}}>TGL. MRS</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 2}}>
                            <Text style={{...styles.tableCell, fontWeight: 700}}>NO. RM</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 3}}>
                            <Text style={{...styles.tableCell, fontWeight: 700}}>KAMAR</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 3}}>
                            <Text style={{...styles.tableCell, fontWeight: 700, flex: 4}}>NAMA PASIEN</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 2}}>
                            <Text style={{...styles.tableCell, fontWeight: 700}}>UMUR</Text>
                        </View>
                        <View style={{...styles.tableColHeader, flex: 5}}>
                            <View style={styles.tableCol}>
                                <Text style={{...styles.tableCell, fontWeight: 700, textAlign: 'center'}}>DIIT PASIEN</Text>
                            </View>
                            <View style={{...styles.tableColHorizontal, backgroundColor: '#c8c9cb'}}>
                                <Text style={{
                                    ...styles.tableCellWithBorder,
                                    fontWeight: 700,
                                    flex: 1,
                                    borderRightStyle: 'dashed',
                                    borderRightColor: '#000',
                                    borderRightWidth: 1
                                }}>Pagi</Text>
                                <Text style={{
                                    ...styles.tableCellWithBorder,
                                    fontWeight: 700,
                                    flex: 1,
                                    borderRightStyle: 'dashed',
                                    borderRightColor: '#000',
                                    borderRightWidth: 1
                                }}>Siang</Text>
                                <Text style={{
                                    ...styles.tableCellWithBorder,
                                    fontWeight: 700,
                                    flex: 1,
                                    borderRightStyle: 'dashed',
                                    borderRightColor: '#000',
                                    borderRightWidth: 1
                                }}>Sore</Text>
                                <Text style={{...styles.tableCellWithBorder, fontWeight: 700, flex: 1}}>Jenis</Text>
                            </View>
                        </View>
                        <View style={{...styles.tableColHeaderLast, flex: 7}}>
                            <View style={styles.tableCol}>
                                <Text style={{...styles.tableCell, fontWeight: 700, textAlign: 'center'}}>CATATAN</Text>
                            </View>
                            <View style={{...styles.tableColHorizontal, backgroundColor: '#c8c9cb'}}>
                                <Text style={{
                                    ...styles.tableCellWithBorder,
                                    fontWeight: 700,
                                    flex: 1,
                                    borderRightStyle: 'dashed',
                                    borderRightColor: '#000',
                                    borderRightWidth: 1
                                }}>Keterangan</Text>
                                <Text style={{
                                    ...styles.tableCellWithBorder,
                                    fontWeight: 700,
                                    flex: 1,
                                    borderRightStyle: 'dashed',
                                    borderRightColor: '#000',
                                    borderRightWidth: 1
                                }}>Alergi</Text>
                                <Text style={{
                                    ...styles.tableCellWithBorder,
                                    fontWeight: 700,
                                    flex: 1,
                                    borderRightStyle: 'dashed',
                                    borderRightColor: '#000',
                                    borderRightWidth: 1
                                }}>Diagnosa</Text>
                                <Text style={{...styles.tableCellWithBorder, fontWeight: 700, flex: 1}}>Asuransi</Text>
                            </View>
                        </View>
                    </View>



                    {
                        props.data?.map((item: any, index: number) => {
                            return (
                                <View style={{...styles.tableRow}} key={index}>
                                    <View style={{...styles.tableCol, flex: 1}}>
                                        <Text style={{...styles.tableCell}}>{item?.kelas}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 2}}>
                                        <Text style={{...styles.tableCell}}>{moment(item?.tgl_mrs).locale('id').format('DD/MM/YYYY')}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 2}}>
                                        <Text style={{...styles.tableCell}}>{item?.no_mr}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 3}}>
                                        <Text style={{...styles.tableCell}}>{item?.nama_kamar}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 3}}>
                                        <Text style={{...styles.tableCell}}>{item?.nama_lengkap}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 2}}>
                                        <Text style={{...styles.tableCell}}>{item?.umur}</Text>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 5}}>
                                        <View style={styles.tableColHorizontal}>
                                            <Text style={{...styles.tableCellWithBorder, flex: 1}}>{item?.pagi}</Text>
                                            <Text style={{...styles.tableCellWithBorder, flex: 1}}>{item?.siang}</Text>
                                            <Text style={{...styles.tableCellWithBorder, flex: 1}}>{item?.sore}</Text>
                                            <Text style={{...styles.tableCellWithBorder, flex: 1}}>{item?.jenis}</Text>
                                        </View>
                                    </View>
                                    <View style={{...styles.tableCol, flex: 7}}>
                                        <View style={styles.tableColHorizontal}>
                                            <Text style={{...styles.tableCellWithBorder, flex: 1}}>{item?.keterangan}</Text>
                                            <Text style={{...styles.tableCellWithBorder, flex: 1}}>{item?.alergi}</Text>
                                            <Text style={{...styles.tableCellWithBorder, flex: 1}}>{item?.diagnosa}</Text>
                                            <Text style={{...styles.tableCellWithBorder, flex: 1}}>{item?.asuransi}</Text>
                                        </View>
                                    </View>
                                </View>
                            )
                        })
                    }
                </View>

                <View  style={styles.pageNumberPos} fixed>
                    <View style={styles.pageNumber}>
                        <Text style={styles.pageprint} render={({ pageNumber, totalPages }) => (
                            `DAFTAR DIIT PASIEN (Per Tanggal ${moment(props?.tanggal).locale('id').format('DD MMMM YYYY')}) Hal ${pageNumber} dari ${totalPages} halaman`
                        )} fixed />
                        <Text style={styles.timeprint} fixed>
                            {`Waktu cetak ${moment().format('DD/MM/YYYY HH:mm:ss')} oleh ${props?.operator}`}
                        </Text>
                    </View>
                </View>

            </Page>
        </Document>
    )
};

export default PrintDocumentDaftarDiit;
