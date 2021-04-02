<template>
  <div class="col-sm-12">
    <div id="nav" class="row">
      <div class="col-sm-1">
        <h2>Tarefas</h2>
      </div>
      <div class="col-sm-11">
        <router-link tag="button" class="btn btn-light" to="/dimensao"
          >Dimensões</router-link
        >
        <router-link
          tag="button"
          class="btn btn-primary"
          to="/cadastro-pergunta"
          >+ Criar Pergunta</router-link
        >
      </div>
    </div>
    <div class="container">
      <h4>Filtro:</h4>
      <select
        @change="filterDimension"
        v-model="dimension"
        class="form-control dimension"
      >
        <option :value="null">Selecione</option>
        <option
          v-for="dimension in dimensions"
          :key="dimension.id"
          :value="dimension.id"
        >
          {{ dimension.dimension }}
        </option>
      </select>
      <h4 for="Filtro"></h4>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Status</th>
            <th scope="coltd ">Pergunta</th>
            <th scope="col">Dimensão</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr :key="question.id" v-for="question in questions_filter">
            <td
              class="status"
              v-if="question.status"
              @click="
                question.status = 0;
                alteraStatus(question.id, 0);
              "
            >
              <i class="fas fa-check-circle"></i>
            </td>
            <td
              class="status"
              v-else
              @click="
                question.status = 1;
                alteraStatus(question.id, 1);
              "
            >
              <i class="fas fa-times"></i>
            </td>
            <td>{{ question.text_question }}</td>
            <td>{{ question.dimension }}</td>
            <td>
              <button
                type="button"
                @click="
                  editQuestion(
                    question.id,
                    question.text_question,
                    question.id_dimension
                  )
                "
                class="btn btn-primary"
              >
                <b>Editar</b>
                <i class="fas fa-pen"></i>
              </button>
              <button
                type="button"
                @click="deleteQuestion(question.id)"
                class="btn btn-danger"
              >
                <b>Excluir</b>
                <i class="far fa-trash-alt"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="showModal" @close="showModal = false">
      <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Confirmação Exclusão</h5>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span aria-hidden="true" @click="showModal = false"
                      >&times;</span
                    >
                  </button>
                </div>
                <div class="modal-body">
                  <p>Deseja realizar essa ação?</p>
                </div>
                <div class="modal-footer">
                  <button
                    @click="showModal = false"
                    type="button"
                    class="btn btn-secondary"
                  >
                    <b>Não</b>
                  </button>
                  <button @click="request" type="button" class="btn btn-danger">
                    <b>Sim</b>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Tarefa",
  data() {
    return {
      questions_filter: null,
      questions: null,
      dimension: null,
      dimensions: null,
      filtro_dimensions: null,
      showModal: false,
      id: null,
      status: null,
    };
  },
  mounted() {
    axios.get("http://127.0.0.1:8000/api/question").then((response) => {
      this.questions = response.data.questions;
      this.questions_filter = this.questions;
    });

    axios.get("http://127.0.0.1:8000/api/dimension").then((response) => {
      this.dimensions = response.data.dimensions;
    });
  },
  methods: {
    filterDimension() {
      if (this.dimension === null) {
        this.$nextTick(() => {
          this.questions_filter = this.questions
        });
        return;
      }

      let filtro_dimensions = this.questions.filter((question) => {
        return question.id_dimension == this.dimension;
      });

      this.$nextTick(() => {
        this.questions_filter = filtro_dimensions;
      });
    },
    request() {
      this.showModal = false;
      console.log(this.id);
      axios
        .delete(`http://127.0.0.1:8000/api/delete-question/${this.id}`)
        .then((response) => {
          this.questions_filter = response.data.questions;
        })
        .catch((error) => {
          this.errorMessage = error.message;
          console.error("Ocorreu um erro! ", error);
        });
    },
    deleteQuestion(id) {
      this.showModal = true;
      this.id = id;
    },
    editQuestion(id, text_question, id_dimension) {
      this.id_question = id;
      this.$router.push({
        name: "EditarPergunta",
        params: {
          id,
          text_question,
          id_dimension,
          dimensions: this.dimensions,
        },
      });
    },
    alteraStatus(id, status) {
      const data = {
        id,
        status,
      };

      axios
        .put(`http://127.0.0.1:8000/api/update-status`, data)
        .then((response) => {
          console.log("Status Alterado!");
        })
        .catch((error) => {
          this.errorMessage = error.message;
          console.error("Ocorreu um erro! ", error);
        });
    },
  },
};
</script>

<style lang="scss">
.container {
  align-content: center;
  justify-content: center;
  background-color: white;
  padding: 30px;
  max-height: 400px;
  border: 1px solid;
  border-radius: 10px;
  text-overflow: ellipsis;
  overflow: auto;
}

h4 {
  text-align: left;
}

table .status:hover {
  cursor: pointer !important;
}

.dimension {
  width: 50%;
  margin-bottom: 50px;
}

button {
  font-weight: bolder;
  margin: 0 3px;
}

.fa-check-circle {
  color: green;
}

.fa-times {
  color: red;
}

.table td {
  vertical-align: auto !important;
}

table {
  margin-bottom: 30px;
}

#nav {
  padding: 30px;
  text-align: right;
  button {
    margin-right: 5px;
  }
  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
