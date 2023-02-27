
<template>
  <GuestLayout>
    <Head title="Register" />

    <form @submit.prevent="submit" class="login-form">
      <div>
        <InputLabel for="name" value="Name" />

        <TextInput
          class="login-input"
          id="name"
          type="text"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
        />

        <InputError :message="form.errors.name" />
      </div>

      <div>
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          class="login-input"
          type="email"
          v-model="form.email"
          required
          autocomplete="username"
        />

        <InputError :message="form.errors.email" />
      </div>

      <div>
        <InputLabel for="password" value="Password" />

        <TextInput
          class="login-input"
          id="password"
          type="password"
          v-model="form.password"
          required
          autocomplete="new-password"
        />

        <InputError :message="form.errors.password" />
      </div>

      <div>
        <InputLabel for="password_confirmation" value="Confirm Password" />

        <TextInput
          id="password_confirmation"
          class="login-input"
          type="password"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />

        <InputError :message="form.errors.password_confirmation" />
      </div>

      <div class="form-links">
        <Link :href="route('login')"> Already registered? </Link>

        <PrimaryButton :disabled="form.processing"> Register </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: false,
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<style lang="scss">
.login-form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  width: 100%;

  .login-input {
    width: 100%;
    color: var(--dark-text-100);
  }

  .form-links {
    display: flex;
    justify-content: space-between;
    align-items: center;

    a {
      color: var(--dark-text-100);
    }
  }
}
</style>
