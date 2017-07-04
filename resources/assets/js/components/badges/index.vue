<template>
    <div class="root-element section">
       <input v-on:keyup="checkStudent"  v-model="keyWords" class="input" placeholder="Select student">
       <nav class="panel">
            <a v-on:click="assignStudent(student)" v-for="student in studentSelection" class="panel-block">{{student.name}}</a>
       </nav>
        <div v-if="activeStudent.name.length > 0" class="columns" style="flex-wrap: wrap">
            <h4 class="is-4">Badges for {{activeStudent.name}}</h4>
            <div class="columns" style="flex-wrap: wrap">
                 <div style="position: relative" class="card column is-one-quarter" v-for="badge in badges">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://bulma.io/images/placeholders/1280x960.png" alt="Image">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-5">{{badge.title}}</p>
                            </div>
                        </div>

                        <div class="content">
                            {{badge.description}}
                        </div>


                    </div>

                     <button v-on:click="toggleBadge(badge.id)" style="position: absolute; bottom: 15px" class="button is-large"><i style="color: green" v-bind:class="badgeActive(badge.id)" class="badge-toggler" ></i></button>

                 </div>
            </div>
        </div>

    </div>
</template>


<script>
    export default {

        data: function() {
            return {
                badges: [],
                keyWords: "",
                students: [],
                studentSelection: [],
                activeStudent: {
                    name: ""
                },
                activeBadges : []

            }
        },



        mounted: function() {
            this.getBadges();
            this.getStudents();
        },

        methods: {

            badgeActive: function(badge_id)
            {
                var classes = {};
                if (!this.activeBadges.includes(badge_id))
                {
                    classes = {
                        'fa fa-toggle-off' : true
                    }
                } else {
                    classes = {
                        'fa fa-toggle-on' : true
                    }
                }
                return classes;
            },

            getBadges: function() {
                var that = this;
                axios.get('/api/badge')
                    .then(function(res){
                        that.badges = res.data;
                    });
            },

            getStudents: function() {
              var that = this;
              axios.get('/api/students')
                  .then(function(res){
                     that.students = res.data;

                  });
            },

            checkStudent: function()
            {
                var selection = [];

                for(var i =0; i < this.students.length; i++)
                {

                    if ( this.students[i].name.toLowerCase().includes(this.keyWords) && this.keyWords.length )
                    {
                        selection.push(this.students[i]);
                    }
                }

                this.studentSelection = selection;
            },

            assignStudent: function(student)
            {
                var that = this;
                this.studentSelection = [];
                this.keyWords = "";
                axios.get('/api/student/' + student.id)
                    .then(function(res){
                        that.activeStudent = res.data;
                        for(var i = 0; i < res.data.badges.length; i++)
                        {
                            that.activeBadges.push(res.data.badges[i].id);
                        }
                    });

            },

            hasBadge: function(badge_id)
            {

            },

            toggleBadge : function(badge_id)
            {
                var that = this;
                axios.post('/dashboard/badges/toggle', {
                    badge_id:   badge_id,
                    student_id: that.activeStudent.id
                }).then(function(res){

                })
            }
        }

    }
</script>