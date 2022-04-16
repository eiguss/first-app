export const state = () => ({
    users: null,
    headers: [
        { text: 'Name',value: 'name' },
        { text: 'Email', value: 'email' },
        { text: 'Role', value: 'role' },
        { text: 'Language', value: 'language_name' },
        { text: 'Creation date', value: 'creation_date' },
        { text: 'Actions', value: 'actions', sortable: false },
    ],

});

export const getters = {
    users: state => state.users,
    headers: state => state.headers,
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
        });
    },
};
