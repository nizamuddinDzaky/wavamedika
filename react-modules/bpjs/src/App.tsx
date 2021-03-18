import React from 'react';
import AppRouter from "./AppRouter";
import {BrowserRouter} from "react-router-dom";
import {Provider} from "react-redux";
import { LastLocationProvider } from "react-router-last-location";
import {PersistGate} from "redux-persist/integration/react";
import {LayoutSplashScreen} from "./components/Layout/LayoutContext";

const getBasename = (path: string) => {
    if(path.includes('/bpjs')) {
        return path.substr(0, path.lastIndexOf('/bpjs'))
    } else if(path.includes('/error')) {
        return path.substr(0, path.lastIndexOf('/error'))
    } else if(path.includes('/auth')) {
        return path.substr(0, path.lastIndexOf('/auth'))
    } else {
        return path.substr(0, path.lastIndexOf('/'))
    }
};

const App: React.FC<any> = ({store, persistor}: any) => {
  return (
      <Provider store={store}
                // loading={<LayoutSplashScreen/>}
      >
          <PersistGate persistor={persistor}>
              <React.Suspense fallback={<LayoutSplashScreen />}>
                  <BrowserRouter basename={getBasename(window.location.pathname)}>
                      <LastLocationProvider>
                        <AppRouter />
                      </LastLocationProvider>
                  </BrowserRouter>
              </React.Suspense>
          </PersistGate>
      </Provider>
  );
}

export default App;
