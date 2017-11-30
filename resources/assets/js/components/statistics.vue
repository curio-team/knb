<template>

    <div class="content root-element section" :class="[className]">

        <div id="fullpage">
            <div class="slide" v-if="activeSection == 's-1'">
                <div class="slide-content">
                    <div class="house-score">
                        <h2 class="title has-text-centered">House Ranking</h2>
                        <article :class="{champion: key === 0}" class="house-container media" style="position: relative" v-for="(house,key) in houses">
                            <figure class="media-left" style="">
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

            <div class="slide" v-if="activeSection == 's-2'">
                <div class="slide-content">
                    <h2 class="title has-text-centered">Top 10 members:</h2>
                    <table class="table">
                        <tr class="leaderboard" :class="{gold: key===0, silver: key ===1, bronze: key === 2}" style="" v-for="(student, key) in top">
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
                </div>
            </div>
            <div class="slide" v-if="activeSection == 's-3'">
                <div class="slide-content">
                    <h2 class="title has-text-centered">Latest News</h2>
                    <div class="box">
                        <h2 class="is-2 news-title">{{news[0].title}}</h2>

                        <p class="date"><i>{{news[0].created_at}}</i></p>

                        <p v-html="news[0].content" class="news-description">

                        </p>
                    </div>

                </div>
            </div>
            <div class="slide" v-if="activeSection == 's-4'">
                <div class="slide-content">
                    <h2 class="title has-text-centered">Latest News</h2>
                    <div class="box">
                        <h2 class="is-2 news-title">{{news[1].title}}</h2>

                        <p class="date"><i>{{news[1].created_at}}</i></p>

                        <p v-html="news[1].content" class="news-description">

                        </p>
                    </div>

                </div>
            </div>
            <div class="slide" v-if="activeSection == 's-5'">
                <div class="slide-content">
                    <h2 class="title has-text-centered">Latest News</h2>
                    <div class="box">
                        <h2 class="is-2 news-title">{{news[2].title}}</h2>

                        <p class="date"><i>{{news[2].created_at}}</i></p>

                        <p v-html="news[2].content" class="news-description">

                        </p>
                    </div>

                </div>
            </div>
        </div>

    </div>

</template>


<script>

    export default {

        data :  function(){
            return {
                activeSection: '',
                sections: ['s-1', 's-2', 's-3', 's-4', 's-5'],
                houses: [],
                top: [],
                className: "",
                counter: "",
                news: []
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

                axios.get('api/news').then((res)=>{
                    this.news = res.data;
                });
            }, 4000)

            this.setNextSection();
            setInterval(()=> {
                this.setNextSection();
            }, 10000);

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
            }

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

    .content figure:not(:last-child) {
        margin-bottom: 0px;
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

</style>

