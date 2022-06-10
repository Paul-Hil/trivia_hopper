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
        forceRerender() {
          this.$emit('forceRerender', true);
        }
        
    },
    mounted() {
        axios.get('http://ec2-18-118-212-205.us-east-2.compute.amazonaws.com/trivia_hopper/backend/questionsList')
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
            <DisplayQuestionsBO :question="value" @force-rerender="forceRerender"/>
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