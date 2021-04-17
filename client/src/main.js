import { createApp } from "vue";
import App from "./App.vue";
import "./registerServiceWorker";
import router from "./router";

import "normalize.css";
import "bootstrap/dist/css/bootstrap.css";
import "./styles/global.css";

createApp(App).use(router).mount("#app");
