import _ from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios;

import dayjs from 'dayjs'
window.dayjs = dayjs
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
