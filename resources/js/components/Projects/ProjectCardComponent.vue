<template>
    <a class="card project-card" :href="this.project.route">
        <div class="like-block"
        v-if="isAuthenticated"
        :disabled="btnDisabled"
        :class="[{active : project.isInFavorites} , favoritesClass]"
        @click.prevent="toggleFavorites"
        ><i class="fas fa-heart"></i></div>
        <div class="card-img-top">
            <img :src="this.project.jsonImages[0]">
        </div>
        <div class="card-body">
        <div class="card-price">{{ this.project.price }} <span class="rub">₽</span></div>
        <h5 class="card-title">{{ this.project.title }}</h5>
        <ul class="card-text">
            <li v-for="(value, label , index) in this.project.jsonValues" :key="index" v-if="index <= 4">
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
        'isAuthenticated'
    ],
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    methods: {
        toggleFavorites() {
            this.btnDisabled = true
            if(!this.project.isInFavorites){
                this.toggleFavoritesUrl = this.project.addToFavoritesLink
            }else{
                this.toggleFavoritesUrl = this.project.removeFromFavoritesLink
            }
            this.project.isInFavorites = !this.project.isInFavorites
            axios.post(this.toggleFavoritesUrl , {'_token' : this.csrfToken}).then(response => {
                if(response.status === 204){
                    this.btnDisabled = false
                    console.log(this.project.isInFavorites + ' favorites');
                    this.$nextTick(this.$forceUpdate);
                    this.favoritesClass = 'animated'
                    setTimeout(() => {this.favoritesClass = ''}, 200)
                }
            }).catch(error => {
                this.btnDisabled = false
                console.log(error);
            })
        }
    }
};
</script>
