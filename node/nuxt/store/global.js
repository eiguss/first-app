export const state = () => ({
    loading:0,
    redirectPath:'/',
});

export const getters = {
    loading: state => state.loading>0,
    redirectPath: state => state.redirectPath,
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
    SET_REDIRECT_PATH(state, redirectPath) {
        state.redirectPath=redirectPath;
    },
};

export const actions = {
};
