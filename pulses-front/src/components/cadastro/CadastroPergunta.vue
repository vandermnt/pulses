<template>
  <div class="col-sm-12">
    <div class="col-sm-3">
      <h2>Criar Pergunta</h2>
    </div>
    <form class="form">
      <div class="form-group">
        <label>Texto Pergunta * </label>
        <input
          v-model="textQuestion"
          type="text"
          class="form-control"
          placeholder="Digite o texto da pergunta"
        />
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Dimensão * </label>
        <select v-model="dimension" class="form-control">
          <option
            v-for="dimension in dimensions"
            :key="dimension.id"
            :value="dimension.id"
          >
            {{ dimension.dimension }}
          </option>
        </select>
      </div>
      <button @click="submitQuestion" class="btn btn-success buttons-pergunta">
        <b>Salvar</b>
      </button>
      <router-link tag="button" to="/" class="btn btn-primary buttons-pergunta"
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
      dimensions: null,
      textQuestion: "",
    };
  },
  mounted() {
    axios.get("http://127.0.0.1:8000/api/dimension").then((response) => {
      this.dimensions = response.data.dimensions;
    });
  },
  methods: {
    submitQuestion(e) {
      e.preventDefault();
      if (!this.dimension || !this.textQuestion) {
        alert("Prencha os campos que obrigatórios!");
        return;
      }

      const data = {
        text_question: this.textQuestion,
        dimension: this.dimension,
      };

      axios
        .post("http://127.0.0.1:8000/api/save-question", data)
        .then((response) => {
          alert("Pergunta cadastrada com sucesso!");
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