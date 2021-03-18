import RequestUtils from "../utils/request.utils";
const BASE_URL = `${process.env.REACT_APP_SERVICE_ENDPOINT}/api.mersi-hospital/dev/rpb/public`;
// const BASE_URL = `${process.env.REACT_APP_SERVICE_ENDPOINT}/mersi-backend/rpb/public`;


const instance = new RequestUtils(BASE_URL, (header: any) => {
    // header['Authorization'] = 'my-secure-token';
    header['Content-Type'] = 'application/json, text/javascript, */*; q=0.01';
});

export default instance;
