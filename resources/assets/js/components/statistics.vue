<template>

    <div class="content root-element section" :class="[className]">
        <div class="columns-25-75">
            <div class="main-stats">
                <div class="house-score columns-33-33-33 row-50-50 ">
                    <div :class="{champion: key === 0}" class="house" style="" v-for="(house,key) in houses">
                        <h4>{{house.name}} </h4>
                        <img v-if="house.id === 1" src="../../../../public/img/icons/houses/s_serpents.png" alt="">
                        <img v-if="house.id === 2" src="../../../../public/img/icons/houses/db_dragons.png" alt="">
                        <img v-if="house.id === 3" src="../../../../public/img/icons/houses/r_ravens.png" alt="">
                        <img v-if="house.id === 4" src="../../../../public/img/icons/houses/v_vikings.png" alt="">
                    </div>
                </div>

            </div>
            <div class="sidebar"><h1>sidebar</h1></div>
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
            }, 1000)

        },

        methods: {


        }
    }


</script>

<style scoped>
    .columns-50-50 {
        display: grid;
        grid-template-columns: 1fr 1fr
    }

    .columns-25-75 {
        display: grid;
        grid-template-columns: 1fr 3fr;
    }

    .columns-33-33-33 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;

    }

    .row-50-50 {
        display: grid;
        grid-template-rows: 1fr 2fr;
    }

    .house {
        margin: 10px;
        padding: 10px;
        text-align: center;
        background: rgba(255,255,255,0.6);
    }


    .champion {
        grid-column: span 3;
        grid-row-start: 2;
        font-size: 1.5em;
    }

    .main-stats {
        padding: 25px;
    }

</style>

