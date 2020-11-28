<template>
    <div class="container">
        <h2>{{ project.title }}</h2>
        Добавлено: {{ createdAt }}
        <div class="description">
            {{ project.description }}
        </div>
        <div class="images">
            <img width="250px" :v-for="image in images" :src="image" :alt="project.title">
        </div>
        <table class="table table-bordered">
            <tbody>
            <tr :v-for="(value, label) in values">
                <th>{{ label }}</th>
                <td>{{ value }}</td>
            </tr>
            </tbody>
        </table>
        <hr>
        <h3>Заказать проект</h3>
        <form :action="this.createOrderLink" method="post">
            <div class="card mb-3">
                <div class="card-header">
                    Характеристики
                </div>
                <div class="card-body pb-2">

                    <div class="form-group" :v-for="attribute in this.orderAttributes">
                        <label :for="'order_attribute_'+attribute.id" class="col-form-label">{{ attribute.name }}</label>

                        <select v-if="attribute.variants.length > 0" :id="'order_attribute_'+attribute.id" class="form-control" :name="'order_attributes['+attribute.id+']'">
                            <option v-if="attribute.required" value=""></option>

                            <option :v-for="variant in attribute.variants" :value="variant">
                                {{ variant }}
                            </option>
                        </select>

                        <input v-else-if="attribute.type === 'number'" :id="'order_attribute_'+attribute.id" type="number" class="form-control" :name="'order_attributes['+attribute.id+']'">

                        <input v-else :id="'order_attribute_'+attribute.id" type="text" class="form-control" :name="'order_attributes['+attribute.id+']'">

                    </div>

                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: [
        'project',
        'images',
        'createdAt',
        'values',
        'createOrderLink',
        'orderAttributes'
    ],
    created() {
        console.log(this.orderAttributes)
    }
}
</script>

<style scoped>
    image {
        width: 250px;
    }
</style>
