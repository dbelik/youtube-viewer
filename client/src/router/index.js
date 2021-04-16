import { createRouter, createWebHistory } from "vue-router";
import List from "../views/List.vue";

const routes = [
  {
    path: "/",
    name: "List",
    component: List,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
