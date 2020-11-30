<template>
    <a class="card" :href="this.projectLink">
        <div class="like-block"><i class="far fa-heart"></i></div>
        <div class="card-img-top">
            <img src="https://cdn.homedit.com/wp-content/uploads/2012/03/modern-high-tech-property.jpg">
        </div>
        <div class="card-body">
        <div class="card-price">от {{ this.project.price }} <span class="rub">₽</span></div>
        <h5 class="card-title">{{ this.project.title }}</h5>
        <ul class="card-text" v-for="(value, label) in this.projectValues">
            <li><span>{{ label }}</span><span>{{ value }}</span></li>
        </ul>
        </div>
    </a>
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
