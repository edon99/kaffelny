import { ColumnDef, createColumnHelper } from '@tanstack/vue-table';
import { Offer } from '@/types';
import LocationActions from '../components/LocationActions.vue';
import { h } from 'vue';
import {serviceLabel, serviceColor} from '@/enums/ServiceEnum';
import {stateLabel, stateColor} from '@/enums/OfferStateEnum';
// const columnHelper = createColumnHelper<Offer>();

//
export const offerColumns: ColumnDef<Offer>[] = [
    {
        id: 'state',
        header: 'State',
        accessorKey: 'state',
        cell: info => h('span', { class: stateColor(info.getValue()) }, stateLabel(info.getValue())),
        footer: props => props.column.id,
    },
    {
        id: 'service',
        header: 'Service',
        accessorKey: 'service',
        cell: info => h('span', { class: serviceColor(info.getValue()) }, serviceLabel(info.getValue())),
        footer: props => props.column.id,
    },
    {
        id: 'hours',
        header: 'Hours',
        accessorKey: 'hours',
        cell: info => info.getValue()?? '—',
        footer: props => props.column.id,
    },
    {
        id: 'description',
        header: 'Description',
        accessorKey: 'description',
        cell: info => info.getValue() ?? '—',
        footer: props => props.column.id,
    },
  {
    id: 'location',
    header: 'Location',
      cell: ({row}) =>
          h(LocationActions,{ lat: row.original.lat, long: row.original.long,}),
    },
    {
        id: 'user',
        header: 'User',
        accessorKey: 'user',
        cell: info => info.getValue()?.name ?? '—',
        footer: props => props.column.id,
    },
    {
        id: 'provider',
        header: 'Provider',
        accessorKey: 'provider',
        cell: info => info.getValue()?.name ?? '—',
        footer: props => props.column.id,
    },
    {
        id: 'created_at',
        header: 'Created At',
        accessorKey: 'created_at',
        cell: info => {
            const value = info.getValue()
            return value
                ? new Date(value).toLocaleDateString('fr-FR', ).replace(/\//g, '-')
                : '—'
        },
        footer: props => props.column.id,
    },
    {
        id: 'actions',
        header: 'Actions',
        // Custom display column
        cell: () => 'Actions',
    },



];

