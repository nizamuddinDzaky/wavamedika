import React from 'react';
import { MuiPickersUtilsProvider, DatePicker } from '@material-ui/pickers';
import MomentUtils from '@date-io/moment';

interface IProps {
    value?: string;
    onChange?: (e: any) => void;
    MUIViews?: Array<"year" | "date" | "month">
}

const MaterialUIPicker: React.FC<IProps> = (props: IProps) => {
    // const [selectedDate, handleDateChange] = useState(new Date());

    return (
        <MuiPickersUtilsProvider utils={MomentUtils}>
            <DatePicker
             value={props?.value} 
             onChange={(e: any) => props?.onChange? props?.onChange(e): null}
             views={props?.MUIViews}
            />
        </MuiPickersUtilsProvider>
    )
    
}

export default MaterialUIPicker;