import React from "react";

const HeaderDropdownToggle = React.forwardRef((props: any, ref: any) => {
    return (
        <div
            ref={ref}
            className="kt-header__topbar-wrapper"
            onClick={e => {
                e.preventDefault();
                props.onClick(e);
            }}
        >
            {props.children}
        </div>
    );
});

HeaderDropdownToggle.displayName = 'HeaderDropdownToggle';
export default HeaderDropdownToggle;
