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

    #timer_bar {
        height: 35px;
        background-color: gray;

        animation: 7s linear 0s infinite timer_bar;
    }
}

@keyframes timer_bar { from { width:0%; } to { width:100%; }  }
</style>