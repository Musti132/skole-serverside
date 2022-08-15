import axios from 'axios';
const API_URL = 'http://localhost:8000/api/v1/';

class ChannelService {
    getChannel(id) {
        return axios
            .get(API_URL + 'channel/' + id,)
            .then(response => {
                return response.data.data;
            });
    }
    sendMessage(id, message) {
        return axios.post(API_URL + 'channel/' + id, {
            message: message,
        });
    }
}
export default new ChannelService();