<template>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label>Buscar...</label>
                <input type="text" class="form-control" name="search"  v-model="filtro">
            </div>
        </div>
        <div class="col-12">
            <custom-table
                :data="usuarios"
                :columns="colunas"
                :search="filtro"
                :itemsPerPage="10">
                <template #row="{ row }">
                    <td>{{ row.nome }}</td>
                    <td>{{ row.cpf}}</td>
                    <td>{{ row.user.name}}</td>
                    <td>{{ row.created_at.slice(0,10).split('-').reverse().join('/')}}</td>
                    <td>
                        <a class="btn btn-primary" :href="'/usuarios/'+row.id">Editar</a>
                        <a class="btn btn-danger" @click="remover(row.id)">Deletar</a>
                    </td>
                </template>
            </custom-table>
        </div>
    </div>
</template>

<script>
export default {
    name: "ListaUsuarios",
    data () {
        return {
            filtro: '',
            usuarios: [],
            colunas: [
                { label: 'Nome', field: 'nome', sortable: 'nome' },
                { label: 'CPF', field: 'cpf', sortable: '' },
                { label: 'Cadastrado por', field: 'user.name', sortable: '' },
                { label: 'Criado em', field: 'created_at' },
                { label: 'Ações', field: 'acoes' },
            ],
        }
    },
    mounted () {
        this.buscaVeiculos()
    },
    methods: {
        remover(id) {
            axios.delete(`/api/usuarios/${id}`).then(() => {
                alert('Item deletado com sucesso!')
                location.reload()
            }).catch(error => {
                console.error(error)
            })
        },
        buscaVeiculos() {
            axios.get('/api/usuarios').then(response => {
                this.usuarios = response.data
                console.log(this.usuarios)
            }).catch(error => {
                alert('Ocorreu um erro ao buscar usuários!')
                console.error(error)
            })
        }
    }
}
</script>

<style scoped>

</style>
