<template>
    <div class="card mb-3 advice-card">
        <div class="row no-gutters">
            <div class="col-md">
                <div class="card-img">
                    <img :src="advice.imageUrl" :alt="advice.title">
                </div>
            </div>
            <div class="col-md">
            <div class="card-body">
                <h4 class="card-title">{{ advice.title }}</h4>
                <h5>Архитектурно-строительная компания</h5>
                <p class="card-text">
                    {{ advice.content }}
                </p>
<<<<<<< HEAD
                <a :href="'advice/'+advice.id" class="yellow-btn">Подробнее</a>
=======
                <a :href="adviceLink" class="yellow-btn">Подробнее</a>
>>>>>>> e55586ec00efccd06087dd1187b4229134f3c848
            </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'advice',
    props: [
        'advice',
        'adviceLink'
    ],
    mounted() {
        console.log(this.advice)
    }
}
</script>
