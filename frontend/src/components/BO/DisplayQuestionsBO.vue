<script>
import axios from 'axios'

export default {
    props: {
        question: Object
    },
    methods: {
        handleDeleteQuestion(evt) {
            let question_id = evt.currentTarget.closest('div').querySelector('.question_id').innerText;

            if(question_id) {
                if(window.confirm("Delete question n°" + question_id + " ?")) {
                    const formData = new FormData;
                    formData.append('questionId', question_id);

                    axios.post('http://localhost/trivia_v0.1/backend/deleteQuestion', formData)
                    .then(result => {
                        if(result.data === true) {
                            // this.$router.push("questions-list");
                            window.location.reload();

                        } else {
                            console.log("Erreur dans l'ajout de la question");
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
                }
            }  
        },

        handleEditQuestion(evt) {
            let question_id = evt.currentTarget.closest('div').querySelector('.question_id').innerText;

            let question_label_section = evt.currentTarget.closest('div').querySelector('.question_label');
            let response_label_section = evt.currentTarget.closest('div').querySelector('.response');

            let question_label = question_label_section.innerText;
            let response_label = response_label_section.innerText;
            
            question_label_section.innerHTML ='<form class=edit_question><input style=width:100% value="' + question_label + '">';
            response_label_section.innerHTML ='<input style=width:100% value="' + response_label + '"></form>';

            question_label_section.querySelector('.edit_question').addEventListener('submit', evt => {
                evt.preventDefault();
                let question_label_edit = evt.currentTarget.querySelector('input').value;
                let response_edit = document.querySelector('span.response').querySelector('input').value;

                if(question_id && question_label_edit && response_label) {
                    if(window.confirm("Modifier question n°" + question_id + " ?")) {

                        const formData = new FormData;

                        formData.append('questionId', question_id);
                        formData.append('question_label', question_label_edit);
                        formData.append('response', response_edit);

                        axios.post('http://localhost/trivia_v0.1/backend/editQuestion', formData)
                        .then(result => {
                            if(result.data === true) {
                                window.location.reload();
                            } else {
                                console.log("Erreur lors de la modification de la question");
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        })
                    }
                }
            })
        },
    },
}
</script>

<template>
    <div>
        <span class="question_id">
            {{question['id']}}
        </span>

        <span class="question_label">
            {{question['question']}}
        </span>

        <span class="response">
            {{question['response_type']}}
        </span>

        <img src="../icons/Edit_icon.png" alt="edit button" @click="handleEditQuestion">
        <img src="../icons/3221803.png" alt="delete button" @click="handleDeleteQuestion">
    </div>
</template>

<style scoped lang="scss">
div {
    display: grid;
    grid-template-columns: 6% 70% 10% 9% 9%;
    align-items: center;
    
    span {
        background-color: rgb(72, 68, 62);
        margin: 5px 0;
        padding: 10px;
        text-align: center;
        color: white;
        border: solid 1.5px white;
    }

    span:nth-child(2) {
        text-align: left;
    }

    img {
        width: 50px;
        background-color: rgb(72, 68, 62);
        margin: 5px 0;
        margin-left: 13px;
        padding: 10px;
        text-align: center;
        color: white;
        border: solid 1.5px white;
        border-radius: 10px;
    }

    img:hover {
        background-color: white;
    }

    img:last-child{
        margin-left: 0;
    }
}
</style>