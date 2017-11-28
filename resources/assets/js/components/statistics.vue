<template>

    <div class="content root-element section" :class="[className]">
        <div class="columns-33-33-33">

            <div class="main-stats">
                <h1>House Podium</h1>
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
                <h1>Top 10 members:</h1>
                <table class="table">
                    <tr :class="{gold: key===0, silver: key ===1, bronze: key === 2}" style="" v-for="(student, key) in top">
                        <td class="ranking_number" style="width: 10px">{{key+1}}</td>
                        <td style="width: 50px;">
                            <img v-if="student.houseId === 1" src="../../../../public/img/icons/houses/s_serpents.png" alt="">
                            <img v-if="student.houseId === 2" src="../../../../public/img/icons/houses/db_dragons.png" alt="">
                            <img v-if="student.houseId === 3" src="../../../../public/img/icons/houses/r_ravens.png" alt="">
                            <img v-if="student.houseId === 4" src="../../../../public/img/icons/houses/v_vikings.png" alt="">
                        </td>
                        <td>
                            {{student.name}}
                        </td>
                        <td>{{student.points}}</td>
                    </tr>
                </table>

                <!-- <article >
                    <h3>{{key+1}}</h3>
                    <div  class="media-left" style="width: 40px; height: auto">


                    </div>
                    <div style="display: flex; justify-content:space-between">
                    <p>{{student.name}}</p>
                    <p>Points: {{student.points}}</p>
                    </div>
                </article> -->
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
        grid-gap: 20px;
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


    .ranking_number {

    }
    article {
        margin-top: 0px !important;
        padding-top: 0px !important;
        margin-bottom: 15px !important;
        border: none !important;
        background: rgba(255,255,255,0.3);
    }

     table {
        border-collapse: separate;
        border-spacing: 0 15px;
        background: inherit;
    }
    table tr td {
        border: none;
    }

    table tr {
        margin-bottom: 10px;
        background: rgba(255,255,255,0.4);
    }

    .gold {
        background: rgb(255,215, 0);
        font-weight: bold;
        box-shadow: 0px 0px 8px 5px rgb(255,215,0);
    }

    .silver {
        background: #D3D3D3;
        font-weight: bold;
        box-shadow: 0px 0px 3px 3px #D3D3D3;

    }

    .bronze {
        background: #cc6633;
        font-weight: bold;
        box-shadow: 0px 0px 3px 3px #cc6633;

    }

    .house-points {
        font-weight: bold;
        font-size: 1.1em;
    }



</style>

