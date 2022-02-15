<template>

        <div class="row align-items-start">
            <div class="col" style="border: 5px solid" id="lewypanel">
                <form class="form-horizontal">
            <div class="form-group row">
              <div class="col-sm-10">
                <input type="file" class="form-control" id="customFile" v-on:change="onChange">
                </div>
              </div>
                <label for="card">Gra</label>
                                    <select v-model="form.session" class="form-control" name="Session_idSession" placeholder="Session">
                                        <option value='0'> Wybierz grę dla mapy</option>
                                        <option v-for='session in sessions' :key='session.title' :value='session.idSession'>{{ session.title }}</option>
                                    </select>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <button type="submit" @click.prevent="formSubmit" class="btn btn-danger"> Submit </button>
                </div>
              </div>
            </form>
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
                    <div class="p-2" v-for="(map, index) in mapy" :key="index">
                        <div id="refresh-map" v-if="map.file !== null">
                            
                            <img :src="`http://localhost:8000/images/${map.name}`" />
                                <button @click="deletePost(map.idMaps)" class="btn btn-warning">Remove</button>
                        </div>   
                    </div>
                        <button class="btn btn-primary" @click="refreshMap()">Odśwież</button>               
                        <movable class="testmove1" v-model="avatar1" posTop="444" posLeft="444" :bounds="{x:[-8,800],y:[-30,300]}"  shiftKey="true"><span></span></movable>
                        <movable class="testmove2" v-model="avatar2" :bounds="{x:[-28,800],y:[-30,300]}" shiftKey="true"><span></span></movable>
                        <movable class="testmove3" :style="avatar3Style" v-model="avatar3" :bounds="{x:[-8,800],y:[-20,300]}" shiftKey="true"><span></span></movable>
                        <movable class="testmove4" v-model="avatar4" :bounds="{x:[-28,800],y:[-20,300]}" shiftKey="true"><span></span></movable>     
                </div>
                <div class="form-group">
                    <label for="title">Tytuł notatki</label>
                    <input type="text" v-model="form.title" class="form-control" name="title" placeholder="Tytuł notatki" >
                </div>
                <div class="form-group">
                    <label for="name"> Data</label>
                    <input type="date" v-model="form.date" class="form-control" name="date" placeholder="Data" >
                </div>
                <select v-model="form.session" class="form-control" name="Session_idSession" placeholder="Session">
                                        <option value='0'> Sesja</option>
                                        <option v-for='session in sessions' :key='session.title' :value='session.idSession'>{{ session.title }}</option>
                                    </select>               
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
#refresh{
    overflow: hidden;
    background-repeat: no-repeat;
    
}

.testmove1 {
        position: absolute;
        height: 20px;
        width: 20px;
        margin: 200px;
        border-radius: 50%;
        background: rgb(0, 0, 0);
        color: white;
      }
.testmove2 {
        position: absolute;
        top: -300px;
        left: 126px;
        height: 20px;
        width: 20px;
        margin: 200px;
        border-radius: 50%;
        background: rgb(143, 15, 15);
        color: white;
      }
.testmove3 {
        position: absolute;
        top: calc(var(--avatar3-top));
        left: calc(var(--avatar3-left));
        height: 20px;
        width: 20px;
        margin: 200px;
        border-radius: 50%;
        background: rgb(198, 211, 11);
        color: white;
      }
.testmove4 {
        position: absolute;
        top: -320px;
        left: 126px;
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
                    photo: '',
                    session: 0,
                },
                top: 444,        
                notes: [],
                messages: [],
                newMessage: '',
                users:[],
                avatars:[],
                mapy:[],
                activeUser: false,
                typingTimer: false,
                randomNumber4: '',
                randomNumber6: '',
                randomNumber8: '',
                randomNumber10: '',
                randomNumber20: '',
                randomNumber100: '',
                avatar1: '',
                avatar2: '',
                avatar3: '',
                avatar4: '',
                sound: 0,
                isPlaying: false,
                sounds: {},
                file: '',
                filepreview: null,
                success: '',
                
                sessions:{},
                notes:{},
                
                errors: {},
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
                    this.form.photo = reader.result;
                }
            },
            formSubmit() {
                this.mapy.push({
                    map: this.file,
                });
                let data = new FormData();
                data.append('file', this.file);
                data.append('session', this.form.session)

                axios.post('/upload',data,this.form).then((res) =>{
                        this.form.session = ''                
                    })
                    .catch(function (errors) {
                        this.errors = errors.response.data.errors
                        console.log(errors.response.data.errors)
                    });
            },
            getMap(){
                let photo = (this.form.photo.length > 200) ? this.form.photo :  this.form.photo ;
                return photo;
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
            createnote(){
               this.notes.push({

                }); 
            axios.post('/createnote',this.form).then((response)=>{
                console.log(response.data)
                this.form.title = this.form.date = this.form.text = this.form.user = this.form.session = '',
                console.log(this.form)
            }).catch((errors) =>{
                this.errors = errors.response.data.errors
                this.$toaster.error('Note error!')
                console.log(errors.response.data.errors)
            })
            },
            fetchMessages() {
                axios.get('/messages').then(response => {
                    this.messages = response.data;
                })
            },
            fetchAllMap() {
                axios.get("/fetchAllMap").then((response) => {
                this.mapy = response.data;
            });
            },
            deletePost(idMaps) {
                axios.post("/delet/" + idMaps).then((response) => {
                    this.fetchAllMap();
                    console.log(response);
                })
                .catch((error) => console.log(error));
                this.mapy.splice(idMaps, 1);
            },
            sendMessage() {
                this.messages.push({
                    user: this.user,
                    message: this.newMessage
                });
                axios.post('/messages', {message: this.newMessage});
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
            refreshMap: function(){
                $('#refresh-map').load(' sessiongame');
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
            this.getSession();
            this.getSound();
            this.getNote();
            this.fetchMessages();
            this.fetchAllMap();
            this.refreshMap();
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
                .listen('MapEvent',(event)=>{
                    this.mapy.push({
                        map: event.maps.name,
                        map: event.maps.idMaps,
                        gracz: event.gracz,
                    });
                })
                .listen('NotesEvent',(event)=>{
                    this.notes.push({
                        note: event.textnotes.text,
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
        computed:{
            topValue(){
                var top = -320;
                return `${top}px`
            },
            leftValue(){
                var left = 126;
                return `${left}px`
            },
            avatar3Style(){
                return{
                '--avatar3-top': this.topValue,
                '--avatar3-left': this.leftValue,
                }
            }
        },
    }

</script>