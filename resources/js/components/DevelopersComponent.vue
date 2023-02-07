<template>
    <form class="developers-block">
        <div class="wrapper">
            <div v-if="error" class="alert alert-danger" role="alert">
                {{ error }}
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="list-group list-group-flush" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action"
                           :id="'list-'+developer.id+'-list'" data-toggle="list"
                           :href="'#list-'+developer.id" role="tab" :aria-controls="developer.id"
                           @click.prevent="changeDeceloper(id)"
                           v-for="(developer , index) in developers" :key="index">
                            {{ developer.name }}
                        </a>
                    </div>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade" :id="'list-'+developer.id"
                             v-for="(developer , index) in developers" :key="index"
                             :aria-labelledby="'list-'+developer.id+'-list'" role="tabpanel">
                            <h5>{{ developer.name + " " + developer.last_name }}</h5>
                            <p>{{ developer.developer_desc }}</p>
                            <p class="mute">{{ developer.email }}</p>
                            <p class="mute">{{ developer.phone }}</p>
                            <textarea v-model="developerMessage" class="developers-textarea"
                                      placeholder="Коментарий для застройщика"></textarea>
                            <button class="btn yellow-btn" @click.prevent="changeVar(developer.id)">Выбрать</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    data:() => ({
        error: '',
        changesDeveloper: null,
        developerMessage: ''
    }),
    props: [
        'developers'
    ],
    methods: {
        changeVar(id) {
            axios.post(`https://www.rbc.work/profile/smeta/developers`, {
                'developer_id': id,
                'text': this.developerMessage
            }).then(response => {
                window.location.href = response.data.redirectTo
            }).catch(error => console.log(error))
        },
        changeDeceloper(id) {
            this.changesDeveloper = id
            this.developerMessage = ''
        }
    }
}
</script>
