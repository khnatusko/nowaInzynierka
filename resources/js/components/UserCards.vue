<template>
<div class="row">
    <div class="col">
        
  <table class="table table-hover text-nowrap" v-if="cards.length > 0">
                  <thead>
                    <tr>
                     <th>Cecha</th>
                     <th>Wartość</th>
                    </tr>
                  </thead>
                  <tbody v-for="card in cards" :key="card.idCardsCharacters">
                  <tr>
                      <th>ID: </th>
                      <td>{{card.idCardsCharacters}}</td>
                  </tr>
                  <tr>
                      <th>Imię: </th>
                      <td>{{card.name}}</td>
                  </tr>
                  <tr>
                      <th>Wzrost: </th>
                      <td>{{card.height}}</td>
                  </tr>
                  <tr>
                      <th>Waga: </th>
                      <td>{{ card.Weight }}</td>
                  </tr>
                  <tr>
                      <th>Kolor oczu: </th>
                      <td>{{ card.eyes_color }}</td>
                  </tr>
                  <tr>
                      <th>Kolor włosów: </th>
                      <td>{{ card.hair_color }}</td>
                  </tr>
                  <tr>
                      <th>Szczegół wyróżniony: </th>
                      <td>{{ card.detail }}</td>
                  </tr>
                  <tr>
                      <th>Wiek: </th>
                      <td>{{ card.age }}</td>
                  </tr>
                  <tr>
                      <th>Rasa: </th>     
                      <td>{{ card.race }}</td>
                  </tr>
                  <tr>
                      <th>Znak zodiaku: </th>
                      <td>{{ card.star }}</td>
                  </tr>
                  <tr>
                      <th>Płęć: </th>
                      <td>{{ card.sex }}</td>
                  </tr>
                  
                  </tbody>
                  <br>
                </table>
                
               
    </div>
    <div class="col">
        <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                     <th>ID Karty</th>
                     <th>Parametr</th>
                     <th>Wartość</th>
                    </tr>
                  </thead>
                  <tbody v-for="parameter in parameters" :key="parameter.idParamiters">
                      <td>{{parameter.idCardsCharacters}}</td>
                      <td>{{parameter.name}}</td>
                      <td>{{parameter.value}}</td>
                  </tbody>
                </table>
                
    </div>
                 
</div>
</template>
<script>
    export default {

        data() {
            return {
                card: 0,
                cards: {},
                parameter: 0,
                parameters: {},
                keyword: null,

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
            },
            getParameters(){
                axios.get('/getParameters').then(function(response){
                    console.log(response.data)
                    this.parameters = response.data;
                }.bind(this));
            },
            
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
            this.getParameters();

        },
    }

</script>