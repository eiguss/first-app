export const state = () => ({
    visible: false,
    items: [
        { title: 'sidebar.users', icon: 'mdi-account-multiple' },
    ]
});

export const getters = {
    visible: state => state.visible,
    items: state => state.items,
};

export const mutations = {
    TOGGLE_VISIBILITY(state) {
        state.visible = !state.visible;
    },
    SET_VISIBILITY(state, visibility) {
        state.visible = visibility;
    },
};

export const actions = {};