export const state = () => ({
    rights: null,
    headers: [
        { text: 'Name',value: 'name' },
        { text: 'Description', value: 'description' },
        { text: 'Actions', value: 'actions', sortable: false },
    ],
    fields: [
        { text: 'Name',value: 'name' },
        { text: 'Description', value: 'description' },
    ],
    defaultNew: {
        name: '',
        description: '',
    },
});

export const getters = {
    rights: state => state.rights,
    headers: state => state.headers,
    fields: state => state.fields,
    defaultNew: state => state.defaultNew,
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
