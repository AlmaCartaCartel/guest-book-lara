<template>
    <div >
        <CommentsContainer />
        <FormContainer />
    </div>
</template>

<script>
    import CommentsContainer from "./components/CommentsContainer";
    import FormContainer from "./components/FormContainer";

    export default {
        name: "app.vue",
        components: {
            CommentsContainer,
            FormContainer
        },
    }
</script>

<style scoped>

</style>
