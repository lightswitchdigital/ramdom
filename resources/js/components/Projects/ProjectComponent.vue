<template>
    <div class="container">
        <h2>{{ this.project.title }}</h2>
        <div class="description">
            {{ this.project.description }}
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'project'
    ]
}
</script>

<style scoped>

</style>
