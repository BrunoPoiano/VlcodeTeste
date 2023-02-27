<template>
  <div class="todo-list-table">
    <table class="table">
      <tr>
        <th><span> </span></th>
        <th><span>Nome </span></th>
        <th><span>Data Limite </span></th>
        <th><span>Crido em </span></th>
        <th><span>Status </span></th>
        <th><span> </span></th>
      </tr>
      <tr v-for="todo in props.list" :key="todo.id">
        <td>
          <div>
            <span>{{ todo.id }} </span>
          </div>
        </td>
        <td>
          <div>
            <span>{{ todo.name }} </span>
          </div>
        </td>
        <td>
          <div>
            <span>{{ todo.date }} </span>
          </div>
        </td>
        <td>
          <div>
            <span> {{ todo.created_at }}</span>
          </div>
        </td>
        <td>
          <div>
            <select name="select" v-model="todo.status" @change="updateTodo(todo)">
              <option :value="0">Pendente</option>
              <option :value="1" selected>Em Execução</option>
              <option :value="2">Finalizada</option>
            </select>
   
          </div>
        </td>
        <td>
          <div >
            <button @click="deleteTodo(todo)">
              Deletar
            </button>
          </div>
        </td>
      </tr>
    </table>
  </div>
</template>

<script setup>
  const props = defineProps({
    list: Array
  })

  const emit = defineEmits(['refreshTable'])

  const updateTodo = (todo) => {
    axios.put(`todo/${todo.id}/${todo.status}`).then(({ data }) => {
    });
  }

  const deleteTodo = (todo) => {
    axios.delete(`todo/${todo.id}`).then(({ data }) => {
      emit('refreshTable')
    });
  }
</script>

<style lang="scss">
.todo-list-table {
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

          button{
            background: hsl(0, 50%, 50%);
            color: #fff;
            padding: 0.5em 1em;
            border-radius: var(--border-radius);
          }

          select{
            cursor: pointer;
            border-radius: var(--border-radius);
            outline: none;
            border:1px solid #3b3b3b;
            background: var(--button-bg);
            color: #fff;
          }
        }

        
      }
    }
  }
}
</style>