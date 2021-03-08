/*global process*/
export default function ({ store, redirect }) {
    store.$axios.interceptors.response.use(
        (response) => {
            store.commit('global/END_LOADING');

            return response;
        }, (error) => {
            store.commit('global/END_LOADING');
            if(error.response.status===401){
                // TODO user not logged
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