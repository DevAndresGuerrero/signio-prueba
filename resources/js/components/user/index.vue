<template>
  <div class="row mb-2">
    <div class="col-md-4">
      <input type="text" class="form-control" v-model="name" placeholder="Buscar por nombre">
    </div>

    <div class="col-md-4">
      <input type="text" class="form-control" v-model="lastname" placeholder="Buscar por apellido">
    </div>

    <div class="col-md-4">
      <input type="text" class="form-control" v-model="country" placeholder="Buscar por pais">
    </div>
  </div>

  <table class="table table-sm table-hover">
    <thead class="thead-dark bg-dark text-white">
      <tr>
        <th>Nombre(s)</th>
        <th>Apellido(s)</th>
        <th>Cedula</th>
        <th>Email</th>
        <th>Pais</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Handle</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Andres</td>
        <td>Guerrero</td>
        <td>1047452903</td>
        <td>dev.andres.guerrero@gmail.com</td>
        <td>Colombia</td>
        <td>CL 20 #83-65, San Fernando. Cartagena - Bolivar</td>
        <td>3112923668</td>
        <td>@mdo</td>
      </tr>
    </tbody>
  </table>
</template>

<script setup>
</script>