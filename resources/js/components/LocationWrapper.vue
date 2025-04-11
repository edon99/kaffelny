
<script setup lang="ts">
import LocationActions from './LocationActions.vue';
import type { Offer } from '@/types';

const props = defineProps<{
    offer: Offer;
}>();
</script>

<template>
    <LocationActions :offer="offer" />
</template>
