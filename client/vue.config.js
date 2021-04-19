module.exports = {
    devServer: {
        proxy: process.env.SERVER_HOST
    },
    pwa: {
        manifestOptions: {
            name: 'Youtube viewer',
            start_url: "./",
            themeColor: "#cc0000",
            backgroundColor: "#f1f1f1",
            icons: [{
              src: "/img/icons/youtube-viewer.svg",
              sizes: "512x512",
              type: "image/svg+xml",
              purpose: "any maskable",
            }]
        }
    }
}