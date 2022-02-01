<template>

        <div class="row align-items-start">
            <div class="col" style="border: 5px solid" id="lewypanel">
                <div v-if="success != ''" class="alert alert-success">
                            {{success}}
                        </div>

                        <form @submit="formSubmit" enctype="multipart/form-data">
                            <input type="file" class="form-control" id="customFile" v-on:change="onChange">
                            <label for="card">Gra</label>
                                    <select v-model="session" class="form-control" name="Session_idSession" placeholder="Session">
                                        <option value='0'> Wybierz grę dla mapy</option>
                                        <option v-for='session in sessions' :key='session.title' :value='session.idSession'>{{ session.title }}</option>
                                    </select>
                            
                            <div v-if="filepreview" class="mt-3">
                                <img :src="filepreview" class="figure-img img-fluid rounded" style="max-height:100px;">
                            </div>
                            <button class="btn btn-primary btn-block mt-3">Wgraj mapę</button>
                        </form><br>

                        
                        <form @submit="formSubmit2" enctype="multipart/form-data">
                            <input type="file" class="form-control" id="customFileMusic" v-on:change="onChangeMusic">
                            
                                <button class="btn btn-primary btn-block mt-3">Wgraj utwór</button>
                        </form>
                        <label for="card">Muzyka</label><br>
                                <button class="btn btn-primary btn-sm" @click.prevent="sound.isPlaying ? pause(sound) : play(sound)" v-for="sound in sounds" :key="sound.idSounds">
                                    {{ sound.isPlaying ? 'Pause' : 'Play' }} {{ sound.Name }}
                                </button><br>

                <br>

                <div>
                    <button type="button" class="btn btn-primary" @click="randomNumberk4()" >Rzut kostką k4</button>
                    Wyrzucona liczba na kości: {{ randomNumber4 }}
                </div><br>
                <div>
                    <button type="button" class="btn btn-primary" @click="randomNumberk6()" >Rzut kostką k6</button>
                    Wyrzucona liczba na kości: {{ randomNumber6 }}
                </div><br>
                <div>
                    <button type="button" class="btn btn-primary" @click="randomNumberk8()" >Rzut kostką k8</button>
                    Wyrzucona liczba na kości: {{ randomNumber8 }}
                </div><br>
                <div>
                    <button type="button" class="btn btn-primary" @click="randomNumberk10()" >Rzut kostką k10</button>
                    Wyrzucona liczba na kości: {{ randomNumber10 }}
                </div><br> 
                <div>
                    <button type="button" class="btn btn-primary" @click="randomNumberk20()" >Rzut kostką k20</button>
                    Wyrzucona liczba na kości: {{ randomNumber20 }}
                </div><br>
                <div>
                    <button type="button" class="btn btn-primary" @click="randomNumberk100()" >Rzut kostką k100</button>
                    Wyrzucona liczba na kości: {{ randomNumber100 }}
                </div>

            </div>
            <div id="target-box"  class="col-6" >
                <div id="refresh">
                <img :src="photo">
                </div>
                <div>                  
                        <movable class="testmove1"  shiftKey="true"><span></span></movable>
                        <movable class="testmove2"  shiftKey="true"><span></span></movable>
                        <movable class="testmove3"  shiftKey="true"><span></span></movable>
                        <movable class="testmove4"  shiftKey="true"><span></span></movable>     
                </div>
                <div class="form-group">
                    <label for="title">Tytuł notatki</label>
                    <input type="text" v-model="form.title" class="form-control" name="title" placeholder="Tytuł notatki" >
                </div>
                <div class="form-group">
                    <label for="name"> Data</label>
                    <input type="date" v-model="form.date" class="form-control" name="date" placeholder="Data" >
                </div>               
                <textarea type="text" v-model="form.text" class="form-control"></textarea>
                <div class="form-group">      
                    <button class="btn btn-lg btn-primary" @click="createnote">Stwórz notatke</button>   
                </div> 

            </div>
            <div class="col" id="czat">
           <div class="card card-default">
               <div class="card-header">Czat</div>
               <div class="card-body p-0">
                   <ul class="list-unstyled" style="height:300px; overflow-y:scroll" v-chat-scroll>
                       <li class="p-2" v-for="(message, index) in messages" :key="index" >
                           <strong v-if="message.user">  {{ message.user.name }} : </strong>
                           {{ message.message }}
                       </li>
                   </ul>
               </div>

               <input
                    @keydown="sendTypingEvent"
                    @keyup.enter="sendMessage"
                    v-model="newMessage"
                    type="text"
                    name="message"
                    placeholder="Wyślij swoją wiadomość..."
                    class="form-control">
           </div>
            <span class="text-muted" v-if="activeUser" >{{ activeUser.name }} pisze...</span>
            <div class="card-header">Aktywni użytkownicy</div>
                <div class="card-body">
                    <ul>
                        <li class="py-2" v-for="(user, index) in users" :key="index">
                            {{ user.name }}
                        </li>
                    </ul>
                </div>
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>Użytkownik</th>
                        <th>Notatka</th>
                    </tr>
                  </thead>
                  <tbody><tr>
                      
                  <tr v-for="note in notes" :key="note.idNotes">
                      <td>{{ currentUser.name }}</td>
                      <td>{{note.text}}</td>
                    </tr>
                  </tbody>
                </table>
       </div>

        </div>

</template>
<style scoped>
#target-box{
    overflow: hidden;
    background-repeat: no-repeat;
    
}

.testmove1 {
        display:block;
        position: absolute;
        top: 8px;
        left: 16px;
        height: 20px;
        width: 20px;
        margin: 200px;
        border-radius: 50%;
        background: rgb(0, 0, 0);
        color: white;
      }
.testmove2 {
        display:block;
        position: absolute;
        top: 8px;
        left: 36px;
        height: 20px;
        width: 20px;
        margin: 200px;
        border-radius: 50%;
        background: rgb(143, 15, 15);
        color: white;
      }
.testmove3 {
        display:block;
        position: absolute;
        top: 28px;
        left: 16px;
        height: 20px;
        width: 20px;
        margin: 200px;
        border-radius: 50%;
        background: rgb(198, 211, 11);
        color: white;
      }
.testmove4 {
        display:block;
        position: absolute;
        top: 28px;
        left: 36px;
        height: 20px;
        width: 20px;
        margin: 200px;
        border-radius: 50%;
        background: rgb(41, 12, 201);
        color: white;
      }

</style>

<script>


    export default {
        
        props: ['user'],
        data() {
            return {
                form: {
                    title: '',
                    date: '',
                    text: '',
                    user: 0,
                },        

                messages: [],
                newMessage: '',
                users:[],
                activeUser: false,
                typingTimer: false,
                photo: './images/ruiny.png',
                randomNumber4: '',
                randomNumber6: '',
                randomNumber8: '',
                randomNumber10: '',
                randomNumber20: '',
                randomNumber100: '',
                sound: 0,
                isPlaying: false,
                sounds: {},
                file: '',
                filepreview: null,
                success: '',
                session: 0,
                sessions:{},
                notes:{},
                

                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                currentUser: {},
                token: localStorage.getItem('token')
                
            };
        },
        methods: {
            onChange(e) {
                this.file = e.target.files[0];

                let reader = new FileReader();
                reader.readAsDataURL(this.file);
                reader.onload = e => {
                    this.filepreview = e.target.result;
                }
            },
            createnote(){
            axios.post('/createnote',this.form).then((response)=>{
                console.log(response.data)
                this.form.title = this.form.date = this.form.text = this.form.user = '',
                console.log(this.form)
            }).catch((errors) =>{
                this.errors = errors.response.data.errors
                this.$toaster.error('Note error!')
                console.log(errors.response.data.errors)
            })
            },
            
            
            onChangeMusic(e) {
                this.file = e.target.files[0];

                let reader = new FileReader();
                reader.readAsDataURL(this.file);
                reader.onload = e => {
                    this.filepreview = e.target.result;
                }
            },
            play(sound){
                if(sound){
                sound.isPlaying = true;
                var sound = new Audio(sound);
                sound.play();
                }
            },
            pause(sound){
                if(sound){
                sound.isPlaying = false;
                var sound = new Audio(sound);
                sound.pause();
                }
            },
            // playSound (sound) {
            //     if(sound) {
            //         var audio = new Audio(sound);
            //             audio.play();
            //     }
            // },
            formSubmit(e) {
                e.preventDefault();
                let existingObj = this;

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                let data = new FormData();
                data.append('file', this.file, this.session);

                axios.post('/upload', data, this ,config)
                    .then(function (res) {
                        this.session = '',
                        existingObj.success = res.data.success;
                    })
                    .catch(function (err) {
                        existingObj.output = err;
                    });
            },
            formSubmit2(e) {
                e.preventDefault();
                let existingObj = this;

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                let data = new FormData();
                data.append('file', this.file, this.session);

                axios.post('/uploadMusic', data, this ,config)
                    .then(function (res) {
                        existingObj.success = res.data.success;
                    })
                    .catch(function (err) {
                        existingObj.output = err;
                    });
            },
            getSession(){
                axios.get('/getSession').then(function(response){
                    console.log(response.data)
                    this.sessions = response.data;
                }.bind(this));
            },
            getNote()
            {
                axios.get('/getNote').then(function(response){
                    console.log(response.data)
                    this.notes = response.data;
                }.bind(this));
            },
            getSound(){
                axios.get('/getSound').then(function(response){
                    console.log(response.data)
                    this.sounds = response.data;
                }.bind(this));
            },

            fetchMessages() {
                axios.get('messages').then(response => {
                    this.messages = response.data;
                })
            },
            sendMessage() {
                this.messages.push({
                    user: this.user,
                    message: this.newMessage
                });
                axios.post('messages', {message: this.newMessage});
                this.newMessage = '';
            },
            sendTypingEvent() {
                Echo.join('rpg')
                    .whisper('typing', this.user);
                console.log(this.user.name + ' is typing now')
            },
            
            randomNumberk4: function (min,max) {
                min = Math.ceil(1);
                max = Math.floor(5);
                this.randomNumber4 = Math.floor(Math.random()* (max - min))+min;
            },
            randomNumberk6: function (min,max) {
                min = Math.ceil(1);
                max = Math.floor(7);
                this.randomNumber6 = Math.floor(Math.random()* (max - min))+min;
            },
            randomNumberk8: function (min,max) {
                min = Math.ceil(1);
                max = Math.floor(9);
                this.randomNumber8 = Math.floor(Math.random()* (max - min))+min;
            },
            randomNumberk10: function (min,max) {
                min = Math.ceil(1);
                max = Math.floor(11);
                this.randomNumber10 = Math.floor(Math.random()* (max - min))+min;
            },
            randomNumberk20: function (min,max) {
                min = Math.ceil(1);
                max = Math.floor(21);
                this.randomNumber20 = Math.floor(Math.random()* (max - min))+min;
            },
            randomNumberk100: function (min,max) {
                min = Math.ceil(1);
                max = Math.floor(101);
                this.randomNumber100 = Math.floor(Math.random()* (max - min))+min;
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
            this.getSession();
            this.getSound();
            this.getNote();
            this.fetchMessages();
            Echo.join('rpg')
                .here(user => {
                    this.users = user;
                })
                .joining(user => {
                    this.users.push(user);
                })
                .leaving(user => {
                    this.users = this.users.filter(u => u.idUser != user.idUser);
                })
                .listen('ChatEvent',(event) => {
                    this.messages.push({
                        message: event.chat.message,
                        user: event.user,
                    });
                })
                .listenForWhisper('typing', user => {
                   this.activeUser = user;
                    if(this.typingTimer) {
                        clearTimeout(this.typingTimer);
                    }
                   this.typingTimer = setTimeout(() => {
                       this.activeUser = false;
                   }, 1000);
                })

        },
    }

</script>