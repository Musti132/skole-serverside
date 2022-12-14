import { createRouter, createWebHistory} from 'vue-router'

import Home from './pages/Home.vue';
import Channels from './pages/Channels.vue';
import ChannelRoom from './pages/ChannelRoom.vue';
import ChannelRoomAi from './pages/ChannelRoomAi.vue';
import Login from './pages/Login.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        redirect: '/home'
    },
    {
        path: '/home',
        component: Home,
        name: 'HomePage'
    },
    {
        path: '/channels',
        component: Channels,
        name: 'Channels'
    },
    {
        path: '/channel/:roomId',
        component: ChannelRoom,
        name: 'ChannelRoom'
    },
    {
        path: '/channel/ai/:roomId',
        component: ChannelRoomAi,
        name: 'ChannelRoomAi'
    },
    {
        path: '/login',
        component: Login,
        name: 'LoginPage'
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;