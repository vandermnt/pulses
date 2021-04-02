import Vue from "vue";
import VueRouter from "vue-router";
import Tarefas from "../views/Tarefas.vue";
import Dimensao from "../views/Dimension.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Tarefas",
    component: Tarefas,
  },
  {
    path: "/dimensao",
    name: "Dimensao",
    component: Dimensao,
  },
  // {
  //   path: "/dimensao",
  //   name: "Dimensao",
  //   component: () =>
  //     import(/* webpackChunkName: "about" */ "../components/Dimension.vue"),
  // },
  {
    path: "/cadastro-dimensao",
    name: "CadastroDimensao",
    component: () =>
      import("../components/cadastro/CadastroDimensao.vue"),
  },
  {
    path: "/cadastro-pergunta",
    name: "Cadastro",
    component: () =>
      import("../components/cadastro/CadastroPergunta.vue"),
  },
  {
    path: "/editar-pergunta",
    name: "EditarPergunta",
    params: true,
    component: () =>
      import("../components/edicao/EditarPergunta.vue"),
  },
  {
    path: "/editar-dimensao",
    name: "EditarDimensao",
    params: true,
    component: () =>
      import("../components/edicao/EditarDimension.vue"),
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
