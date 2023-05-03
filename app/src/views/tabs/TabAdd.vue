<template>
    <ion-page>
<<<<<<< Updated upstream
        <top-bar title="Creating a task" :menu="false"></top-bar>
        <ion-content :fullscreen="true">
          <ion-header collapse="condense">
            <ion-toolbar>
              <ion-title size="large">Add Task</ion-title>
            </ion-toolbar>
          </ion-header>

          <ExploreContainer name="Tab 3 page" />
=======
      <ion-header class="header">
        <ion-toolbar>
          <router-link to="/login">
            <ion-icon :icon="chevronBackOutline"></ion-icon>
          </router-link>
          <ion-title>
            Creating a task
          </ion-title>
        </ion-toolbar>
      </ion-header>

        <ion-content fullscreen>
          <div class="content">
            <ion-item>
              <ion-label position="stacked">Name of the task</ion-label>
              <ion-input v-model="taskName" placeholder="Write here a name of the task..."></ion-input>
            </ion-item>
            <ion-list>
              <ion-item>
                <ion-select aria-label="fruit" placeholder="Select fruit">
                  <ion-select-option value="apples">Apples</ion-select-option>
                  <ion-select-option value="oranges">Oranges</ion-select-option>
                  <ion-select-option value="bananas">Bananas</ion-select-option>
                </ion-select>
              </ion-item>
            </ion-list>
          </div>
          <div class="bottom">
            <ion-button v-on:click="createTask()">
              Create a task
            </ion-button>
          </div>
>>>>>>> Stashed changes
        </ion-content>

    </ion-page>
</template>

<<<<<<< Updated upstream
<script lang="ts">
import ExploreContainer from '@/components/ExploreContainer.vue';
import TopBar from '@/components/TopBar.vue';
=======
<script>
import { IonPage, IonContent, IonItem, IonList, IonSelect, IonSelectOption, IonHeader,IonTitle, IonIcon, IonToolbar } from '@ionic/vue';
import { chevronBackOutline } from 'ionicons/icons';

>>>>>>> Stashed changes
import { defineComponent } from 'vue';
import axios from "axios";

export default defineComponent({
<<<<<<< Updated upstream
    components: { ExploreContainer, TopBar },
=======
    components: {
      IonPage, IonContent, IonIcon, IonToolbar, IonTitle, IonHeader, IonList, IonSelect, IonSelectOption
    },

    data() {
      return {
        chevronBackOutline,
        taskName: '',
        assignTo: '',
        description: '',
        deadline: '',
      }
    },
  methods: {
    async createTask() {
      const response = await axios.get('https://roomates.hybridlab.dev/cms/api/v1/user', {headers: {
        Authorization: localStorage.getItem('userToken')
        }})
      console.log(response)
    }
  },
>>>>>>> Stashed changes
});
</script>

<style scoped>

.header {
  background-color: white;
  padding: 16px
}

a {
  color: #262B2C !important;
  text-decoration: none;
}

.content {
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.bottom {
  position: absolute;
  top: 70%;
  left: 50%;
  transform: translate(-50%, -50%);
}

d-none {
  display: none;
}

.row {
  display: flex;
  width: 100%;
}

.header-md::after {
  display: none;
}

ion-toolbar {
  --border-width: 0px;
  --border-style: none;
  --background: white;
}

ion-toolbar > ion-title {
  color: #989AA2;
  font-weight: 600;
  font-size: 18px !important;
}

ion-content > ion-title {
  color: #262B2C;
  font-size: 24px;
  font-weight: 600;
}

ion-item {
  font-family: 'Roboto', sans-serif;
  --ion-border-color: #C6C6C8;
  padding-right: 16px;
  width: 100vw;
}

ion-icon {
  color: black;
  width: 24px;
  height: 24px;
  float: left !important;
}

ion-button {
  width: 200px !important;
  height: 48px;
  font-weight: 700 !important;
  --border-color: #262B2C;
  --border-radius: 20px;
  --border-width: 0.5px;
  color: #FFFFFF;
  text-transform: none;
  font-size: 17px;
}

ion-label {
  font-family: 'Roboto', sans-serif;
  font-size: 12px !important;
  color: #3C3C43;
  opacity: 60%;
}

</style>