<template>
  <div class="jumbotron">
    <h1 class="display-4">
      Welcome Back, {{ auth_user.name }} {{ auth_user.surname }}
    </h1>
    <p class="lead">We wish you a productive and exciting day!</p>
    <hr class="my-4" />
    <div v-if="auth_user.role_id == 1">
      <p>Start managing professors in <strong>Professors' page</strong>.</p>
      <a class="btn btn-primary btn-lg" href="/professors" role="button"
        >Professors</a
      >
    </div>
    <div v-else-if="auth_user.role_id == 2">
      <p>Start managing students in a <strong>room</strong>.</p>
      <a class="btn btn-primary btn-lg" href="/room" role="button">Room</a>
    </div>
    <div v-else>
      <p>Start discussing your ideas in <strong>Forum</strong></p>
      <a class="btn btn-primary btn-lg" href="/forum" role="button">Forum</a>
    </div>
  </div>
</template>
<script>
export default {
  props: ["auth_user"],
};
</script>

<style>
</style>