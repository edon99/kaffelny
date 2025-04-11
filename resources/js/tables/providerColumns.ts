import { Provider } from '@/types';
import { ColumnDef, createColumnHelper } from '@tanstack/vue-table';

const columnHelper = createColumnHelper<Provider>();

export const providerColumns: ColumnDef<Provider>[] = [
    columnHelper.group({
        header: 'Provider List',
        footer: props => props.column.id,
        columns: [
            columnHelper.accessor('name', {
                header: 'Name',
                cell: info => info.getValue(),
                footer: props => props.column.id,
            }),
            columnHelper.accessor('birthdate', {
                header: 'Birthdate',
                cell: info => new Date(info.getValue()).toLocaleDateString('fr-FR'),
                footer: props => props.column.id,
            }),
            columnHelper.accessor('gender', {
                header: 'Gender',
                cell: info => info.getValue()?.toString().toLowerCase(),
                footer: props => props.column.id,
            }),
            columnHelper.accessor('occupation', {
                header: 'Occupation',
                cell: info => info.getValue(),
                footer: props => props.column.id,
            }),


            columnHelper.accessor('email', {
                header: 'Email',
                cell: info => info.getValue(),
                footer: props => props.column.id,
            }),
            columnHelper.accessor('phone', {
                header: 'Phone',
                cell: info => info.getValue(),
                footer: props => props.column.id,
            }),

    columnHelper.accessor('pay_per_hour', {
        header: 'Pay / Hour',
        cell: (info) => info.getValue() ? `${info.getValue()} DA` : '—',
        footer: (props) => props.column.id,
    }),
    // Location
    columnHelper.display({
        id: 'actions',
        header:'Actions',
        cell: () => 'Actions',
    }),
        ],
    }),
];
