<template>
    <div class="card mx-4" style="width: 30%; float: left">
        <div class="card-header">
            <a :href="this.projectLink">{{ this.project.title }}</a>
        </div>
        <div class="card-body">
            {{ this.project.description }}
            <hr>
            <div
                v-for="(value, label) in this.projectValues"
            >
                {{ label }} : {{ value }}
                <br>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'project',
        'projectLink',
        'projectImages',
        'projectValues'
    ]
};
</script>

<style scoped>

</style>
