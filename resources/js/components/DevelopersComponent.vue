<template>
    <form class="developers-block">
        <div class="container">
            <div class="wrapper">
            <div v-if="error" class="alert alert-danger" role="alert">
                {{error}}
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="list-group list-group-flush" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action"
                        :id="'list-'+developer.id+'-list'" data-toggle="list" 
                        :href="'#list-'+developer.id" role="tab" :aria-controls="developer.id"
                        @click.prevent="changesDeveloper = developer.id"
                        v-for="(developer , index) in developers" :key="index">
                        {{ developer.name }}
                        </a>
                    </div>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade" :id="'list-'+developer.id"
                        role="tabpanel" :aria-labelledby="'list-'+developer.id+'-list'"
                        v-for="(developer , index) in developers" :key="index">
                        {{ developer.phone }}
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn yellow-btn" @click="changeVar">Выбрать</button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    data:() => ({
        error: '',
        changesDeveloper: null
    }),
    props: [
        'developers'
    ],
    mounted() {
        console.log(this.developers);
    },
    methods: {
        changeVar() {
            if(!this.changesDeveloper){
                this.error = 'Выбирайте "Единую Россию"'
            }
        }
    }
}
</script>