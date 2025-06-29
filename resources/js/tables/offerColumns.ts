import { ColumnDef, createColumnHelper } from '@tanstack/vue-table';
import { Offer } from '@/types';
import LocationActions from '../components/LocationActions.vue';
import { h } from 'vue';
import {serviceLabel, serviceColor} from '@/enums/ServiceEnum';
import {stateLabel, stateColor} from '@/enums/OfferStateEnum';


const columnHelper = createColumnHelper<Offer>();
export const offerColumns = [
    columnHelper.accessor('state', {
        id: 'state',
        header: 'State',
        cell: info => h('span', { class: stateColor(info.getValue()) }, stateLabel(info.getValue())),
        footer: props => props.column.id,
    }),
    columnHelper.accessor('service', {
        id: 'service',
        header: 'Service',
        size: 200,
        cell: info => h('span', { class: serviceColor(info.getValue()) }, serviceLabel(info.getValue())),
        footer: props => props.column.id,
    }),
    columnHelper.accessor('hours', {
        id: 'hours',
        header: 'Hours',
        cell: info => info.getValue() ?? '—',
        footer: props => props.column.id,
    }),
    columnHelper.accessor('description', {
        id: 'description',
        header: 'Description',
        size: 600,
        cell: info => info.getValue() ?? '—',
        footer: props => props.column.id,
    }),
    columnHelper.display({
        id: 'location',
        header: 'Location',
        cell: ({ row }) =>
            h(LocationActions, {
                lat: row.original.lat,
                long: row.original.long,
            }),
    }),
    columnHelper.accessor('user', {
        id: 'user',
        header: 'User',
        cell: info => info.getValue()?.name ?? '—',
        footer: props => props.column.id,
    }),
    columnHelper.accessor('provider', {
        id: 'provider',
        header: 'Provider',
        cell: info => info.getValue()?.name ?? '—',
        footer: props => props.column.id,
    }),
    columnHelper.accessor('created_at', {
        id: 'created_at',
        header: 'Created At',
        cell: info => new Date(info.getValue()).toLocaleDateString('fr-FR'),
        footer: props => props.column.id,
    }),
    columnHelper.display({
        id: 'actions',
        header: 'Actions',
        cell: () => 'Actions',
    }),
];

