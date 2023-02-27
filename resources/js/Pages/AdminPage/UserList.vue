<template>
  <div>
    <h1>Lista de Usuarios</h1>
  </div>
  <div class="user-list-table">
    <table class="table">
      <tr>
        <th><span> </span></th>
        <th><span>Nome </span></th>
        <th><span>Criado em </span></th>
        <th><span>Afazeres Criados/Completos </span></th>
      </tr>
      <tr v-for="user in users" :key="user.id">
        <td>
          <div>
            <span>{{ user.id }} </span>
          </div>
        </td>
        <td>
          <div>
            <span>{{ user.name }} </span>
          </div>
        </td>
        <td>
          <div>
            <span> {{ user.created_at }}</span>
          </div>
        </td>
        <td>
          <div>
            <span> {{ user.todo_quantity }}/{{user.todo_completed}}</span>
          </div>
        </td>
      </tr>
    </table>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";

const users = ref([]);

onMounted(() => {
  axios.get("users/list").then(({ data }) => {
    users.value = data;
  });
});
</script>

<style lang="scss">
.user-list-table {
  margin-top: 2rem;

  .table {
    border-radius: var(--border-radius);
    background: #292d33;
    tr {
      th:first-child {
        border-radius: var(--border-radius) 0 0 0;
      }
      th:last-child {
        border-radius: 0 var(--border-radius) 0 0;
      }
      th {
        background: #858e99;
        span {
          display: flex;
          padding: 1em 1.5em;
        }
      }

      td {
        border: 1px solid #31363c;
        padding: 1em 1.5em;
        > div {
          display: flex;
          justify-content: center;

          button {
            background: hsl(0, 50%, 50%);
            color: #fff;
            padding: 0.5em 1em;
            border-radius: var(--border-radius);
          }

          select {
            cursor: pointer;
            border-radius: var(--border-radius);
            outline: none;
            border: 1px solid #3b3b3b;
            background: var(--button-bg);
            color: #fff;
          }
        }
      }
    }
  }
}
</style>