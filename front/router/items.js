import Index from '../components/pages/Index.vue'
import Warehouse from '../components/pages/Warehouse.vue'

import { BASE_URL } from '../config';

export default [
    {
        name: 'site_index',
        path: BASE_URL + '/',
        component: Index,
        meta: {
            label: 'Отгрузка продукции',
            roles: ['ROLE_CLIENT']
        }
    },
    {
        name: 'site_warehouse',
        path: BASE_URL + '/warehouse',
        component: Warehouse,
        meta: {
            label: 'Учёт продукции',
            roles: ['ROLE_CLIENT']
        }
    },
]