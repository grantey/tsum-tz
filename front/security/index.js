import config from '../config'

export default {
    isGranted (role) {
    	if (config.roles !== null) {
    		return config.roles.includes(role)	
    	} else {
    		return true;
    	}   
    }
}