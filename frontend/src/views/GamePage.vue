<script setup lang="ts">
import axios from 'axios'
import HeaderSection from '@/components/HeaderSection.vue'
import DisplayQuestions from '@/components/DisplayQuestions.vue'
import DiscordLogo from '@/components/DiscordLogo.vue'
</script>

<script lang="ts">
export default {
  data() {
      return {
          isConnected: false,
          gameDone: false,
          getQuestionsList: false,
          username: "",
          questionsList: [],
          questionNumber: 0,
          numberOfQuestions: null,
          userScore: 0,
          userResponse: null
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

    ifIsQuestionNumber(result) {
      this.questionNumber = result;
    },

    checkUserResponse(userResponse){
      this.userResponse = userResponse;
      var goodAnswer = this.questionsList.responses[this.questionNumber];

      if(goodAnswer === userResponse) {
        this.userScore = this.userScore + 1;
      }

      if(this.numberOfQuestions === (this.questionNumber + 1)) {
        this.gameDone = true;
      }
    },
    reloadPage() {
      window.location.reload();
    }
  },
  mounted () {
    axios.get('http://localhost/trivia_v0.1/backend/game')
    .then(response => {
      this.questionsList = (response.data)
      this.numberOfQuestions = response.data.questions.length;
      this.getQuestionsList = true;
    })
    .catch(error => (console.log(error)))
  }
}
</script>

<template>
     <section>
        <HeaderSection 
          @is-connected="ifIsConnected"
          @username="ifIsUsername"
        />

        <div v-if="(getQuestionsList)">
          <div v-if="(!gameDone)">
            <DisplayQuestions 
              :question-display="questionsList.questions[questionNumber]"
              :question-number="questionNumber"
              :number-of-questions="numberOfQuestions"
              @user-response="checkUserResponse"
              @question-number="ifIsQuestionNumber"
            />
          </div>

          <div id="result" v-else>
            <h3>Partie terminée</h3>
            <p>Bravo !! Tu as obtenus {{userScore}} bonne réponses sur {{numberOfQuestions}} questions.</p>
            <button @click="reloadPage">Faire une nouvelle partie</button>
          </div>
        </div>

        <DiscordLogo :username="this.username"/>
    </section>
</template>

<style>
section#display_question {
  margin-top: 15vh;
  text-align: center;
  font-size: 1.5vw;
}

div#result {
  margin-top: 15vh;
  text-align: center;
}
</style>