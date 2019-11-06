<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Vue CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <script src="https://kit.fontawesome.com/2a6b92cd0f.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div id="app">
      <!-- simulación de navbar del sitio -->
      <div class="container-fluid">
        <div class="row bg-dark">
          <div class="col-md-12">
            <p class="text-center text-light display-4 pt-2" style="font-size:25px;">CRUD con Vue.js</p>
          </div>
        </div>
      </div>

    <!-- mensaje y boton de agregar -->
      <div class="container">
        <div class="row mt-3 mb-4">
          <div class="col-md-6">
            <h3>Usuarios registrados</h3>
          </div>
          <div class="col-md-6">
            <button type="button" name="button" class="btn btn-primary float-right" @click="modalUsuarioNuevo=true"><i class="fas fa-user-plus mr-2"></i>Agregar nuevo usuario</button>
          </div>
        </div>
        <!-- alertas al usuario -->
        <div class="alert alert-danger" role="alert" v-if="errorMsg">
          {{ errorMsg }}
        </div>
        <div class="alert alert-success" role="alert" v-if="successMsg">
          {{ successMsg }}
        </div>
        <!-- tabla de usuarios -->
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Correo</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Opciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users">
                  <th scope="row">{{ user.id }}</th>
                  <td>{{ user.nombre }}</td>
                  <td>{{ user.correo }}</td>
                  <td>{{ user.telefono }}</td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-secondary btn-sm" @click="modalUsuarioEditar=true"><i class="fas fa-pen mr-2"></i>Editar</button>
                      <button type="button" class="btn btn-secondary btn-sm" @click="modalUsuarioEliminar=true"><i class="fas fa-trash mr-2"></i>Eliminar</button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Modal agregar nuevo usuario -->
      <div v-if="modalUsuarioNuevo">
        <transition name="modal">
          <div class="modal-mask">
            <div class="modal-wrapper">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Agregar nuevo usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="modalUsuarioNuevo = false">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post">
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="emailHelp" autocomplete="off" required v-model="app.newUser.nombre">
                      </div>
                      <div class="form-group">
                        <label>Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" autocomplete="off" required v-model="app.newUser.correo">
                      </div>
                      <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" autocomplete="off" required v-model="app.newUser.telefono">
                      </div>
                      <button type="button" class="btn btn-primary" @click="modalUsuarioNuevo=false; addUser();">Agregar usuario</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </transition>
      </div>

      <!-- modal editar usuario -->
      <div v-if="modalUsuarioEditar">
        <transition name="modal">
          <div class="modal-mask">
            <div class="modal-wrapper">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Editar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="modalUsuarioEditar = false">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post">
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="emailHelp" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                        <label>Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" autocomplete="off" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Actualizar usuario</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </transition>
      </div>

      <!-- modal eliminar usuario -->
      <div v-if="modalUsuarioEliminar">
        <transition name="modal">
          <div class="modal-mask">
            <div class="modal-wrapper">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Eliminar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="modalUsuarioEliminar = false">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h3 class="text-center">¿Estás seguro de eliminar a <span class="text-danger">Nombre</span>?</h3>
                    <button type="button" name="button" class="btn btn-danger">Estoy seguro</button>
                    <button type="button" name="button" class="btn btn-success float-right" @click="modalUsuarioEliminar = false">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </transition>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="main.js"></script>
  </body>
</html>
