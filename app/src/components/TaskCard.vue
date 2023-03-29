<template>
    <ion-card>
        <ion-card-header>
            <ion-card-title>
                {{ title }}
            </ion-card-title>
            <ion-card-subtitle>
                <img src="@/../resources/room_living.svg">
                {{ date }}
            </ion-card-subtitle>
        </ion-card-header>

        <ion-card-content>
            <span style="color: #2FDF75">BY: </span>{{ author }}
        </ion-card-content>
    </ion-card>
</template>

<script>
import { defineComponent } from 'vue';
export default defineComponent({
    name: "TaskCard",
    props: {
        title: String,
        date: String,
        priority: Number,
        author: String

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