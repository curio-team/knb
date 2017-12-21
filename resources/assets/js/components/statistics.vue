<template>

    <div class="content root-element section" :class="[className]">

        <div id="fullpage">
            <div class="slide" v-if="activeSection == 's-1'">
                <div class="slide-content">
                    <div class="house-score">
                        <h2 class="title has-text-centered">Latest Received Badges</h2>
                        <div class="content container">
                            <div :class="{row: key === 0, row: key === 1, row2: key === 2, row3: key === 3}"  class="box" v-for="(bdgusr,key) in badgesUsers">
                                <img :src="getImg(bdgusr.img_path)" alt="">
                                <p class="badge-info">
                                    <span>Username:</span>
                                    <span>{{bdgusr.user_id + "  "}}</span>
                                    <span>House:</span>
                                    <span>{{bdgusr.name + "  "}}</span>
                                    <span>Badge:</span>
                                    <span>{{bdgusr.title}}</span>
                                    <span>Received at:</span>
                                    <span>{{bdgusr.received_at}}</span>
                                </p>

                                <p class="badge-image-house house-icon-container image is-128x128">
                                    <img class="house-icon" v-if="bdgusr.id === 1" src="../../../../public/img/icons/houses/s_serpents.png" alt="">
                                    <img class="house-icon" v-if="bdgusr.id === 2" src="../../../../public/img/icons/houses/db_dragons.png" alt="">
                                    <img class="house-icon" v-if="bdgusr.id === 3" src="../../../../public/img/icons/houses/r_ravens.png" alt="">
                                    <img class="house-icon" v-if="bdgusr.id === 4" src="../../../../public/img/icons/houses/v_vikings.png" alt="">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="slide" v-if="activeSection == 's-2'">
                <div class="slide-content">
                    <div class="house-score">
                        <h2 class="title has-text-centered">House Ranking</h2>
                        <article :class="{champion: key === 0}" class="house-container media" style="position: relative" v-for="(house,key) in houses">
                            <figure class="" style="">
                                <p class="house-icon-container image is-128x128">
                                    <img class="house-icon" v-if="house.id === 1" src="../../../../public/img/icons/houses/s_serpents.png" alt="">
                                    <img class="house-icon" v-if="house.id === 2" src="../../../../public/img/icons/houses/db_dragons.png" alt="">
                                    <img class="house-icon" v-if="house.id === 3" src="../../../../public/img/icons/houses/r_ravens.png" alt="">
                                    <img class="house-icon" v-if="house.id === 4" src="../../../../public/img/icons/houses/v_vikings.png" alt="">
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="content">
                                    <p class="house-title">{{house.name}}
                                        <span style="float:right"> {{house.points}} </span>
                                    </p>
                                </div>
                            </div>
                        </article>

                    </div>
                </div>
            </div>

            <div class="slide" v-if="activeSection == 's-3'">
                <div class="slide-content">
                    <h2 class="title has-text-centered">Top 5 members for Vikings</h2>
                    <table class="table">
                        <tr class="leaderboard" :class="{gold: key===0, silver: key ===1, bronze: key === 2}" style="" v-for="(student , key) in houseUsersVikings">
                            <td class="ranking_number" style="width: 10px">{{key+1}}</td>
                            <td style="width: 50px;">
                                <img src="../../../../public/img/icons/houses/v_vikings.png" alt="">
                            </td>
                            <td>
                                <p >{{student.name}}</p>
                            </td>
                            <td>
                                <p>{{student.points}}</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        <div class="slide" v-if="activeSection == 's-4'">
            <div class="slide-content">
                <h2 class="title has-text-centered">Top 5 members for Serpents</h2>
                <table class="table">
                    <tr class="leaderboard" :class="{gold: key===0, silver: key ===1, bronze: key === 2}" style="" v-for="(student , key) in houseUsersSerpents">
                        <td class="ranking_number" style="width: 10px">{{key+1}}</td>
                        <td style="width: 50px;">
                            <img src="../../../../public/img/icons/houses/s_serpents.png" alt="">
                        </td>
                        <td>
                            <p>{{student.name}}</p>
                        </td>
                        <td>
                            <p>{{student.points}}</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="slide" v-if="activeSection == 's-5'">
            <div class="slide-content">
                <h2 class="title has-text-centered">Top 5 members for Dragons</h2>
                <table class="table">
                    <tr class="leaderboard" :class="{gold: key===0, silver: key ===1, bronze: key === 2}" style="" v-for="(student , key) in houseUsersDragons">
                        <td class="ranking_number" style="width: 10px">{{key+1}}</td>
                        <td style="width: 50px;">
                            <img src="../../../../public/img/icons/houses/db_dragons.png" alt="">
                        </td>
                        <td>
                            <p>{{student.name}}</p>
                        </td>
                        <td>
                            <p>{{student.points}}</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="slide" v-if="activeSection == 's-6'">
            <div class="slide-content">
                <h2 class="title has-text-centered">Top 5 members for Ravens</h2>
                <table class="table">
                    <tr class="leaderboard" :class="{gold: key===0, silver: key ===1, bronze: key === 2}" style="" v-for="(student , key) in houseUsersRavens">
                        <td class="ranking_number" style="width: 10px">{{key+1}}</td>
                        <td style="width: 50px;">
                            <img src="../../../../public/img/icons/houses/r_ravens.png" alt="">
                        </td>
                        <td>
                            <p>{{student.name}}</p>
                        </td>
                        <td>
                            <p>{{student.points}}</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        data :  function(){
            return {
                activeSection: '',
                sections: ['s-1', 's-2', 's-3', 's-4', 's-5', 's-6'],
                houses: [],
                top: [],
                houseUsersVikings:[],
                houseUsersSerpents:[],
                className: "",
                counter: "",
                news: [],
                badgesUsers: []

            }

        },


        mounted : function()
        {
            setInterval(() => {
                axios.get('api/BadgeUser').then((res) => {
                    this.badgesUsers = res.data;

                });

                axios.get('api/house').then((res) => {
                this.houses = res.data;
                this.className = this.houses[0].name.replace(' ', '-').toLowerCase();
                });

//                axios.get('api/studentranking/5').then((res)=>{
//                    this.top = res.data;
//                });
                axios.get('api/studentranking/1').then((res) =>{
                    this.houseUsersSerpents = res.data;
                });
                axios.get('api/studentranking/2').then((res) =>{
                    this.houseUsersDragons = res.data;
                });
                axios.get('api/studentranking/3').then((res) =>{
                    this.houseUsersRavens = res.data;
                });
                axios.get('api/studentranking/4').then((res) =>{

                    this.houseUsersVikings = res.data;
                });

                axios.get('api/news').then((res)=>{
                    this.news = res.data;
                });
            }, 5000);

            this.setNextSection();
            setInterval(()=> {
                this.setNextSection();
            }, 5000);

        },

        methods: {
         setNextSection() {
                console.log(this.activeSection);
                if (!this.activeSection || this.counter >= this.sections.length)
                {
                    this.counter = 0;
                }

                this.activeSection = this.sections[this.counter];
                this.counter++;
            },

            getImg(i){
                 var path = "/img/badges/";
                return  path + i;
            },
//
//         selectHouseVikings(){
//             var house = house.id;
//               return house;
//            };
//
//        selectHouseSerpents(){
//
//            return house;
//        };

        }
    }


</script>

<style scoped>
    @import url('https://fonts.googleapis.com/css?family=Spectral+SC');

    h2.title {
        font-family: 'Spectral SC';
        font-size: 3em;
        text-transform: uppercase;
    }
    .house {
        margin: 10px;
        padding: 10px;
        text-align: center;
        background: rgba(255,255,255,0.6);
    }
    .container {
    }
    .box:not(:last-child) {
        margin-bottom: 0;
    }
    .box {
        background: rgba(255,255,255,0.7);
        display: inline-block;
        margin: 20px;
        width: 630px;
    }
    .badge-image-house {
        float: left;
        display: flex;
        flex-direction: column;

    }
    .badge-info {
        font-family: 'Spectral SC';
        font-size: 25px;
        float: right;
        display: flex;
        flex-direction: column;
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
        font-weight: bold;
        background: #D3D3D3;
        box-shadow: 0px 0px 3px 3px #D3D3D3;
    }

    .bronze {
        font-weight: bold;
        background: #cc6633;
        box-shadow: 0px 0px 3px 3px #cc6633;
    }

    .house-title {
        font-family: 'spectral SC';
        font-size: 5em;
        color: rgba(255,255,255,0.3);
        text-shadow: 3px 3px 1px black;
    }

    .house-points {
        font-weight: bold;
        font-size: 1.1em;
    }

    .house-container {
        margin-bottom: 30px !important;
        padding-right: 40px;
    }


    .house-icon-container {
        border-radius: 50%;
        border: 1px solid;
        padding: 20px;
        box-shadow: 0px 0px 40px black;
    }

    .news-description {
        font-size: 1.3em;
        width: 75%;
    }

    .news-title {
        font-size: 2.3em;
    }

    .leaderboard {
        font-size: 1.2em;
    }

    .latest{
        border: solid #000000;
    }
    .box img {
        width: 280px;
        height: 280px;
    }
    .content figure:not(:last-child) {
        margin-bottom: 0;
    }

</style>


