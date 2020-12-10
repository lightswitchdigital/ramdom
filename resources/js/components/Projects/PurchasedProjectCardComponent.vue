<template>
    <a class="card project-card" :href="orderLink">
        <div class="card-img-top">
            <img :src="project.project.jsonImages[0]">
        </div>
        <div class="card-body">
            <div class="card-price">от {{ project.price }} <span class="rub">₽</span></div>
            <h5 class="card-title">{{ project.project.title }}</h5>
            <ul class="card-text">
                <li v-for="(value, label , index) in project.jsonValues" :v-if="index < 4" :key="index">
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
        'orderLink'
    ],
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    methods: {
    }
};
</script>
