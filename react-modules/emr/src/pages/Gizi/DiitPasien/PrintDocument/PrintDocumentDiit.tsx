import React from 'react';
import { Page, Text, View, Document, StyleSheet } from '@react-pdf/renderer';

interface Props {
    data: Array<any>
}

const styles = StyleSheet.create({
    page: {
        flexDirection: 'row',
        backgroundColor: '#E4E4E4',
        flexWrap: 'wrap'
    },
    section: {
        // width: 150,
        margin: 3,
        padding: 4,
        // flexGrow: 1,
        flexGrow: 0,
        flexShrink: 0,
        flexBasis: 190
    },
    fontName: {
        fontSize: 12,
        fontWeight: 600
    },
    fontSection2: {
        fontSize: 10
    },
    sectionKeterangan: {
        flexDirection: 'row',
        fontSize: 10
    },
    sectionKeteranganText: {
        backgroundColor: '#919294',
        minWidth: 30
    },
    sectionKeterangan2: {
        flexDirection: 'row',
        fontSize: 8
    },
    itemContainer: {
        flexDirection: 'row',
        // borderStyle: 'solid',
        // borderColor: '#000',
        // borderWidth: 2,
    },
    watermarks: {
        position: 'absolute',
        top: 0,
        right: -8,
        fontSize: 36,
        fontWeight: 800,
        opacity: 0.5,
        color: '#919294'
    }
});


const PrintDocumentDiit: React.FC<Props> = (props: Props)  => {
    return(
        <Document>
            <Page size="A4" style={styles.page}>
                {
                    props?.data?.map((item: any, index: number) => {
                        return (
                            <View style={styles.section} key={index}>
                                <View style={styles.itemContainer}>
                                    <View style={styles.item}>
                                        <Text style={styles.fontName}>{item?.nama_lengkap}</Text>
                                        {/*<Text style={styles.fontSection2}> TglLahir: 20/05/1996 | No RM: {item?.no_mr}</Text>*/}
                                        <Text style={styles.fontSection2}> Umur: {item.umur} | No RM: {item?.no_mr}</Text>
                                        <View style={styles.sectionKeterangan}>
                                            {item?.jenis1 && <Text style={styles.sectionKeteranganText}>{item.jenis1}</Text>}
                                            {item?.jenis2 && <Text style={styles.sectionKeteranganText}>{item.jenis2}</Text>}
                                            {item?.jenis3 && <Text style={styles.sectionKeteranganText}>{item.jenis3}</Text>}
                                            {item?.jenis4 && <Text style={styles.sectionKeteranganText}>{item.jenis4}</Text>}
                                            {item?.jenis5 && <Text style={styles.sectionKeteranganText}>{item.jenis5}</Text>}
                                            {/*<Text style={{...styles.sectionKeteranganText, backgroundColor: 'red'}}>NL</Text>*/}
                                        </View>
                                        {/*<Text style={styles.sectionKeterangan2}>*/}
                                            {/*paket alma (-)*/}
                                        {/*</Text>*/}
                                        {/*<Text style={styles.sectionKeterangan2}>*/}
                                            {/*sawi, brokoli, seafood, coklat, kacang tanah*/}
                                        {/*</Text>*/}
                                        {/*<Text style={styles.watermarks}>B</Text>*/}
                                    </View>
                                </View>
                            </View>
                        )
                    })
                }

            </Page>
        </Document>
    )
};

export default PrintDocumentDiit;
