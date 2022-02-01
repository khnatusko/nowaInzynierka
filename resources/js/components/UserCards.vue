<template>
  <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                     <th>ID</th>
                      <th>Name</th>
                      <th>Height</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr v-for="card in cards" :key="card.idCardsCharacters">
                      <td>{{card.idCardsCharacters}}</td>
                      <td>{{card.name}}</td>
                      <td>{{card.height}}</td>
                    </tr>
                  </tbody>
                </table>
</template>
<script>
    export default {

        data() {
            return {
                card: 0,
                cards: {},

                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                currentUser: {},
                token: localStorage.getItem('token')
                
            };
        },
        methods: {
            getCardsUser(){
                axios.get('/getCardsUser').then(function(response){
                    console.log(response.data)
                    this.cards = response.data;
                }.bind(this));
            }
        },
        mounted() {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            
            axios.get('/user').then((response) => {
                this.currentUser = response.data
                
            }).catch((errors) => {
                console.log(errors)
            })
            
        },
        created(){
            this.getCardsUser();

        },
    }

</script>