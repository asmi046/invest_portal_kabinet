
<template>
    <p v-html="message"></p>
    <div v-show="isStart" class="btn-link__actions">
        <a v-show="showFl" href="#" class="btn fign_fl" @click.prevent="signFl">Подписать как физлицо</a>
        <a v-show="showUl" href="#" class="btn fign_ul" @click.prevent="signUl">Подписать как юридическое лицо</a>
    </div>
    <img v-show="showLoader" class="loader" :src="assetUrl + 'img/loader.svg'" alt="Загрузка">
    <p class="result_status" :class="{ 'error': resultStatusIsError, 'success': !resultStatusIsError }" v-show="showResultStatus">{{ resultMessage }}</p>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

var message = ref('Выберите тип подписания:');
var resultMessage = ref('');

const assetUrl = window.Laravel?.assetUrl || '/';
const storageUrl = window.Laravel?.storageUrl || '/storage/';

const props = defineProps({
    model: {
        type: String,
        required: true
    },
    documentId: {
        type: Number,
        required: true
    },
    user: {
        type: Object,
        required: true
    }
})

const isStart = ref(true);
const showLoader = ref(false);
const showResultStatus = ref(false);
const resultStatusIsError = ref(false);

const showFl= ref(false)
const showUl= ref(false)

const stopProcess = (is_error = false, message = "", e = null) => {
        resultMessage.value = message + (e ? e.message : '');
        resultStatusIsError.value = is_error;
        showResultStatus.value = true;
        showLoader.value = false;
        if (is_error) {
            console.error(message, e);
        } else {
            setTimeout(() => window.location.reload(), 1000);
        }
}

const signFl = () => {
    message.value = 'Подписание как физлицо:';
    isStart.value = false;
    showLoader.value = true;
    axios.get('/goskey/sign_fl', {
        params: {
            model: props.model,
            documentId: props.documentId
        }
    })
    .then(response => {
        stopProcess(false, 'Документ отправлен на подпись');
    })
    .catch(e => {
        stopProcess(true, 'Ошибка при подписании как физлицо: ', e);
    });
}

const signUl = () => {
    message.value = 'Подписание как юридическое лицо:';
    isStart.value = false;
    showLoader.value = true;
    axios.get('/goskey/sign_ul', {
        params: {
            model: props.model,
            documentId: props.documentId
        }
    })
    .then(response => {
        stopProcess(false, 'Документ отправлен на подпись');
    })
    .catch(e => {
        stopProcess(true, 'Ошибка при подписании как юрлицо: ', e);
    });
}

const whotShow = () => {
    if (props.user && props.user.role == "Физическое лицо") {
        showFl.value = true
    } else if (props.user && props.user.role == "Юридическое лицо") {
        showUl.value = true
    } if (props.user && props.user.role == "Сотрудник") {
        showFl.value = true
        if (props.user.ul_attorney) {
            showUl.value = true
        }
    }
}


onMounted(() => {
    whotShow()
})

</script>
