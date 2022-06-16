<script setup lang="ts">
import LoginButtons from '@/components/LoginButtons.vue'
</script>

<script lang="ts">
export default {
    methods: {
      ifIsConnected(result){
        this.$emit('isConnected', result);
      },
      ifIsUsername(result){
        this.$emit('username', result);
      }
    }
}
</script>

<template>
    <header>
        <router-link :to="'/'"><h1>Trivial Hopper's</h1></router-link>

        <LoginButtons @is-connected="ifIsConnected" @username="ifIsUsername" />
    </header>
</template>