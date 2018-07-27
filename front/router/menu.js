import security from '../security'
import items from './items'

const appendMeta = (item) => {
    const granted = item.meta.roles === undefined ? true : item.meta.roles.some(role => security.isGranted(role))

    const meta = Object.assign({}, item.meta, { granted })

    const children = (item.children || []).map(child => appendMeta(child))

    return Object.assign({}, item, { meta, children })
};

const collected = items.map(item => appendMeta(item));

const generateRoutesFromMenu = (items, routes = []) => {
    for (const item of items) {
        if (item.path !== null) {
            routes.push(Object.assign({}, item, { path: item.path, children: [] }))
        }
        if (item.children) {
            generateRoutesFromMenu(item.children, routes)
        }
    }

    return routes
};

export const menu = [].concat(...collected);

export const generateRoutes = () => generateRoutesFromMenu(menu);