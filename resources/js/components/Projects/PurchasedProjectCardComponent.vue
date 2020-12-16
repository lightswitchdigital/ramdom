<template>
    <a class="card project-card order-card" :href="orderLink">
        <div class="card-img-top">
            <img :src="project.project.jsonImages[0]">
        </div>
        <div class="card-body">
            <div class="card-price">от {{ project.price }} <span class="rub">₽</span></div>
            <h5 class="card-title">{{ project.project.title }}</h5>
            <ul class="card-text">
                <li v-for="(value, label , index) in project.jsonValues" :key="index">
                    <span>{{ label }}</span><span>{{ value }}</span>
                </li>
            </ul>
            <br>
            <small
                data-toggle="modal"
                :data-target="'#project-details-'+project.id" 
                @click.prevent="postProject">
                Подробнее
            </small>
            <a :href="project.orderLink" class="btn yellow-btn mt-3">
                Заказать строительство
            </a>
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
};
</script>
