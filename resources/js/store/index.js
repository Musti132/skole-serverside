import { createStore } from 'vuex';
import { auth } from './auth.module'
import { channel } from './channel.module'

const store = createStore({
    modules: {
        auth,
        channel
    }
});

export default store;
