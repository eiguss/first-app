export default {
    server:{
        host:'0.0.0.0'
    },
    srcDir: 'nuxt/',
    ssr: false,
    target: 'static',
    head: {
        title: 'nginx slim php and nuxt',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        ],
        link: [
            { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
        ]
    },
    css: [
    ],
    plugins: [
        '~/plugins/axios.js',
        '~/plugins/i18n.js',
    ],
    loading: '~/components/Loading.vue',
    loadingIndicator: '~/custom-loading.html',
    components: true,
    axios: {
        baseURL: '/',
    },
    buildModules: [
        '@nuxtjs/vuetify',
    ],
    modules: [
        '@nuxtjs/axios',
    ],
    build: {
        publicPath: '/assets/',
    },
    router: {
        extendRoutes (routes) {
            routes.push(
                {
                    name: 'page404',
                    path: '*',
                    component: '~/components/page-404.vue'
                }
            );
        }
    },
    watchers: {
        webpack: {
            poll: true
        }
    }
};
