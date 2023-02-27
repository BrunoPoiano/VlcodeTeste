

<template>
  <Head title="Todo App" />
    <div>
            <NavBar />
    </div>
    <div class="main-page">
        <router-view />
    </div>

</template>
<script setup>
import { Head } from '@inertiajs/vue3';
import NavBar from "@/Components/NavBar.vue";
import { onMounted } from 'vue';


 onMounted(() => {

 })
</script>

<style lang="scss">
  .main-page{
    display: grid;
    place-items: center;
    margin: 1rem 5rem;
  }
</style>