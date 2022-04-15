import Vue from 'vue';
import VueI18n from 'vue-i18n';

Vue.use(VueI18n);

export default ({ app, store }) => {
    app.i18n = new VueI18n({
        locale: store.getters['logged-user/locale'],
        fallbackLocale: 'en',
        silentFallbackWarn: true,
        messages: {
            'en': require('~/locales/en.json'),
            'es': require('~/locales/es.json'),
        },
    });

    app.i18n.path = link => {
        if (app.i18n.locale === app.i18n.fallbackLocale) {
            return `/${link}`;
        }

        return `/${app.i18n.locale}/${link}`;
    };
    
    store.$i18n = app.i18n;
};