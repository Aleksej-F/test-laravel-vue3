import "./bootstrap";

import { createApp } from "vue";
import { createPinia } from "pinia";

import "./app.scss";

import App from "./App.vue";
import router from "./src/router";

const app = createApp(App);
app.use(router);
app.use(createPinia());

app.mount("#app");


