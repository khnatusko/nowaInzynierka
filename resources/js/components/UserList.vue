<template>
        <main>
            

            <div class="row justify-content-center">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                
                <input type="text" placeholder="Search" v-model="keyword" class="form-control form-control-sm">
                <table class="table table-hover" >
                    
                <tbody>
                    
                    <tr>      

                        <th>Name</th>
                        <th>Surname</th>
                        <th>Nick</th>
                        <th>Email</th>
                </tr>
                
                <tr  v-for="user in users.data" :key="user.idUser">
                    
                    <td>{{user.name}}</td>
                    <td>{{user.surname}}</td>
                    <td>{{user.nick}}</td>
                    <td>{{user.email}}</td>
                    
                </tr>
                
                </tbody></table>
            <pagination :data="users" @pagination-change-page="listUsers" class="justify-content-center"></pagination>
            
          </div>
        </div>
    </div>
</div>
        </main>
 
</template>
<script>
    export default {
        data(){
            return {
                users: {},
                keyword: null,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                currentUser: {},
                token: localStorage.getItem('token') 
            }
        },
        watch:{
            keyword(after, before){
                this.getResults();
            }
        },
        methods:{          
            listUsers(page = 1) {
                axios.get('/listuser?page=' + page).then(response =>{
                    this.users = response.data;
                });
            },

            getResults(){
                axios.get('/search_user',{params: {keyword: this.keyword} }).then(response => this.users.data = response.data).catch(error => {});
            }
            
        },
        created(){
            this.listUsers()
        },
        mounted() {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
            
        
        }
    }
</script>


<style scoped>



</style>