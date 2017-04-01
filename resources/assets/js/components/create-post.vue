<template>
    <div class="content">
        <div class="columns">
    <div class="column is-offset-two-thirds is-one-third panel is-pulled-right">
        <p class="panel-heading">
            How to ask questions!
        </p>
        <div class="panel-block">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores at enim facilis nobis velit! Ab asperiores autem, dignissimos facere fugit ipsam ipsum itaque iusto, quae quibusdam quidem rem saepe! Cupiditate!
        </div>
    </div>
        </div>
    <form action="">
        <div class="field">
            <label class="label">Title</label>
            <p class="control">
                <input type="text" placeholder="Please be specific about your question" class="input">
            </p>
        </div>
        <div class="field">
            <label class="label">Question</label>
            <textarea name="" id="" cols="30" rows="10" class="textarea"></textarea>
        </div>
        <div class="field is-grouped">
            <p class="control">
                <button class="button is-primary">Submit</button>
            </p>
            <p class="control">
                <button class="button is-link">cancel</button>
            </p>
        </div>
    </form>
    </div>
</template>


<script>
    export default {
        data: {
            title   : "",
            content : ""
        },

        created() {

        }
    }
</script>