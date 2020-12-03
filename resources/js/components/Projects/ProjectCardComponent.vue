<template>
    <a class="card project-card" :href="this.project.route">
        <div class="like-block"><i class="fas fa-heart"></i></div>
        <div class="card-img-top">
            <img :src="this.project.jsonImages[0]">
        </div>
        <div class="card-body">
        <div class="card-price">от {{ this.project.price }} <span class="rub">₽</span></div>
        <h5 class="card-title">{{ this.project.title }}</h5>
        <ul class="card-text">
            <li v-for="(value, label , index) in this.project.jsonValues" :v-if="index <= 4" :key="index">
                <span>{{ label }}</span><span>{{ value }}</span>
            </li>
        </ul>
        </div>
    </a>
</template>

<script>
export default {
    props: [
        'project'
    ],
    created() {
        // this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
        console.log(this.project.jsonImages, this.project.jsonValues)
    },
    methods: {
        // liked() {
        //     if(!this.project.isInFavorites){
        //         this.favoritesUrl = this.favoritesAddLink
        //     }else{
        //         this.favoritesUrl = this.favoritesRemoveLink
        //     }
        //     axios.post(this.favoritesUrl , {'_token' : this.csrfToken}).then(response => {
        //         if(response.status === 204){
        //             console.log('is ok');
        //         }
        //     }).catch(error => {
        //         console.log(error);
        //     })
        // }
    }
};
</script>
