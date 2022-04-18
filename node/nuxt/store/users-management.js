export const state = () => ({
    users: null,
    headers: [
        { text: 'Name',value: 'name' },
        { text: 'Email', value: 'email' },
        { text: 'Role', value: 'role', filterable: false },
        { text: 'Language', value: 'language_name', filterable: false },
        { text: 'Active', value: 'active', filterable: false },
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
        active: true,
    },
    actions: [
        {
            name:'edit',
            icon:'mdi-pencil',
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
    SET_USER(state, user) {
        state.users.push(user);
    },
    EDIT_USER(state, {user, index}) {
        Object.assign(state.users[index], user);
    }
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
    async addUser({ commit, state }, user) {
        // return await this.$axios.post(
        //     'api/users', user
        // ).then(response => {
            // let id = response.data.id;
            let id = state.users.length+1;
            user.id = id;
            commit('SET_USER', user);
        // }).catch(() => {
        //     return false;
        // });
    },
    async editUser({ commit }, {user, index}) {
        // return await this.$axios.post(
        //     'api/users/'+user.id, user
        // ).then(response => {
            commit('EDIT_USER', { user: user, index: index });
        // }).catch(() => {
        //     return false;
        // });
    },
};
