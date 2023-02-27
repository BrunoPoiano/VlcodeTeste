<template>
  <div class="title">
    <span> Lista de Tarefas </span>
  </div>

  {{$auth}}
  <div class="create-search">
    <div
      @click="showSearch = !showSearch"
      :class="showSearch == 0 ? 'chosed' : ''"
    >
      Criar
    </div>
    <div
      @click="showSearch = !showSearch"
      :class="showSearch == 1 ? 'chosed' : ''"
    >
      Pesquisar
    </div>
  </div>

  <div class="new-todo" v-if="!showSearch">
    <div class="inputs">
      <div>
        <span>Afazer</span>
        <input
          type="text"
          v-model="todo.name"
          placeholder="Ex: Ir ao mercado"
        />
      </div>
      <div>
        <span>Data de entrega</span>
        <input type="date" v-model="todo.date" />
      </div>
    </div>

    <div class="button">
      <button @click="addNewTodo" :disabled="disableButtonComputed">
        Adicionar
      </button>
    </div>
  </div>
  <div class="new-todo" v-else>
    <TodoFilters @refreshTable="getTodos" />
  </div>

  <div class="todo-list">
    <TodoListTable
      ref="todoListTable"
      :list="todoList"
      @refreshTable="getTodos"
    />
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import TodoFilters from "./components/TodoFilters.vue";
import TodoListTable from "./components/TodoListTable.vue";

const todo = ref({
  name: "",
  date: "",
});

const todoList = ref([]);

const showSearch = ref(false);

const disableButtonComputed = computed(() => {
  if (todo.value.name.length == 0) {
    return true;
  }

  if (todo.value.date.length == 0) {
    return true;
  }
});

const addNewTodo = () => {
  let fd = new FormData();
  fd.append("name", todo.value.name);
  fd.append("date", todo.value.date);

  axios.post("todo", fd).then(({ data }) => {
    getTodos();
  });
};

const getTodos = (filters = null) => {
  axios
    .get("todo", {
      params: {
        ...filters,
      },
    })
    .then(({ data }) => {
      todoList.value = data;
      resetTodo();
    });
};

const resetTodo = () => {
  todo.value.name = "";
  todo.value.date = "";
};
onMounted(() => {
  getTodos();
});
</script>

<style lang="scss">
.title {
  display: grid;
  place-items: center;
  span {
    font-size: 1.5rem;
    padding: 0.8em;
  }
}

.create-search {
  display: flex;
  gap: var(--gap);
  margin: 1.5rem;
  padding: 0.2em 0.1em;
  border-radius: var(--border-radius);
  > div {
    cursor: pointer;
    padding: 0.4em 0.9em;
    border-radius: var(--border-radius);
  }

  .chosed {
    background: var(--button-bg);
    color: #fff;
  }
}

.new-todo {
  display: flex;
  gap: var(--gap);
  width: 100%;
  .inputs {
    display: flex;
    gap: var(--gap);
    width: 100%;
    > div {
      display: flex;
      flex-direction: column;
      width: 100%;

      input {
        width: 100%;
        border-radius: var(--border-radius);
        outline: none;
        color: var(--dark-text-100);
      }
    }
    > div:has(input[type="date"]) {
      width: 250px;
    }
  }

  .button {
    display: flex;
    align-items: end;
    button {
      background: var(--button-bg);
      padding: 0.5em 1em;
      border-radius: var(--border-radius);
    }

    button:hover {
      background: var(--button-bg-hover);
    }

    button:disabled {
      cursor: not-allowed;
      background: hsl(0, 0%, 91%);
      color: var(--dark-text-100);
    }
  }
}
</style>