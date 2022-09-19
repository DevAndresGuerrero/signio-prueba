<template>
  <div class="container mt-4 d-flex justify-content-center">
    <div class="card col-12 col-md-10 col-lg-8 col-xl-6">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-baseline">
          <h2>Editar Usuario: {{ user.name }}</h2>
          <router-link class="btn btn-primary" :to="{ name: 'users' }">
            Listados de usuarios
          </router-link>
        </div>
      </div>
      <div class="card-body">
        <div class="row" v-if="success">
          <div class="col-12">
            <div class="alert alert-success" role="alert">
              <div>{{ success }}</div>
            </div>
          </div>
        </div>

        <div class="row" v-if="errors">
          <div class="col-12">
            <div class="alert alert-danger" role="alert">
              <div v-for="(err, key) in errors" :key="key">{{ err[0] }}</div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <form class="row g-3">
              <!-- Primera seccion -->
              <div class="col-md-6">
                <label for="name" class="form-label">Nombre(s)</label>
                <input 
                  id="name" 
                  type="text" 
                  class="form-control" 
                  v-model="form.name"
                  oninput="this.value = this.value.replace(/[^A-Za-z. ]/g, '')"
                  minlength="5"
                  maxlength="100"
                >
              </div>

              <div class="col-md-6">
                <label for="lastname" class="form-label">Apellido(s)</label>
                <input 
                  id="lastname" 
                  type="text" 
                  class="form-control" 
                  v-model="form.lastname"
                  oninput="this.value = this.value.replace(/[^A-Za-z. ]/g, '')"
                  minlength="5"
                  maxlength="100"
                >
              </div>
              <!-- Fin Primera seccion -->

              <!-- Segunda seccion -->
              <div class="col-md-6">
                <label for="dni" class="form-label">Cedula</label>
                <input type="text" class="form-control" id="dni" v-model="form.dni">
              </div>

              <div class="col-md-6">
                <label for="phone" class="form-label">Celular</label>
                <input 
                  id="phone" 
                  type="text" 
                  class="form-control" 
                  v-model="form.phone"
                  oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                >
              </div>
              <!-- Fin Segunda seccion -->

              <!-- Tercera seccion -->
              <div class="col-md-4">
                <label for="country" class="form-label">Pais</label>
                <select id="country" class="form-select" aria-label="Default select example" v-model="form.country">
                  <option value="">Seleccione un pais</option>
                  <option 
                    v-for="(val, key) in countries" 
                    :value="key"
                    :key="key"
                    >{{ val }}</option>
                </select>
              </div>

              <div class="col-md-8">
                <label for="address" class="form-label">Direccion</label>
                <input 
                  id="address" 
                  type="text" 
                  class="form-control" 
                  v-model="form.address"
                  maxlength="180"
                >
              </div>
              <!-- Fin Tercera seccion -->

              <!-- Cuarta seccion -->
              <div class="col-12 d-flex justify-content-between">
                <div class="form-check form-check-inline" v-for="(category, index) in categories" :key="index">
                  <input 
                    type="radio" 
                    name="category_id" 
                    :id="index"
                    class="form-check-input" 
                    :value="category.id" 
                    v-model="form.category_id"
                  >
                  <label class="form-check-label" :for="index">
                    {{ category.name }}
                  </label>
                </div>
              </div>
              <!-- Fin Cuarta seccion -->

              <!-- Quinta seccion -->
              <div class="col-md-12">
                <label for="email" class="form-label">Correo Electronico</label>
                <input 
                  id="email" 
                  type="email" 
                  class="form-control" 
                  v-model="form.email"
                  pattern="/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/"
                  maxlength="150"
                >
              </div>
              <!-- Fin Quinta seccion -->

              <!-- Sexta seccion -->
              <div class="col-md-6">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" v-model="form.password">
              </div>

              <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirmacion de Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" v-model="form.password_confirmation">
              </div>
              <!-- Fin Sexta seccion -->

              <div class="col-12">
                <button type="submit" class="btn btn-primary" @click.prevent="saveUser">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref, reactive } from 'vue'
  import { useRoute } from 'vue-router';

  const route = useRoute();
  const user = ref(null)
  const categories = ref([])
  const countries = ref([])
  const success = ref(null)
  const errors = ref(null)

  const form = reactive({
    name: null,
    lastname: null,
    dni: null,
    email: null,
    country: null,
    address: null,
    phone: null,
    category_id: null,
    category: {},
    password: null,
    password_confirmation: null,
  })

  const getUser = async () => {
    let response = await fetch(`https://signio-prueba.test/api/users/${route.params.userId}`)
    let {data} = await response.json();
    user.value = data;

    form.name = user.value.name
    form.lastname = user.value.lastname
    form.dni = user.value.dni
    form.email = user.value.email
    form.country = user.value.country
    form.address = user.value.address
    form.phone = user.value.phone
    form.category_id = user.value.category_id
    form.category = user.value.category
  }

  const saveUser = async () => {
    let response = await fetch(`https://signio-prueba.test/api/users/${route.params.userId}`, {
      method: 'PUT',
      headers: {
        "Content-Type" : "application/json",
        "accept" : "application/json"
      },
      body: JSON.stringify(form)
    })

    errors.value = null
    success.value = null

    let result = await response.json();

    if(result.errors) {
      return errors.value = result.errors
    }

    success.value = "Usuario actualizado exitosamente!"
  }

  const getCategories = async () => {
    let response = await fetch('https://signio-prueba.test/api/categories')
    categories.value = await response.json();
  }

  const getCountries = async () => {
    let response = await fetch('https://signio-prueba.test/api/countries')
    countries.value = await response.json();
  }

  getUser();
  getCategories();
  getCountries();
</script>
