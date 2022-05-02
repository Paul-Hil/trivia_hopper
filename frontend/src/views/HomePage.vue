<script setup lang="ts">
import HeaderSection from '@/components/HeaderSection.vue'
import DiscordLogo from '@/components/DiscordLogo.vue'
</script>

<script lang="ts">

export default {
    data() {
        return {
            isConnected: false,
            username: ""
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
      }
    }
}
</script>


<template>
    <section>
      <HeaderSection @is-connected="ifIsConnected" @username="ifIsUsername" />
      
      <main id="game" v-if="isConnected">
        <h2>Welcome back {{this.username}} !</h2>

        <router-link :to="'/game'">
          <button>Rejoindre une partie</button>
        </router-link>

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
  max-width: 50vw;
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

@media only screen and (max-width: 1270px) {
  #app {
    max-width: 80%;

  }
}

</style>
