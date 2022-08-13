import axios from 'axios';
const API_URL = 'http://localhost:8000/api/v1/auth/';
class AuthService {
    login(user) {
        return axios
            .post(API_URL + 'login', {
                email: user.email,
                password: user.password
            })
            .then(response => {
                if (response.data.token) {
                    localStorage.setItem('token', response.data.token);
                    localStorage.setItem('user', JSON.stringify(response.data.user));
                }
                return response.data;
            });
    }
    logout() {
        localStorage.removeItem('user');
        localStorage.removeItem('token');
    }
    register(user) {
        return axios.post(API_URL + 'register', {
            username: user.username,
            email: user.email,
            password: user.password
        });
    }
}
export default new AuthService();