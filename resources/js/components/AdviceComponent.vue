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
                <p class="card-text" v-html="advice.content"></p>
                <a class="yellow-btn" href="/login">Подробнее</a>
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
