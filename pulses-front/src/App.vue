<template>
  <div id="app">
    <div>
      <router-link
        tag="button"
        to="/"
        class="btn btn-primary buttons-pergunta"
        >Tarefas</router-link
      >
       <router-link
        tag="button"
        to="/dimensao"
        class="btn btn-primary buttons-pergunta"
        >Dimensões</router-link
      >
    </div>
    <router-view />
  </div>
</template>

<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");
#app {
  font-family: "Poppins", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  height: 100px;
  padding: 30px 110px;
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

button {
  font-weight: bolder;
  border-radius: 5px;
}
</style>
