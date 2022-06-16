<script>
import axios from 'axios';

export default {
    data() {
        return {
            leaderboard: null,
        }
    },

    mounted() {
        axios.get('https://triviahopperapi.xyz/trivia_hopper/backend/leaderboard')
        .then(response => {
            this.leaderboard = response.data;
        })
    }
}
</script>

<template>
    <section>
        <h2>Leaderboard</h2>
        <div class="leaderboard">
            <div class="leaderboard_username">Username</div> 
                    
            <div>Score %</div>
        </div>

        <div class="leaderboard" v-if="leaderboard" v-for="item in leaderboard" key="item.id">
            <div class="leaderboard_username">{{item.username}}</div> 
                    
            <div>{{item.score}}</div>
        </div>

    </section>
</template>

<style lang="scss" scoped>
section  {
    h2 {
        color: black;
    }

    text-align: center;
    width: 35%;
    margin: auto;
    margin-top: 6%;
    border-radius: 30px;
    background-color: white;
    color: black;

    .leaderboard {
        height: 37px;
        display: grid;
        grid-template-columns: 50% 50%;
        background-color: gray;
        border: solid white 2px;
        border-right: none;
        border-left: none;

        div.leaderboard_username {
            border-right: solid 2px white;
        }
    }

    .leaderboard:nth-of-type(even) {
        background-color: rgb(194, 194, 194);
    }

    .leaderboard:last-child {
        border-end-start-radius: 30px;
        border-end-end-radius: 30px;
    }
}
</style>