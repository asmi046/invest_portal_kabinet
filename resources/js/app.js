import './bootstrap';
import './v-script.js';

import {createApp} from 'vue/dist/vue.esm-bundler'
import GoskeySignPanel from "./components/GoskeySignPanel.vue"
import GoskeySignProcess from "./components/GoskeySignProcess.vue"
import axios from 'axios'
import VueAxios from 'vue-axios'

    const goskey_app = createApp({
        components:{
            GoskeySignPanel,
            GoskeySignProcess
        },
        setup() {}
    })

    goskey_app.use(VueAxios, axios)
    goskey_app.mount("#goskey_app");
