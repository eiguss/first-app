export default function ({ store, route }) {
    store.$axios.interceptors.response.use(
        (response) => {
            store.commit('global/END_LOADING');

            return response;
        }, (error) => {
            store.commit('global/END_LOADING');
            // If 401, user not logged in, redirect to login page
            if(error.response.status===401){
                store.commit('global/SET_REDIRECT_PATH', route.path);
                store.$router.push('/login');
            }else if(error.response.status===403){
                // TODO redirect to unathorized
            }

            return Promise.reject(error);
        }
    );

    store.$axios.interceptors.request.use(
        (request) => {
            store.commit('global/START_LOADING');

            return request;
        }
    );
}