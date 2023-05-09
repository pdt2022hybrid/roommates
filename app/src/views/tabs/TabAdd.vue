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
            </ion-button>
          </div>
        </ion-content>
    </ion-page>
</template>

<script lang="ts">
import TopBar from '@/components/TopBar.vue';
import { defineComponent } from 'vue';

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
