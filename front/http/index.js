import axios from 'axios'
axios.defaults.headers.post['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.get['X-Requested-With'] = 'XMLHttpRequest';

import { BASE_URL } from '../config'

import 'babel-polyfill';

const http = axios.create({
    baseURL: BASE_URL,
    timeout: 10000,
    headers: {  }
})

http.interceptors.response.use(response => response, error => {
    if (error.response.status === 401) {
        document.location.href = BASE_URL + '/logout'
    }

    if (error.response.status === 403) {
        alert('Access denied')
    }

    return Promise.reject(error)
})

export default http