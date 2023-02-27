<template>
  <GuestLayout>
    <Head title="Log in" />

    <div v-if="status">
      {{ status }}
    </div>

    <form @submit.prevent="submit" class="login-form">
      <div>
        <InputLabel for="email" value="Email" />

        <TextInput
          class="login-input"
          id="email"
          type="email"
          v-model="form.email"
          required
          autofocus
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
          autocomplete="current-password"
        />

        <InputError :message="form.errors.password" />
      </div>

      <div class="form-check">
        <label>
          <Checkbox name="remember" v-model:checked="form.remember" />
          <span>Lembre-se de mim</span>
        </label>
      </div>

      <div class="form-links">
        <Link :href="route('register')">Criar Conta</Link>

        <Link v-if="canResetPassword" :href="route('password.request')">
          Esqueceu sua senha?
        </Link>

        <PrimaryButton :disabled="form.processing"> Log in </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => {
      form.reset("password")
        axios.get('logged-user').then(({data}) => {
        localStorage.setItem('logged_user', data.is_admin)
        //localStorage.getItem('logged_user')
      })
    }
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

  .form-check {
    > label {
      align-items: center;
      display: flex;
      gap: 10px;
      color: var(--dark-text-100);
    }
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
