<template>
  <div class="row justify-content-md-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form @submit.prevent="userLogin">
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" v-model="parameter.email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" v-model="parameter.password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
          <button class="btn btn-primary" style="float:right;margin-top:-38px;background-color:green;border-color:green" @click="register()">Register</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return {
            parameter : {}
        }
    },
    mounted(){
    },
    methods :{
        userLogin : function() {
          let url = `/api/login`;
          this.axios.post(url, this.parameter).then((response) => {
            if(response.data.success){
                if(response.data.data.token == null){
                    alert("Please contact administrator to access this page!");
                }else{
                    localStorage.setItem('token', response.data.data.token) 
                    this.$router.push({name: 'landingpage'});
                }
            }else{
                alert("something went wrong");
                this.parameter = {};
            }
            
          });
        },
        register : function() {
          this.$router.push({name: 'registerpage'});
        }
    }
}
</script>