<template>
    <ion-page>
        <top-bar title="Place Tasks" :menu="true"></top-bar>
        <ion-content :fullscreen="true">
          <ion-header collapse="condense">
            <ion-toolbar>
              <ion-title size="large">Tasks</ion-title>
            </ion-toolbar>
          </ion-header>

          <ExploreContainer name="Tab 2 page" />
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