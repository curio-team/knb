<template>

    <div class="content root-element section" :class="[className]">
        <div class="columns-25-75">
            <div class="main-stats">
                <div class="house-score columns-33-33-33 row-50-50 ">

                    <div :class="{champion: key === 0}" class="house" style="position: relative" v-for="(house,key) in houses">
                        <h4>{{house.name}} </h4>
                        <div style="min-height: 100px">
                        <img v-if="house.id === 1" src="../../../../public/img/icons/houses/s_serpents.png" alt="">
                        <img v-if="house.id === 2" src="../../../../public/img/icons/houses/db_dragons.png" alt="">
                        <img v-if="house.id === 3" src="../../../../public/img/icons/houses/r_ravens.png" alt="">
                        <img v-if="house.id === 4" src="../../../../public/img/icons/houses/v_vikings.png" alt="">
                        </div>
                        <p class="house-points">{{house.points}}</p>
                    </div>

                </div>

            </div>
            <div class="sidebar">
                <h1>TOP 10 MEMBERS:</h1>
                <article :class="{gold: key===0, silver: key ===1, bronze: key === 2}" style="" class="media" v-for="(student, key) in top">
                    <h3>{{key+1}}</h3>
                    <div  class="media-left" style="width: 40px; height: auto">
                        <img v-if="student.houseId === 1" src="../../../../public/img/icons/houses/s_serpents.png" alt="">
                        <img v-if="student.houseId === 2" src="../../../../public/img/icons/houses/db_dragons.png" alt="">
                        <img v-if="student.houseId === 3" src="../../../../public/img/icons/houses/r_ravens.png" alt="">
                        <img v-if="student.houseId === 4" src="../../../../public/img/icons/houses/v_vikings.png" alt="">
                    </div>
                    <p>{{student.name}}</p>
                </article>
            </div>
        </div>

    </div>

</template>


<script>
    export default {

        data :  function(){
            return {
                houses: [],
                top: [],
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

                axios.get('api/studentranking/10').then((res)=>{
                    this.top = res.data;

                });
            }, 4000)

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


    article {
        margin-top: 0px !important;
        padding-top: 0px !important;
        margin-bottom: 15px !important;
        border: none !important;
        background: rgba(255,255,255,0.3);
    }

    .gold {
        background: rgb(255,215, 0);
        font-weight: bold;
        box-shadow: 0px 0px 8px 5px rgb(255,215,0);
    }

    .silver {
        background: #D3D3D3;
        font-weight: bold;
        box-shadow: 0px 0px 8px 5px #D3D3D3;

    }

    .bronze {
        background: #cc6633;
        font-weight: bold;
        box-shadow: 0px 0px 8px 5px #cc6633;

    }

    .house-points {
        font-weight: bold;
        font-size: 1.3em;
    }

</style>

