<template>
    <div v-if="$props.error" class="alert text-center alert-danger" role="alert">
      {{ $props.error }}
    </div>
</template>

<script>

export default {
    name: 'InfoError',
    props: {
          error: String,
          
        }
}
</script>