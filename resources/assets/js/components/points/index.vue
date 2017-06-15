<template>

    <div class="root-element section">
        <input class="input" type="text" placeholder="search student by name" v-on:keyup="checkStudent" v-model="keyWords">

        <div v-for="student in studentSelection">
            <a href="">{{student.name}}</a>
        </div>
    </div>
</template>

<script>
    export default {

        data :  function(){
            return {
                students: [],
                studentSelection: [],
                keyWords: ""
            }

        },

        props: ['d'],

        mounted : function()
        {
            this.students = JSON.parse(this.d);
        },

        methods: {

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
                }

        }
    }


</script>