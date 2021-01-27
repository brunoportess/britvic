<template>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Data de entrega</label>
                <input type="date" v-model="data_inicio" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Data de devolução</label>
                <input type="date" v-model="data_fim" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Usuário</label>
                <select class="form-control" v-model="reserva.usuario_id">
                    <option v-if="data_inicio.length < 10 || data_fim.length < 10" value="0">Informe as datas</option>
                    <option v-for="(item, index) in usuarios" :key="index" :value="item.id">{{item.nome}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Veículo</label>
                <select class="form-control" v-model="reserva.veiculo_id">
                    <option v-if="data_inicio.length < 10 || data_fim.length < 10" value="0">Informe as datas</option>
                    <option v-for="(item, index) in veiculos" :key="index" :value="item.id">
                        {{ item.marca }} {{ item.modelo }} {{ item.ano }}
                    </option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="button" @click="salvar" :disabled="desabilitado" class="btn btn-primary">Salvar</button>
            <a  class="btn btn-danger" href="/reservas" role="button">Cancelar</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "ReservaFormulario",
    props: {
        item: {
            type: Object,
            default: null
        }
    },
    data () {
        return {
            reserva: {
                veiculo_id: '0',
                usuario_id: '0',
            },
            data_inicio: '',
            data_fim: '',
            veiculos: [],
            usuarios: []
        }
    },
    mounted () {
        this.buscaUsuarios()
        if(this.item !== null) {
            this.data_inicio = this.item.data_inicio
            this.data_fim = this.item.data_fim
            this.reserva = this.item
            this.reserva.usuario_id = this.reserva.usuario_id.toString()
            this.reserva.veiculo_id = this.reserva.veiculo_id.toString()
            console.log(this.reserva)
        }
    },
    watch: {
        data_inicio: {
            handler () {
                if (this.data_inicio !== '' && this.data_fim !== '') {
                    this.buscaVeiculosDisponiveis()
                }
            }
        },
        data_fim: {
            handler () {
                if (this.data_inicio !== '' && this.data_fim !== '') {
                    this.buscaVeiculosDisponiveis()
                }
            }
        }
    },
    computed: {
        desabilitado () {
            return this.data_fim.length === 0 || this.data_inicio.length === 0 || parseInt(this.reserva.usuario_id) === 0 || parseInt(this.reserva.veiculo_id) === 0
        }
    },
    methods: {
        buscarDadosReserva () {

        },
        buscaUsuarios () {
            axios.get('/api/usuarios').then(response => {
                this.usuarios = response.data
                if(this.usuarios.length === 0) {
                    alert('Favor cadastrar um usuário!')
                }
            }).catch(error => {
                console.error(error)
            })
        },
        buscaVeiculosDisponiveis() {
            let link = this.item !== null ? 'veiculos' : `veiculos-disponiveis/${this.data_inicio}/${this.data_fim}`
            axios.get(`/api/${link}`).then(response => {
                this.veiculos = response.data
            }).catch(error => {
                console.error(error)
            })
        },
        salvar () {
            let dados = Object.assign({}, this.reserva)
            dados.data_inicio = this.data_inicio
            dados.data_fim = this.data_fim
            dados.usuario_id = parseInt(dados.usuario_id)
            dados.veiculo_id = parseInt(dados.veiculo_id)
            console.log(dados)
            axios.post('/api/reservas', dados).then(response => {
                window.location.replace("reservas");
            }).catch(error => {
                console.error(error)
            })
        }
    }
}
</script>

<style scoped>

</style>
