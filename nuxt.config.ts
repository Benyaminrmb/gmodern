// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    rootDir: './client',
    typescript: {
        strict: true,
        shim: false
    },
    runtimeConfig: {
        // Private keys are only available on the server
        apiSecret: '123',
        // Public keys that are exposed to the client
        public: {
            apiBase: process.env.API_URL || '/api'
        },
        apiUrl: 'http://localhost:8000'
    },
    modules: [
        // ...
        '@pinia/nuxt',
        '@vueuse/nuxt',
        '@nuxtjs/tailwindcss',
        '@nuxtjs/color-mode',
        '@vueuse/nuxt',

    ],
    build: {
        transpile: ['@headlessui/vue'],
    },
    colorMode: {
        preference: 'system', // default theme
        dataValue: 'theme', // activate data-theme in <html> tag
        classSuffix: '',
    },
    tailwindcss: {
        configPath: './tailwind.config.ts',
        exposeConfig: false,
        config: {},
        injectPosition: 0,
        viewer: true,
    },

    app: {
        head: {

            titleTemplate: '%s Gmodern | جی مدرن',
            "og:titleTemplate": '%s Gmodern | جی مدرن',
            meta: [
                {
                    name: 'viewport',
                    content: 'width=device-width, initial-scale=1',
                },


            ],
            link: [{rel: 'icon', type: 'image/x-icon', href: '/favicon.ico'}],
        },
    },
    // css
    css: [
        '~/assets/sass/app.scss',
    ],
})
