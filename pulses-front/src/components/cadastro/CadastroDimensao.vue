<template>
  <div class="col-sm-12">
    <div class="col-sm-3">
      <h2>Criar Dimensão</h2>
    </div>
    <form class="form">
      <div class="form-group">
        <label>Texto Dimensão * </label>
        <input
          v-model="dimension"
          type="text"
          class="form-control"
          placeholder="Digite a dimensão"
        />
      </div>
      <button @click="submitDimension" class="btn btn-success buttons-pergunta">
        <b>Salvar</b>
      </button>
      <router-link
        tag="button"
        to="/dimensao"
        class="btn btn-primary buttons-pergunta"
        ><b>Cancelar</b></router-link
      >
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      dimension: "",
    };
  },
  methods: {
    submitDimension(e) {
      e.preventDefault();
      if (!this.dimension) {
        alert("Prencha os campos que obrigatórios!");
        return;
      }

      const data = {
        dimension: this.dimension,
      };

      axios
        .post("http://127.0.0.1:8000/api/save-dimension", data)
        .then((response) => {
          alert("Dimensão cadastrada com sucesso!");
          this.$router.push("/dimensao");
        })
        .catch((error) => {
          this.errorMessage = error.message;
          console.error("Ocorreu um erro! ", error);
        });
    },
  },
};
</script>

<style>
@import "../../assets/styles/form.css";
</style>