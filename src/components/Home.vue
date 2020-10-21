<template src="@/templates/home.html">

    

</template>

<script>
  import axios from 'axios'
export default {
  name: 'Home',
  data(){
  return{ 
    errorMsg: "",
    successMsg: "",
    //addUser component bata aaxa
    showAddModal: false,
    //editUser component bata aaxa
    showEditModal: false,
    //deleteUser component bata aaxa
    showDeleteModal: false,
    users: [],
    newUser: {name: "", email: "", phone: ""},
    currentUser: {}

    
  }
},


mounted: function(){
  // to get all data and added data automatically/directly in the table without being having to load webpage over and over
    this.getAllUsers();
},
methods: {
  // requesting data to the table 
   getAllUsers(){
        let app = this;
      axios.get('http://localhost/vueApps/crud-app/src/?action=read')
      .then(function(response){
        if(response.data.error){
          app.errorMsg = response.data.message;
        }
        else{
          app.users = response.data.users;
        }
      })
   },
   addUser(){
      // to add data in the table
         let app = this;
        let formData = app.toFormData(app.newUser);
         axios.post('http://localhost/vueApps/crud-app/src/?action=create', formData)
      .then(function(response){
        app.newUser = {name: "", email: "", phone: ""};
        if(response.data.error){
          app.errorMsg = response.data.message;
        }
        else{
          app.successMsg = response.data.message;
          app.getAllUsers();
        }
      })
   },

    updateUser(){
      // to update data in the table
         let app = this;
        let formData = app.toFormData(app.currentUser);
         axios.post('http://localhost/vueApps/crud-app/src/?action=update', formData)
      .then(function(response){
        app.currentUser = {};
        if(response.data.error){
          app.errorMsg = response.data.message;
        }
        else{
          app.successMsg = response.data.message;
          app.getAllUsers();
        }
      })
   },

    deleteUser(){
      // to delete data in the table
         let app = this;
        let formData = app.toFormData(app.currentUser);
         axios.post('http://localhost/vueApps/crud-app/src/?action=delete', formData)
      .then(function(response){
        app.currentUser = {};
        if(response.data.error){
          app.errorMsg = response.data.message;
        }
        else{
          app.successMsg = response.data.message;
          app.getAllUsers();
        }
      })
   },
   
   toFormData(obj){
     //to append data in the table using FormData
       var fd = new FormData();
       for(var i in obj){
         fd.append(i,obj[i]);
       }
       return fd;
   },
   // this method is for updateUser() method
   selectUser(user){
     this.currentUser = user;
   },
   clearMsg(){
     //to clear the errorMsg and successMsg
     this.errorMsg = "";
     this.successMsg = "";
   }
}
 

}
</script>


