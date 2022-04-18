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
        {
            name:'delete',
            icon:'mdi-delete',
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
};
