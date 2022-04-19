export const state = () => ({
    users: null,
    headers: [
        { text: 'Name',value: 'name' },
        { text: 'Email', value: 'email' },
        { text: 'Role', value: 'role_name', filterable: false },
        { text: 'Language', value: 'language_name', filterable: false },
        { text: 'Active', value: 'active', filterable: false },
        { text: 'Actions', value: 'actions', sortable: false, filterable: false },
    ],
    editableFields: [
        { text: 'Name', value: 'name' },
        { text: 'Email', value: 'email' },
        { text: 'Role', value: 'role_name', type:'dropdown', key:'role_id', dataKey: 'roles'},
        { text: 'Language', value: 'language_name', type:'dropdown', key:'language_id', dataKey: 'languages' },
    ],
    defaultNew: {
        name: '',
        email: '',
        role_name: '',
        role_id: '',
        language_name: '',
        language_id: '',
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
    users: state => {
        state.users.forEach( (user, index) => {
            user['language_name'] = user['language']['name'];
            user['language_id'] = user['language']['id'];
            user['role_name'] = user['role']['name'];
            user['role_id'] = user['role']['id'];
            state.users[index] = user;
        });
        return state.users;
    },
    headers: state => state.headers,
    editableFields: state => state.editableFields,
    defaultNew: state => state.defaultNew,
    actions: state => state.actions,
    data: (_state, _getters, _rootState, rootGetters) => {
        return {
            'roles': {
                textKey: 'name',
                valueKey: 'id',
                items: rootGetters["roles-management/roles"],
            },
            'languages': {
                textKey: 'name',
                valueKey: 'id',
                items: rootGetters["languages/languages"],
            },
        };
    },
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
