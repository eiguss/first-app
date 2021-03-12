/*global process*/
export const state = () => ({
    user: {},
});

export const getters = {
    user: state => state.user,
};

export const mutations = {
    SET_USER(state, user) {
        state.user = user;
    },
};

export const actions = {
    async getUser({ commit }) {
        return await this.$axios.get(
            'api/user'
        ).then(response => { 
            commit('SET_USER', response.data);
        });
    },
    async login({}, user) {
        return await this.$axios.post(
            'api/login', {
                email: user.email,
                password: user.password,
            }
        ).then(() => {
            return true;
        }).catch(() => {
            return false;
        });
    },
};