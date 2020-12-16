<template>
    <div class="projects-wrapper d-flex">
        <div class="spinner-border" role="status" v-if="isLoaded">
            <span class="sr-only">Loading...</span>
        </div>
        <ProjectCard v-else v-for="(project , index) in projects" :key="index" 
        :project="project.project">
        </ProjectCard>
    </div>
</template>

<script>

export default {
    data:() => ({
        projects: [],
        isLoaded: false
    }),
    components: {ProjectCard: () => import('./ProjectCardComponent')},
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    mounted() {
        this.isLoaded = true
        axios.get("projects/get-saved-projects" , {'_token' : this.csrfToken})
        .then(response => {
            if(response.status === 200){
                this.projects = response.data
                this.isLoaded = false
            }
        }).catch(err => {
            console.log(err);
        })
    }
}
</script>