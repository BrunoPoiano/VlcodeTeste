<template>
  <div class="todo-filters">
    <div>
      <span> Pesquisar </span>
      <input type="text" v-model="filters.search" @keyup="refreshTable"/>
    </div>

    <div>
      <span> Ordenar por </span>
      <select name="select" v-model="filters.orderBy" @change="refreshTable">
        <option value="id">id</option>
        <option value="name">Nome</option>
        <option value="date" selected>Data Limite</option>
        <option value="created_at">Criado em</option>
        <option value="status">Status</option>
      </select>
    </div>

    <div>
      <span> entre as data Limites </span>
      <div class="input-dates">
        <input type="date" v-model="filters.startDate" @change="refreshTable"/>
        <input type="date" v-model="filters.endDate" @change="refreshTable"/>
      </div>
    </div>

    <div>
      <span> status </span>
      <select name="select" v-model="filters.status" @change="refreshTable">
        <option :value="3">todos</option>
        <option :value="0">Pendente</option>
        <option :value="1" selected>Em Execução</option>
        <option :value="2">Finalizada</option>
      </select>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
  const emit = defineEmits(['refreshTable'])

  const debounce = ref(null);
  const filters = ref({
      search: '',
      orderBy: 'id',
      startDate: '',
      endDate: '',
      status: '3',
  });

  const refreshTable = () => {
    clearTimeout(debounce)

    debounce = setTimeout(() => {
      emit('refreshTable', filters.value)
    }, 800)
  }

</script>

<style lang="scss">
.todo-filters {
  display: flex;
  width: 100%;
  gap: var(--gap);

  > div:has(select) {
    width: 200px;
  }

  > div {
    width: 100%;
    display: flex;
    flex-direction: column;

    span{
      text-transform: capitalize;
    }

    input[type="text"] {
      width: 100%;
    }

    input {
      width: 100%;
      border-radius: var(--border-radius);
      outline: none;
      color: var(--dark-text-100);
    }

    select {
      cursor: pointer;
      border-radius: var(--border-radius);
      outline: none;
      border: 1px solid #3b3b3b;
      color: var(--dark-text-100);
    }

    .input-dates {
      display: flex;
      gap: var(--gap);
      input {
        width: 50%;
      }
    }
  }
}
</style>