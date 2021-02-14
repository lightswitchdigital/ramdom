<template>
    <a class="card project-card" :href="project.project.route">
        <div class="card-img-top">
            <img :src="project.project.jsonImages[0]">
        </div>
        <div class="card-body">
            <div class="card-price">{{ project.project.price }} <span class="rub">₽</span></div>
            <h5 class="card-title">{{ project.project.title }}</h5>
            <ul class="card-text">
                <li v-for="(value, label , index) in project.project.jsonValues" :key="index" v-if="index <= 4">
                    <span>{{ label }}</span><span>{{ value }}</span>
                </li>
            </ul>
        </div>
    </a>
</template>

<script>
export default {
    data:() => ({
        toggleFavoritesUrl: '',
        favoritesClass: '',
        btnDisabled: false
    }),
    props: [
        'project',
    ],
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    methods: {
        postProject() {
            this.$emit('postModal', this.project)
        }
    }
}
</script>
