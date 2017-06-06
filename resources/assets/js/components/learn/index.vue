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
                categories: [],
                active : ''
            }

        },

        mounted: function() {
            axios.get('json/series_data.json').then(response =>{
                this.categories = response.data;
                this.setActive(this.categories[0]);
            });
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