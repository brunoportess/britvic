<template>
    <div>
        <table class="table table-hover table-bordered table-custom table-striped table-light" v-if="listItem">
            <thead v-if="!hideHeader">
            <slot name="columns">
                <th v-for="(column, index) in columns" :key="index" class="color-base text-center" :class="{ mhand: column.sortable, 'text-right': column.field == 'actions' }" @click="sortBy(column.sortable)">{{column.label}} <span v-if="column.sortable !== ''" class="ml-1"><i class="fas fa-sort" style="font-size: 0.7rem;"></i></span></th>
            </slot>
            </thead>
            <tbody>
            <tr v-if="listItem.length === 0">
                <td :colspan="columns.length" class="text-center font-weight-bold">
                    <span>Nenhum registro a ser exibido</span>
                </td>
            </tr>
            <!--<tr v-else v-for="(item, index) in listItem" @click="sendItem(item)" :key="index" :class="{ 'text-danger': (item.hasOwnProperty('ativo') && item.ativo == 0) ? true : false }">-->
            <tr style="color: #727272" v-else v-for="(item, index) in listItem" @click="sendItem(item)" :key="index">
                <slot name="row" :row="item">
                    <td v-for="(column, index) in columns" :key="index" :class="{'text-right': column.field == 'actions'}">
                        <slot name="column" :item="item" :column="column">
                            {{itemValue(item, column.field)}}
                        </slot>
                    </td>
                </slot>
            </tr>
            </tbody>
        </table>
        <div class="row" v-if="pagination">
            <div class="col">
        <span class="color-base">
          Mostrando {{quantityBegin}} a {{quantityEnd}} de {{filteredData.length}} resultados
        </span>
            </div>
            <div class="col d-flex align-items-baseline justify-content-end">
        <span class="float-right">
          <button class="btn btn-sm mr-1 float-left font-weight-bold d-flex align-items-center" :disabled="!hasPage(-1)" @click="prevPage"><i class="fas fa-caret-left align-bottom mr-1"></i>Anterior</button>
          <button class="btn btn-sm ml-1 font-weight-bold d-flex align-items-center" :disabled="!hasPage(1)"  @click="nextPage">Próximo<i class="fas fa-caret-right align-bottom ml-1"></i></button>
        </span>
                <!--
                <span class="menu-bg-blue p-1 float-right h6 small" style="border-radius:10px">
                  Exportar dados
                </span>
                -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CustomTable',
    data: function () {
        var sortOrders = {}
        this.columns.forEach(function (key) {
            sortOrders[key.sortable] = 1
        })
        return {
            page: 0,
            pagination: true,
            quantityBegin: 0,
            quantityEnd: 0,
            // dataSize: '',
            searchKey: '',
            sortKey: '',
            sortOrders: sortOrders,
            listItem: [],
            pageSize: 0
        }
    },
    watch: {
        data: {
            handler () {
                this.filteredList()
            }
        },
        itemsPerPage: {
            handler () {
                this.pageSizeSet()
            }
        },
        search: {
            handler () {
                this.filteredList()
            }
        }
    },
    computed: {
        dataSize () {
            return this.filteredData.length
        },
        filteredData: function () {
            var sortKey = this.sortKey
            // var filterKey = this.searchKey && this.searchKey.toLowerCase()
            var filterKey = this.search && this.search.toLowerCase()
            var order = this.sortOrders[sortKey] || 1
            var data = this.data
            if (filterKey) {
                data = data.filter(function (row) {
                    return Object.keys(row).some(function (key) {
                        return String(row[key]).toLowerCase().indexOf(filterKey) > -1
                    })
                })
            }
            if (sortKey) {
                data = data.slice().sort(function (a, b) {
                    a = a[sortKey]
                    b = b[sortKey]
                    return (a === b ? 0 : a > b ? 1 : -1) * order
                })
            }
            return data
        }
    },
    mounted () {
        this.pageSizeSet()
        if(this.hidePagination) {
            this.pagination = false
            //this.pageSize = 10
        }
        console.log(this.pagination)
        this.filteredList()
    },
    methods: {
        pageSizeSet() {
            if(this.itemsPerPage) {
                this.pageSize =  this.itemsPerPage
            } else {
                this.pageSize = 10
            }
        },
        filteredList () {
            let items = this.filteredData
            let s = this.page * this.pageSize
            let e = (this.page + 1) * this.pageSize
            if (items.length <= s) {
                s = 0
                e = this.pageSize
                this.pageNumber(0)
            }
            this.quantityBegin = s + 1,
                this.quantityEnd = e < this.filteredData.length ? e : this.filteredData.length
            this.listItem = items.slice(s, e)
        },
        pageNumber (page) {
            this.page = page
        },
        sortBy: function (key = '') {
            if (key !== '') {
                this.sortKey = key
                this.sortOrders[key] = this.sortOrders[key] * -1
                this.filteredList()
            }
        },
        itemValue (item, column) {

            if (column !== 'actions' && column !== 'custom') {
                if (column.includes('.')) {
                    return this.getDescendantProp(item, column)
                } else {
                    return item[column]
                }
            } else {
                return 'CUSTOM'
            }
        },
        hasPage: function (dir) {
            if (dir === -1 && (this.page > 0)) return true
            if (dir === 1 && (((this.page + 1) * this.pageSize) < this.dataSize)) return true
            return false
        },
        prevPage: function () {
            if (this.hasPage(-1)) {
                this.page--
                this.filteredList()
            }
        },
        nextPage: function () {
            if (this.hasPage(1)) {
                this.page++
                this.filteredList()
            }
        },
        sendItem: function (item) {
            this.$emit('receiveItem', item)
        },
        getDescendantProp (obj, desc) {
            let arr = desc.split('.');
            let item = Object.assign({}, obj)
            for(let x = 0; x<arr.length; x++) {
                item = item[arr[x]]
            }
            return item;
        }
    },
    props: {
        columns: Array,
        data: Array,
        itemsPerPage: Number,
        search: String,
        hidePagination: Boolean,
        hideHeader: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style scoped>
.mhand {
    cursor: pointer;
}
.controls {
    font-weight: 700;
    font-size: 1rem;
}
table > thead, table > tfoot {
    background-color: #f3f4f7;
}

@media only screen and (max-width: 992px) {
    table {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}
</style>
