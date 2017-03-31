<template>
    <div class="content top-ranking">
        <table class="table">
            <thead>
            <tr>
                <th> Pos </th>
                <th> House </th>
                <th> Points </th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="house in houses">
                <td> {{ house.id }} </td>
                <td> {{ house.name }} </td>
                <td> 167 </td>
            </tr>

            </tbody>
        </table>
        <a> more statistics </a>

    </div>
</template>


<script>
    export default {
        data: function()
        {
            return {
                houses: [],
                house :{
                    id: "",
                    points: ""
                }
            }
        },

        mounted: function()
        {
            this.fetchHouses();
        },

        methods :
        {
            fetchHouses: function()
            {
                this.$http.get('api/house').then(function(res){
                   this.houses = res.data;
                });
            }
        }

    }
</script>