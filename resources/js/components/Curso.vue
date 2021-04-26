
<template>
    <div>
        <h1 class="text-center">Gestionar Cursos</h1>
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
              <label for="descripcion">Nombre del Curso</label>
              <input v-model="curso.nombrecurso" type="text" class="form-control" id="descripcion" placeholder="Descripcion del Articulo">
            </div>
            <div class="my-4">
              <label for="stock">Intensidad Horaria</label>
              <input v-model="curso.intensidadhoraria" type="number" class="form-control" id="stock" placeholder="Stock del Articulo">
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
          <th scope="col">Nombre del Curso</th>
          <th scope="col">Intensidad Horaria</th>       
        <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cur in cursos" :key="cur.id">
          <th scope="row">{{ cur.id }}</th>
          <td>{{ cur.nombrecurso }}</td>
          <td>{{ cur.intensidadhoraria }}</td>  
          <td>
            <button  @click="modificar=true; abrirModal(cur);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(cur.id)" class="btn btn-danger">
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
      curso:{        
        nombrecurso:'',
        intensidadhoraria:1,     
      },
            modificar:true,
            modal:0,
            tituloModal:'',
            cursos:[],
        }
    },
    methods: {
        async listar(){
            const res= await axios.get('/cursos');
            this.cursos= res.data;
        },
        async eliminar(id){
            const res= await axios.delete('/cursos/'+id);
            this.listar();          
        },
    async guardar() {
      if(this.modificar){
        const res = await axios.put('/cursos/'+this.id, this.curso);
        // console.log(this.id);

      }else{
        const res = await axios.post('/cursos/', this.curso);
      }
      this.cerrarModal();
      this.listar();
    },
        abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Curso";
        this.curso.nombrecurso=data.nombrecurso;
        this.curso.intensidadhoraria=data.intensidadhoraria;      
      }else{
        this.id=0;
        this.tituloModal="Crear Curso";       
        this.curso.nombrecurso='';
        this.curso.intensidadhoraria='';      
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