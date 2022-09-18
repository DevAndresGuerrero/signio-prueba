<template>
  <div class="container mt-4">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-baseline">
          <h1>Usuarios</h1>
          <a href="/users/create" class="btn btn-primary">Nuevo usuario</a>
        </div>
      </div>
      <div class="card-body">
        <UserIndex />
      </div>
    </div>
  </div>
</template>

<script setup>
  import UserIndex from '@/components/user/index.vue'
</script>
