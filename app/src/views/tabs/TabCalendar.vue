<template>
    <ion-page>
        <top-bar title="Calendar" :menu="true"></top-bar>
        <ion-content :fullscreen="true">
          <ion-header collapse="condense">
            <ion-toolbar>
              <ion-title size="large">Calendar</ion-title>
            </ion-toolbar>
          </ion-header>
        </ion-content>
    </ion-page>
</template>

<script lang="ts">
import TopBar from '@/components/TopBar.vue';
import { defineComponent } from 'vue';

export default defineComponent({
    components: { TopBar },
});
</script>