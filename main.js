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
        console.log(response);
        if(response.status == 200){
          this.app.users = response.data;
          console.log(this.app.users);
        }else{
          this.app.errorMsg = "Error";
        }
      });
    }
  }
});
