<template>
    <div class="balance-modal">
        <div class="container">
            <h1 class="title">Пополнить баланс</h1>
            <div class="card">
            <div class="modal-body" :class="{animated: animated}">
                <form class="first-step" v-if="step === 1 || step === 0" @submit.prevent='onSubmit'>
                    <div class="form-group">
                        <label for="sumInput">Сумма</label>
                        <input class="form-control"
                                type="number"
                                id="sumInput"
                                v-model="sum"
                                :class="{'is-invalid': error}"
                            >
                        <span v-if="error" class="invalid-text">Введите сумму</span>
                    </div>
                    <button type="submit" class="btn yellow-btn">Дальше</button>
                </form>
                <div class="second-step" v-else-if="step === 0 || step === 2">
                    <div v-if="isLoaded" class="spinner-border text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div v-else>
                        <h5>Реквизиты</h5>
                        <ul>
                            <li v-for="(value, label , index) in balanceInfo" :key="index" v-if="label != 'qrcode_url'">
                                <p>{{label}}:</p> <p> {{value}}</p>
                            </li>
                        </ul>
                        <img :src="balanceInfo.qrcode_url" alt="">    
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'link'
    ],
    data: () => ({
        step: 1,
        error: false,
        animated: false,
        isLoaded: false,
        balanceInfo: {}
    }),
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    methods: {
        onSubmit() {
            if(this.sum){
                this.isLoaded = true;
                axios.post(this.link , {'amount':  +this.sum,'_token' : this.csrfToken}).then(response => {
                    if(response.status === 200){
                        this.balanceInfo = response.data
                        this.step = 0
                        this.isLoaded = false
                        setTimeout(() => {
                            this.animated = true
                        }, 200)
                        setTimeout(() => {
                            this.step = 2
                            this.animated = false
                        }, 500)
                    }
                }).catch(error => {
                    console.log(error);
                })
            }else{
                this.error = true
            }
        }
    }
}
</script>
