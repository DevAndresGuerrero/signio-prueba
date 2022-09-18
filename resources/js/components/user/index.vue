<template>
  <div class="row mb-2">
    <div class="col-md-4">
      <input type="text" class="form-control" v-model="search" placeholder="Buscar por nombre, apellido o pais">
    </div>
  </div>

  <div class="row px-2 table-responsive">
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
        <tr v-for="u in filterUsers">
          <td>{{ u.name }}</td>
          <td>{{ u.lastname }}</td>
          <td>{{ u.dni }}</td>
          <td>{{ u.email }}</td>
          <td>{{ u.country }}</td>
          <td>{{ u.address }}</td>
          <td>{{ u.phone }}</td>
          <td>Action</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
  import { ref, computed } from 'vue'
  import { storeToRefs } from 'pinia'
  import { useUserStore } from "@/stores/user"
  const userStore = useUserStore()
  const { users } = storeToRefs( userStore )

  const search = ref('')

  const mixUserArray = async () => {
    await userStore.fetchData()
  }

  const filterUsers = computed(() => {
    if (!search.value.length) return users.value

    return users.value.filter(user => {
      return user.name.toLowerCase().match(search.value.toLowerCase()) || 
              user.lastname.toLowerCase().match(search.value.toLowerCase())
    })
  })

  mixUserArray();
</script>