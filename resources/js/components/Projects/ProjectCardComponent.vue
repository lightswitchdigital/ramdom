<template>
    <div class="card mx-4" style="width: 30%; float: left">
        <div class="card-header">
            <a :href="this.projectLink">{{ this.project.title }}</a>
        </div>
        <div class="card-body">
            {{ this.project.description }}
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'project',
        'projectLink'
    ]
};
</script>

<style scoped>

</style>
