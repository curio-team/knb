<template>
    <div class="content">
        dit is een post
    </div>
</template>

<script>
    export default {

        props: ['user_id'],
        data() {
            return {
                ''
            }
        },

        created() {
            axios.get('api/')
        }

    }
</script>