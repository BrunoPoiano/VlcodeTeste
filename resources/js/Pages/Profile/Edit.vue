<template>
  <Head title="Profile" />
  <div class="profile-cards">
    <div class="card">
      <UpdateProfileInformationForm
        :must-verify-email="mustVerifyEmail"
        :status="status"
        class="max-w-xl"
      />
    </div>

    <div class="card">
      <UpdatePasswordForm class="max-w-xl" />
    </div>

    <div class="card">
      <DeleteUserForm class="max-w-xl" />
    </div>
  </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
  mustVerifyEmail: Boolean,
  status: String,
});
</script>

<style lang="scss">
.profile-cards{
    display: flex;
    flex-direction: column;
    gap: 5rem;

    .card{
        min-width: 30rem;
        background: hsl(0, 0%, 99%);
        padding: 1.5em 3rem;
        border-radius: var(--border-radius);
    }
}

    
</style>