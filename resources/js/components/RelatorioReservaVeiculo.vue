<template>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="">Veículo</label>
                <select class="form-control" v-model="item.veiculo_id">
                    <option v-for="(obj, key) in veiculos" :key="key" :value="obj.id">
                        {{ obj.marca }} {{ obj.modelo }} {{ obj.ano }}
                    </option>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="">Mês</label>
                <input type="month" v-model="item.mes" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="align-self-center col-12 col-md-4 d-flex mt-3">
            <button type="button" class="btn btn-primary" @click="gerarRelatorio">FILTRAR</button>
        </div>
        <div class="col-12">
            <custom-table
                :data="dados"
                :columns="colunas"
                :search="filtro"
                :itemsPerPage="10">
                <template #row="{ row }">
                    <td>{{ row.veiculo }}</td>
                    <td>{{ row.dia.slice(0,10).split('-').reverse().join('/') }}</td>
                    <td>{{ row.alugado }}</td>
                </template>
            </custom-table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Relatorio",
    data () {
        return {
            item: {
                veiculo_id: '0',
                mes: ''
            },
            filtro: '',
            dados: [],
            veiculos: [],
            colunas: [
                { label: 'Veículo', field: 'veiculo', sortable: 'veiculo' },
                { label: 'Data', field: 'data', sortable: 'data' },
                { label: 'Alugado', field: 'alugado', sortable: 'alugado' }
            ],
        }
    },
    mounted () {
        this.buscaVeiculos()
    },
    methods: {
        buscaVeiculos() {
            axios.get('/api/veiculos').then(response => {
                this.veiculos = response.data
                console.log(this.usuarios)
            }).catch(error => {
                alert('Ocorreu um erro ao buscar os veiculos!')
                console.error(error)
            })
        },
        gerarRelatorio() {
            let item = Object.assign({}, this.item)
            item.veiculo_id = parseInt(item.veiculo_id)
            axios.get(`/api/relatorio/${item.veiculo_id}/${item.mes}`).then(response => {
                this.dados = response.data
                console.log(this.dados)
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
