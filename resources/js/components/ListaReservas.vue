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
                    <td>{{ row.usuario.nome }}</td>
                    <td>{{ row.veiculo.marca }} {{ row.veiculo.modelo }} {{ row.veiculo.ano }}</td>
                    <td>{{ row.veiculo.placa}}</td>
                    <td>{{ row.data_inicio.slice(0,10).split('-').reverse().join('/')}}</td>
                    <td>{{ row.data_fim.slice(0,10).split('-').reverse().join('/')}}</td>
                    <td>
                        <a class="btn btn-primary" :href="'/reservas/'+row.id">Editar</a>
                        <a class="btn btn-danger" @click="remover(row.id)">Deletar</a>
                    </td>
                </template>
            </custom-table>
        </div>
    </div>
</template>

<script>
export default {
    name: "ListaReservas",
    data () {
        return {
            filtro: '',
            usuarios: [],
            colunas: [
                { label: 'Usuário', field: 'nome', sortable: 'nome' },
                { label: 'Veículo', field: 'veiculo.marca', sortable: '' },
                { label: 'Placa', field: 'veiculo.placa', sortable: '' },
                { label: 'Data de entrega', field: 'data_inicio' },
                { label: 'Data de devolução', field: 'data_fim' },
                { label: 'Ações', field: 'acoes' },
            ],
        }
    },
    mounted () {
        this.buscaVeiculos()
    },
    methods: {
        remover(id) {
            axios.delete(`/api/reservas/${id}`).then(() => {
                alert('Item deletado com sucesso!')
                location.reload()
            }).catch(error => {
                console.error(error)
            })
        },
        buscaVeiculos() {
            axios.get('/api/reservas').then(response => {
                this.usuarios = response.data
                console.log(this.usuarios)
            }).catch(error => {
                alert('Ocorreu um erro ao buscar os dados!')
                console.error(error)
            })
        }
    }
}
</script>

<style scoped>

</style>
