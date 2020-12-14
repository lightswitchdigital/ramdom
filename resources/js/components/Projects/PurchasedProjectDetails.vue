<template>
    <div class="modal fade" :id="'project-details-'+project.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ project.project.title }}
                    {{ project.price }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "PurchasedProjectDetails",
    props: [
        'project'
    ]
}
</script>

<style scoped>

</style>
