<script setup lang="ts">
import HeaderSection from '@/components/HeaderSection.vue'
import DiscordLogo from '@/components/DiscordLogo.vue'
import HomeLeaderboard from '@/components/HomeLeaderboard.vue'

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
    },

    ifIsUsername(result){
      console.log(result);
      this.username = result;
      this.isConnected = true;
    },

    handleClick() {
    this.$router.push({
      name: "game",
      params: {
        numberOfQuestionSelected: this.numberOfQuestionSelected,
      }
    });
    }
  },
  mounted() {
    axios.get('http://ec2-18-118-212-205.us-east-2.compute.amazonaws.com/trivia_hopper/backend/numberOfQuestions')
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

      <main id="game" v-if="username">
        <h2>Welcome back {{username}} !</h2>

        <button @click="handleClick">Rejoindre une partie</button>

        <form>
          <label>Nombre de questions </label>
          <select v-model="numberOfQuestionSelected" v-if="numberTotalOfQuestions">
            <option v-for="n in numberTotalOfQuestions" :key="n">
              {{ n }}
            </option>
          </select>
        </form>

        <DiscordLogo v-if="username" :username="username"/>
      </main>
      <h2 v-else>Connecte toi avec Discord pour commencer à jouer !</h2>

      <HomeLeaderboard />
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

h2 {
  margin: auto;
  margin-top: 10%;
  text-align: center;
  color: white;
}

header .wrapper {
  display: flex;
  place-items: flex-start;
  flex-wrap: wrap;
}

.logo {
  margin: 0 2rem 0 0;
}

form {
  color: white;
  margin: 30px;
}

@media only screen and (max-width: 1270px) {
  #app {
    max-width: 80%;

  }
}

</style>
