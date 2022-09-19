<template>
  <div class="container mt-4">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-baseline">
          <h1>Usuarios</h1>
          <router-link 
            class="btn btn-primary" 
            :to="{ name: 'userCreate' }">
            Nuevo usuario
          </router-link>
        </div>
      </div>
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-md-4">
            <input type="text" class="form-control" v-model="search" placeholder="Buscar por nombre, apellido o pais">
          </div>
        </div>

        <div class="row px-2 table-responsive">
          <table class="table table-sm table-hover">
            <thead class="thead-dark bg-dark text-white">
              <tr>
                <th>Categoria</th>
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
                <td>{{ u.category?.name ?? 'Por asignar' }}</td>
                <td>{{ u.name }}</td>
                <td>{{ u.lastname }}</td>
                <td>{{ u.dni }}</td>
                <td>{{ u.email }}</td>
                <td>{{ u.country }}</td>
                <td>{{ u.address }}</td>
                <td>{{ u.phone }}</td>
                <td>
                  <router-link :to="{ name: 'userEdit', params: { userId:u.id }}">Edit</router-link>
                  <a href="#" class="p-2 text-danger" @click.prevent="deleteUser(u.id)">Delete</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref, computed } from 'vue'
  import { storeToRefs } from 'pinia'
  import { useUserStore } from "@/stores/user"

  const search = ref('')
  const userStore = useUserStore()
  const { users } = storeToRefs( userStore )

  const mixUserArray = async () => {
    await userStore.fetchData()
  }

  const filterUsers = computed(() => {
    let query = search.value.toLowerCase();
    if (!query.length) return users.value

    return users.value.filter(user => {
      return user.name.toLowerCase().match(query) || 
          user.lastname.toLowerCase().match(query) ||
          user.category?.name.toLowerCase().match(query)
    })
  })

  const deleteUser = (userId) => {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        axios.delete(`https://signio-prueba.test/api/users/${userId}`)
          .then(()=>{
            users.value = users.value.filter(user => {
              return user.id != userId
            })
          })

        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
      }
    })
  }

  mixUserArray();
</script>
