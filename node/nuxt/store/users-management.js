export const state = () => ({
    users: null,
    headers: [
        { text: 'Name',value: 'name' },
        { text: 'Email', value: 'email' },
        { text: 'Role', value: 'role' },
        { text: 'Language', value: 'language_name' },
        { text: 'Actions', value: 'actions', sortable: false },
    ],
    fields: [
        { text: 'Name',value: 'name' },
        { text: 'Email', value: 'email' },
        { text: 'Role', value: 'role' },
        { text: 'Language', value: 'language_name' },
    ],
    defaultNew: {
        name: '',
        email: '',
        role: '',
        language_name: '',
    },
});

export const getters = {
    users: state => state.users,
    headers: state => state.headers,
    fields: state => state.fields,
    defaultNewUser: state => state.defaultNewUser,
};

export const mutations = {
    SET_USERS(state, users) {
        state.users=users;
    },
};

export const actions = {
    async getUsers({ commit }) {
        return await this.$axios.get(
            'api/users'
        ).then(response => { 
            commit('SET_USERS', response.data.users_info);
        }).catch(() => {
            return false;
        });
    },
};
