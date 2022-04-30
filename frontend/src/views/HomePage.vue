<script setup lang="ts">
import LoginButtons from '@/components/LoginButtons.vue'
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
      },
      ifIsUsername(result){
        this.username = result;
      }
    }
}
</script>


<template>
    <section>
        <header>
            <h1>Trivial Hopper's</h1>

            <LoginButtons @is-connected="ifIsConnected" @username="ifIsUsername" />
        </header>

        <main id="game" v-if="isConnected">
            <h2>Welcome back {{this.username}} !</h2>
            <button>Rejoindre une partie</button>
        </main>
    </section>
</template>

<style>
@import '../assets/base.css';

button {
  padding: 1.5vw;
  margin: 2vw;
  background-color: purple;
  color: white;
  border: white 2px solid;
  border-radius: 20px;
  font-size: 1.3vw;
}

button:hover {
  background-color: rgb(122, 52, 122);
}

#game {
  text-align: center;
}

#app {
  max-width: 1280px;
  margin: 0 auto;
  padding: 2rem;

  font-weight: normal;
}

body {
  display: flex;
}

#app {
  display: grid;
  grid-template-rows: 20% 1fr;
  padding: 0 2rem;
}

header {
  display: flex;
  place-items: center;
  
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

</style>
