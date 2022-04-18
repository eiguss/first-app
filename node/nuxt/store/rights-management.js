export const state = () => ({
    rights: null,
    headers: [
        { text: 'Name',value: 'name' },
        { text: 'Description', value: 'description', filterable: false },
        { text: 'Actions', value: 'actions', sortable: false, filterable: false },
    ],
    fields: [
        { text: 'Name',value: 'name' },
        { text: 'Description', value: 'description' },
    ],
    defaultNew: {
        name: '',
        description: '',
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
    rights: state => state.rights,
    headers: state => state.headers,
    fields: state => state.fields,
    defaultNew: state => state.defaultNew,
    actions: state => state.actions,
};

export const mutations = {
    SET_RIGHTS(state, rights) {
        state.rights=rights;
    },
};

export const actions = {
    async getRights({ commit }) {
        return await this.$axios.get(
            'api/rights'
        ).then(response => {
            commit('SET_RIGHTS', response.data.rights_info);
        }).catch(() => {
            return false;
        });
    },
};
