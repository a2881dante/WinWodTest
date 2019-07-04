<template>
    <div class="card">
        <div class="card-header">
            Создание нового товара
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="item-name">Наименование товара</label>
                    <input type="text" class="form-control" name="item-name" id="item-name"
                           placeholder="Наименование товара" v-model="item.name">
                </div>
                <div class="form-group">
                    <label for="item-name">Размеры:</label>
                    <div class="form-group form-check col-2" v-for="size in dataSizes">
                        <input type="checkbox" class="form-check-input"
                               :value="size.id" v-model="sizes">
                        <label class="form-check-label">{{size.sign}}</label>
                        <p>{{item.sizes}}</p>
                    </div>
                    <input type="file" id="file" ref="file" @change="handleFileUpload"/>
                </div>
                <button class="col-12 btn btn-success" @click.prevent="storeItem">Сохранить</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ItemCreateComponent",
        data: function(){
            return {
                item: {},
                dataSizes: [],
                sizes: [],
                file: '',
            }
        },
        mounted(){
            this.getSizes();
        },
        methods: {
            storeItem(){
                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('name', this.item.name);
                formData.append('sizes', this.sizes);
                console.log(this.item);
                axios.post('./items',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then((response) => {
                        this.item = {};
                        this.sizes = [];
                        this.file = '';
                        this.$emit('storeItem', response.data);
                    }
                );
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },
            getSizes(){
                axios
                    .get('./sizes')
                    .then((response) => {
                        this.dataSizes = response.data
                    });
            }
        },
    }
</script>

<style scoped>

</style>