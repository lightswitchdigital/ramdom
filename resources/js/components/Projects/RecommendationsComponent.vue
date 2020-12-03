<template>
    <div class="recommend-block">
        <h3 class="title">Вам может понравиться</h3>
        <VueSlickCarousel
        ref="recommend"
        v-bind="settings">
        <ProjectCardComponent
<<<<<<< HEAD:resources/js/components/common/RecommendComponent.vue
        v-for="(project , index) in recommendations"
        :key="index"
=======
        v-for="project in this.recommendations"
        :key="project.id"
>>>>>>> c9707408d306d6b4ef8058aec69b07be1095d28d:resources/js/components/Projects/RecommendationsComponent.vue
        :project="project"
        :projectLink="'#'"
        :projectValues="[]"/>
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
</template>

<script>
<<<<<<< HEAD:resources/js/components/common/RecommendComponent.vue
=======
import ProjectCardComponent from './ProjectCardComponent'
import VueSlickCarousel from 'vue-slick-carousel'
>>>>>>> c9707408d306d6b4ef8058aec69b07be1095d28d:resources/js/components/Projects/RecommendationsComponent.vue
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
    props: [
        'recommendations'
    ],
    data:() => ({
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
<<<<<<< HEAD:resources/js/components/common/RecommendComponent.vue
    components: { 
        'ProjectCardComponent': () => import('../Projects/ProjectCardComponent') ,
        'VueSlickCarousel': () => import('vue-slick-carousel')
    }
=======
    props: [
        'recommendations'
    ],
    components: { ProjectCardComponent , VueSlickCarousel }
>>>>>>> c9707408d306d6b4ef8058aec69b07be1095d28d:resources/js/components/Projects/RecommendationsComponent.vue
}
</script>
