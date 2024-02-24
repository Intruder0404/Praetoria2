<template>
  <div class="d-flex align-center justify-center" style="height: 100vh">
    <v-sheet width="400" class="mx-auto">
      <v-form fast-fail @submit.prevent="submit">
        <v-text-field v-model="username" label="User Name"></v-text-field>

        <v-text-field v-model="password" label="Password"></v-text-field>

        <v-text-field v-model="confirmPassword" label="Confirm Password"></v-text-field>

        <v-btn to="/home" type="submit" color="primary" block class="mt-2">Register</v-btn>

      </v-form>
    </v-sheet>
  </div>
</template>
<script  lang="ts">
export default {
  data() {
    return {
      username: '',
      password: '',
      confirmPassword: '',
    };
  },
  methods: {
    login() {
      // Your login logic here
    },
  },
}
</script>
