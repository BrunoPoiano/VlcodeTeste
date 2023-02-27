

<template>
    <Head title="Welcome" />
    <div class="content">
        <div
            class="nav-bar" 
            v-if="canLogin" 
        >
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                >Dashboard
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    >Criar Conta</Link
                >
            </template>
        </div>

        <div class="explanation">
            <div class="content">
                <h1>
                    Teste técnico para Desenvolvedor Full Stack
                </h1>

                <h2>
                    Escopo do Projeto
                </h2>
                <p>
                    A ideação do projeto seria um mini sistema para criar tarefas.
                </p>

                <ul>
                    <li>
                        Tela para listar os usuários
                    </li>
                    <li>
                        Tela para criar um usuário
                    </li>
                    <li>
                        Tela para excluir um usuário
                    </li>
                    <li>
                        Tela para lista suas tarefas
                    </li>
                    <li>
                        Tela para criar uma nova tarefa
                    </li>
                    <li>
                        Tela para excluir uma tarefa
                    </li>
                    <li>
                        Tela para alterar o estado da tarefa (Pendente, Em Execução, Finalizada).
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<style lang="scss">

.content{
    height: 100vh;
    display: flex;
    flex-direction: column;
    .nav-bar{
        display: flex;
        justify-content: end;
        gap: 20px;
        padding: 1em;
    
        a{
            font-size: 15px;
        }
    }
    .explanation{
        .content{
            display: flex;
            place-items: center;

            > *{
                margin-bottom: 0.5em;
            }

            h1{
                margin-top: 10rem;
                font-size: 2rem;
            }
            h2{
                font-size: 1.3rem;
            }
        }
    }
}
</style>
