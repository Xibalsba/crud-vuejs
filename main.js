var app = new Vue({
  el:"#app",
  data:{
    errorMsg:false,
    successMsg:false,
    modalUsuarioNuevo:false,
    modalUsuarioEditar:false,
    modalUsuarioEliminar:false,
    users:[],
    newUser:{nombre:"",correo:"",telefono:""},
    currentUser:{}
  },
  mounted: function(){
    this.getAllUsers();
  },
  methods:{
    getAllUsers(){
      axios.get("http://localhost/vuejs/controller.users.php?action=index").then(function(response){
        // console.log(response);
        if(response.status == 200){
          this.app.users = response.data;
          // console.log(this.app.users);
        }else{
          this.app.errorMsg = "No se pueden mostrar los datos.";
        }
      });
    },
    toFormData(obj){
      var fd = new FormData();
      for(var i in obj){
        fd.append(i,obj[i]);
      }
      return fd;
    },
    selectUser(user){
      app.currentUser = user;
    },
    addUser(){
      var formData = app.toFormData(app.newUser);
      
      axios.post("http://localhost/vuejs/controller.users.php?action=insert",formData).then(function(response){
        // console.log(response);
        this.app.newUser = {nombre:"",correo:"",telefono:""};
        if(response.status == 200){
          this.app.successMsg = "el usuario creado correctamente.";
          this.app.getAllUsers();
        }else{
          this.app.errorMsg = "ocurrió un error al agregar usuario.";
        }
      });
    },
    updateUser(){
      var formData = app.toFormData(app.currentUser);
      
      axios.post("http://localhost/vuejs/controller.users.php?action=update",formData).then(function(response){
        // console.log(response);
        this.app.currentUser = {};
        if(response.status == 200){
          this.app.successMsg = "el usuario ha sido actualizado.";
          this.app.getAllUsers();
        }else{
          this.app.errorMsg = "ocurrió un error al actualizar los datos del usuario, inténtelo de nuevo.";
        }
      });
    },
    deleteUser(){
      var formData = app.toFormData(app.currentUser);
      
      axios.post("http://localhost/vuejs/controller.users.php?action=delete",formData).then(function(response){
        // console.log(response);
        this.app.currentUser = {};
        if(response.status == 200){
          this.app.successMsg = "el usuario fue eliminado.";
          this.app.getAllUsers();
        }else{
          this.app.errorMsg = "ocurrió un error al eliminar el usuario, inténtelo de nuevo.";
        }
      });
    }
  }
});
