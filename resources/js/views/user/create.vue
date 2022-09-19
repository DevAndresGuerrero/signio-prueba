<template>
  <div class="container mt-4 d-flex justify-content-center">
    <div class="card col-12 col-md-10 col-lg-8 col-xl-6">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-baseline">
          <h2>Crear usuario</h2>
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
                <input type="text" class="form-control" id="name" v-model="form.name">
              </div>

              <div class="col-md-6">
                <label for="lastname" class="form-label">Apellido(s)</label>
                <input type="text" class="form-control" id="lastname" v-model="form.lastname">
              </div>
              <!-- Fin Primera seccion -->

              <!-- Segunda seccion -->
              <div class="col-md-6">
                <label for="dni" class="form-label">Cedula</label>
                <input type="text" class="form-control" id="dni" v-model="form.dni">
              </div>

              <div class="col-md-6">
                <label for="phone" class="form-label">Celular</label>
                <input type="text" class="form-control" id="phone" v-model="form.phone">
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
                <input type="text" class="form-control" id="address" v-model="form.address">
              </div>
              <!-- Fin Tercera seccion -->

              <!-- Cuarta seccion -->
              <div class="col-md-12">
                <label for="email" class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" id="email" v-model="form.email">
              </div>
              <!-- Fin Cuarta seccion -->

              <!-- Quinta seccion -->
              <div class="col-md-6">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" v-model="form.password">
              </div>

              <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirmacion de Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" v-model="form.password_confirmation">
              </div>
              <!-- Fin Quinta seccion -->

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

  const form = reactive({
    name: null,
    lastname: null,
    dni: null,
    email: null,
    country: null,
    address: null,
    phone: null,
    password: null,
    password_confirmation: null,
  })

  const countries = ref([])
  const success = ref(null)
  const errors = ref(null)

  const saveUser = async () => {
    let response = await fetch('https://signio-prueba.test/api/users', {
      method: 'POST',
      headers: {
        "Content-Type" : "application/json",
        "accept" : "application/json"
      },
      body: JSON.stringify(form)
    })

    errors.value = null

    let result = await response.json();

    if(result.errors) {
      return errors.value = result.errors
    }

    success.value = "Usuario creado exitosamente!"
  }

  const getCountries = async () => {
    let response = await fetch('https://signio-prueba.test/api/countries')
    countries.value = await response.json();
  }

  getCountries();
</script>
