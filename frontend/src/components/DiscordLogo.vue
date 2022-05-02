<script>
export default {
    props: {
        username: String,
    }
}
</script>

<template>
    <section>
        <img src="./icons/Discord-Logo.png" alt="Logo Discord">

        <span>{{username}}</span>
    </section>
</template>

<style scoped>

    section {
        position: fixed;
        bottom: 20px;
        color: white;
        font-size: 20px;
        display: flex;
        align-items: center;
    }

    img {
        width: 7%;
    }
</style>    