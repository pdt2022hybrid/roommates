<template>
    <ion-card>
        <ion-card-header>
            <ion-card-title>
                {{ title }}
            </ion-card-title>
            <ion-card-subtitle>
                <img :src="this.getIcon()" alt="">
                {{ date }}
            </ion-card-subtitle>
        </ion-card-header>

        <ion-card-content>
            <span style="color: #2FDF75">BY: </span>{{ author }}
        </ion-card-content>
    </ion-card>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
export default defineComponent({
    name: "TaskCard",
    props: {
        title: String,
        date: String,
        priority: Number,
        author: String,
        icon: String
    },
    methods: {
        getIcon: function () {
            return require(`@/../resources/${this.icon}`);
        }
    }
})
</script>

<style scoped>
ion-card {
    text-align: left;
}
ion-card-header {
    display: flex;
    flex-flow: column-reverse;
}
ion-card-title {
    font-weight: 500;
    font-size: 14px;
    line-height: 16px;
    letter-spacing: 1.5px;
}
ion-card-subtitle {
    color: #EC445A;
}
</style>