<template>
    <div>
        <div v-for="(request, index) in requests" :key="index" class="request-block">
            <div :id="'downloadModal'+request.id" aria-hidden="true" aria-labelledby="downloadModalLabel" class="modal fade"
                 tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body pt-4">
                            <form :action="'/profile/smeta/download-docs/' + request.id" enctype="multipart/form-data"
                                  method="POST">
                                <h1>Скачать смету</h1>
                                <input v-model="csrfToken" name="_csrf" type="hidden">
                                <br>
                                <div class="form-group mx-sm-3  mb-2">
                                    <label for="logo">Логотип компании</label>
                                    <input id="logo" class="form-control-file" name="logo" type="file">
                                </div>
                                <br>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label class="sr-only" for="project_name">Название проекта</label>
                                    <input id="project_name" class="form-control" name="project_name" placeholder="Новый проект"
                                           type="text">
                                </div>
                                <br>
                                <button class="btn btn-primary" type="submit">Скачать</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <p>#{{ request.id }}</p>
            <p>
                {{ request.user.name + " " + request.user.last_name }}
                <br>
                {{ request.user.phone }}
                <br>
                {{ request.user.email }}
            </p>
            <p class="message-for-dev"><span>{{ request.text }}</span></p>
            <p>{{ request.price }} руб</p>
            <div class="btn-group-flex">
                <a :data-target="'#downloadModal'+request.id" class="btn btn-primary" data-toggle="modal" type="button">Скачать
                    смету</a>
            </div>
            <div aria-label="Basic radio toggle button group" class="btn-group" role="group">
                <input :id="'btnradio1'+request.id"
                       v-model="statusValues[+request.id]"
                       :name="'btnradio'+request.id"
                       class="btn-check"
                       type="radio"
                       value="active"
                       @input="sendStatus(request.id, 'active')"
                >
                <label :for="'btnradio1'+request.id" class="btn btn-outline-primary">На рассмотрении</label>

                <input :id="'btnradio2'+request.id"
                       v-model="statusValues[+request.id]"
                       :name="'btnradio'+request.id"
                       class="btn-check"
                       type="radio"
                       value="accepted"
                       @input="sendStatus(request.id, 'accepted')"
                >
                <label :for="'btnradio2'+request.id" class="btn btn-outline-primary">Принята</label>

                <input :id="'btnradio3'+request.id"
                       v-model="statusValues[+request.id]"
                       :name="'btnradio'+request.id"
                       class="btn-check"
                       type="radio"
                       value="rejected"
                       @input="sendStatus(request.id, 'rejected')"
                >
                <label :for="'btnradio3'+request.id" class="btn btn-outline-primary">Отклонена</label>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'developer-request',
    data: () => ({
        statusValues: {},
        csrfToken: ""
    }),
    props: [
        'requests',
        'statuses',
        'statusRoute'
    ],
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
        this.requests.forEach(r => {
            this.statusValues[+r.id] = r.status
        })
    },
    methods: {
        sendStatus(id, status) {
            axios.post(this.statusRoute, {status: status, request_id: id}).then().catch(e => console.log(e))
        }
    },
}
</script>
