<template>
    <div class="card">
        <div class="card-header">
            Список товаров
        </div>
        <div class="card-body">
            <item-create-component @storeItem="storeItem"></item-create-component>
            <div v-if="isLoad">
                <p>Подождите, идет загрузка данных.</p>
            </div>
            <div v-if="!isLoad">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Наименование</th>
                        <th scope="col">Размеры</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in items">
                        <th scope="row">{{item.id}}</th>
                        <td><img class="item-img" :src="`./${item.avatar_url}`"></td>
                        <td>{{item.name}}</td>
                        <td>
                            <span v-for="size in item.sizes">
                                {{size.sign+"  "}}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group ">
                                <a class="btn btn-primary" :href="`./items/${item.id}/edit`">Изменить</a>
                                <a class="btn btn-danger" @click="deleteItem(item)">Удалить</a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ItemsListComponent",
        data: function () {
            return {
                isNewItem: false,
                isLoad: true,
                items: [],
            }
        },
        mounted() {
            this.getItems();
        },
        methods: {
            /**
             *
             */
            getItems(){
                this.isLoad = true;
                axios
                    .get('./items')
                    .then((response) => {
                        this.items = response.data;
                        this.isLoad = false;
                    })
                    .catch(function (resp) {
                        alert("Ошибка загрузки");
                    });
            },

            /**
             *
             * @param item
             */
            deleteItem(item){
                console.log(item.id);
                axios
                    .delete(`./items/${item.id}`)
                    .then(() => {
                        var idx = this.items.indexOf(item);
                        if (idx != -1) {
                            return this.items.splice(idx, 1);
                        }
                    })
                    .catch(function (resp) {
                        alert("Ошибка при удалении товара");
                    });
            },

            /**
             *
             * @param item
             */
            storeItem(item){
                this.items.push(item);
            }
        }
    }
</script>

<style scoped>

    .item-img{
        width: 100px;
        height: auto;
    }

</style>