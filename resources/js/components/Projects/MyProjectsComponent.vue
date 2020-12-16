<template>
    <div class="favorites-block">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" 
                id="bouth-tab" data-toggle="tab"
                href="#bouth" role="tab" 
                aria-controls="bouth" aria-selected="true">Купленные</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#saved"
                id="saved-tab" data-toggle="tab" role="tab" 
                aria-controls="saved" aria-selected="true">Сохраненные</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="bouth" role="tabpanel" aria-labelledby="bouth-tab">
                <BouthProjects></BouthProjects>
            </div>
            <div class="tab-pane fade" id="saved" role="tabpanel" aria-labelledby="saved-tab">
                <SaveProjects></SaveProjects>
            </div>
        </div>
            <!-- {{projects.links()}} -->
    </div>
</template>

<script>
export default {
    components: {
        BouthProjects: () => import('./BouthProjectsComponent'),
        SaveProjects: () => import('./SaveProjectsComponent')
    }
}
</script>