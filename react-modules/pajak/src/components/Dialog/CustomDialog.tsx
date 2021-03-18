import React, {forwardRef, useEffect, useRef, useState} from 'react';
import {Dialog} from "rc-easyui";
// import customDialogEasyUI from "../../assets/js/customDialogEasyUI";

interface IProps {
    children: any;
    title: string;
    style?: any;
    sizing?: string | 'small' | 'medium' | 'large';
    // width?: number;
    // height?: number;
}

interface IReactFC extends IProps{
    ref: any;
}

const CustomDialog: React.FC<IReactFC> = forwardRef((props: IProps, ref: any) => {
    const mounted:any = useRef();

    // let sizing: number = 1;
    let sizingWidthDesktop: number = 80/ 100;
    let sizingHeightDesktop: number = 85/ 100;
    let sizingWidthMobile: number = 98/ 100;
    let sizingHeightMobile: number = 80/ 100;
    switch (props.sizing) {
        case 'small':
            // sizing = 4;
            sizingWidthDesktop = 30/ 100;
            sizingHeightDesktop = 30 / 100;
            sizingWidthMobile = 80/100;
            sizingHeightMobile = 40/100;
            break;
        case 'medium':
            // sizing = 2;
            sizingWidthDesktop = 50/ 100;
            sizingHeightDesktop = 50 / 100;
            sizingWidthMobile = 80/100;
            sizingHeightMobile = 50/100;
            break;
        case 'large':
            // sizing = 1;
            sizingWidthDesktop = 80/ 100;
            sizingHeightDesktop = 85 / 100;
            sizingWidthMobile = 98/100;
            sizingHeightMobile = 80/100;
            break;
        default:
            // sizing = 2;

            sizingWidthDesktop = 50/ 100;
            sizingHeightDesktop = 50 / 100;
            sizingWidthMobile = 80/100;
            sizingHeightMobile = 50/100;
            break;
    }

    const [panelWidth, setPanelWidth] = useState<number>(window.innerWidth > 600?
        (window.innerWidth* sizingWidthDesktop) :
        (window.innerWidth* sizingWidthMobile)
    );
    const [panelHeight, setPanelHeight] = useState<number>(window.innerWidth > 600 ?
        (window.innerHeight * sizingHeightDesktop):
        (window.innerHeight * sizingHeightMobile)
    );

    const onWindowResize = () => {
        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;
        if(windowWidth > 600) {
            setPanelWidth((windowWidth* sizingWidthDesktop));
            setPanelHeight((windowHeight * sizingHeightDesktop));
        } else {
            setPanelWidth((windowWidth* sizingWidthMobile));
            setPanelHeight((windowHeight *sizingHeightMobile));
        }
        ref?.current?.center();
    };

    const onOpen = () => {
        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;
        if(windowWidth > 600) {
            setPanelWidth((windowWidth* sizingWidthDesktop));
            setPanelHeight((windowHeight * sizingHeightDesktop));
        } else {
            setPanelWidth((windowWidth* sizingWidthMobile));
            setPanelHeight((windowHeight *sizingHeightMobile));
        }
        ref?.current?.center();
    }

    const onScroll = () => {
        ref?.current?.center();
    };

    useEffect(() => {
        // Component Did Mount
        if (!mounted.current) {
            mounted.current = true;
            // listener for windows resize
            window.addEventListener( 'resize', onWindowResize, false );
            window.addEventListener( 'scroll', onScroll);

            // auto close dialog in component did mount
            ref?.current?.close();
            ref?.current?.center();
            // ref?.current?.maxi
            // console.log('ref', ref?.current)
        }
    });

    return(
        <Dialog
            title={props.title}
            style={{
                width: panelWidth,
                height: panelHeight,
                ...props?.style
            }}
            ref={ref}
            className={'panel-window'}
            resizable={false}
            onOpen={onOpen}
            collapsible

        >
            {
                props?.children
            }
        </Dialog>
    )
});

export default CustomDialog;
