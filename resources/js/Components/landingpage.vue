<template>
    <div>
    <div class="row justify-content-md-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">Main Menu</div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Welcome, glad to see you here!</label> 
                <button type="submit" class="btn btn-primary" style="background-color : red !important;border-color : red !important;float:right" @click="logout()">LOGOUT</button>
            </div>
            <div class="form-group" >
                <label for="score">User List</label>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Position</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody v-for="users in user_list">
                    <tr>
                        <td>{{users.name}}</td>
                        <td>{{users.email}}</td>
                        <td>{{users.status}}</td>
                        <td>{{users.position}}</td>
                        <td align="center"><router-link :to="{name: 'editpage', params: { datauser: users }}" class="btn btn-primary" style="background-color : green !important;border-color : green">Edit</router-link></td>
                        <td align="center"><button type="submit" class="btn btn-primary" style="background-color : red !important;border-color : red !important;" @click="deletedata(users.id)">DELETE</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
    data(){
        return {
            token : '',
            user_list : {},
        }
    },
    mounted(){
        this.init();
    },
    methods :{
        init : function(){
            if(localStorage.getItem('token') == null){
                alert("Please login first!");
                this.$router.push({name: 'homepage'});
            }else{
                let url = `/api/user-list`;
                this.axios.get(url,{
                    headers : {
                        'Authorization': 'Bearer '+localStorage.getItem('token')
                    }
                }).then((response) => {
                if(response.data.success){
                    this.user_list = response.data.data;
                }else{
                    alert("something went wrong");
                }
            });
            }

        },
        logout : function(){
            if(confirm("Do you really want to leave?")){
                localStorage.removeItem('token');
                this.$router.push({name: 'homepage'});
            }
        },
        deletedata : function(id){
            var formData = new FormData();
            formData.append('id',id);
            if(confirm("Are you sure ? ")){
                let url = `/api/delete-role`;
                this.axios.post(url,formData,{
                    headers : {
                        'Authorization': 'Bearer '+localStorage.getItem('token')
                        }
                    }).then((response) => {
                    if(response.data.success){
                        alert("Delete success!");
                        location.reload();
                    }else{
                        alert("something went wrong");
                    }
                });
            }
        }
    }
}
</script>