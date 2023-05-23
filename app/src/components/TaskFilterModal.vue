<template>
    <ion-content :fullscreen="true">
      <ion-card class="title-card">
        <ion-card-header>
          <ion-card-title>
            <ion-grid>
              <ion-row>
                <ion-col size="auto">
                  <ion-icon @click="closeModal()" :icon="close" style="font-size: 24px;"></ion-icon>
                </ion-col>
                <ion-col class="title">
                  Filters
                </ion-col>
              </ion-row>
            </ion-grid>
          </ion-card-title>
        </ion-card-header>
      </ion-card>
      <p class="subtitle">Date</p>
      <ion-item v-for="sel in labelsDate" :key="sel">
        <ion-label label-placement="fixed">{{ sel.label }}</ion-label>
        <ion-select v-model="sel.value" interface="popover" justify="space-between" :placeholder="optionsDate[0].text">
          <ion-select-option v-for="o in optionsDate" :key="o" :value="o.id">{{ o.text }}</ion-select-option>
        </ion-select>
      </ion-item>
      <p class="subtitle">Roommate</p>
      <ion-item v-for="roommate in membersFilter" :key="roommate">
        <ion-label>{{ roommate.name }}</ion-label>
        <ion-checkbox v-model="roommate.value" justify="space-between"></ion-checkbox>
      </ion-item>
      <p class="subtitle">Status</p>
      <ion-item v-for="status in statuses" :key="status">
        <ion-label>{{ status.status }}</ion-label>
        <ion-checkbox v-model="status.value" justify="space-between"></ion-checkbox>
      </ion-item>
    </ion-content>
</template>

<script lang="ts">
import {
  placeholderMembers, taskFilterDateOptions, taskFilterMember, taskFilterImportance, TaskFilter,
  dateOptionsValue, DefaultTaskFilterStatuses, taskFilterStatus
} from "@/types";
import {close} from 'ionicons/icons';
import {defineComponent} from "vue";
import {modalController} from "@ionic/vue";
import {store} from "@/store";

export default defineComponent({
  props: {
    filter: {
      type: Object,
      required: true
    }
  },

  data() {
    return {
      modalFilter: {},
      members: [],
      membersFilter: [],
      statuses: DefaultTaskFilterStatuses,
      close,
      optionsDate: [
        {id: 'any', text: "Any"},
        {id: 'newest', text: "Newest"},
        {id: 'oldest', text: "Oldest"},
      ],
      labelsDate: [
        {id: 'createdDate', label: "Task created", value: 'any' as dateOptionsValue},
        {id: 'promiseDate', label: "Promise date", value: 'any' as dateOptionsValue},
        {id: 'cancelDate', label: "Auto cancel date", value: 'any' as dateOptionsValue},
      ]
    }
  },

  async mounted() {
    this.modalFilter = this.filter;
    await store.dispatch('storeUsers');
    this.members = JSON.parse(localStorage.getItem('roomUsers'));
    for (const member of this.members) {
      const val = !this.modalFilter.members.find(o => o.id === member.id)
      this.membersFilter.push({id: member.id, name: member.name, value: val});
    }
    this.labelsDate[this.labelsDate.findIndex(o => o.id === 'createdDate')].value =
        this.modalFilter.dateOptions.createdDate;
    this.statuses = this.modalFilter.status;
  },

  methods: {
    closeModal() {
      const dateOptions: taskFilterDateOptions = {
        createdDate: this.labelsDate.find(obj => {return obj.id === 'createdDate'}).value,
        promiseDate: this.labelsDate.find(obj => {return obj.id === 'promiseDate'}).value,
        cancelDate: this.labelsDate.find(obj => {return obj.id === 'cancelDate'}).value,
      };
      const memberFilterIds: taskFilterMember[] = [];
      for(const o of this.membersFilter) {
        if(o.value === false) memberFilterIds.push({name: o.name, id: o.id});
      }
      modalController.dismiss({
        filter: new TaskFilter(dateOptions, memberFilterIds, this.statuses)
      })
    }
  }
})
</script>

<style scoped>
body {
    font-family: 'Noto Sans', sans-serif;
    font-style: normal;
}

.overlay {
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    position: fixed;
    -webkit-overflow-scrolling: touch;
}

.title {
    margin-left: 6.4vw;
    font-weight: 500;
    font-size: 20px;
    line-height: 120%;
    color: #222428;
}

.title-card {
    margin-top: 3.5vh;
}

.subtitle {
    font-weight: 400;
    font-size: 20px;
    line-height: 24px;
    text-align: left;
    margin-left: 7.6vw;
}

ion-select {
    max-width: 100% !important;
}

p {
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
}

ion-card-title {
    margin: 0 auto;
    text-align: left;
}

ion-grid, ion-col {
    padding: 0;
}
</style>