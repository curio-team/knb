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
        data()
        {
            return {
                houses: [],
                house :{
                    id: "",
                    points: ""
                }
            }
        },

        created() {
            axios.get('api/house')
                    .then(response => this.houses = response.data)
        }
    }
</script>