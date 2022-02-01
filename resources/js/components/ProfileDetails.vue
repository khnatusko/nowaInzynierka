<template>
        <main>
            <div class="cards">
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-info">
                            <div class="card-head">
                                <span>Dane osobowe</span>
                                <small>ID: {{ currentUser.idUser }} </small><br>
                                <small>Imię i Nazwisko: {{ currentUser.name }} {{ currentUser.surname }}</small><br>
                                <small>Email: {{ currentUser.email }}</small><br>
                                <small>Login: {{ currentUser.login }}</small><br>
                                <small>Nick: {{ currentUser.nick }}</small>
                            </div>
                            <div role="group">
                            
                            </div>
                        </div>
                        <div class="card-chart yellow">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" style="margin-bottom: 10px" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                            </span>
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
                
              csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              
              currentUser: {},
              token: localStorage.getItem('token') 
            }
        },
        methods:{
            
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