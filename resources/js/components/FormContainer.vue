<template>
    <form ref="form" method="post" class="comment" id="form" v-on:submit="sendMessage">
    </form>
</template>

<script>
    export default {
        name: "FormContainer",
        methods: {
            getForm: async function () {
                let response = await axios.get('/comments/form');

                return await response.data;
            },
            change: function () {
                this.getForm()
                    .then(
                        res => this.$refs.form.innerHTML = res
                    ).catch(
                        res => console.log(new Error(res))
                    )
            },

            sendMessage: async function (e){
                e.preventDefault();

                let response = await axios.post('/comments/add', new FormData(this.$refs.form));

                this.$refs.form.innerText = await response.data;
            }
        },
        mounted() {
            this.change()
        }
    }
</script>

<style scoped>

</style>
