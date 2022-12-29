// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    rootDir: './client',
    typescript: {
        strict: true,
        shim: false
    },
    modules: [
        // ...
        '@pinia/nuxt',
        '@vueuse/nuxt',
        '@nuxtjs/tailwindcss',
        '@nuxtjs/color-mode',
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
    publicRuntimeConfig: {
        API_URL: process.env.API_URL,
    },
    app: {
        head: {

            titleTemplate: '%s Gmodern | جی مدرن',
            meta: [
                {
                    name: 'viewport',
                    content: 'width=device-width, initial-scale=1',
                },
                {
                    hid: 'description',
                    name: 'description',
                    content: 'best app',
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
