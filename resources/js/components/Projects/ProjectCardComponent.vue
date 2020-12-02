<template>
    <a class="card" :href="this.project.route">
        <div class="like-block"><i class="far fa-heart"></i></div>
        <div class="card-img-top">
            <img :src="this.project.jsonImages[0]">
        </div>
        <div class="card-body">
        <div class="card-price">от {{ this.project.price }} <span class="rub">₽</span></div>
        <h5 class="card-title">{{ this.project.title }}</h5>
        <ul class="card-text" v-for="(value, label) in this.project.jsonValues">
            <li><span>{{ label }}</span><span>{{ value }}</span></li>
        </ul>
        </div>
    </a>
</template>

<script>
export default {
    props: [
        'project',
    ],
    created() {
        console.log(this.project.jsonImages, this.project.jsonValues)
    }
};
</script>
