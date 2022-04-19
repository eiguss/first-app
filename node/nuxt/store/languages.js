export const state = () => ({
    languages: null,
});

export const getters = {
    languages: state => state.languages,
    languageById: state => id => {
        let language = null;
        state.languages.forEach(element => {
            if(element.id===id){
                language=element;
            }
        });
        return language;
    }
};

export const mutations = {
    SET_LANGUAGES(state, languages) {
        state.languages=languages;
    },
};

export const actions = {
    async getLanguages({ commit }) {
        // return await this.$axios.get(
        //     'api/languages'
        // ).then(response => {
            let response = {data:{languages_info: [
                {
                    'id': 1,
                    'name': 'english',
                    'isoCode': 'en',
                },
                {
                    'id': 2,
                    'name': 'spanish',
                    'isoCode': 'es',
                },
            ]}}
            commit('SET_LANGUAGES', response.data.languages_info);
        // }).catch(() => {
        //     return false;
        // });
    },
};
