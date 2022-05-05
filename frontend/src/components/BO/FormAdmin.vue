<script>
import axios from 'axios'

export default {
    data() {
        return {
            username: null,
            password: null,
            passwordFieldType: "password"
        }
    },
    methods: {
        checkForm(evt) {
            evt.preventDefault();
            const formData = new FormData;
            formData.append('username', this.username);
            formData.append('password', this.password);

            if(this.username && this.username.length >= 5 && this.password && this.password.length >= 5) {
                axios.post('http://localhost/trivia_v0.1/backend/loginAdmin', formData)
                .then(response => {
                    if(response.data === true) {
                        this.$emit('isConnected_asAdmin', response.data);
                    }
                })
                .catch(error => {
                    console.log(error);
                })
            } else {
            console.log("Merci de rentrer un pseudo & psw valide");
            }
         },
        switchVisibility() {
            this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";
        }
    },
}
</script>

<template>
    <form @submit="checkForm">
        <div class="champ">
            <label>Username</label>
            <input v-model="username" placeholder="username" />
        </div>
        
        <div class="champ">
            <label>Password</label>
            <input v-model="password" :type="passwordFieldType" placeholder="password">
            <button type="password" @click="switchVisibility">show / hide</button>
        </div>

        <button type="submit">Suivant</button>
    </form>
</template>

<style lang="scss" scoped>
div.champ {
    margin: 20px;
    input {
        padding: 5px;
        margin: 10px;
    }
}

form {
    border: solid 4px white;
    border-radius: 30px;
    margin: auto;
    margin-top: 15vh;
    text-align: center;
    width: 40%;
}
</style>