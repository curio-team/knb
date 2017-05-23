<template>
    <div class="root-element section">
        <div class="container">
            <div class="content">
                <h1>Learn</h1>

                <div class="tabs is-centered is-medium is-boxed">
                    <ul>
                        <li v-for="category in categories" v-bind:class="{'is-active': isActive(category.name)}" v-on:click="setActive(category)"><a>{{category.name}}</a></li>
                    </ul>
                </div>

                <div v-for="category in categories">
                    <div class="columns" v-if="category.name === active.name">
                        <p v-if="!category.series.length > 0" class="notification is-warning">Nog geen video series beschikbaar</p>
                        <div style="cursor:pointer"  v-for="serie in category.series" v-on:click="serieClicked(serie.tag)" class="column is-one-quarter">
                            <div class="card">
                                <div class="card-image">
                                    <figure class="image is-4by3">
                                        <img src="http://bulma.io/images/placeholders/1280x960.png" alt="Image">
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <div class="media">
                                        <div class="media-content">
                                            <p class="title is-4">{{serie.title}}</p>
                                            <p class="subtitle is-6">{{serie.difficulty}}</p>
                                        </div>
                                    </div>
                                    <div class="content">
                                        {{serie.content}}
                                    </div>
                                    <b>{{serie.length}}</b>
                                </div>
                            </div>
                        </div>


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
                categories: [
                    {
                        name: "HTML/CSS",
                        series: [
                            {
                                title: 'HTML CSS Fundamentals',
                                difficulty: 'beginner',
                                content: "Deze video series is voor jou als je vanaf nul wilt weten hoe een webpagina opgebouwd wordt.",
                                length: "still in progress",
                                tag: 'html-css-fundamentals'
                            }
                        ]
                    },

                    {
                        name: "C#",
                        series: [
                            {
                                title: 'C# Fundamentals',
                                difficulty: 'beginner',
                                content: "In deze video series maak je kennis met programmeren. Dit gebeurt in de taal C#. Tim neemt je mee vanaf het configureren van visual studio tot het maken van werkende applicaties.",
                                length: 'still in progress...',
                                tag: 'csharp_fundamentals'

                            }
                        ]
                    },

                    {
                        name: "PHP",
                        series : [
                            {
                                title:  "Maak een todo list met PHP en MySql",
                                difficulty: "beginner",
                                content: "In deze videoserie maak je met behulp van PDO een databaseconnectie en maak je een een online todo list waarbij de items in een database worden gezet.",
                                length: "6 videos",
                                tag: 'series-todo-beginner'
                            },
                            {
                                title:  "PHP Fundamentals",
                                difficulty: "beginner",
                                content: "In deze videoserie maak je kennis met PHP als programmeertaal. Deze serie is geschikt voor als je met behulp van PHP je programmeerskills wilt opvijzelen.",
                                length: "8 videos",
                                tag: 'series-php-fundamentals'
                            }
                        ]
                    },
                    {
                        name : "SQL",
                        series: []
                    },
                    {
                        name : "UML",
                        series: []
                    },
                    {
                        name: "Normaliseren",
                        series: []
                    },

                    {
                        name: "Xamarin",
                        series: []
                    },
                    {
                        name: "Javascript",
                        series: []
                    }

                ],
                active : ''

            }

        },

        mounted: function() {
            this.setActive(this.categories[0]);
        },

        methods: {

            setActive : function(name) {
                this.active = name;
            },

            isActive : function(name)
            {
                return name === this.active.name ? true : false;
            },

            serieClicked : function(tag)
            {
                document.location.href= "/learn/" +  tag;
            }

        }
    }


</script>