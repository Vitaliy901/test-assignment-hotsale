<template>
      <div v-if="!$props.show" class="alert text-center alert-info" role="alert">
        You are successfully registered!
      </div>
</template>

<script>

export default {
    name: 'InfoSuccess',
    props: {
          show: Boolean,
          required: true
        }

}
</script>
