<script setup lang="ts">
import axios from 'axios'
import DisplayQuestionsBO from '@/components/BO/DisplayQuestionsBO.vue'
</script>

<script lang="ts">
export default {
    data() {
        return {
            questionsList: [],
            getQuestionsList: false,
        }
    },
    methods: {
        newQuestion() {
            this.$emit('addNewQuestion', true);
        },
    },
    mounted() {
        axios.get('http://localhost/trivia_v0.1/backend/questionsList')
        .then(response => {
            this.getQuestionsList = true;
            this.questionsList = response.data;
        })
        .catch(error => {console.log(error)})
    }
}
</script>

<template>
    <div>
        <div v-if="getQuestionsList" id="questionsList">
            <span>ID</span>
            <span>Question</span>
            <span>Réponse</span>
            <button id="addNew" @click="newQuestion">Add new</button>
        </div>

        <div v-for="value, index in questionsList" :key="value.id">
            <DisplayQuestionsBO :question="value"/>
        </div>
    </div>
</template>

<style lang="scss">
button#addNew {
    border-radius: 0;
    padding: 0;
    margin: 0;
    margin-left: 10px;

}

div#questionsList {
    padding: 20px 0;
    margin-top: 30px;
    display: grid;
    grid-template-columns: 6% 70% 10% 16%;
    grid-template-rows: 5% 1fr;
    text-align: center;
    span {
        padding: 5px;
        border: solid 2.5px white;
    }
}
</style>