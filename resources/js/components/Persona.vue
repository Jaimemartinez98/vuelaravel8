
<template>
    <div>
        <h1 class="text-center">Gestionar Personas</h1>
        <hr>

        
  <!-- Button to Open the Modal -->
    <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary my-4">Nuevo</button>

    <!-- The Modal -->
    <div class="modal" :class="{mostrar: modal}">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">{{tituloModal}}</h4>
            <button @click="cerrarModal();"  type="button" class="close" data-dismiss="modal">
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
             <div class="my-4">
              <label for="nombre">Cedula</label>
              <input v-model="persona.id" type="number" class="form-control" id="nombre" placeholder="Nombre del Articulo">
            </div>
            <div class="my-4">
              <label for="nombre">Nombre</label>
              <input v-model="persona.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del Articulo">
            </div>
            <div class="my-4">
              <label for="descripcion">Apellido</label>
              <input v-model="persona.apellido" type="text" class="form-control" id="descripcion" placeholder="Descripcion del Articulo">
            </div>
            <div class="my-4">
              <label for="stock">Celular</label>
              <input v-model="persona.celular" type="number" class="form-control" id="stock" placeholder="Stock del Articulo">
            </div>
             <div class="my-4">
              <label for="descripcion">Direccion</label>
              <input v-model="persona.direccion" type="text" class="form-control" id="descripcion" placeholder="Descripcion del Articulo">
            </div>
             <div class="my-4">
              <label for="descripcion">Barrio</label>
              <input v-model="persona.barrio" type="text" class="form-control" id="descripcion" placeholder="Descripcion del Articulo">
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
              Cancelar
            </button>
            <button  @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">
              Guardar
            </button>


          </div>
        </div>
      </div>
    </div>



        <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Celular</th>
          <th scope="col">Direccion</th>
          <th scope="col">Barrio</th>
        <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="per in personas" :key="per.id">
          <th scope="row">{{ per.id }}</th>
          <td>{{ per.nombre }}</td>
          <td>{{ per.apellido }}</td>
          <td>{{ per.celular }}</td>
          <td>{{ per.direccion }}</td>
          <td>{{ per.barrio }}</td>
          <td>
            <button  @click="modificar=true; abrirModal(per);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(per.id)" class="btn btn-danger">
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    </div>
</template>



<script>
export default {
    data() {
        return {
      persona:{
        id:1,
        nombre:'',
        apellido:'',
        celular:'',
        direccion:'',
        barrio:'',
      },
            modificar:true,
            modal:0,
            tituloModal:'',
            personas:[],
        }
    },
    methods: {
        async listar(){
            const res= await axios.get('/personas');
            this.personas= res.data;
        },
        async eliminar(id){
            const res= await axios.delete('/personas/'+id);
            this.listar();          
        },
    async guardar() {
      if(this.modificar){
        const res = await axios.put('/personas/'+this.id, this.persona);
        // console.log(this.id);

      }else{
        const res = await axios.post('/personas/', this.persona);
      }
      this.cerrarModal();
      this.listar();
    },
        abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Persona";
        this.persona.nombre=data.nombre;
        this.persona.apellido=data.apellido;
        this.persona.celular=data.celular;
        this.persona.direccion=data.direccion;
        this.persona.barrio=data.barrio;
      }else{
        this.id=0;
        this.tituloModal="Crear Persona";
        this.persona.id=1;
        this.persona.nombre='';
        this.persona.apellido='';
        this.persona.celular=1;
        this.persona.direccion='';
        this.persona.barrio='';
      }
    },
     cerrarModal(){
      this.modal=0;
    },

    },
    created(){
        this.listar();
    }

}
</script>




<style>
   .mostrar{
    display: list-item;
    opacity: 1;
    background: rgba(75, 56, 143, 0.705);
  } 
</style>