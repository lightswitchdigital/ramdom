<template>
    <div class="modal fade region-modal" id="regionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Выберите регион</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" 
                    v-for="(region , index) in regions" :key="index">
                        <a :href="'?region='+region.slug">region.name</a>
                    </li>
                </ul>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'regions'
    ]
}
</script>