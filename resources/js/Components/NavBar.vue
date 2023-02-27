<template>
  <div class="nav-bar-wraper">
    <Dropdown>
      <template #trigger>
        <span>
          <button type="button">
            {{ $page.props.auth.user.name }}
          </button>
        </span>
      </template>

      <template #content>
        <DropdownLink @click="router.push({ name: isAdmin ? 'userList' : 'TodoList' })">
          Dashboard
        </DropdownLink>
        <DropdownLink @click="router.push({ name: 'profile' })">
          Profile
        </DropdownLink>
        <DropdownLink :href="route('logout')" method="post" as="button">
          Log Out
        </DropdownLink>
      </template>
    </Dropdown>
  </div>
</template>

<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import router from "@/router";

const isAdmin = localStorage.getItem('logged_user') ? localStorage.getItem('logged_user') : 0;

</script>

<style lang='scss'>
.nav-bar-wraper {
  display: flex;
  width: 100%;
  justify-content: end;

  .relative{
    background: var(--button-bg);
    padding: .4em 1em;
    border-radius: var(--border-radius);

    .rounded-md{
        background: var(--button-bg);
        a, button{
            color: var(--white-text-100);
        }

        a:hover,
        button:hover{
                    background: var(--button-bg-hover);
        }
    }
  }
}
</style>