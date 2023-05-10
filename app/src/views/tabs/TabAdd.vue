<template>
    <ion-page>

        <top-bar title="Creating a task" :menu="false"></top-bar>
        <ion-content :fullscreen="true">
          <div class="content">
            <ion-item>
              <ion-label position="stacked">Name of the task</ion-label>
              <ion-input v-model="taskName" placeholder="Write here a name of the task..."></ion-input>
            </ion-item>
            <ion-list>
              <ion-item>
                <ion-select aria-label="fruit" placeholder="Assign to a roomate">
                  <div class="options" v-for="member in members" v-bind:key="member">
                    <ion-select-option value="member">{{ member }}</ion-select-option>
                  </div>
                </ion-select>
              </ion-item>
            </ion-list>
            <ion-list>
              <ion-item>
                <ion-select aria-label="fruit" placeholder="Pre defined tasks">
                  <ion-select-option value="apples">Cleaning</ion-select-option>
                  <ion-select-option value="oranges">Take out the rubish</ion-select-option>
                  <ion-select-option value="bananas">Buy groceries</ion-select-option>
                </ion-select>
              </ion-item>
            </ion-list>
            <div class="calendar">
              <ion-datetime class="date-time"></ion-datetime>
            </div>
          </div>
          <div class="bottom">
            <ion-button v-on:click="createTask()">
              Create a task
              apwjd
            </ion-button>
          </div>
        </ion-content>
    </ion-page>
</template>

<script>
import { IonPage, IonContent, IonList, IonSelect, IonSelectOption, IonDatetime } from '@ionic/vue';
import { chevronBackOutline } from 'ionicons/icons';
import TopBar from "@/components/TopBar.vue";

import { defineComponent } from 'vue';
import axios from "axios";

export default defineComponent({
    components: {
      IonPage, IonContent, IonList, IonSelect, IonSelectOption, IonDatetime, TopBar
    },

    data() {
      return {
        chevronBackOutline,
        taskName: '',
        assignTo: '',
        description: '',
        deadline: '',
        members: ['jeden', 'dva', 'tri']
      }
    },
  methods: {
    async createTask() {
      const response = await axios.get('https://roomates.hybridlab.dev/cms/api/v1/user', {headers: {
        Authorization: localStorage.getItem('userToken')
        }})
      console.log(response);
    }
  },
});
</script>

<style scoped>

a {
  color: #262B2C !important;
  text-decoration: none;
}

d-none {
  display: none;
}

.row {
  display: flex;
  width: 100%;
}

.calendar {
  margin-top: 2rem;
  margin-bottom: 1rem;
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