import { ColumnDef, createColumnHelper } from '@tanstack/vue-table';
import { Offer } from '@/types';
import { type Row } from '@tanstack/vue-table';
import LocationWrapper from '../components/LocationWrapper.vue';
import LocationActions from '../components/LocationActions.vue';
import { Button } from '@/components/ui/button';
import { resolveComponent,h } from 'vue';

const columnHelper = createColumnHelper<Offer>();

//
export const offerColumns: ColumnDef<Offer>[] = [
    {
        id: 'state',
        header: 'State',
        accessorKey: 'state',
        cell: info => info.getValue(),
        footer: props => props.column.id,
    },
    {
        id: 'service',
        header: 'Service',
        accessorKey: 'service',
        cell: info => info.getValue(),
        footer: props => props.column.id,
    },
    {
        id: 'hours',
        header: 'Hours',
        accessorKey: 'hours',
        cell: info => info.getValue(),
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
        id: 'user_id',
        header: 'User ID',
        accessorKey: 'user_id',
        cell: info => info.getValue() ?? '—',
        footer: props => props.column.id,
    },
    {
        id: 'provider_id',
        header: 'Provider ID',
        accessorKey: 'provider_id',
        cell: info => info.getValue() ?? '—',
        footer: props => props.column.id,
    },
    {
        id: 'created_at',
        header: 'Created At',
        accessorKey: 'created_at',
        cell: info => {
            const value = info.getValue()
            return value
                ? new Date(value).toLocaleDateString('fr-FR', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                }).replace(/\//g, '-')
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

