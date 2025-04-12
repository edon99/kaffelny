<script setup lang="ts">
import { ref } from 'vue'
import { Button } from '@/components/ui/button'
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog'
import { VMap, VMapMarker, VMapOsmTileLayer, VMapZoomControl } from 'vue-map-ui';

// import { VMap, VMapOsmTileLayer, VMapZoomControl, VMapMarker } from 'vue-leaflet'

const props = defineProps<{
    lat: string
    long: string
}>()

const latlng = ref([props.lat, props.long])
</script>

<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button variant="outline">
                Show Map
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-[800px]">
            <DialogHeader>
                <DialogTitle>Map Location</DialogTitle>
                <DialogDescription>
                    View the selected coordinates on an interactive map.
                </DialogDescription>
            </DialogHeader>
            <div class="w-full h-[400px] rounded overflow-hidden border">
                <VMap :center="latlng" :zoom="13" style="height: 100%; width: 100%">
                    <VMapOsmTileLayer />
                    <VMapZoomControl />
                    <VMapMarker
                        v-if="props.lat && props.long"
                        :latlng="latlng"
                    />
                </VMap>
            </div>

            <DialogFooter>
                <DialogTrigger>
                <Button @click="$emit('close')">Close</Button>
                </DialogTrigger>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
