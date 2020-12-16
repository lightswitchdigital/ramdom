<template>
    <div class="projects-wrapper d-flex">
        <Modal v-if="modalProject != {}" :project="modalProject.project"></Modal>
        <div class="spinner-border" role="status" v-if="isLoaded">
            <span class="sr-only">Loading...</span>
        </div>
        <ProjectCard v-else 
        v-for="(project , index) in projects" 
        :key="index" :project="project"
        @postModal="getProject">
        </ProjectCard>
        <!-- <button @click.prevent="getMore">Показать больше</button> -->
    </div>
</template>

<script>
import Modal from './PurchasedProjectDetails'

export default {
    data:() => ({
        projects: [],
        isLoaded: false,
        modalProject: {},
        pageNumber: 1
    }),
    components: {ProjectCard: () => import('./PurchasedProjectCardComponent'), Modal},
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    mounted() {
        this.getProjects()
    },
    methods: {
        getProject(project) {
            this.modalProject = project
        }, 
        getProjects() {
            this.isLoaded = true
            axios.get(`projects/get-purchased-projects?batch=${this.pageNumber}` , {'_token' : this.csrfToken})
            .then(response => {
                if(response.status === 200){
                    this.projects = response.data
                    this.isLoaded = false
                }
            }).catch(err => {
                console.log(err);
            })
        },
        getMore(){
            this.pageNumber+=1
            this.getProjects()
        }
    }
}
</script>