<template>
  <div class="container-sm border bg-light shadow-sm shadow-lg rounded border-2 p-3">
    <InfoSuccess :show="show" />
    <InfoError :error="error" />
    <div v-if="show">
      <h4 class="text-center mt-3 text-secondary mb-4">Form</h4>
      <form @submit.prevent>
        <div class="mb-4">
          <input v-model="form.email" type="email" 
          pattern="[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}" 
          autofocus 
          name="email" 
          class="form-control" 
          placeholder="Email" required>
        </div>
        <div class="d-flex flex-column flex-lg-row gap-3 mb-4">
          <input v-model="form.first_name" type="text" name="first_name" class="form-control" maxlength="255" placeholder="First name" required>
          <input v-model="form.last_name" type="text" name="last_name" class="form-control" maxlength="255" placeholder="Last name" required>
        </div>
        <div class="d-flex flex-column flex-lg-row gap-3 mb-4">
          <input v-model="form.password" 
          type="password" 
          name="password" 
          class="form-control" 
          placeholder="Password" 
          minlength="6" maxlength="255" required>
          <input v-model="form.confirmation_password" type="password" 
          name="confirmation_password" 
          class="form-control" 
          placeholder="Confirm Password" 
          minlength="6" maxlength="255" required>
        </div>
        <button @click="createUser" type="submit" class="btn mt-4 w-100 btn-primary">Submit</button>
      </form>
    </div>
  </div>
  
</template>

<script>
import axios from 'axios';
import InfoSuccess from './InfoSuccess.vue';
import InfoError from './InfoError.vue';

export default {
    name: 'MainForm',
    components: {
      InfoSuccess,
      InfoError
    },
    data() {
      return {
        form: {
          email: '',
          first_name: '',
          last_name: '',
          password: '',
          confirmation_password: ''
        },
        show: true,
        error: '' 
      }
    },
    methods: {
      createUser() {
          axios.post('http://127.0.0.1:9000', this.form, {
              headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            }
          }).then(response => {
            if (response.status == 201) {
              this.show = false
            }
        }).catch((error) => {
          if (error.response.data) {
            this.error = error.response.data
            setTimeout(() => this.error = '', 5000);
          }
        });
      }

    }

}
</script>

<style>
.container-sm {
    max-width: 800px;
}
</style>
