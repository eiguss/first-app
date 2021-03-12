/*global process*/
export const state = () => ({
    email: '',
    name: '',
});

export const getters = {
    email: state => state.email,
    name: state => state.name,
};

export const mutations = {
    SET_USER(state, user) {
        state.email = user.email;
        state.name = user.name;
    },
};

export const actions = {
    async getUser({ commit }) {
        return await this.$axios.get(
            'api/user'
        ).then(response => { 
            commit('SET_USER', response.data.user_info);
        });
    },
    async isLoggedUser({ commit }) {
        return await this.$axios.get(
            'api/user/is-logged'
        ).then(response => { 
            return response.data.isLogged;
        });
    },
    async login({}, user) {
        return await this.$axios.post(
            'api/user/login', {
                email: user.email,
                password: user.password,
            }
        ).then(() => {
            return true;
        }).catch(() => {
            return false;
        });
    },
    async logout() {
        return await this.$axios.post(
            'api/user/logout'
        ).then(() => {
            return true;
        }).catch(() => {
            return false;
        });
    },
};