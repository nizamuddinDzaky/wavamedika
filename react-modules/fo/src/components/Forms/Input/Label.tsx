import React from 'react';
import clsx from 'clsx';
// import { classNames } from 'react-select/src/utils';

interface IProps {
    label?: string;
    fontSm?: boolean;
    formControlSm?: boolean;
    labelSize?: number;
    styles?: any;
    labelClass?: any;
}

export default function Label(props: IProps) {
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
        </>
    )
}
