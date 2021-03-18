import React from 'react';
import clsx from 'clsx';
// import { classNames } from 'react-select/src/utils';
import MaterialUIPicker from './MaterialUIPicker';

interface IProps {
    value?: string | number | any;
    label?: string;
    inputName?: string;
    inputType?: string;
    onChange?: (e: any) => void;
    onKeyDown?: (e: any) => void;
    placeholder?: string;
    fontSm?: boolean;
    formControlSm?: boolean;
    disabled?: boolean;
    colSize?: number;
    labelSize?: number;
    error?: any;
    submitted?: boolean;
    styles?: any;
    MUIViews?: Array<"year" | "date" | "month">;
    inputRef?: any; 
    labelClass?: any;
    inputClass?: any;
    inputWrapperClass?: any;
    errorClass?:any;
}

export default function HorizontalInput(props: IProps) {
    const onChange = (e: any) => {
        if(props.onChange) {
            props.onChange(e);
        }
    };

    const colSize = props.colSize? `col-lg-${props.colSize}`: '';
    const labelSize = props.labelSize? `col-lg-${[props.labelSize]}`: 'col-lg-1';

    return(
        <>
            <label className={clsx('col-form-label col-sm-12',
                {'form-control-sm': props.formControlSm},
                labelSize,
                props?.labelClass,
                {'kt-font-sm': props.fontSm})}
                style={{marginTop: 5}}
            >
                {props.label}: &nbsp;
            </label>
            <div className={clsx('col-sm-12', props?.inputWrapperClass, colSize)} style={{paddingTop: 5}}>
                {props.inputType !== 'MUIPicker' && props.inputType ?
                <input className={clsx('form-control',{'is-invalid': props?.error}, props?.inputClass, {'form-control-sm': props.formControlSm})}
                       name={props.inputName}
                       type={props.inputType? props.inputType: 'text'}
                       onChange={(e) => onChange(e)}
                       value={props.value}
                       disabled={props.disabled}
                       placeholder={props?.placeholder}
                       ref={props?.inputRef}
                       onKeyDown={props?.onKeyDown}
                />:
                <MaterialUIPicker
                    onChange={(e) => onChange(e)}
                    value={props.value}
                    MUIViews={props?.MUIViews}
                ></MaterialUIPicker>
                }
                {!!props.error && (
                    <div className={clsx('col-12', props?.errorClass, {'form-control-sm': props.formControlSm})} style={{ color: "red" }}>
                        {props?.error}
                    </div>
                )}
            </div>
        </>
    )
}
