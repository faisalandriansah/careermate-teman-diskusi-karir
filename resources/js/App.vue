<template>
    <div id="app">
        <router-view />

        <Notivue v-slot="item">
            <NotivueSwipe :item="item">
                <Notification :item="item">
                    <NotificationProgress :item="item" />
                </Notification>
            </NotivueSwipe>
        </Notivue>
    </div>
</template>

<script setup>
import {
    Notivue,
    NotivueSwipe,
    Notification,
    NotificationProgress,
} from "notivue";
import "notivue/notification-progress.css";
</script>
