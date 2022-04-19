export const state = () => ({
    rights: null,
    headers: [
        { text: 'Name',value: 'name' },
        { text: 'Description', value: 'description', filterable: false },
        { text: 'Actions', value: 'actions', sortable: false, filterable: false },
    ],
    editableFields: [
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
    ],
});

export const getters = {
    rights: state => state.rights,
    headers: state => state.headers,
    editableFields: state => state.editableFields,
    defaultNew: state => state.defaultNew,
    actions: state => state.actions,
};

export const mutations = {
    SET_RIGHTS(state, rights) {
        state.rights=rights;
    },
    SET_RIGHT(state, right) {
        state.rights.push(right);
    },
    EDIT_RIGHT(state, {right, index}) {
        Object.assign(state.rights[index], right);
    }
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
    async addRight({ commit, state }, right) {
        // return await this.$axios.post(
        //     'api/rights', right
        // ).then(response => {
            // let id = response.data.id;
            let id = state.rights.length+1;
            right.id = id;
            commit('SET_RIGHT', right);
        // }).catch(() => {
        //     return false;
        // });
    },
    async editRight({ commit }, {right, index}) {
        // return await this.$axios.post(
        //     'api/rights/'+right.id, right
        // ).then(response => {
            commit('EDIT_RIGHT', { right: right, index: index });
        // }).catch(() => {
        //     return false;
        // });
    },
};
