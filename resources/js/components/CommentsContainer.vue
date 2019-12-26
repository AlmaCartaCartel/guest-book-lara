<template>
    <div ref="comments">

    </div>
</template>

<script>
    export default {
        name: "CommentsContainer",
        methods:{
            getComments: async function (res = null){
                if (res == null){
                    res = '/comments/all?page=1';
                }
                const response = await axios.get(res);

                return await response.data;
            },
            setPaginate: function(){
                let paginate_links = document.getElementsByClassName('page-item');

                for (let link of paginate_links){
                    link.addEventListener('click', (e) => {
                        e.preventDefault();

                       this.change(e.target);
                    })
                }
            },
            change: function (url = null) {
                this.getComments(url)
                    .then(
                        res => this.$refs.comments.innerHTML = res
                    ).catch(
                        res => console.log(new Error(res))
                    ).then(
                        () => {
                            this.setPaginate();
                            this.applyPostId();
                        }
                    )
            },
            applyPostId: function() {
                const comment_id = document.querySelector('.comment_id');
                const answers = document.querySelectorAll('.answer');
                for (let i = 0; i < answers.length; i++){
                    answers[i].addEventListener('click', function () {

                        comment_id.value = this.dataset.commentid;
                        const blockID = 'form';
                        document.getElementById(blockID).scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        })
                    })
                }
            }
        },
        mounted() {
            this.change();
        }
    }

</script>

<style scoped>

</style>
