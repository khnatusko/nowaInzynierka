<template>
<div>
  <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                     <th>Cecha</th>
                     <th>Wartość</th>
                    </tr>
                  </thead>
                  <tbody v-for="parameter in parameters" :key="parameter.idParamiters">
                  <tr>
                      <th>ID Karty: </th>
                      <td>{{parameter.CardsCharacters_idCardsCharacters}}</td>
                  </tr>
                  <tr>
                      <th>Nazwa: </th>
                      <td>{{parameter.name}}</td>
                  </tr>
                  <tr>
                      <th>Wartość: </th>
                      <td>{{parameter.value}}</td>
                  </tr>
                  </tbody>
                </table>
                
</div>
</template>
<script>
export default {
    data() {
        return{
        parameter: 0,
        parameters: '',

        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        currentUser: {},
        token: localStorage.getItem('token')

        };
    },
    methods: {
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
            this.getParameters();

        },

}
</script>