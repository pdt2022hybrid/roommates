<template>
  <ion-icon @click="openModal()" class="menu-icon" :icon="require(`@/../resources/icon_filter.svg`)"/>
</template>

<script lang="ts">

import {
  placeholderMembers, taskFilterDateOptions, taskFilterMember, taskFilterImportance, TaskFilter,
  dateOptionsValue, TaskStatuses, taskFilterStatus
} from "@/types";
import {defineComponent} from "vue";
import {modalController} from "@ionic/vue";
import AFilterModal from '@/components/a-filter-modal.vue'

export default defineComponent({
  name: "TaskFilter",
  data() {
    const members: taskFilterMember[] = [];
    for (const o of placeholderMembers) {
      members.push({name: o, value: true});
    }
    const statuses: taskFilterStatus[] = [];
    for (const o of TaskStatuses) {
      statuses.push({status: o, value: true});
    }
    return {
      members,
      statuses,
      filter: {
        name: null
      }
    }
  },
  // computed() {
  //   filteredBlogs() {
  //     // this.blogs = [{name: 'asdasd'}, ....]
  //
  //     if (!this.filter)
  //         return this.blogs
  //
  //     let blogs = this.blogs
  //
  //     if (this.filter.name)
  //       blogs = blogs.filter(blog => blog.name == this.filter.name)
  //
  //     if (this.filter.author)
  //       blogs = blogs.filter(blog => blog.autor == this.filter.autor)
  //
  //     return blogs
  //   }
  //
  // },
  methods: {
    async openModal() {
      const modal = await modalController.create({
        component: AFilterModal,
        componentProps: {
          filter: this.filer
        }

      })

      await modal.present()

      const { data } = await modal.onDidDismiss()
      this.filter = data.filter
    },
    submit() {
      this.show = false;
      const dateOptions: taskFilterDateOptions = {
        createdDate: this.labelsDate.find(obj => {
          return obj.id === 'createdDate'
        }).value,
        promiseDate: this.labelsDate.find(obj => {
          return obj.id === 'promiseDate'
        }).value,
        cancelDate: this.labelsDate.find(obj => {
          return obj.id === 'cancelDate'
        }).value,
      };
      this.$emit('updateFilter', new TaskFilter(dateOptions, this.members, this.statuses, this.importanceSort));
    }
  },
  emits: ['updateFilter']
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

.menu-icon {
  color: black;
  width: 24px;
  height: 24px;
  float: left !important;
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