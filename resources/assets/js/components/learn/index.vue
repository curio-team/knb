<template>
    <div class="root-element section">
                <h2 class="sub-title">What do you want to learn next?</h2>
                <div class="tabs is-centered is-medium is-boxed">
                    <ul>
                        <li v-for="category in categories" v-bind:class="{'is-active': isActive(category.name)}" v-on:click="setActive(category)"><a>{{category.name}}</a></li>
                    </ul>
                </div>

                <div v-for="category in categories">

                    <div v-if="category.name === active.name">
                        <div class="tabs is-medium is-boxed">
                            <ul>
                                <li v-bind:class="{'is-active': isSubActive(subCategory)}" v-on:click="setSubActive(subCategory)" v-for="subCategory in subCategories"><a>{{subCategory}}</a></li>
                            </ul>
                        </div>

                        <div  v-if="category.name === active.name">

                            <!--make this a video component-->
                            <div class="columns" v-if="subActive === 'Videos'">
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

                            <div v-if="subActive === 'Workbook'">
                                <p>This is the werkbook section</p>
                            </div>

                            <div v-if="subActive === 'Resources'">
                                <div class="columns">
                                    <div class="column">
                                        <nav class="panel">
                                            <div class="panel-body">
                                                <div class="panel-block">
                                                    <a href="https://www.sublimetext.com/">Sublime Text (Code Editor)</a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://www.visualstudio.com/">Visual Studio (Microsoft Development Environment)</a> (Install enterprise version via MSDN)
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://www.jetbrains.com/phpstorm/">PHP Storm (Editor for PHP)</a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://www.apachefriends.org/">Xampp (local webserver software to run sites on)</a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://www.getpaint.net/">Paint.net (image editing software)</a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="http://www.7-zip.org/">7 zip (file compression software)</a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://www.getcloudapp.com/">CloudApp (Easily take screenshots and clips with instant upload)</a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://products.office.com/nl-nl/home">Microsoft Office</a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://git-scm.com/download/win">GIT (version control system)</a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://www.gitkraken.com/">GIT Kraken (awesome git client)</a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="">SMTP 4 dev (local smtp server)</a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://getcomposer.org">Composer (PHP Package Manager)</a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://nodejs.org/">Node JS (Javascript environment)</a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://products.office.com/nl-nl/visio/flowchart-software?tab=tabs-1">Microsoft Visio </a>(via msdn)
                                                </div>

                                                <div class="panel-block">
                                                    <a href="https://products.office.com/nl-nl/project/project-and-portfolio-management-software?tab=tabs-1">Microsoft Project </a>(via msdn)
                                                </div>
                                            </div>
                                            <h3 class="is-3">Useful online apps</h3>
                                            <div class="panel-body">
                                                <div class="panel-block">
                                                    <a href="https://asana.com"> Asana (Project Management Tool) </a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://codepen.io"> Codepen.io ( Make and share runnable code snippets ) </a>
                                                </div>
                                                <div class="panel-block">
                                                    <a href="https://github.com"> Github ( Biggest open source development platform ) </a>
                                                </div>
                                            </div>

                                        </nav>


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
                categories: [],
                subCategories: [],
                active : '',
                subActive: ''
            }

        },

        mounted: function() {
            //TODO: Load from database instead of plain JSON file
            axios.get('json/series_data.json').then(response =>{
                this.categories = response.data;
                this.subCategories = ['Videos', 'Workbook', 'Resources'];
                this.setActive(this.categories[0]);
                this.setSubActive(this.subCategories[0]);
            });
        },

        methods: {

            setActive : function(name) {
                this.active = name;
            },

            setSubActive: function(name) {
                this.subActive = name;
            },

            isActive : function(name)
            {
                return name === this.active.name ? true : false;
            },

            isSubActive: function(name)
            {
                return name === this.subActive ? true : false;
            },

            serieClicked : function(tag)
            {
                document.location.href= "/learn/" +  tag;
            }

        }
    }


</script>

<style scoped>

    .sub-title {
        text-align: center;
    }

</style>