import React, { useEffect } from 'react';
import { LayoutSplashScreen } from '../components/Layout/LayoutContext';

const Dashboard = () => {
    useEffect(() => {
        const basePath = window.location.href.substr(0, window.location.href.lastIndexOf('/gizi'));
        
        window.location.href = basePath + '/dashboard';
    }, []);

    return (
        <LayoutSplashScreen visible={true}/>
    )
}

export default Dashboard;