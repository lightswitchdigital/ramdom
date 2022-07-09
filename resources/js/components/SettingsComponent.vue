<template>
    <div>
        <div class="card">

        </div>
    </div>
</template>

<script>
export default {
    data() { return { csrfToken: null }},
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
}
</script>

<style scoped>

</style>
