export const state = () => ({
    roles: null,
    headers: [
        { text: 'Name',value: 'name' },
        { text: 'Description', value: 'description', filterable: false },
        { text: 'Rights', value: 'rights_string', filterable: false },
        { text: 'Actions', value: 'actions', sortable: false, filterable: false },
    ],
    fields: [
        { text: 'Name',value: 'name' },
        { text: 'Description', value: 'description' },
        { text: 'Rights', value: 'rights_string' },
    ],
    defaultNew: {
        name: '',
        description: '',
        rights_string: '',
    },
    actions: [
        {
            name:'edit',
            icon:'mdi-pencil',
        },
    ],
});

export const getters = {
    roles: state => state.roles,
    headers: state => state.headers,
    fields: state => state.fields,
    defaultNew: state => state.defaultNew,
    actions: state => state.actions,
};

export const mutations = {
    SET_ROLES(state, roles) {
        state.roles=roles;
    },
    SET_ROLE(state, role) {
        state.roles.push(role);
    },
    EDIT_ROLE(state, {role, index}) {
        Object.assign(state.roles[index], role);
    }
};

export const actions = {
    async getRoles({ commit }) {
        return await this.$axios.get(
            'api/roles'
        ).then(response => { 
            commit('SET_ROLES', response.data.roles_info);
        }).catch(() => {
            return false;
        });
    },
    async addRole({ commit, state }, role) {
        // return await this.$axios.post(
        //     'api/roles', role
        // ).then(response => {
            // let id = response.data.id;
            let id = state.roles.length+1;
            role.id = id;
            commit('SET_ROLE', role);
        // }).catch(() => {
        //     return false;
        // });
    },
    async editRole({ commit }, {role, index}) {
        // return await this.$axios.post(
        //     'api/roles/'+role.id, role
        // ).then(response => {
            commit('EDIT_ROLE', { role: role, index: index });
        // }).catch(() => {
        //     return false;
        // });
    },
};
