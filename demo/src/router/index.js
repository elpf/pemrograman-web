import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    name: "home",
    component: () => import("../views/home.vue"),
  },
  {
    path: "/admin",
    name: "admin",
    component: () => import("../views/admin.vue"),
  },
  {
    path: "/admin/books",
    name: "books.index",
    component: () => import("../views/books/index.vue"),
  },
  {
    path: "/admin/books/create",
    name: "books.create",
    component: () => import("../views/books/create.vue"),
  },
  {
    path: "/admin/books/edit/:id",
    name: "books.edit",
    component: () => import("../views/books/edit.vue"),
  },
  {
    path: "/admin/testimonials",
    name: "testimonials.index",
    component: () => import("../views/testimonials/index.vue"),
  },
  {
    path: "/admin/testimonials/create",
    name: "testimonials.create",
    component: () => import("../views/testimonials/create.vue"),
  },
  {
    path: "/admin/testimonials/edit/:id",
    name: "testimonials.edit",
    component: () => import("../views/testimonials/edit.vue"),
  },
  {
    path: "/admin/categories",
    name: "categories.index",
    component: () => import("../views/categories/index.vue"),
  },
  {
    path: "/admin/categories/create",
    name: "categories.create",
    component: () => import("../views/categories/create.vue"),
  },
  {
    path: "/admin/testimonials/edit/:id",
    name: "categories.edit",
    component: () => import("../views/categories/edit.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;