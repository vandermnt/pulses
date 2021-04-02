<template>
  <div class="col-sm-12">
    <div class="col-sm-3">
      <h2>Editar Dimensão</h2>
    </div>
    <form class="form">
      <div class="form-group">
        <label>Nome dimensão * </label>
        <input
          v-model="dimension"
          type="text"
          class="form-control"
          placeholder="Digite o texto da pergunta"
        /><br />
      </div>
      <button @click="saveDimension" class="btn btn-success buttons">
        <b>Salvar</b>
      </button>
      <router-link tag="button" to="/dimensao" class="btn btn-primary buttons"
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
      id_dimension: null,
      dimension: null,
    };
  },
  mounted() {
    this.id_dimension = this.$route.params.id;
    this.dimension = this.$route.params.dimension;
  },
  methods: {
    saveDimension(e) {
      e.preventDefault();

      const data = {
        id_dimension: this.id_dimension,
        dimension: this.dimension,
      };
      console.log(data);
      axios
        .put("http://127.0.0.1:8000/api/update-dimension", data)
        .then((response) => {
          alert("Dimensão editada com sucesso!");
          this.$router.push("/");
          console.log(response.status);
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
