<template>
  <div class="col-sm-12">
    <div id="nav" class="row">
      <div class="col-sm-1">
        <h2>Dimensões</h2>
      </div>
      <div class="col-sm-11">
        <router-link
          tag="button"
          class="btn btn-primary"
          to="/cadastro-dimensao"
          >+ Criar Dimensão</router-link
        >
      </div>
    </div>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Dimensão</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr :key="dimension.id" v-for="dimension in dimensions">
            <td>{{ dimension.dimension }}</td>
            <td>
              <button
                type="button"
                @click="editDimension(dimension.id, dimension.dimension)"
                class="btn btn-primary"
              >
                <b>Editar</b>
                <i class="fas fa-pen"></i>
              </button>
              <button
                @click="deleteDimension(dimension.id)"
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
  data() {
    return {
      dimensions: null,
      showModal: false,
      id: null,
    };
  },
  mounted() {
    axios.get("http://127.0.0.1:8000/api/dimension").then((response) => {
      this.dimensions = response.data.dimensions;
    });
  },
  methods: {
    request() {
      this.showModal = false;
      axios
        .delete(`http://127.0.0.1:8000/api/delete-dimension/${this.id}`)
        .then((response) => {
          this.dimensions = response.data.dimensions;
        })
        .catch((error) => {
          this.errorMessage = error.message;
          console.error("Ocorreu um erro! ", error);
          alert(
            "Não foi possível excluir sua dimensão, pois há perguntas vinculadas a ela!"
          );
        });
    },
    editDimension(id, dimension) {
      this.$router.push({
        name: "EditarDimensao",
        params: {
          id,
          dimension,
        },
      });
    },
    deleteDimension(id) {
      this.showModal = true;
      this.id = id;
    },
  },
};
</script>

<style lang="scss">
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(92, 47, 47, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
</style>
