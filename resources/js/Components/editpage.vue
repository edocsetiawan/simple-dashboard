<template>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Role</div>
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" class="form-control" v-model="parameter.name" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="name">Status : </label>
                            <select v-model="parameter.status">
                                <option v-for="statuses in status" :value="statuses.name">{{statuses.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Position</label>
                            <input type="name" class="form-control" v-model="parameter.position">
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color:green;border-color:green">Submit</button>
                    </form>
                    <button class="btn btn-primary" style="float:right;margin-top:-38px;background-color:red;border-color:red" @click="cancel()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['datauser'],
    data(){
        return {
            parameter :{
                id : null,
                name : '',
                status : '',
                position : '',
            },
            status : [
                {key:1, name:"active"},
                {key:2, name:"inactive"}
            ],
        }
    },
    mounted(){
        this.init();
    },
    methods :{
        init(){
            if(this.datauser){
                this.is_new = false;
                this.parameter.id = this.datauser.id;
                this.parameter.name = this.datauser.name;
                this.parameter.status = this.datauser.status;
                this.parameter.position = this.datauser.position;
            }
        },
        cancel() {
            this.$router.push({name: 'landingpage'});
        },
        submit(){
            if(this.parameter.name === ''){
                alert("Please fill name!");
            }else if(this.parameter.status === ''){
                alert("Please fill status!");
            }else if(this.parameter.position === ''){
                alert("Please fill position!");
            }else{
                if(confirm("Are you sure ? ")){
                let url = `/api/edit-role`;
                this.axios.post(url,this.parameter,{
                    headers : {
                        'Authorization': 'Bearer '+localStorage.getItem('token')
                        }
                    }).then((response)=>{
                    if(response.data.success){
                        alert("Update success")
                        this.$router.push({name: 'landingpage'});
                    }else{
                        alert("something went wrong");
                    }
                }); 
            }
            }
        }
    }
}
</script>