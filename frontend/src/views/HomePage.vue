<script setup lang="ts">
import HeaderSection from '@/components/HeaderSection.vue'
import DiscordLogo from '@/components/DiscordLogo.vue'

import axios from 'axios'
</script>

<script lang="ts">

export default {
  data() {
      return {
          isConnected: false,
          username: "",
          numberTotalOfQuestions: null,
          numberOfQuestionSelected: 10,
      }
  },
  methods: {

    ifIsConnected(result){
      this.isConnected = result;
      this.$emit('isConnected', result);
    },

    ifIsUsername(result){
      this.username = result;
      this.$emit('username', result);
    },

    handleClick() {
    this.$router.push({
      name: "game",
      params: {
        numberOfQuestionSelected: this.numberOfQuestionSelected,
      }
    });
      // let data = {
      //   id: 25,
      //   numberOfQuestionSelected: this.numberOfQuestionSelected,
      // };
      
      // this.$router.push({
      //   name: "game",
      //   params: {data}
      // })
    }
  },
  mounted() {
    axios.get('http://localhost/trivia_v0.1/backend/numberOfQuestions')
    .then(response => {
      this.numberTotalOfQuestions = response.data;
    })
    .catch(error => (console.log(error)))
  }
}
</script>


<template>
    <section>
      <HeaderSection @is-connected="ifIsConnected" @username="ifIsUsername" />
      <main id="game" v-if="isConnected">
        <h2>Welcome back {{this.username}} !</h2>

        <button @click="handleClick">Rejoindre une partie</button>

        <form>
          <label>Nombre de questions (default on 10)</label>
          <select v-model="numberOfQuestionSelected">
            <option v-for="n in this.numberTotalOfQuestions" :key="n">
              {{ n }}
            </option>
          </select>
        </form>

        <DiscordLogo :username="this.username"/>
      </main>
    </section>
</template>

<style>
@import '../assets/base.css';
a { text-decoration: none; color: unset; }

button {
  padding: 1vw;
  margin: 1vw;
  background-color: purple;
  color: white;
  border: white 2px solid;
  border-radius: 20px;
  font-size: 16px;
}

button:hover {
  background-color: rgb(122, 52, 122);
}

#game {
  text-align: center;
  margin-top: 25vh;
}

#app {
  display: grid;
  position: relative;
  margin: 0 auto;
  grid-template-rows: 20% 1fr;
  grid-template-columns: 1fr;
  padding: 0 2rem;
  font-weight: normal;
  width: 100%;
  max-width: 60vw;
}

body {
  display: flex;
}

header {
  display: flex;
  place-items: center;
  background-color: rgb(80, 59, 59);
  border-radius: 30px;
  justify-content: space-around;
}

h1,h2 {
    margin: 2vw;
    margin-top: none;

  }

header .wrapper {
  display: flex;
  place-items: flex-start;
  flex-wrap: wrap;
}

.logo {
  margin: 0 2rem 0 0;
}

select {
  display: ;
}

@media only screen and (max-width: 1270px) {
  #app {
    max-width: 80%;

  }
}

</style>
