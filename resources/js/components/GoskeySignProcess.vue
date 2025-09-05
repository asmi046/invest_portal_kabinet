<template>
  <div class="status_line">
    <img v-show="show_loader" class="loader" :src="assetUrl + 'img/loader.svg'" alt="Загрузка">
    <p v-if="status !== null">
        Статус: <span class="state" :class="{'error': error_code != null, 'success': status_code == 100}">{{ status }}</span>
    </p>
  </div>
  <div class="sign_files">
        <div v-for="(file, index) in sign_files" :key="index" class="file">
            <a :href="'/goskey/download/'+ file.signed_file" target="_blank" class="sign_file_link">Подписанный файл (#{{ index + 1 }})</a>
            <a :href="'/goskey/download/'+ file.signature" target="_blank" class="sign_file_link">Подпись (#{{ index + 1 }})</a>
        </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import axios from 'axios';

const props = defineProps({
  messageId: {
    type: String,
    required: true
  }
});

const assetUrl = window.Laravel?.assetUrl || '/';
const storageUrl = window.Laravel?.storageUrl || '/storage/';


const status = ref(null);
const status_code = ref(null);
const error_code = ref(null);
const show_loader = ref(true);
const sign_files = ref([]);
let intervalId = null;


const fetchStatus = () => {
    axios.get('/goskey/get_sign_state', {
        params: { message_id: props.messageId }
    }).then(response => {
            if ('status' in response.data) {
                console.log(response.data);
                status.value = response.data.status;
                status_code.value = response.data.status_code;
                error_code.value = response.data.error_code;

            } else {
                status.value = null;
                status_code.value = null;
                error_code.value = null;
            }


            if (status_code.value == 100 || error_code.value != null) {
                clearInterval(intervalId);

                sign_files.value = JSON.parse(response.data.signatures);
                console.log(sign_files.value);
                show_loader.value = false;
            }
        })
        .catch(() => {
            status.value = 'Ошибка проверки статуса';
        });
}

onMounted(() => {
  fetchStatus();
  intervalId = setInterval(fetchStatus, 3000);
});

onUnmounted(() => {
  if (intervalId) clearInterval(intervalId);
});
</script>
