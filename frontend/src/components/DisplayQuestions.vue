<script setup lang="ts">
import TimerBar from '@/components/TimerBar.vue'
</script>

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
            timeLimit: 7000,
            timeoutId: null,
        }
    },
    methods: {
      handleResponse(evt) {

        this.userResponse = null;
        this.reset_animation();
        
        clearTimeout(this.timeoutId);

        if(evt.currentTarget.className === 'button_true') {
            this.userResponse = "true";
        }

        if(evt.currentTarget.className === 'button_false') {
            this.userResponse = "false";
        }

        this.$emit('userResponse', this.userResponse);
        this.$emit('questionNumber', this.questionNumber + 1);
      },

    reset_animation() {
        var el = document.getElementById('timer_bar');
        el.style.animation = 'none';
        el.offsetHeight; /* trigger reflow */
        el.style.animation = null; 
    }
    },
    mounted() {
        this.timeoutId = setTimeout(function() {
            this.$emit('questionNumber', this.questionNumber + 1);
        }.bind(this), this.timeLimit);
    },
    updated() {
        this.timeoutId = setTimeout(function() {
            if(this.questionNumber !== (this.numberOfQuestions - 1)) {
                this.$emit('questionNumber', this.questionNumber + 1);
            } else {
                this.$emit('gameDone', true);
            }
        }.bind(this), this.timeLimit);
    }
}
</script>


<template>
    <section id="display_question">
        <h3 id="number_question">- Question n°{{questionNumber + 1}} / {{numberOfQuestions}} -</h3>
        <p id="label_question">{{questionDisplay}}</p>
        <div id="responses">
            <button class="button_true" @click="handleResponse">Vrai</button>
            ou
            <button class="button_false" @click="handleResponse">Faux</button>
        </div>
        
        <TimerBar />
    </section>
</template>

<style scoped lang="scss">
#label_question {
        color: white;
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