export const state = () => ({
    email: '',
    name: '',
    token: '',
    locale: 'en',
    acronym: '',
    role: '',
    rights: [],
});

export const getters = {
    email: state => state.email,
    name: state => state.name,
    locale: state => state.locale,
    acronym: state => state.acronym,
    role: state => state.role,
    rights: state => state.rights,
};

export const mutations = {
    SET_USER(state, user) {
        state.email = user.email;
        state.name = user.name;
        state.locale = user.locale;
        state.role = user.role;
        state.rights = user.rights;

        let fullName = state.name.split(' ');
        state.acronym = fullName[0].charAt(0).toUpperCase();
        if(fullName[1]){
            state.acronym += fullName[1].charAt(0).toUpperCase();
        }
        this.$i18n.locale = state.locale;
    },
    RESET_USER(state){
        state.email = '';
        state.name = '';
        state.token = '';
        state.locale = 'en';
        state.acronym = '';
        state.role = '';
        state.rights = [];
    },
    SET_TOKEN(state, token) {
        state.token = token;
    },
};

export const actions = {
    async getUser({ commit }) {
        return await this.$axios.get(
            'api/logged-user'
        ).then(response => { 
            commit('SET_USER', response.data.user_info);
            commit('SET_TOKEN', response.data.token);
        });
    },
    async isLoggedUser({ commit }) {
        return await this.$axios.get(
            'api/logged-user/is-logged'
        ).then(response => {
            commit('SET_TOKEN', response.data.token);
            return response.data.isLogged;
        });
    },
    async login({state}, user) {
        return await this.$axios.post(
            'api/logged-user/login', {
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
    async logout({ commit }) {
        return await this.$axios.post(
            'api/logged-user/logout'
        ).then(() => {
            commit('RESET_USER');
            this.$router.push('/login');
            return true;
        }).catch(() => {
            return false;
        });
    },
};