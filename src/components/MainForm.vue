<template>
  <div class="container-sm border bg-light shadow-sm shadow-lg rounded border-2 p-3">
    <h4 class="text-center mt-3 text-secondary mb-4">Form</h4>
    <form action="">
      <div class="mb-4">
        <input type="email" 
        pattern="[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}" 
        autofocus 
        name="email" 
        class="form-control" 
        placeholder="Email" required>
      </div>
      <div class="d-flex flex-column flex-lg-row gap-3 mb-4">
        <input type="text" name="first_name" class="form-control" maxlength="255" placeholder="First name" required>
        <input type="text" name="last_name" class="form-control" maxlength="255" placeholder="Last name" required>
      </div>
      <div class="d-flex flex-column flex-lg-row gap-3 mb-4">
        <input type="password" name="password" class="form-control" placeholder="Password" minlength="6" maxlength="255" required>
        <input type="password" 
        name="confirmation_password" 
        class="form-control" 
        placeholder="Confirm Password" 
        minlength="6" maxlength="255" required>
      </div>
      <button type="submit" class="btn mt-4 w-100 btn-primary">Submit</button>
    </form>
  </div>
  
</template>

<script>

export default {
    name: 'MainForm',
}
</script>

<style>
.container-sm {
    max-width: 800px;
}
</style>
