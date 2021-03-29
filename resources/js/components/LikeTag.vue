<template>
    <div style="font-size: 12px;">
        <span @click="toggleLike" v-text="likeText"> ♡ </span>
    </div>
</template >

    <script>
        export default {

            props: ['user_id', 'post_id', 'like'],

            mounted() {
            console.log('Component mounted.')
        },

        data: function() {
            return {
                status: this.like,
            }
        },

        methods: {
            toggleLike() {
                axios.post('/l/' + this.post_id + '/' + this.user_id)
                    .then(response => {
                        this.status = !this.status;
                        console.log(response.data);
                    })
                    .catch(error => {
                        if (error.response.status == 401) {
                            window.location = '/login';
                        }
                    });
            }
        },

        computed: {
            LikeText() {
                return (this.status) ? ' ♡ ' : ' • ';
            }
        }
    }
</script>
