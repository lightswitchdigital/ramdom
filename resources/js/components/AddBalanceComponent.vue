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
                    <h5>Реквизиты</h5>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <div class="qr-block">
                        <img src="https://spbformat.ru/wp-content/uploads/2020/05/qr-kod.jpg" alt="">
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
    data: () => ({
        step: 1,
        error: false,
        animated: false
    }),
    methods: {
        onSubmit() {
            if(this.sum){
                console.log(this.sum);
                this.step = 0
                setTimeout(() => {
                    this.animated = true
                }, 200)
                setTimeout(() => {
                    this.step = 2
                    this.animated = false
                }, 500)
            }else{
                this.error = true
            }
        }
    }
}
</script>