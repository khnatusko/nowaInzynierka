<template>
        <main>
         <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">              
                        <div class="card-header"><h1>Tutaj wprowadzisz statystyki</h1></div>
                        <div class="card-body">
                        <form @submit.prevent="createparameters()">    
                            <div class="form-group" v-for="(input,k) in forma" :key="k">
                            <label for="name"> Nazwa</label>
                            <input type="text"  v-model="input.name" class="form-control" name="name" placeholder="Podaj nazwe" >
                            <label for="value"> Wartość</label>
                            <input type="text"  v-model="input.value" class="form-control" name="value" placeholder="Podaj wartość" >
                            <span>
                                <i class="bi bi-dash-circle-fill" @click="remove(k)" id="red" v-show="k || ( !k && forma.length > 1)">-</i>
                                <i class="bi bi-plus-circle-fill" @click="add(k)" id="green" v-show="k == forma.length-1">+</i>
                            </span>
                            

                                <label for="card">Karta Postaci</label>
                                    <select v-model="form.card" class="form-control" name="card" placeholder="Card">
                                        <option value='0'> Wybierz dla której karty postaci statystyki</option>
                                        <option v-for='card in cards' :key='card.name' :value='card.idCardsCharacters'>{{ card.name }}</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-lg btn-primary"  >Dodaj parametry</button>    
                                  
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
    </div>
        </main>

</template>
<script>

import axios from 'axios'

axios.defaults.withCredentials = true;
export default {
    data() {
        return{
            forma: [{
                name: '',
                value: '',
                
                
            }],
            form: {             
                card:0,
            },
            
            
            cards: {},
            errors: {},
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            currentUser: {},
            token: localStorage.getItem('token') 

        
        }
    },
    methods:{
        getCards(){
            axios.get('/getCards').then(function(response){
                console.log(response.data)
                this.cards = response.data;
            }.bind(this));
        },

        createparameters(){
            axios.post('/createparameters',{myArray: this.forma, myCard: this.form}).then((response)=>{
                console.log(response.data)
                this.form.card = '',
                this.forma.name = this.forma.value = ''
                console.log('Parametry dodane')


            }).catch((errors) =>{
                this.errors = errors.response.data.errors
                this.$toaster.error('Parameters error!')
                console.log(errors.response.data.errors)
            })
        },
         add(index) {
            this.forma.push({ name: "",value: "" });
        },
        remove(index) {
            this.forma.splice(index, 1);
        },
        


    },
    created: function(){
        this.getCards();
  
    },
    mounted() {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            
           
        }
}
</script>
