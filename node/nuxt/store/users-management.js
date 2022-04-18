export const state = () => ({
    users: null,
    headers: [
        { text: 'Name',value: 'name' },
        { text: 'Email', value: 'email' },
        { text: 'Role', value: 'role', filterable: false },
        { text: 'Language', value: 'language_name', filterable: false },
        { text: 'Actions', value: 'actions', sortable: false, filterable: false },
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
    actions: [
        {
            name:'edit',
            icon:'mdi-pencil',
        },
        {
            name:'disable_enable',
            icon:'mdi-cancel',
            iconEnable:'mdi-check',
        },
    ],
});

export const getters = {
    users: state => state.users,
    headers: state => state.headers,
    fields: state => state.fields,
    defaultNew: state => state.defaultNew,
    actions: state => state.actions,
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
