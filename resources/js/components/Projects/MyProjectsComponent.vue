<template>
    <div class="favorites-block">
        <div v-if="loading">
            <preloader></preloader>
        </div>
        <div v-else>
            <h4>Сохраненные проекты</h4>
            <div class="my-projects-wrapper my-3">
                <div v-if="savedProjects.length > 0">
                    <VueSlickCarousel
                        ref="recommend"
                        v-bind="settings">
                        <saved-project-card
                            v-for="project in savedProjects"
                            :key="project.id"
                            :project="project"
                            :projectLink="'#'"/>
                        <template #prevArrow>
                            <div class="btn-prev">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                        </template>
                        <template #nextArrow>
                            <div class="btn-next">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </template>
                    </VueSlickCarousel>
                </div>
                <div v-else>
                    У вас пока нет сохраненных проектов.
                </div>
            </div>
            <h4>Купленные проекты</h4>
            <div class="my-projects-wrapper my-3">
                <div v-if="purchasedProjects.length > 0">
                    <VueSlickCarousel
                        ref="recommend"
                        v-bind="settings">
                        <purchased-project-card
                            v-for="project in purchasedProjects"
                            :key="project.id"
                            :project="project"
                            :projectLink="'#'"/>
                        <template #prevArrow>
                            <div class="btn-prev">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                        </template>
                        <template #nextArrow>
                            <div class="btn-next">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </template>
                    </VueSlickCarousel>
                </div>
                <div v-else>
                    Здесь пока что пусто. Покупайте проекты и они появятся здесь!
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
    props: [
        'projectsLink'
    ],
    components: {
        VueSlickCarousel
    },
    data: () => ({
        purchasedProjects: [],
        savedProjects: [],
        loading: false,
        settings: {
            "infinite" : true,
            "slidesToShow": 4,
            "slidesToScroll": 1,
            "responsive": [
                {
                    "breakpoint": 1024,
                    "settings": {
                        "slidesToShow": 3,
                        "infinite": true
                    }
                },
                {
                    "breakpoint": 600,
                    "settings": {
                        "slidesToShow": 2
                    }
                },
                {
                    "breakpoint": 480,
                    "settings": {
                        "slidesToShow": 1
                    }
                }
            ]
        }
    }),
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    mounted() {
        this.getProjects()
    },
    methods: {
        getProjects() {
            this.loading = true
            axios.get(this.projectsLink)
                .then(response => {
                    if(response.status === 200){
                        this.purchasedProjects = response.data.purchased
                        this.savedProjects = response.data.saved
                        this.loading = false
                    }
                    console.log(this.purchasedProjects)
                })
        },
    }
}
</script>

<style scoped>
    .my-projects-wrapper {
        min-height: 300px;
    }
</style>
