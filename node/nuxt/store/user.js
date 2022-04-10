export const state = () => ({
    email: '',
    name: '',
    token: '',
    locale: 'en',
    acronym: '',
});

export const getters = {
    email: state => state.email,
    name: state => state.name,
    locale: state => state.locale,
    acronym: state => state.acronym,
};

export const mutations = {
    SET_USER(state, user) {
        state.email = user.email;
        state.name = user.name;
        state.token = user.token;
        state.locale = user.locale;

        let fullName = state.name.split(' ');
        state.acronym = fullName[0].charAt(0).toUpperCase();
        if(fullName[1]){
            state.acronym += fullName[1].charAt(0).toUpperCase();
        }
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
            this.$router.push('/login');
            return true;
        }).catch(() => {
            return false;
        });
    },
};