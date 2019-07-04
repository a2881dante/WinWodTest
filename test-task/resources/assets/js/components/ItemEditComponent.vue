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
                           placeholder="Наименование товара">
                </div>
                <button class="col-12 btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ItemEditComponent"
    }
</script>

<style scoped>

</style>