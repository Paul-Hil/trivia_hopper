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
          numberOfQuestionSelected: 10,
          userScore: 0,
          userResponse: null,
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

      if(this.questionsList.responses[this.questionNumber] === userResponse) {
        this.userScore = this.userScore + 1;
      }

      if(this.numberOfQuestions === (this.questionNumber + 1)) {
        this.gameDone = true;
      }
    },
    checkGameDone() {
      this.gameDone = true;
    },
    reloadPage() {
      window.location.reload();
    }
  },
  updated() {
    if(!this.gameDone) {
      if(this.questionsList && this.userResponse) {
        if((JSON.stringify(this.questionsList['responses'][this.questionNumber - 1])) === '"'+ this.userResponse + '"') {
          let sectionScore = document.querySelector('.loop_answer:last-child');
          sectionScore.querySelector('.answer').classList.remove('wrong_answer');
          sectionScore.querySelector('.answer').classList.add('correct_answer');

        }
        this.userResponse = null;
      }
    }
  },

  mounted () {
    let numberOfQuestionSelected = this.$route.params.numberOfQuestionSelected;

    if(numberOfQuestionSelected) {
      this.numberOfQuestionSelected = numberOfQuestionSelected;
    }

    axios.get('http://localhost/trivia_v0.1/backend/game?numberOfQuestions=' + this.numberOfQuestionSelected)
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
              @game-done="checkGameDone"
            />

            <div id="display_score">
              <div v-for="numberOf in questionNumber" :key="numberOf" class="loop_answer">
                  <div class="answer wrong_answer"></div>
              </div>
            </div>
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

<style lang="scss">
#display_score {
  display: flex;
  position: fixed;
  flex-direction: column;
  top: 25%;
  right: 17%;
  div {
    width: 30px;
    height: 30px;
    margin: 5px;
  }

  div > div {
    width: 100%;
    height: 100%;
    border: white 3px solid;
    border-radius: 30px;
  }

  div.correct_answer {
    background-color: green;
  }

  div.wrong_answer {
    background-color: red;
  }
}

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