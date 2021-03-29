<template>
    <div style="font-size: 12px;">
        <a href="#" class="text-decoration-none font-weight-bold"
            @click="followUser" v-text="buttonText"></a>
    </div>
</template >

    <script>
        export default {

            props: ['user_id', 'follows'],

            mounted() {
                console.log('Component mounted.')
        },

        data: function() {
            return {
                status: this.follows,
            }
        },

        methods: {
            followUser() {
                axios.post('/follow/' + this.user_id)
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
            buttonText() {
                return (this.status) ? '  •  Unfollow' : '  •  Follow';
            }
        }
    }
</script>
