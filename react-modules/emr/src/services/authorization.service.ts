import request from './api.service';
import { plainToClass } from 'class-transformer';
import listUser from "../pojo/User";

const slug = '/login_login';

interface login {
    nik: string;
    password: string;
}
const login = async (data: login): Promise<listUser> => {
    const resp = await request.post(`${slug}/login`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listUser, resp);
};

export default {
    login,
}
