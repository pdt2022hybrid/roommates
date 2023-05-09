<template>
    <ion-page>
        <top-bar title="Creating a task" :menu="false"></top-bar>
        <ion-content :fullscreen="true">
          <ion-header collapse="condense">
            <ion-toolbar>
              <ion-title size="large">Add Task</ion-title>
            </ion-toolbar>
          </ion-header>
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
