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
                :data="veiculos"
                :columns="colunas"
                :search="filtro"
                :itemsPerPage="10">
                <template #row="{ row }">
                    <td :class="{'text-danger' :row.ativo === 0}">{{ row.marca }}</td>
                    <td :class="{'text-danger' :row.ativo === 0}">{{ row.modelo}}</td>
                    <td :class="{'text-danger' :row.ativo === 0}">{{ row.ano}}</td>
                    <td :class="{'text-danger' :row.ativo === 0}">{{ row.placa}}</td>
                    <td :class="{'text-danger' :row.ativo === 0}">{{ row.created_at.slice(0,10).split('-').reverse().join('/')}}</td>
                    <td :class="{'text-danger' :row.ativo === 0}">
                        <a class="btn btn-primary" :href="'/veiculos/'+row.id">Editar</a>
                        <a v-if="row.ativo === 1" class="btn btn-danger" @click="remover(row.id)">Deletar</a>
                    </td>
                </template>
            </custom-table>
        </div>
    </div>
</template>

<script>
export default {
    name: "ListaVeiculos",
    data () {
        return {
            filtro: '',
            veiculos: [],
            colunas: [
                { label: 'Marca', field: 'marca', sortable: 'marca' },
                { label: 'Modelo', field: 'modelo', sortable: 'modelo' },
                { label: 'Ano', field: 'ano', sortable: 'ano' },
                { label: 'Placa', field: 'placa', sortable: 'placa' },
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
            axios.delete(`/api/veiculos/${id}`).then(() => {
                alert('Item deletado com sucesso!')
                location.reload()
            }).catch(error => {
                console.error(error)
            })
        },
        buscaVeiculos() {
            axios.get('/api/veiculos').then(response => {
                this.veiculos = response.data
                console.log(this.veiculos)
            }).catch(error => {
                alert('Ocorreu um erro ao buscar veículos!')
                console.error(error)
            })
        }
    }
}
</script>

<style scoped>

</style>
