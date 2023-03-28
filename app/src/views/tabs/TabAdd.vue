<template>
    <ion-page>
        <top-bar title="Creating a task" :menu="false"></top-bar>
        <ion-content :fullscreen="true">
          <ion-header collapse="condense">
            <ion-toolbar>
              <ion-title size="large">Add Task</ion-title>
            </ion-toolbar>
          </ion-header>

          <ExploreContainer name="Tab 3 page" />
        </ion-content>
    </ion-page>
</template>

<script lang="ts">
import ExploreContainer from '@/components/ExploreContainer.vue';
import TopBar from '@/components/TopBar.vue';
import { defineComponent } from 'vue';

export default defineComponent({
    components: { ExploreContainer, TopBar },
});
</script>