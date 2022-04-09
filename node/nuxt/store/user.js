export const state = () => ({
    email: '',
    name: '',
    token: '',
    locale: 'es',
});

export const getters = {
    email: state => state.email,
    name: state => state.name,
    locale: state => state.locale,
};

export const mutations = {
    SET_USER(state, user) {
        state.email = user.email;
        state.name = user.name;
        state.token = user.token;
        state.locale = user.locale;

        this.$i18n.locale = state.locale;
    },
    SET_TOKEN(state, token) {
        state.token = token;
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
            commit('SET_TOKEN', response.data.token);

            return response.data.isLogged;
        });
    },
    async login({state}, user) {
        return await this.$axios.post(
            'api/user/login', {
                email: user.email,
                password: user.password,
                token: state.token,
            }
        ).then(() => {
            return true;
        }).catch((error) => {
            if(error.response.status===403){
                // if invalid csrf token, reload
                window.location.reload(true);
            }

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