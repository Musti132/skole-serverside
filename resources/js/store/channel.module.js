import ChannelService from '../services/channel.service';

const initialState = {
    channel: [],
}
    
export const channel = {
    namespaced: true,
    state: initialState,
    actions: {
        getChannelRoom({ commit }, id) {
            return ChannelService.getChannel(id).then(
                channel => {
                    commit('getChannelSuccess', channel);
                    return Promise.resolve(channel);
                },
                error => {
                    commit('getChannelFailure');
                    return Promise.reject(error);
                }
            );
        },
        sendMessage({ commit }, payload) {
            return ChannelService.sendMessage(payload.id, payload.message).then(
                channel => {
                    return Promise.resolve(channel);
                }
            );
        }
    },
    mutations: {
        getChannelSuccess(state, channel) {
            state.channel = channel;
        },
        getChannelFailure(state) {
            state.channel = null;
        },
    },

    getters: {
        getChannel(state) {
            return state.channel;
        }
    }
};