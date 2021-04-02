<template>
  <div class="col-sm-12">
    <div class="col-sm-3">
      <h2>Editar Pergunta</h2>
    </div>
    <form class="form">
      <div class="form-group">
        <label>Texto Pergunta * </label>
        <input
          v-model="text_question"
          type="text"
          class="form-control"
          placeholder="Digite o texto da pergunta"
        /><br />
        <label>Dimensão:</label>
        <select v-model="selected" class="form-control dimension">
          <option
            v-for="dimension in dimensions"
            :key="dimension.id"
            :value="dimension.id"
          >
            {{ dimension.dimension }}
          </option>
        </select>
      </div>
      <button @click="saveQuestion" class="btn btn-success buttons-pergunta">
        Salvar
      </button>
      <router-link tag="button" to="/" class="btn btn-primary buttons-pergunta"
        >Cancelar</router-link
      >
    </form>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      id_question: null,
      id_dimension: null,
      text_question: null,
      dimensions: null,
      selected: null,
    };
  },
  mounted() {
    this.id_question = this.$route.params.id;
    this.id_dimension = this.$route.params.id_dimension;
    this.text_question = this.$route.params.text_question;
    this.dimensions = this.$route.params.dimensions;

    for (let index in this.dimensions) {
      if (this.dimensions[index].id === this.id_dimension) {
        this.selected = this.dimensions[index].id;
        return;
      }
    }
    console.log(typeof this.dimensions);
  },
  methods: {
    saveQuestion(e) {
      e.preventDefault();

      const data = {
        text_question: this.text_question,
        id_dimension: this.selected,
        id_question: this.id_question,
      };

      axios
        .put("http://127.0.0.1:8000/api/update-question", data)
        .then((response) => {
          alert("Pergunta editada com sucesso!");
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
    @import '../../assets/styles/form.css';
</style>