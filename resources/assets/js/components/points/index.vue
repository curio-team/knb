<template>

    <div class="root-element section">
        <h1 class="is-title">Points</h1>
        <div class="panel">
            <div class="panel-heading" v-if="inHistory.length > 0">
                Added points this session:
            </div>

            <div v-for="data in inHistory" class="panel-block">
                {{data.type}} {{data.points}} points to {{data.name}} for {{data.reason}}
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-body">
                <div class="field">
                    <select v-model="allocate.type" class="input">
                        <option value="assign">Assign</option>
                        <option value="deassign">De-assign</option>
                    </select>
                </div>
                <div class="field">
                    <input class="input" placeholder="amount points" type="number" name="" id="" v-model="allocate.points">
                </div>
                <p>to &nbsp;</p>
                <div class="field is-grouped">
                    <input class="input" type="text" placeholder="search student by name" v-on:keyup="checkStudent" v-model="keyWords">
                </div>
                <p>because: &nbsp;</p>
                <div class="field is-grouped">
                    <input class="input" type="text" placeholder="Reason" v-model="allocate.reason">
                </div>
                <button class="button is-primary" v-on:click="allocation()">Assign</button>
            </div>
        </div>

        <div v-for="student in studentSelection">

            <p v-on:click="assignStudent(student)" href="">{{student.name}}</p>

        </div>
    </div>
</template>

<script>
    export default {

        data :  function(){
            return {
                students: [],
                studentSelection: [],
                keyWords: "",
                allocate: {
                    type: "assign",
                    points: "",
                    reason: "",
                    student: "",
                    id: ""
                },
                inHistory: []
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
                },

                assignStudent: function(student)
                {
                    this.keyWords = student.name;
                    this.allocate.id = student.id;
                    this.studentSelection = [];
                },

                allocation: function()
                {
                    var that = this;
                    axios.post('/dashboard/points', {
                        type: this.allocate.type,
                        points: this.allocate.points,
                        reason: this.allocate.reason,
                        user_id: this.allocate.id
                    }).then(function(res){

                        that.inHistory.push({
                            type:   'assigned',
                            points: that.allocate.points,
                            reason: that.allocate.reason,
                            name: res.data.name
                        });
                    });
                }

        }
    }


</script>