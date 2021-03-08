export default {
    server:{
        host:"0.0.0.0"
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
    ],
    loading: '~/components/Loading.vue',
    loadingIndicator: '~/custom-loading.html',
    axios: {
        baseURL: "http://localhost:8080",
    },
    components: true,
    buildModules: [
        '@nuxtjs/vuetify',
    ],
    modules: [
        '@nuxtjs/axios',
    ],
    build: {
        publicPath: '/assets/',
    }
}
