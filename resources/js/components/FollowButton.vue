<template>
    <!-- should always have a single to refered as root div -->
    <div>
        <button class="btn btn-primary ml-3" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

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
                //alert(this.user_id);
                axios.post('/follow/' + this.user_id)
                    .then(response => {
                        this.status = !this.status;
                        console.log(response.data);
                    })
                    .catch(error => {
                        if( error.response.status == 401 ) {
                            window.location = '/login';
                        }
                    });
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }
</script>
