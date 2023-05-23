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
                <ion-select v-model="this.assignTo" aria-label="fruit" placeholder="Assign to a roommate">
                  <div class="options" v-for="member in members" v-bind:key="member">
                    <ion-select-option :value="member.name">{{ member.name }}</ion-select-option>
                  </div>
                </ion-select>
              </ion-item>
            </ion-list>
            <ion-list>
              <ion-item>
                <ion-select v-model="miniRoom" aria-label="fruit" placeholder="Which room">
                  <div class="options" v-for="miniroom in minirooms" v-bind:key="miniroom">
                    <ion-select-option v-model="miniRoom" :value="miniroom.name">{{ miniroom.name }}</ion-select-option>
                  </div>
                </ion-select>
              </ion-item>
            </ion-list>
            <ion-list>
              <ion-item>
                <ion-select aria-label="fruit" placeholder="Pre defined tasks">
                  <ion-select-option value="Cleaning">Cleaning</ion-select-option>
                  <ion-select-option value="Rubish">Take out the rubish</ion-select-option>
                  <ion-select-option value="Buy Groceries">Buy groceries</ion-select-option>
                </ion-select>
              </ion-item>
            </ion-list>
            <ion-item>
              <ion-label position="stacked">Description of the task</ion-label>
              <ion-input v-model="description" placeholder="Add description"></ion-input>
            </ion-item>
            <div class="calendar">
              <ion-datetime :value="new Date()" mode="ios" displayFormat="MM/DD/YYYY" pickerFormat="MM DD YYYY" v-model="deadline" class="date-time"></ion-datetime>
            </div>
            <div class="row">
              <ion-chip @click="() => this.statusId = 3" :color="statusId == 3 ? 'success' : 'dark'">Completed</ion-chip>
              <ion-chip @click="this.statusId = 2" :color="statusId == 2 ? 'warning' : 'dark'">In progress</ion-chip>
              <ion-chip @click="this.statusId = 1" :color="statusId == 1 ? 'medium' : 'dark'">Not started</ion-chip>
            </div>
          </div>
          <div class="bottom">
            <ion-button v-on:click="createTask()">
              Create a task
            </ion-button>
          </div>
        </ion-content>
    </ion-page>
</template>

<script lang="ts">
import TopBar from '@/components/TopBar.vue';
import {store} from "@/store";
import axios from "axios";
import { IonPage, IonContent, IonList, IonChip, IonSelect, IonSelectOption, IonDatetime } from '@ionic/vue';
import { defineComponent } from 'vue';

export default defineComponent({
    components: {
      IonPage, IonContent, IonList, IonSelect, IonSelectOption, IonDatetime, TopBar, IonChip
    },

    data() {
      return {
        taskName: null,
        assignTo: null,
        userAssignedId: null,
        description: null,
        statusId: null,
        deadline: null,
        miniRoom: null,
          minirooms: JSON.parse(localStorage.getItem('miniRooms')),
        members: JSON.parse(localStorage.getItem('roomUsers')),
        miniroomId: null,
      }
    },
  methods: {
      createTask: async function () {
        for (let i = 0; i <  this.minirooms.length; i++) {
          if(this.miniRoom == this.minirooms[i].name) {
            this.miniroomId = this.minirooms[i].id
          }
        }
        for (let i = 0; i < this.members.length; i++) {
          if(this.assignTo == this.members[i].name) {
            this.userAssignedId = this.members[i].id
          }
        }
        if(this.taskName == null || this.deadline == null || this.miniroomId == null || this.assignTo == null || this.statusId == null) {
          alert('Please fill all fields, the description is optional....');
          return;
        }
        if(this.description == null) {
          this.description == 'There is no descripton'
        }
        const data = {
          task_name: this.taskName,
          task_description: this.description,
          deadline: this.deadline,
          miniroom_id: this.miniroomId,
          user_assigned_id: this.userAssignedId,
          status_id: this.statusId,
        }
        await axios.post('/v1/task/create', data, {headers: {
          Authorization: 'Bearer ' + localStorage.getItem('userToken')
          }})
        const oldTasks = JSON.parse(localStorage.getItem('roomTasks'))
        oldTasks.push(data)
        localStorage.setItem('roomTasks', oldTasks)
        await store.dispatch('storeTasks')
        this.$events.emit('reloadTasks')
        this.$router.push({path: '/tabs/home'})
    }
  },

  async mounted() {

    this.minirooms = JSON.parse(localStorage.getItem('miniRooms'))
    this.members = JSON.parse(localStorage.getItem('roomUsers'))
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

.calendar {
  margin-top: 2rem;
  margin-bottom: 1rem;
  display: flex;
  justify-content: center;
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

:root {
  --ion-color-rose: #3171e0;
  --ion-color-rose-rgb: 131, 24, 67;
  --ion-color-rose-contrast: #ffffff;
  --ion-color-rose-contrast-rgb: 255, 255, 255;
  --ion-color-rose-shade: #73153b;
  --ion-color-rose-tint: #8f2f56;

  --ion-text-color: #881337;
  --ion-text-color-rgb: 136, 19, 55;

  --ion-color-step-50: #f9e6e9;
  --ion-color-step-100: #f3dbdf;
  --ion-color-step-150: #edd0d6;
  --ion-color-step-200: #e7c5cd;
  --ion-color-step-250: #e1bac3;
  --ion-color-step-300: #dbaeba;
  --ion-color-step-350: #d5a3b1;
  --ion-color-step-400: #cf98a7;
  --ion-color-step-450: #c98d9e;
  --ion-color-step-500: #c48295;
  --ion-color-step-550: #be778b;
  --ion-color-step-600: #b86c82;
  --ion-color-step-650: #b26178;
  --ion-color-step-700: #ac566f;
  --ion-color-step-750: #a64b66;
  --ion-color-step-800: #a03f5c;
  --ion-color-step-850: #9a3453;
  --ion-color-step-900: #94294a;
  --ion-color-step-950: #8e1e40;
}

.ion-color-rose {
  --ion-color-base: var(--ion-color-rose);
  --ion-color-base-rgb: var(--ion-color-rose-rgb);
  --ion-color-contrast: var(--ion-color-rose-contrast);
  --ion-color-contrast-rgb: var(--ion-color-rose-contrast-rgb);
  --ion-color-shade: var(--ion-color-rose-shade);
  --ion-color-tint: var(--ion-color-rose-tint);
}

ion-datetime {
  --background: #fff1f2;
  --background-rgb: 255, 241, 242;

  border-radius: 16px;
  box-shadow: rgba(var(--ion-color-rose-rgb), 0.3) 0px 10px 15px -3px;
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
