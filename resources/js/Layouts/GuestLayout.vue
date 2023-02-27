

<template>
  <div class="login-card">
    <div class="card">
        <slot />
    </div>
  </div>
</template>

<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<style lang="scss">
.login-card{
    min-height: 100vh;
     display: grid;
        place-items: center;
    .card{
        display: grid;
        place-items: center;
        padding: 20px;
        background: #fff;
        min-width: 400px;
        height: fit-content;
        border-radius: var(--border-radius);
    }
}
</style>
