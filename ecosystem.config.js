module.exports = {
    apps: [
        {
            name: 'Gmodern.ir',
            port: 5959,
            exec_mode: 'cluster',
            instances: 'max',
            script: './client/.output/server/index.mjs'
        }
    ]
}
