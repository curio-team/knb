<template>

    <div class="content root-element section" :class="[className]">

        <div v-for="house in houses">
            <h1>{{house.name}} {{house.points}}</h1>
            <img v-if="house.id === 1" src="../../../../public/img/icons/houses/s_serpents.png" alt="">
            <img v-if="house.id === 2" src="../../../../public/img/icons/houses/db_dragons.png" alt="">
            <img v-if="house.id === 3" src="../../../../public/img/icons/houses/r_ravens.png" alt="">
            <img v-if="house.id === 4" src="../../../../public/img/icons/houses/v_vikings.png" alt="">
        </div>
    </div>

</template>

<script>
    export default {

        data :  function(){
            return {
                houses: [],
                className: ""
            }

        },


        mounted : function()
        {
            setInterval(() => {

                axios.get('api/house').then((res) => {
                this.houses = res.data;
                this.className = this.houses[0].name.replace(' ', '-').toLowerCase();
                });
            }, 10000)

        },

        methods: {


        }
    }


</script>


