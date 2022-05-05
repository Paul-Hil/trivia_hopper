
<script>
import axios from 'axios'


export default {
    data() {
        return {
            newQuestionLabel: null,
            response: null
        }
    },
    methods: {
        checkForm(evt) {
            evt.preventDefault();
            if(this.newQuestionLabel.length > 8 && this.response) {
                const formData = new FormData;

                formData.append('newQuestionLabel', this.newQuestionLabel);
                formData.append('password', this.response);

                axios.post('http://localhost/trivia_v0.1/backend/newQuestion', formData)
                .then(result => {
                    console.log(result);
                    if(result === 1) {
                        this.$emit('addNewQuestion', false);
                    }
                    console.log("Erreur dans l'ajout de la question");
                })
                .catch(error => {
                    console.log(error);
                })

            } else {
                console.log("Penser à tout remplir");
            }
        },
        handleResponse(evt) {
            evt.preventDefault();
            if(evt.currentTarget.innerHTML === "Vrai") {
                this.response = true;

                evt.currentTarget.style.backgroundColor = "green";
                document.querySelector('#button_false').style.backgroundColor = "purple"
            } else {
                this.response = false;

                evt.currentTarget.style.backgroundColor = "red";
                document.querySelector('#button_true').style.backgroundColor = "purple"

            }
        },
        handleReload() {
            window.location.reload();
        }
    }
}
</script>

<template>
    <div>
        <button @click="handleReload">Go back</button>

        <form @submit="checkForm">
            <h2>Ajouter une nouvelle question</h2>

            <input v-model="newQuestionLabel">

            <div id="responses">
                <button id="button_true" @click="handleResponse">Vrai</button>
                <button id="button_false" @click="handleResponse">Faux</button>
            </div>
            
            <button type="submit">Envoyer</button>
        </form>
    </div>
</template>

<style lang="scss" scoped>
h2 {
    color: white;
}
button {
    margin: 30px;
}

input {
    padding: 5px;
    margin: 10px;
    width: 100%;
}

#responses {
    button {
        padding: 1.2vw;
        width: 8vw;
        font-size: 1.2vw;
    }
}

form {
    margin: auto;
    margin-top: 15vh;
    text-align: center;
    width: 40%;
}
</style>