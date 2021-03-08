export const state = () => ({
    loading:0,
});

export const getters = {
    loading: state => state.loading>0,
};

export const mutations = {
    START_LOADING(state) {
        ++state.loading;
    },
    END_LOADING(state) {
        if(state.loading > 0) {
            --state.loading;
        }
    },
};

export const actions = {
};
