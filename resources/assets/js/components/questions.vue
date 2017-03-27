<template>
    <div class="container">
        @if (5 > 7)
            hello?
        @endif
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
