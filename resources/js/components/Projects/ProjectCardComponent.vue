<template>
    <a class="card" :href="this.projectLink">
        <div class="like-block"><i class="far fa-heart"></i></div>
        <div class="card-img-top">
        <img src="https://cdn.homedit.com/wp-content/uploads/2012/03/modern-high-tech-property.jpg">
        </div>
        <div class="card-body">
        <div class="card-price">от {{ this.project.price }} <span class="rub">₽</span></div>
        <h5 class="card-title">{{ this.project.title }}</h5>
            <div :v-for="(value, label) in this.projectValues">
                {{ label }} : {{ value }}
                <br>
            </div>
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

<style scoped>

</style>
