<template>
<div class="row">
  <div class="col-8">
    <div class="card card-default">
      <div>
        <div class="d-block text-center">
            <form class="form-horizontal">
            <div class="form-group row">
              <div class="col-sm-10">
                <input type="file" class="form-control" id="customFile" v-on:change="change">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" v-model="topcord">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" v-model="leftcord">
                </div>
              </div>
                <label for="card">Avatar</label>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <button type="submit" @click.prevent="createAvatar" class="btn btn-danger"> Stwórz </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="p-2" v-for="(avatar, index) in avatary" :key="index" :style="cordValue">
        <div v-if="avatar.file !== null">
          <movable  :bounds="{x:[-8,800],y:[-30,300]}"  shiftKey="true"><img  class="testmove" :src="`http://localhost:8000/images/${avatar.name}`" /></movable>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.testmove {
        position: absolute;
        top: var(--top);
        left: var(--left);
        margin: 200px;
        border-radius: 50%;
      }

</style>
<script>
export default {
    props: ['user'],
    // props:{
    //   top:{
    //     type: Number,
    //     default: -320,
    //   },
    //   left: {
    //     type: Number,
    //     default: 126,
    //   }
    // },
  data() {
    return {
      form: {
        session: 0,
        user: 0,
        photo: '',
        
      },
      topcord: 0,
      leftcord: 0,
      file: '',
      avatary: [],
      sessions: {},

      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                currentUser: {},
                token: localStorage.getItem('token')
    };
  },

  
  methods: {
    change(e) {
        this.file = e.target.files[0];

                let reader = new FileReader();
                reader.readAsDataURL(this.file);
                reader.onload = e => {
                    this.form.photo = reader.result;
                }
    },
    
    createAvatar() {
      this.avatary.push({
        avatar: this.file,
        avatar: this.topcord,
        avatar: this.leftcord,
      });
      let data = new FormData();
                data.append('file', this.file);
                data.append('topcord', this.topcord);
                data.append('leftcord', this.leftcord);

                axios.post('/createAvatar',data,this.form).then((res) =>{
                        this.topcord = this.leftcord = ''                
                    })
                    .catch(function (errors) {
                        this.errors = errors.response.data.errors
                        console.log(errors.response.data.errors)
                    });
    },
    fetchAllAvatar() {
      axios.get("/fetchAllAvatar").then((response) => {
        this.avatary = response.data;
      });
    },
  },
  created() {
    this.fetchAllAvatar();
    Echo.join("rpg")
    .listen("MoveEvent", (event) => {
       this.avatary.push({
           avatar: event.avataricon.name,
           user: event.user
           });
      
    });
  },
  mounted() {
    this.fetchAllAvatar();
    
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            
            axios.get('/user').then((response) => {
                this.currentUser = response.data
                
            }).catch((errors) => {
                console.log(errors)
            })
  },
 computed:{
            cordValue(){
              return{
                '--top': this.topcord+'px',
                '--left': this.leftcord+'px'
              }
            },
        },
};
</script>