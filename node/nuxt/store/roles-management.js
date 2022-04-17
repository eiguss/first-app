export const state = () => ({
    roles: null,
    headers: [
        { text: 'Name',value: 'name' },
        { text: 'Description', value: 'description' },
        { text: 'Rights', value: 'rights' },
        { text: 'Actions', value: 'actions', sortable: false },
    ],
    fields: [
        { text: 'Name',value: 'name' },
        { text: 'Description', value: 'description' },
        { text: 'Rights', value: 'rights' },
    ],
    defaultNew: {
        name: '',
        description: '',
        rights: [],
    },
});

export const getters = {
    roles: state => state.roles,
    headers: state => state.headers,
    fields: state => state.fields,
    defaultNew: state => state.defaultNew,
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
