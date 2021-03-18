export function getDaysArray (year: number, month: number){
    var monthIndex = month - 1;
    var names = [ 'Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab' ];
    var date = new Date(year, monthIndex, 1);
    var result: any = [];
    while (date.getMonth() === monthIndex) {
        result.push({ date: ('0' + date.getDate()).slice(-2), day: names[date.getDay()]});
        date.setDate(date.getDate() + 1);
    }
    return result;
};
