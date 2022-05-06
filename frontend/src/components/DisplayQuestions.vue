<script lang="ts">
export default {
    props: {
        questionDisplay: String,
        questionNumber: Number,
        numberOfQuestions: Number
        
    },
    data() {
        return {
            userResponse: null,
        }
    },
    methods: {
      handleResponse(evt) {
          if(evt.currentTarget.className === 'button_true') {
            this.userResponse = "true";
          } else {
            this.userResponse = "false";
          }
        this.$emit('userResponse', this.userResponse);
        this.$emit('questionNumber', this.questionNumber + 1);
      },
    }
}
</script>


<template>
    <section id="display_question">
        <h3 id="number_question">- Question n°{{questionNumber + 1}} / {{numberOfQuestions}} -</h3>
        <p id="label_question">{{questionDisplay}}</p>
        <div id="responses">
            <button class="button_true" @click="handleResponse">Vrai</button>
            <button class="button_false" @click="handleResponse">Faux</button>
        </div>
    </section>
</template>

<style scoped lang="scss">
#label_question {
        color: white;
}

.class1.class2 {

}

.class1 .class2 {
    
}

#responses {
    button {
        padding: 1.2vw;
        width: 8vw;
        font-size: 1.2vw;
        margin: 4vw;
    }
    .button_true {
        background-color: green;
        &:hover {
            background-color: rgb(51, 124, 51);

        }
    }
    .button_false {
        background-color: red;
        &:hover {
            background-color: rgb(250, 46, 46);
        }
    }
}
</style>