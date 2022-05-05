<script>
export default {
    props: {
        question: Object
    },
    methods: {

    }
}
</script>

<template>
    <div>
        <span>
        {{question['id']}}
        </span>

        <span>
        {{question['question']}}
        </span>

        <span>
        {{question['response_type']}}
        </span>
        <img src="../icons/Edit_icon.png" alt="edit button">
        <img src="../icons/3221803.png" alt="delete button">

    </div>
</template>

<style scoped lang="scss">
div {
    display: grid;
    grid-template-columns: 6% 70% 10% 10% 10%;
    
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
        width: 65%;
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