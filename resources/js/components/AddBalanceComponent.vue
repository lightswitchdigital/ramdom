<template>
<div class="modal fade" id="exampleModalBalance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content balance-modal">
      <div class="modal-header">
        <h1 class="title">Пополнить баланс</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="card">
            <div class="modal-body" :class="{animated: animated}">
                <form class="first-step" v-if="step === 1" @submit.prevent='onSubmit'>
                    <h5 style="text-align: center; margin: 0 0 35px 0">Пополнить баланс</h5>
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
                    <button style="display: block; margin: 15px auto" type="submit" class="btn secondary-btn">Продолжить</button>
                </form>
                <div class="second-step" v-else-if="step === 2">
                    <div v-if="loading">
                        <preloader></preloader>
                    </div>
                    <div v-else>
                        <img :src="balanceInfo.qrcode_url" alt="">
                        <div class="hint">
                            Чтобы пополнить баланс, переведите средства по указанному ниже счету или сканируйте QR-код. Средства начислятся сразу после того, как модерация сайта подтвердит их поступление.
                        </div>
                        <h4 style="margin: 30px 0 20px">Реквизиты</h4>
                        <ul v-if="balanceInfo" class="payment-credentials">
                            <li>
                                <p>Сумма:</p><p>{{ balanceInfo.amount }}</p>
                            </li>
                            <li>
                                <p>Название компании:</p><p>{{ balanceInfo.company_name }}</p>
                            </li>
                            <li>
                                <p>ИНН:</p><p>{{ balanceInfo.inn }}</p>
                            </li>
                            <li>
                                <p>КПП:</p><p>{{ balanceInfo.kpp }}</p>
                            </li>
                            <li>
                                <p>ОРГН:</p><p>{{ balanceInfo.orgn }}</p>
                            </li>
                            <li>
                                <p>Расчетный счет:</p><p>{{ balanceInfo.payment_account }}</p>
                            </li>
                            <li>
                                <p>Корр. счет:</p><p>{{ balanceInfo.correspondent_account }}</p>
                            </li>
                            <li>
                                <p>БИК:</p><p>{{ balanceInfo.bik }}</p>
                            </li>
                            <li>
                                <p>Назначение платежа:</p><p>{{ balanceInfo.purpose }}</p>
                            </li>
                            <li>
                                <p>Имя:</p><p>{{ balanceInfo.name }}</p>
                            </li>
                        </ul>
                    </div>
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
        loading: false,
        balanceInfo: {}
    }),
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    methods: {
        onSubmit() {
            if(this.sum){
                this.loading = true;
                this.step = 2;
                this.animated = true;
                axios.post(this.link , {'amount': + this.sum, '_token' : this.csrfToken}).then(response => {
                    if(response.status === 200){
                        setTimeout(() => {
                            this.balanceInfo = response.data
                            this.loading = false
                        }, 200);
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
