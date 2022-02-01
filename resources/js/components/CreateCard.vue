<template>
<main>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">              
                        <div class="card-header"><h1>Stwórz kartę postaci</h1></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                            <div class="form-group">
                            <label for="name"> Imię</label>
                            <input type="text" v-model="form.name" class="form-control" name="name" placeholder="Imię" ><br>
                            </div>
                                </div>
                                <div class="col-md-6">
                            <div class="form-group">
                            <label for="height"> Wzrost (w cm)</label>
                            <input type="text" v-model="form.height" class="form-control" name="height" placeholder="Wzrost" ><br>
                            </div>
                                </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="weight"> Waga (w kg)</label>
                            <input type="text" v-model="form.weight" class="form-control" name="weight" placeholder="Waga" ><br>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="eyes_color"> Kolor oczu</label>
                            <input type="text" v-model="form.eyes_color" class="form-control" name="eyes_color" placeholder="Kolor oczu" ><br>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="hair_color"> Kolor włosów</label>
                            <input type="text" v-model="form.hair_color" class="form-control" name="hair_color" placeholder="Kolor włosów" ><br>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="detail"> Szczegół</label>
                            <input type="text" v-model="form.detail" class="form-control" name="detail" placeholder="Szczegół" ><br>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="age"> Wiek</label>
                            <input type="text" v-model="form.age" class="form-control" name="age" placeholder="Wiek" ><br>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="race"> Rasa</label>
                            <input type="text" v-model="form.race" class="form-control" name="race" placeholder="Rasa" ><br>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="star"> Znak zodiaku</label>
                            <input type="text" v-model="form.star" class="form-control" name="name" placeholder="Znak zodiaku" >
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="sex"> Płęć</label>
                            <input type="text" v-model="form.sex" class="form-control" name="sex" placeholder="Płęć" ><br>
                            </div>
                            </div>
                            <div class="col-md-6" >
                            <div class="form-group">      
                                <button class="btn btn-primary" id="stworz"  @click="createcard" >Stwórz</button>
                            </div> 
                            </div> 
                            
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
    data() {
        return{
            form:  {
            name: '',
            height: '',
            weight: '',
            eyes_color: '',
            hair_color: '',
            detail: '',
            age: '',
            race: '', 
            sex: '',
            user: 0,

            
        },
         
        
         errors: {},
         csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            currentUser: {},
            token: localStorage.getItem('token') 
         
      }
    },
    methods:{  
         
        createcard(){
            axios.post('/createcard',this.form).then((response)=>{
                console.log(response.data)
                this.form.name = this.form.height = this.form.weight = this.form.eyes_color = this.form.hair_color = this.form.detail = this.form.age = this.form.race = this.form.sex = this.form.user = '',
                console.log('Załatwiono')
                
            }).catch((errors) =>{
                this.errors = errors.response.data.errors
                console.log(errors.response.data.errors)
            })
        },     
        },
        created: function(){
             
    },
    mounted() {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            
            
        }
}
</script>