<template>
    <ion-page>
        <top-bar title="Creating a task" :menu="false"></top-bar>
        <ion-content :fullscreen="true">
          <div class="content">
            <ion-item>
              <ion-select aria-label="name" v-model="taskName" placeholder="Title">
                <div v-for="predefinedName in predefinedNames" :key="predefinedName" class="options">
                  <ion-select-option :value="predefinedName">{{ predefinedName }}</ion-select-option>
                </div>
              </ion-select>
            </ion-item>
            <ion-item :class="taskName == 'Other' ? 'd-block' : 'd-none'">
              <ion-label position="floating">Name of the task</ion-label>
              <ion-input v-model="otherName"></ion-input>
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
                <ion-select v-model="miniRoom" aria-label="fruit" placeholder="Choose room">
                  <div class="options" v-for="miniroom in minirooms" v-bind:key="miniroom">
                    <ion-select-option v-model="miniRoom" :value="miniroom.name">{{ miniroom.name }}</ion-select-option>
                  </div>
                </ion-select>
              </ion-item>
            </ion-list>
            <ion-item>
              <ion-label position="stacked">Description of the task</ion-label>
              <ion-input v-model="description" placeholder="Description"></ion-input>
            </ion-item>
            <p style="color: #EC445A;">{{ this.errorMsg }}</p>
            <div class="calendar">
              <ion-datetime :value="deadline" mode="ios" displayFormat="MM/DD/YYYY" pickerFormat="MM DD YYYY" v-model="deadline" class="date-time"></ion-datetime>
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
import { IonPage, IonContent, IonList, IonSelect, IonSelectOption, IonDatetime } from '@ionic/vue';
import { defineComponent } from 'vue';

export default defineComponent({
    components: {
      IonPage, IonContent, IonList, IonSelect, IonSelectOption, IonDatetime, TopBar
    },

    data() {
      return {
        otherName: null,
        taskName: null,
        assignTo: null,
        userAssignedId: null,
        description: null,
        statusId: 1,
        deadline: null,
        miniRoom: null,
        minirooms: JSON.parse(localStorage.getItem('miniRooms')),
        members: JSON.parse(localStorage.getItem('roomUsers')),
        miniroomId: null,
        errorMsg: '',
        predefinedNames: [
            'Other',
            'Cleaning',
            'Take out rubbish',
            'Buy groceries',
            'Unload the dishwasher',
            'Vacuum up',
            'Make dinner',
            'Make lunch',
            'Make breakfast',
        ]
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
          this.errorMsg = 'Please fill all fields, the description is optional';
          return;
        }
        /*if(this.description == null) {
          this.description = 'There is no descripton'
        }*/
        const data = {
          task_name: this.taskName == 'Other' ? this.otherName : this.taskName,
          task_description: this.description,
          deadline: this.deadline,
          miniroom_id: this.miniroomId,
          user_assigned_id: this.userAssignedId,
          status_id: this.statusId,
        }

        await axios.post('/v1/task/create', data, {headers: {
          Authorization: 'Bearer ' + localStorage.getItem('userToken')
        }});
        const oldTasks = JSON.parse(localStorage.getItem('roomTasks'));
        oldTasks.push(data);
        localStorage.setItem('roomTasks', oldTasks);
        this.taskName = this.assignTo = this.miniRoom = this.description = this.deadline = this.miniroomId = this.otherName = this.userAssignedId = null; //clear
        await store.dispatch('storeTasks');
        this.$events.emit('reloadTasks')
        this.$router.push('/tabs/home')
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

.custom-select-option::before {
  content: none;
}

.d-none {
  display: none !important;
}

.d-block {
  display: block;
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
