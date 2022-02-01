<template>


        <main>
<div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">              
                        <div class="card-header"><h1>Utwórz grupę</h1></div>
                        <div class="card-body">
                            <div class="form-group">
                            <label for="title"> Nazwa gry</label>
                            <input type="text" v-model="form.title" class="form-control" name="title" placeholder="Nazwa gry" >
                            </div>

                            <div class="form-group">
                            <label for="name"> Data</label>
                            <input type="date" v-model="form.gametime" class="form-control" name="gametime" placeholder="Data gry" >
                            </div>

                           <div class="form-group">
                            <label for="user"> Użytkownicy</label>
                            <select v-model="form.user" class="form-control" name="User_idUser" placeholder="User">
                                <option value='0'> Wybierz użytkownika</option>
                                <option v-for='user in users' :key='user.nick' :value='user.idUser'>{{  user.nick }}</option>
                            </select>
                            </div>

                            <div class="form-group">
                            <label for="user"> Użytkownicy</label>
                            <select v-model="form.user1" class="form-control" name="User_idUser" placeholder="User">
                                <option value='0'> Wybierz użytkownika</option>
                                <option v-for='user1 in users' :key='user1.nick' :value='user1.idUser'>{{  user1.nick }}</option>
                            </select>
                            </div>

                            <div class="form-group">
                            <label for="user"> Użytkownicy</label>
                            <select v-model="form.user2" class="form-control" name="User_idUser" placeholder="User">
                                <option value='0'> Wybierz użytkownika</option>
                                <option v-for='user2 in users' :key='user2.nick' :value='user2.idUser'>{{  user2.nick }}</option>
                            </select>
                            </div>

                            <div class="form-group">
                            <label for="user"> Użytkownicy</label>
                            <select v-model="form.user3" class="form-control" name="User_idUser" placeholder="User">
                                <option value='0'> Wybierz użytkownika</option>
                                <option v-for='user3 in users' :key='user3.nick' :value='user3.idUser'>{{  user3.nick }}</option>
                            </select>
                            </div>
                            

                            

                            <div class="form-group">      
                                <button class="btn btn-lg btn-primary" @click="creategame" >Utwórz</button>
                                
                            </div> 

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
        data(){
            
            return {
                form: {
                    title: '',
                    gametime: '',
                    user: 0,
                    user1: 0,
                    user2: 0,
                    user3: 0,
                    
                },
               
                users:{},
                errors:{},
                
              csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              
              currentUser: {},
              token: localStorage.getItem('token') 
            }
        },
        methods:{
            creategame(){
            axios.post('/creategame',this.form).then((response)=>{
                console.log(response.data)
                this.form.title = this.form.gametime = ''
                this.form.user = this.form.user1 = this.form.user2 = this.form.user3 = '',     
                console.log(this.forma)
                console.log(this.form)

            }).catch((errors) =>{
                this.errors = errors.response.data.errors
                this.$toaster.error('Gra error!')
                console.log(errors.response.data.errors)
            })
        },
            getUsers(){
            axios.get('/getUsers').then(function(response){
                console.log(response.data)
                this.users = response.data;
            }.bind(this));
        },
         add(index) {
            this.forma.push({ user: 0 });
        },
        remove(index) {
            this.forma.splice(index, 1);
        },
        },
        
        created: function()
        {
        this.getUsers();
           
        },
        

        
        mounted() {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            
            axios.get('/user').then((response) => {
                this.currentUser = response.data
                
            }).catch((errors) => {
                console.log(errors)
            })
        }
       
    }
</script>


<style scoped>

</style>