<template>
    <div class="container">
        <h2>{{ project.title }}</h2>
        Добавлено: {{ createdAt }}
        <div class="description">
            {{ project.description }}
        </div>
        <div class="images">
            <img width="250px" v-for="image in images" :src="image" :alt="project.title">
        </div>
        <table class="table table-bordered">
            <tbody>
            <tr v-for="(value, label) in values">
                <th>{{ label }}</th>
                <td>{{ value }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: [
        'project',
        'images',
        'createdAt',
        'values'
    ]
}
</script>

<style scoped>
    image {
        width: 250px;
    }
</style>
