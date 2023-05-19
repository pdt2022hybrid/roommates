import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { store, key } from './store';
import axios from "axios";
import { IonicVue } from '@ionic/vue';
import { IonPage, IonContent, IonItem, IonGrid, IonRow, IonCol, IonButton, IonIcon, IonLabel, IonInput, IonTitle, IonHeader, IonToolbar, IonList, IonTabButton, IonTabs, IonCard, IonCardHeader, IonCardTitle, IonCardSubtitle, IonCardContent, IonSelect, IonSelectOption, IonCheckbox, IonRadio, IonRadioGroup } from '@ionic/vue';


/* Core CSS required for Ionic components to work properly */
import '@ionic/vue/css/core.css';

/* Basic CSS for apps built with Ionic */
import '@ionic/vue/css/normalize.css';
import '@ionic/vue/css/structure.css';
import '@ionic/vue/css/typography.css';

/* Nase vlastne CSS */
import './theme/main.css'


/* Optional CSS utils that can be commented out */
import '@ionic/vue/css/padding.css';
import '@ionic/vue/css/float-elements.css';
import '@ionic/vue/css/text-alignment.css';
import '@ionic/vue/css/text-transformation.css';
import '@ionic/vue/css/flex-utils.css';
import '@ionic/vue/css/display.css';

/* Theme variables */
import './theme/variables.css';
import './theme/global.css';

const app = createApp(App)
    .use(IonicVue, {
        mode: 'ios'
    })
    .use(store, key)
    .use(router)
    .component("ion-page", IonPage)
    .component("ion-content", IonContent)
    .component("ion-item", IonItem)
    .component("ion-grid", IonGrid)
    .component("ion-row", IonRow)
    .component("ion-col", IonCol)
    .component("ion-button", IonButton)
    .component("ion-icon", IonIcon)
    .component("ion-label", IonLabel)
    .component("ion-input", IonInput)
    .component("ion-title", IonTitle)
    .component("ion-header", IonHeader)
    .component("ion-toolbar", IonToolbar)
    .component("ion-list", IonList)
    .component("ion-tab-button", IonTabButton)
    .component("ion-tabs", IonTabs)
    .component("ion-card", IonCard)
    .component("ion-card-header", IonCardHeader)
    .component("ion-card-title", IonCardTitle)
    .component("ion-card-subtitle", IonCardSubtitle)
    .component("ion-card-content", IonCardContent)
    .component("ion-select", IonSelect)
    .component("ion-select-option", IonSelectOption)
    .component("ion-checkbox", IonCheckbox)
    .component("ion-radio", IonRadio)
    .component("ion-radio-group", IonRadioGroup)

router.isReady().then(() => app.mount('#app'));

axios.defaults.baseURL = process.env.VUE_APP_AXIOS_URL;
app.config.globalProperties.$axios = axios;
