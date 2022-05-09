<template>
    <div id="section-bar">
        <div id="timer_bar">
        </div>
    </div>
</template>

<style scoped lang="scss">
#section-bar {
    margin: auto;
    text-align: center;
    max-width: 80%;
    border: solid 3px white;
    height: 40px;
    margin-top: 40px;
    border-radius: 30px;

    #timer_bar {
        height: 34px;
        background-color: blue;
        border-radius: 30px;

        animation: 7s linear 0s infinite timer_bar;
    }
}

@keyframes timer_bar { from { width:5%; } to { width:80%;} to {width:100%; background-color: red;}  }
</style>